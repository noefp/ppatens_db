CREATE TABLE gene (
    gene_id bigserial PRIMARY KEY,
    gene_name varchar(80) NOT NULL,
    genome_version varchar(80)
);

CREATE TABLE gene_gene (
    gene_gene_id bigserial PRIMARY KEY,
    gene_id1 bigserial REFERENCES gene(gene_id),
    gene_id2 bigserial REFERENCES gene(gene_id)
);

CREATE TABLE annotation (
    annotation_id bigserial PRIMARY KEY,
    annot_term varchar(80),
    annot_desc text NOT NULL,
    annot_type varchar(80),
    annot_src varchar(80)
);

CREATE TABLE gene_annotation (
    gene_annotation_id bigserial PRIMARY KEY,
    gene_id bigserial REFERENCES gene(gene_id),
    annotation_id bigserial REFERENCES annotation(annotation_id)
);


--
-- Name: getphoneticcode(text); Type: FUNCTION; Schema: public; Owner: web_usr
--

CREATE FUNCTION public.getphoneticcode(stringtoencode text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
	lowerString TEXT;
	i INTEGER=1;
	last TEXT;
	current TEXT;
	next TEXT;
	result text = '';
	newCharAtCurrentPos text ='';
BEGIN
	SELECT lower(stringToEncode) INTO lowerString	;
	SELECT ' ' INTO current;
	SELECT substring(lowerString,i,1) INTO next;

	WHILE (i<=char_length(stringToEncode)) LOOP
		SELECT current INTO last;
		SELECT next INTO current;
		i:=i+1;
		SELECT substring(lowerString,i,1) INTO next;
		IF(current='a' OR current ='e' OR current = 'i' OR current = 'o' OR current = 'u' OR current ='ö' OR current = 'ü' OR current = 'ä') THEN
			if(last='' OR last=' ') THEN
				newCharAtCurrentPos='a';
			ELSE
				newCharAtCurrentPos='';
			END IF;
		ELSIF (current='h') THEN
			newCharAtCurrentPos:='a';
		ELSIF (current='b') THEN
			newCharAtCurrentPos :='b';
		ELSIF (current = 'p' AND next <> 'h') THEN
			newCharAtCurrentPos='b';
		ELSIF (current='d' OR current='t') THEN
			IF (next <> 'c' and next <> 's' and next <> 'z')  THEN 
				newCharAtCurrentPos='c';
			ELSE
				newCharAtCurrentPos='i';
		END IF;
		ELSIF (current = 'f' or current = 'v' or current ='w') THEN
			newCharAtCurrentPos='d';
		ELSIF (current='p' and next = 'h') THEN
			newCharAtCurrentPos='d';
		ELSIF (current='g' or current = 'h' or current ='q') THEN
			newCharAtCurrentPos='e';
		ELSIF (current='c') THEN 
			IF ((last = '' OR last=' ') AND (next = 'a' OR next='h' OR next='k' or next='l' or next='o' or next ='q' or next='r' or next='u' or next='x')) THEN
				newCharAtCurrentPos='e';
			ELSIF (next='a' or next='h' or next='k' or next='o' or next='q'  or next='u' or next='x') and (last <>'s' and last <>'z')
			THEN
				newCharAtCurrentPos='e';
			ELSIF (last='s' OR last='z') THEN
				newCharAtCurrentPos='i';
			ELSIF (last = '' or last= ' ') and (next <>'a' AND next <>'h' and next <>'k' and next <>'l' and next <>'o' and next <> 'q' and next <> 'r' and next <> 'u' and next <> 'x') THEN
				newCharAtCurrentPos='i';
			ELSIF (next <>'a' AND next<>'h' AND next <>'k' AND next <>'o' AND next <>'q' AND next <>'u' AND next <>'u' AND next<>'x') THEN
				newCharAtCurrentPos='i';
			END IF;
		ELSIF (current='x' and (last<>'c' and last <>'k' and last <>'q')) THEN
			newCharAtCurrentPos='ei';
		ELSIF (current='l') THEN
			newCharAtCurrentPos='f';
		ELSIF	(current ='m' OR current ='n') THEN
			newCharAtCurrentPos='g';
		ELSIF (current = 'r') THEN
			newCharAtCurrentPos='h';
		ELSIF (current='s' OR current='z') THEN
			newCharAtCurrentPos='i';
		ELSIF (current='x' and (last='c' OR last ='k' OR last ='q')) THEN
			newCharAtCurrentPos='i';
		
		ELSE
			newCharAtCurrentPos := current;
		END IF;
		result:=result || newCharAtCurrentPos;
	END LOOP;
	return result;
END;
$$;

--
-- Name: annotation_phonetic; Type: TABLE;  Owner: web_usr--
CREATE TABLE annotation_phonetic (
    annot_phonetic_id bigserial NOT NULL,
    annotation_id bigint NOT NULL references annotation(annotation_id),
    phoneticDesc text,
	phoneticTerm text not null
);

CREATE OR REPLACE FUNCTION public.insertannotationphonetic() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
	insert into "public"."annotation_phonetic"
		(annotation_id,phoneticDesc,phoneticTerm) values(new.annotation_id,getPhoneticCode(new.annot_desc),getPhoneticCode(new.annot_term));
	return new;
END;
$$;

CREATE OR REPLACE FUNCTION public.updateannotationphonetic() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
	update "public"."annotation_phonetic"
		set phoneticDesc=getPhoneticCode(new.annot_desc),
		phoneticTerm=getPhoneticCode(new.annot_desc)
		where annotation_id=new.annotation_id;
	return new;
END;
$$;

CREATE TRIGGER insertAnnotationPhonetic AFTER INSERT ON public.annotation FOR EACH ROW EXECUTE PROCEDURE public.insertannotationphonetic();

CREATE TRIGGER updateAnnotationPhonetic AFTER UPDATE ON public.annotation FOR EACH ROW EXECUTE PROCEDURE public.updateannotationphonetic();



ALTER FUNCTION public.getphoneticcode(stringtoencode text) OWNER TO web_usr;
ALTER FUNCTION public.updateannotationphonetic() OWNER TO web_usr;
ALTER FUNCTION public.insertannotationphonetic() OWNER TO web_usr;
GRANT ALL PRIVILEGES ON gene TO web_usr;
GRANT ALL PRIVILEGES ON gene_gene TO web_usr;
GRANT ALL PRIVILEGES ON annotation TO web_usr;
GRANT ALL PRIVILEGES ON gene_annotation TO web_usr;
GRANT ALL PRIVILEGES ON annotation_phonetic TO web_usr;

CREATE INDEX ON annotation (annot_term,annot_desc);
CREATE INDEX ON annotation_phonetic (phoneticDesc,phoneticTerm);
CREATE INDEX ON gene (gene_name);

-- Run this if you have an existing schema containing filled tables to insert all phonetic descriptions and terms into phonetic table:
-- INSERT INTO annotation_phonetic (annotation_id, phoneticDesc, phoneticTerm)  select annotation_id, getPhoneticCode(annot_desc), getPhoneticCode(annot_term) FROM annotation;