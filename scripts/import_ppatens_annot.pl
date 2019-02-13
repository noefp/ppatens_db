#!/usr/bin/perl

use strict;
use warnings;

use DBI;
use Term::ReadKey;

# check arguments and print usage
if (scalar(@ARGV) != 2) {
	print "Usage: perl import_ppatens_annot.pl <annot_file> <phytozome_annot_trimmed>\n";
	exit;
}

# save arguments in variables
my ($annot_file,$phytozome_file) = @ARGV;


sub insert_gene {
	my $dbh = shift;
	my $gene_name = shift;
	my $gene_version = shift;
	my $my_gene_id;

	# check if entry already exist and import it to the database
	my $sth = $dbh->prepare("SELECT gene_id FROM gene WHERE gene_name = \'$gene_name\'");
	$sth->execute() or die $sth->errstr;

	my @gene_id = $sth->fetchrow_array();

	if (@gene_id) {
	  #print "\n $gene_name already exists in gene table: ".$gene_id[0]."\n";
		$my_gene_id = $gene_id[0];
	} else {
		# print "$gene_name\tV$gene_version\n";

	  $sth = $dbh->prepare("INSERT INTO gene (gene_name,genome_version) VALUES (\'$gene_name\',\'$gene_version\')");
	  $sth->execute() or die $sth->errstr;
		$sth = $dbh->prepare("SELECT gene_id FROM gene WHERE gene_name = \'$gene_name\'");
		$sth->execute() or die $sth->errstr;

		(my @gene_id) = $sth->fetchrow_array();

		# print $gene_id[0]."\n";
		$my_gene_id = $gene_id[0];
		$sth->finish();
	}

  return $my_gene_id;
}

sub insert_gene_gene {
	my $dbh = shift;
	my $gene_id1 = shift;
	my $gene_id2 = shift;

	# check if entry already exist and import it to the database
	my $sth = $dbh->prepare("SELECT gene_gene_id FROM gene_gene WHERE gene_id1 = '".$gene_id1."' AND gene_id2 = '".$gene_id2."'");
	$sth->execute() or die $sth->errstr;

	my ($gene_gene_id) = $sth->fetchrow_array();

	if ($gene_gene_id) {
	 # print "\n $gene_id1-$gene_id2 already exists in gene_gene table: $gene_gene_id\n";
	} else {
	  $sth = $dbh->prepare("INSERT INTO gene_gene (gene_id1,gene_id2) VALUES ('".$gene_id1."','".$gene_id2."')");
	  $sth->execute() or die $sth->errstr;
		$sth->finish();
	}
}

