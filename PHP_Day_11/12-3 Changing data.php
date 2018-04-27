Changing Data
==============
Change the contact add page so that it edits existing records.

1. In the contents/about.php file add an edit button to link to the maintenance page with the id of the current contact in the URL. This is the current <h2> line:
<h2><?php echo htmlspecialchars($item->name()); ?></h2>
Replace it with this new <h2> line:
<h2><?php echo htmlspecialchars($item->name()); ?>
<a class="button"
href="index.php?content=contactmaint&id=<?php echo $item->getId(); ?>">
Edit</a></h2>

2. In the contents/contactmaint.php file check for the id in the URL. If it is not 0 then get the row from the table to create the Contact object. Do this by changing $item = new Contact; to the following code:
$id = (int) $_GET['id'];
// Is this an existing item or a new one?
if ($id) {
// Get the existing information for an existing item
$item = Contact::getContact($id);
} else {
// Set up for a new item
$item = new Contact;
}

3. Change the legend to show the id if this is an existing contact:
<legend><?php echo ($id) ? 'ID: '. $id : 'Add a Contact' ?></legend>

4. Add the getContact() method in the includes/classes/contact.php file to create a
Contact object from a row in the contacts table:
public static function getContact($id) {
// Get the database connection
$connection = Database::getConnection();
// Set up the query
$query = 'SELECT * FROM `contacts` WHERE id="'. (int) $id.'"';
// Run the MySQL command
$result_obj = '';
try {
$result_obj = $connection->query($query);
if (!$result_obj) {
throw new Exception($connection->error);
} else {
$item = $result_obj->fetch_object('Contact');
if (!$item) {
throw new Exception($connection->error);
} else {
// pass back the results
return($item);
}
}
}
catch(Exception $e) {
echo $e->getMessage();
}
}

5. You need to change the processing of the contact.maint task. In the includes/init.php file, locate the contact.maint case. The header redirect needs the id of the row. That id is added to the $result array from the editRecord() method and passed through the editContact() function.

header("Location: index.php?content=contactmaint&id=$results[2]");

6. In the includes/functions.php file change the maintContact() function to call the editRecord() function if the id already exists. This is the current code:
// Set up a Contact object based on the posts
$contact = new Contact($item);
$results = $contact->addRecord();
Replace it with this new code:
// Set up a Contact object based on the posts
$contact = new Contact($item);
if ($contact->getId()) {
$results = $contact->editRecord();
} else {
$results = $contact->addRecord();
}

7. Back in the includes/classes/contact.php file add the editRecord() method to update the table. You need the id to create the URL to redirect to the correct page if there is an error, so add a third element to the return array. 
public function editRecord() {
// Verify the fields
if ($this->_verifyInput()) {
// Get the Database connection
$connection = Database::getConnection();
// Set up the prepared statement
$query = 'UPDATE `contacts`
SET first_name=?, last_name=?, position=?, email=?, phone=?
WHERE id=?';
$statement = $connection->prepare($query);
// bind the parameters
$statement->bind_param('sssssi',
$this->first_name, $this->last_name, $this->position,	
$this->email, $this->phone, $this->id);
if ($statement) {
$statement->execute();
$statement->close();
// add success message
$return = array('', 'Contact Record successfully added.', '');
return $return;
} else {
$return = array('contactmaint',
'No Contact Record Added. Unable to create record.' ,
(int) $this->id);
return $return;
}
} else {
// send fail message and return to contactmaint
$return = array('contactmaint',
'No Contact Record Added. Missing required information.' ,
(int) $this->id);
return $return;
}
}

8. Go to the About Us page.

9. Click the Edit button on George Smith and you see the page. Make changes and click Save to save the changes.

