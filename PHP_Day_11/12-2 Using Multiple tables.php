Using Multiple tables
=====================
Use the Author_Books example code to manipulate tables in Smithside Auctions. 

1. The code for steps 1–3 is in the author_books.sql file and you can import it into your database in phpMyAdmin.

♦ Create and fill the authors table in phpMyAdmin 

CREATE TABLE 'authors' (
'author_id' int(11) NOT NULL AUTO_INCREMENT,
'first_name' varchar(50) NOT NULL,
'last_name' varchar(50) NOT NULL,
constraint pk_Authors PRIMARY KEY ('author_id asc')
)
;

♦ Fill the table with data
INSERT INTO 'authors' ('author_id', 'first_name', 'last_name') VALUES
(1, 'Sally', 'Meyers'),
(2, 'George', 'Smith'),
(3, 'Peter', 'Gabriel'),
(4, 'Dale', 'Mercer');

2. Create and fill the types table.

♦ Create and fill the types table
CREATE TABLE 'types' (
'type_id' int(11) NOT NULL AUTO_INCREMENT,
'type_name' varchar(20) NOT NULL,
constraint pk_Types PRIMARY KEY ('type_id' asc)
) 
;

♦ INSERT INTO 'types' ('type_id', 'type_name') VALUES
(1, 'History'),
(2, 'Suspense'),
(3, 'Science Fiction');

3. Create and fill the books table.

CREATE TABLE 'books' (
'book_id' int(11) NOT NULL AUTO_INCREMENT,
'title' varchar(50) NOT NULL,
'author_id' int(11) DEFAULT NULL,
'type_id' int(11) DEFAULT NULL,
constraint pk_Books PRIMARY KEY ('book_id')
);

♦ INSERT INTO 'books' ('book_id', 'title', 'author_id', 'type_id') VALUES
(1, 'A Long Day in Spring', 3, 1),
(2, 'Fifteen Hours in March', 2, 2),
(3, 'Green Trees Go Wild', 1, 3),
(4, 'And Then It Happened', 1, 1),
(5, 'Missing in Action', 5, 2),
(6, 'Fourteen Days in February', 2, 2),
(7, 'Sixteen Seconds in March', 2, 2);

4. List the title of the book and the first and last name of the author.
SELECT title, first_name, last_name
FROM books JOIN authors AS a ON author = a.author_id
;


5. Take the MySQL statement in step 4, sort it by title, and display it using PHP
<?php
define("MYSQLUSER", "root");
define("MYSQLPASS", "root");
define("HOSTNAME", "localhost");
define("MYSQLDB", "Author_Books");
// Make connection to database
$connection = @new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
if ($connection->connect_error) {
die('Connect Error: ' . $connection->connect_error);
} else {
// Set up the query
$query = "SELECT title, first_name, last_name "
. " FROM books JOIN authors AS a ON author = a.author_id "
. " ORDER BY 'title' ASC "
;

// Run the query
$result_obj = '';
$result_obj = $connection->query($query);
// Read the results
// loop through the results, row by row
// reading each row into an associative array
while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
// collect the array
$items[] = $result;
}
// print array when done
foreach ($items as $item) {
echo $item['title']. ' by ' . $item['first_name']. ' ' . $item['last_name'];
//print_r($item);
echo '<br />';
}
}

6. List the type name, title, and full name of the author for any titles that contain "Day." Put in sequence by the type in descending sequence, then the title.
SELECT type_name, title, CONCAT(last_name, ', ', first_name) AS full_name
FROM books AS b
JOIN authors AS a ON author = a.author_id
JOIN types AS t ON b.type_id = t.type_id
WHERE title LIKE '%Day%'
ORDER BY type_name DESC, title;

7. Take the MySQL statement in step 6 and put it into a PHP statement to display
<?php
define("MYSQLUSER", "root");
define("MYSQLPASS", "root");
define("HOSTNAME", "localhost");
define("MYSQLDB", "Author_books");
// Make connection to database
$connection = @new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
if ($connection->connect_error) {
die('Connect Error: ' . $connection->connect_error);
} else {
// Set up the query
$query = "SELECT type_name, title,
CONCAT(last_name, ', ', first_name) AS full_name "
. " FROM books AS b "
. " JOIN authors AS a ON author = a.author_id "
. " JOIN types AS t ON b.type_id = t.type_id "
. " WHERE title LIKE '%Day%' "
. " ORDER BY type_name DESC, title "
;
// Run the query
$result_obj = '';
$result_obj = $connection->query($query);
// Read the results
// loop through the results, row by row
// reading each row into an associative array
while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
// collect the array
$items[] = $result;
}
// print array when done
foreach ($items as $item) {
echo $item['type_name'] . ': ' . $item['title']. ' by ' . $item['full_name'];
echo '<br />';
}
}


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
