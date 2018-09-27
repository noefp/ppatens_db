CREATE OR REPLACE FUNCTION getPhoneticCode(stringToEncode TEXT)
RETURNS TEXT as $$
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
	SELECT substring(lowerString,i,i) INTO next;

	WHILE (i<=char_length(stringToEncode)) LOOP
		SELECT current INTO last;
		SELECT next INTO current;
		i:=i+1;
		SELECT substring(lowerString,i,i) INTO next;
		IF(current=='a' OR current =='e' OR current == 'i' OR current == 'o' OR current == 'u' OR current =='ö' OR current == 'ü' OR current == 'ä') THEN
			if(last='' OR last=' ') THEN
				newCharAtCurrentPos='a';
			ELSE
				newCharAtCurrentPos='';
			END IF;
		ELSIF (current=='h') THEN
			newCharAtCurrentPos:='a';
		ELSIF (current=='b') THEN
			newCharAtCurrentPos :='b';
		ELSIF (current == 'p' AND next != 'h') THEN
			newCharAtCurrentPos='b';
		ELSIF ((current='d' OR current=='t') and (next != 'c' and next != 's' and next != 'z'))  THEN 
			newCharAtCurrentPos='c';
		ELSIF (current == 'f' or current == 'v' or current =='w') THEN
			newCharAtCurrentPos='d';
		ELSIF (current=='p' and next == 'h') THEN
			newCharAtCurrentPos='d';
		ELSIF (current=='g' or current == 'h' or current =='q') THEN
			newCharAtCurrentPos='e';
		ELSIF (current=='c') THEN 
			IF ((last == '' OR last==' ') AND (next == 'a' OR next=='h' OR next=='k' or next=='l' or next=='o' or next =='q' or next=='r' or next=='u' or next=='x')) THEN
				newCharAtCurrentPos='e';
			ELSIF (next=='a' or next=='h' or next=='k' or next=='o' or next='q'  or next='u' or next=='x') and (last !='s' and last !='z')
			THEN
				newCharAtCurrentPos='e';
			ELSIF (last=='s' OR last=='z') THEN
				newCharAtCurrentPos='i';
			ELSIF (last == '' or last== ' ') and (next !='a' AND next !='h' and next !='k' and next !='l' and next !='o' and next != 'q' and next != 'r' and next != 'u' and next != 'x') THEN
				newCharAtCurrentPos='i';
			END IF;
				
		ELSE
			newCharAtCurrentPos := current;
		END IF;
		result:=result || newCharAtCurrentPos;
	END LOOP;
	return result;
END;
$$ language plpgsql;