10. In step 7 you added a third element to the array that returns out of editRecord(). You need to add that element to the array that addRecord() returns, as shown in the following code from includes/classes/contact.php.
// Run the MySQL statement
if ($connection->query($query)) {
$return = array('', 'Contact Record successfully added.', '' );
// add success message
return $return;
} else {
// send fail message and return to contactmaint
$return = array('contactmaint', 'No Contact Record Added. Unable to i
create record.', '');
return $return;
}
} else {
// send fail message and return to contactmaint
$return = array('contactmaint', 'No Contact Record Added. Missing i
required information.', '0');
return $return;
}

Change the category add page so that it edits existing records.
	1. In the contents/categories.php file add an Edit button to link to the maintenance page with the id of the current category in the URL. Put it below the Display Lots button:
<a class="button edit"
href="index.php?content=categorymaint&cat_id=<?php echo $item->getCat_id();
?>">
Edit</a>

	2. In the contents/categorymaint.php file, check for the category id in the URL. If it is not 0 then get the row from the table to create the Category object. Do this by changing $item = new Category; to the following code:
$id = (int) $_GET['cat_id'];
// Is this an existing item or a new one?
if ($id) {
// Get the existing information for an existing item
$item = Category::getCategory($id);
} else {
// Set up for a new item
$item = new Category;
}

	3. Change the legend to show the id if this is an existing category:
<legend><?php echo ($id) ? 'ID: '. $id : 'Add a Category' ?></legend>

	4. Add the getCategory() method in the includes/classes/category.php file to create a Category object from a row in the categories table:
public static function getCategory($cat_id) {
// Get the DB connection
$connection = Database::getConnection();
// Prepare the query
$query = 'SELECT * FROM `categories` WHERE cat_id="'. (int) $cat_id.'"';
// Run the MySQL command
$result_obj = $connection->query($query);
try {
while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
$item = new Category($result);
}
// pass back the results
return($item);
}
catch(Exception $e) {
return false;
}
}

	5. You need to change the processing of the category.maint task. In the includes/init.php file locate the category.maint case. The header redirect needs the id of the row. That id is added to the $result array from the editRecord() method and passed through the editCategory() function.
header("Location: index.php?content=categorymaint&cat_id=$results[2]");

	6. In the includes/functions.php change the maintCategory() function to call the editRecord() function if the id already exists. This is the current code:
// Set up a Category object based on the posts
$category = new Category($item);
$results = $category->addRecord();
Replace it with this new code:
// Set up a Category object based on the posts
$category = new Category($item);
if ($category ->getGet_id()) {
$results = $category ->editRecord();
} else {
$results = $category ->addRecord();
}

	7. Back in the includes/classes/category.php file, add the editRecord() method to update the table. You need the id to create the URL to redirect to the correct page if there is an error, so add a third element to the return array.
public function editRecord() {
// Verify the fields
if ($this->_verifyInput()) {
// Get the Database connection
$connection = Database::getConnection();
// Set up the prepared statement
$query = 'UPDATE `categories`
SET cat_name=?, cat_description=?, cat_image=?
WHERE cat_id=?';
$statement = $connection->prepare($query);
// bind the parameters
$statement->bind_param('sssi',
$this->cat_name, $this->cat_description, $this->cat_image,
$this->cat_id);
if ($statement) {
$statement->execute();
$statement->close();
// add success message
$return = array('', 'Category Record successfully added.', '');
return $return;
} else {
$return = array('categorymaint',
'No Category Record Added. Unable to create record.',
(int) $this->cat_id);
return $return;
}
} else {
// send fail message and return to categorymaint
$return = array('contactmaint',
'No Contact Record Added. Missing required information.',
(int) $this->cat_id);
return $return;
}
}

	8. Go to the Lot Categories page

	9. Click the Edit button on the Gents category and you see the result. Make changes and click Save to save the changes.

	10. In step 7, you added a third element to the array that returns out of editRecord(). You need to add that element to the array that addRecord() returns as shown in the following code from includes/classes/contact.php.
// Run the MySQL statement
if ($connection->query($query)) {
$return = array('', 'Category Record successfully added.','');
// add success message
return $return;
} else {
// send fail message and return to categorymaint
$return = array('contactmaint', 'No Category Record Added. Unable to i
create record.','');
return $return;
}
} else {
// send fail message and return to categorymaint
$return = array('categorymaint', 'No Category Record Added. Missing i
required information.','0');
return $return;
}



