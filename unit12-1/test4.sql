1. 	Write the SQL statement(s) to create tables in the classes database with the following schema. 
	An underline indicates a primary key.

      instructors(instructor_id, name, phone, office)
      classes(section, course_number, title, instructor_id)
###      
	USE classes;
	CREATE TABLE instructors( 
		instructor_id INT PRIMARY KEY,
		name VARCHAR(15),
		phone INT,
		office CHAR(5),
		);
	CREATE TABLE classes(
		section INT PRIMARY KEY,
		course_number CHAR(4), 
		title VARCHAR(25),
		instructor_id INT,
		);
###      		

2. Write the SQL statement(s) to insert the following data into the instructors table:

      instructor_id   name        phone     office
      1               Dehkhoda    4629      B220E
      2               Rogler      8472      B220J
      3               Geddes      4628      B220T

###
	USE classes;
	INSERT INTO instructors VALUES( 1, 'Dehkhoda', 4629, 'B220E' );
	INSERT INTO instructors VALUES( 2, 'Rogler', 8472, 'B220J' );
	INSERT INTO instructors VALUES( 3, 'Geddes', 4628, 'B220T' );
###

3. Write the SQL statement(s) to insert the following data into the classes table:

      section    course_number    title                 instructor_id
      1441       CS80             Internet Programming  3
      4118       CS55             Java Programming      1
      4119       CS60             Database Concepts     2
      4128       CS85             PHP Programming       3

###
	USE classes;
	INSERT INTO classes VALUES ( 1441, 'CS80', 'Internet Programming', 3);
	INSERT INTO classes VALUES ( 4118, 'CS55', 'Java Programming', 1);
	INSERT INTO classes VALUES ( 4119, 'CS60', 'Database Concepts', 2);
	INSERT INTO classes VALUES ( 4128, 'CS85', 'PHP Programming', 3);


