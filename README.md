# PpGmlDB
Physcomitrella patens gene model lookup database

#Setup
To run this application you have to add a file named pp_paths.php.
This file should define two functions:
getBlastdbcmdPath()   (returns path to blastdbcmd executable
getBlastdbBaseLocation() (Returns the path where all blast db's to use are - the path should finish with a /).

Example pp_paths.php:
<?php
function getBlastdbcmdPath() {return "/usr/bin/blastdbcmd";}
function getBlastdbBaseLocation() { return "/tmp/dbTemp/";}
?>

# Database
To create the database structure execute create_annot_schema.sql.
If you wan't to import a large amount of data afterwards, don't create the index before all data have been inserted. This will be much faster if executed after insertion of all data.
 Create a file "pp_database_access.php" this should define one function "getConnectionString()" which returns the connection string to the database.
 
 # Requirements
 To work the application needs a linux machine with installed find. It's also possible to use windows-machines - in this case you have to change the find command in pp_blastdbcmd.php to a executable returning the same result. The database to use should be postgres. If possible use postgres 10 or above - othervise the <% operator is not supported and the gin search should use old like syntax. In this case change $postgres_version to 10 in pp_database_data.php.
 