sub insert_go {
	my $dbh = shift;
	my $go_term_str = shift;
	my $go_desc_str = shift;
	my $go_type = shift;
	my $gene_id = shift;

	# to remove special character that crush the SQL import code
	$go_desc_str =~ s/[\'\"]//g;

	my @go_array = split(":",$go_term_str);
	my @go_desc_array = split(":",$go_desc_str);
	my $go_term;
	my $go_desc;
	my $my_annot_id;


	for (my $i = 0; $i < scalar(@go_array); $i++) {
		$go_term = $go_array[$i];
		$go_desc = $go_desc_array[$i];

		if ($go_type =~ /^GO/) {
			my $go_length = 7 - length($go_term);
			my $zeroes = "0" x $go_length;
			# print "zeroes: $zeroes, go_term: $go_term\n";

			$go_term =~ s/^/GO:$zeroes/;

			# print "go_term: $go_term\n";
		}

		# check if entry already exist and import it to the database
		my $sth = $dbh->prepare("SELECT annotation_id FROM annotation WHERE annot_term = \'$go_term\'");
		$sth->execute() or die $sth->errstr;

		my @annot_id = $sth->fetchrow_array();

		if (@annot_id) {
			#print "\n $go_term already exists in gene table: ".$annot_id[0]."\n";
			$my_annot_id = $annot_id[0];
		} else {
			# print "$go_term\t$go_desc\n";

			$sth = $dbh->prepare("INSERT INTO annotation (annot_term,annot_desc,annot_type) VALUES (\'$go_term\',\'$go_desc\',\'$go_type\')");
			$sth->execute() or die $sth->errstr;
			$sth = $dbh->prepare("SELECT annotation_id FROM annotation WHERE annot_term = \'$go_term\'");
			$sth->execute() or die $sth->errstr;

			(my @annot_id) = $sth->fetchrow_array();

			# print $gene_id[0]."\n";
			$my_annot_id = $annot_id[0];
			$sth->finish();
		}

		# check if entry already exist and import it to the database
		$sth = $dbh->prepare("SELECT gene_annotation_id FROM gene_annotation WHERE gene_id = '".$gene_id."' AND annotation_id = '".$my_annot_id."'");
		$sth->execute() or die $sth->errstr;

		my ($gene_annotation_id) = $sth->fetchrow_array();

		if ($gene_annotation_id) {
			#print "\n $gene_id-$my_annot_id already exists in gene_annotation table: gene_annotation_id\n";
		} else {
			$sth = $dbh->prepare("INSERT INTO gene_annotation (gene_id,annotation_id) VALUES ('".$gene_id."','".$my_annot_id."')");
			$sth->execute() or die $sth->errstr;
			$sth->finish();
		}

	} # end for loop

}

sub insert_annot {
	my $dbh = shift;
	my $go_term = shift;
	my $go_desc = shift;
	my $go_type = shift;
	my $gene_id = shift;

	my $my_annot_id;

	# to remove special character that crush the SQL import code
	if ($go_desc) {
		$go_desc =~ s/[\'\"]//g;
	}

	if ($go_type eq "TAIR") {
		$go_term =~ s/ARATHwo_//;
	}
	if ($go_type eq "TAIR") {
		$go_desc =~ s/Has \d+ Blast hits to \d+ proteins in \d+ species:.+\(source: NCBI BLink\)\.//;
	}
	if ($go_type eq "NCBI Nr") {
		$go_desc =~ s/^PREDICTED: //;
	}

	# check if entry already exist and import it to the database
	my $sth = $dbh->prepare("SELECT annotation_id FROM annotation WHERE annot_term = \'$go_term\'");
	$sth->execute() or die $sth->errstr;

	my @annot_id = $sth->fetchrow_array();

	if (@annot_id) {
		#print "\n $go_term already exists in gene table: ".$annot_id[0]."\n";
		$my_annot_id = $annot_id[0];
	} else {
		# print "$go_term\t$go_desc\n";

		$sth = $dbh->prepare("INSERT INTO annotation (annot_term,annot_desc,annot_type) VALUES (\'$go_term\',\'$go_desc\',\'$go_type\')");
		$sth->execute() or die $sth->errstr;
		$sth = $dbh->prepare("SELECT annotation_id FROM annotation WHERE annot_term = \'$go_term\'");
		$sth->execute() or die $sth->errstr;

		(my @annot_id) = $sth->fetchrow_array();

		# print $gene_id[0]."\n";
		$my_annot_id = $annot_id[0];
		$sth->finish();
	}

	# check if entry already exist and import it to the database
	$sth = $dbh->prepare("SELECT gene_annotation_id FROM gene_annotation WHERE gene_id = '".$gene_id."' AND annotation_id = '".$my_annot_id."'");
	$sth->execute() or die $sth->errstr;

	my ($gene_annotation_id) = $sth->fetchrow_array();

	if ($gene_annotation_id) {
		#print "\n $gene_id-$my_annot_id already exists in gene_annotation table: gene_annotation_id\n";
	} else {
		$sth = $dbh->prepare("INSERT INTO gene_annotation (gene_id,annotation_id) VALUES ('".$gene_id."','".$my_annot_id."')");
		$sth->execute() or die $sth->errstr;
		$sth->finish();
	}

}




my $dbname="pp_annot6";
my $host="localhost";
my $username="postgres";

print "Password> ";
ReadMode 'noecho';  # Disable echoing
my $password=<STDIN>;
ReadMode 'original';   # Turn it back on

print "\n";
chomp($password);

my $dbh = DBI->connect("dbi:Pg:dbname=$dbname;host=$host;", "$username", "$password");
$dbh->begin_work;

my @genes16;
my @genes16m;
my @genes12;
my @genes11;
my @genes11m;
my @gobps;
my @gomfs;
my @goccs;
my @gobp_descs;
my @gomf_descs;
my @gocc_descs;

open (my $fh2, $annot_file) || die ("\nERROR: the file $annot_file could not be found\n");
while (my $line = <$fh2>) {
  chomp($line);
  my ($id33,$id31,$id16,$id16m,$id12,$id11,$id11m,$id30,$gobp,$gomf,$gocc,$gobp_desc,$gomf_desc,$gocc_desc,$tair_id,$tair_desc,$sp_id,$sp_desc,$nr_id,$nr_desc) = split("\t",$line);

	if ($id16) {
	  @genes16 = split(";",$id16);
	}

	if ($id16m) {
	  @genes16m = split(";",$id16m);
	}

	if ($id12) {
	  @genes12 = split(";",$id12);
	}

	if ($id11) {
	  @genes11 = split(";",$id11);
	}

	if ($id11m) {
	  @genes11m = split(";",$id11m);
	}


	if ($tair_id) {
		$tair_id =~ s/ARATHwo //;
	}

	# print "$id33\n";
	my $gene_id33 = insert_gene($dbh,$id33,"3.3");
	my $gene_id31;
	my $gene_id30;
	my $gene_id16;
	my $gene_id16m;
	my $gene_id12;
	my $gene_id11;
	my $gene_id11m;
	# print "$gene_id33\n";

	if ($id30) {
		# print "$id33-$id30\n";

		$gene_id30 = insert_gene($dbh,$id30,"3.0");
		insert_gene_gene($dbh,$gene_id33,$gene_id30);
	}

	if ($id31) {
		# print "$id33-$id31\n";

		$gene_id31 = insert_gene($dbh,$id31,"3.1");
		insert_gene_gene($dbh,$gene_id33,$gene_id31);
	}

	if ($id16) {
		foreach my $g (@genes16) {
			# print "$id33-$g\n";

			$gene_id16 = insert_gene($dbh,$g,"1.6");
			insert_gene_gene($dbh,$gene_id33,$gene_id16);
		}
	}

	if ($id16m) {
		foreach my $g (@genes16m) {
			# print "$id33-$g\n";

			$gene_id16m = insert_gene($dbh,$g,"1.6");
			insert_gene_gene($dbh,$gene_id33,$gene_id16m);
		}
	}

	if ($id12) {
		foreach my $g (@genes12) {
			# print "$id33-$g\n";

			$gene_id12 = insert_gene($dbh,$g,"1.2");
			insert_gene_gene($dbh,$gene_id33,$gene_id12);
		}
	}

	if ($id11) {
		foreach my $g (@genes11) {
			# print "$id33-$g\n";

			$gene_id11 = insert_gene($dbh,$g,"1.2_Phypa");
			insert_gene_gene($dbh,$gene_id33,$gene_id11);
		}
	}

	if ($id11m) {
		foreach my $g (@genes11m) {
			# print "$id33-$g\n";

			$gene_id11m = insert_gene($dbh,$g,"1.2_Phypa");
			insert_gene_gene($dbh,$gene_id33,$gene_id11m);
		}
	}

	if ($gobp) {
		insert_go($dbh,$gobp,$gobp_desc,"GO BP",$gene_id33);
	}
	if ($gomf) {
		insert_go($dbh,$gomf,$gomf_desc,"GO MF",$gene_id33);
	}
	if ($gocc) {
		insert_go($dbh,$gocc,$gocc_desc,"GO CC",$gene_id33);
	}

	if ($tair_id) {
		insert_annot($dbh,$tair_id,$tair_desc,"TAIR",$gene_id33);
	}
	if ($sp_id) {
		insert_annot($dbh,$sp_id,$sp_desc,"SwissProt",$gene_id33);
	}
	if ($nr_id) {
		insert_annot($dbh,$nr_id,$nr_desc,"NCBI Nr",$gene_id33);
	}

} #end of file

# Include phytozome ids for genes included in the database
open (my $fh3, $phytozome_file) || die ("\nERROR: the file $phytozome_file could not be found\n");
while (my $line = <$fh3>) {
  chomp($line);
  my ($phytozome_id,$gene_name,$tair_desc) = split("\t",$line);

	my $my_gene_id;

	# check if entry already exist
	my $sth = $dbh->prepare("SELECT gene_id FROM gene WHERE gene_name = \'$gene_name\'");
	$sth->execute() or die $sth->errstr;

	my @gene_id = $sth->fetchrow_array();

	if (@gene_id) {
		$my_gene_id = $gene_id[0];
	}

	if ($my_gene_id && $phytozome_id) {
		insert_annot($dbh,$phytozome_id,$tair_desc,"Phytozome",$my_gene_id);
	}

}



$dbh->commit;
$dbh->disconnect;
