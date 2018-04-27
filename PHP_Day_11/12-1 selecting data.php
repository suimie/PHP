Selecting Data
===============

Change the About Us page to get the contact information from the database.
1. In contents/about.php the information is currently hard-coded in to the $items array. Replace those 30 lines with a static call to the Content class method getContacts():
// Get the contact information
$items = Contact::getContacts();
?>

2. When the information was hard-coded, you had total control over what it was. By pulling information from the database, you don't have the same control. There could be malicious information and there could be characters, such as ampersands, that should be encoded as HTML entities, such as &amp;. To fix this, pass all string information through the htmlspecialchars() function:
<h2><?php echo htmlspecialchars($item->name()); ?></h2>
<p>Position: <?php echo htmlspecialchars($item->getPosition()); ?><br />
<?php echo htmlspecialchars($item->getEmail()); ?><br />
Phone: <?php echo htmlspecialchars($item->getPhone()); ?><br /></p>

3. In includes/classes/contact.php add the getContacts() public static method to retrieve the rows and fill the array. Use the fetch_object() method with the Contact class to read the rows into objects.
static function getContacts() {
// clear the results
$items = '';
// Get the connection
$connection = Database::getConnection();
// Set up query
$query = 'SELECT * FROM 'contacts' ORDER BY first_name, last_name';
// Run the query
$result_obj = '';
$result_obj = $connection->query($query);
// Loop through the results,
// passing them to a new version of this class,
// and making a regular array of the objects
try {
while($result = $result_obj->fetch_object('Contact')) {
$items[]= $result;
}
// pass back the results
return($items);
}
catch(Exception $e) {
return false;
}
}

Create a maintenance page so you can add lot categories into the categories table. Add the lot categories into the categories table. Change the Lot Categories page to get the information from the database.
	
	1. In contents/categories.php add documentation at the beginning of the file:
<?php
/**
* categories.php
*
* Content for Categories page
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/

	2. Follow that with the code to load the $items variable using the static getCategories() method from the Category class. If nothing is returned, initialize $items to an array so that later use of the variable doesn't create errors.
// Get the category information
$items = Category::getCategories();

if (empty($items)) {
$items = array();
}
?>

	3. In the <h1> header, add a link to the new data entry page. Give it the class button for the CSS styling.
<h1>Categories<a class="button"
href="index.php?content=categorymaint&cat_id=0">Add</a></h1>

	4. Wrap the first <li>...</li> in a foreach loop to loop through the $items array.
<?php foreach ($items as $i=>$item) : ?>
<li class="row0">
...
</li>
<?php endforeach; ?>

	5. Change the <li> class to calculate the class for either row0 or row1 based on the $i key variable:
<li class="row<?php echo $i % 2; ?>">

	6. Set up the images. The table has a field for the name of the file in the images folder. There is another file with the same name in the images/thumbnail folder. You want to check to see if these files exist before trying to display them, to prevent broken links and also verify that what you display is an actual filename in a specific folder. If a file doesn't exist, display a generic image instead.
<?php
$image = 'images/'. $item->getCat_image();
if (!is_file($image)) {
$image = 'images/nophoto.jpg';
}
$image_t = 'images/thumbnails/'. $item->getCat_image();
if (!is_file($image_t)) {
$image_t = 'images/thumbnails/nophoto.jpg';
}
?>

	7. Change the image references to the new image variables:
<div class="list-photo">
<a href="<?php echo $image; ?>">
<img alt="" src="<?php echo $image_t; ?>"/></a>
</div>

	8. Change the <h2> link to assign the content= parameter based on the category name. Change <h2> text to the category name as well. Change the description to use the category description and change the content= parameter in the <a> tag link to the category name in lowercase.
<div class="list-description">
<h2>
<a href="index.php?content=<?php echo i
htmlspecialchars($item->getCat_name()); ?>&amp;sidebar=catnav">
<?php echo htmlspecialchars (strtolower($item->getCat_name())); ?></a>
</h2>
<p><?php echo htmlspecialchars($item->getCat_description()); ?></p>
<a class="button display" href="index.php?content=<?php echo i
htmlspecialchars (strtolower($item->getCat_name())); ?>&amp;sidebar=catnav">
Display Lots</a>
</div>

	9. Remove the rest of the <li> groups.

	10. In includes/classes/category.php add the getCategories() public static method to retrieve the rows and fill the array. Rather than directly creating the Category object, use fetch_array(MYSQLI_ASSOC) to retrieve the row. Use that array to create a new Category object that is added as an element in the $items array. This is a different way of creating the
same $items array as is created in the Contact class using the fetch_object().

static public function getCategories() {
// clear the results
$items = '';
// Get the connection
$connection = Database::getConnection();
// Set up the query
$query = 'SELECT * FROM 'categories' ORDER BY cat_name';
// Run the query
$result_obj = '';
$result_obj = $connection->query($query);
// Loop through getting associative arrays,
// passing them to a new version of this class,
// and making a regular array of the objects
try {
while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
$items[]= new Category($result);
}
// pass back the results
return($items);
}
catch(Exception $e) {
return false;
}
}

	11. Add the addRecord() method to add rows to the categories table:
public function addRecord() {
// Verify the fields
if ($this->_verifyInput()) {
// Get the Database connection
$connection = Database::getConnection();
// Prepare the data
$query = "INSERT INTO categories(cat_name, cat_description, cat_image)
VALUES ('" . Database::prep($this->cat_name) . "',
'" . Database::prep($this->cat_description) ."',
'" . Database::prep($this->cat_image) . "')";
// Run the MySQL statement
if ($connection->query($query)) {
$return = array('', 'Category Record successfully added.');
// add success message
return $return;
} else {
// send fail message and return to categorymaint
$return = array('contactmaint', 'No Category Record Added.
Unable to create record.');
return $return;
}
} else {
// send fail message and return to categorymaint
$return = array('categorymaint', 'No Category Record Added.
Missing required information.');
return $return;
}

	12. Add the _verifyInput() method to verify that a category name was entered:
protected function _verifyInput() {
$error = false;
if (!trim($this->cat_name)) {
$error = true;
}
if ($error) {
return false;
} else {
return true;
}
}

	13. Create content/categorymaint.php, which is the form for data entry of the categories:
<?php
/**
* categorymaint.php
*
* Maintenance for the Categories table
*
* @version 1.2 2018-02-03
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/
$item = new Category;
?>
<h1>Category Maintenance</h1>
<form action="index.php?content=categories" method="post" name="maint"
id="maint">
<fi eldset class="maintform">
<legend>Add a Category</legend>
<ul>
<li><label for="cat_name" class="required">Category</label><br />
<input type="text" name="cat_name" id="cat_name" class="required"
value="<?php echo $item->getCat_name(); ?>" /></li>
<li><label for="cat_description">Description</label><br />
<textarea rows="5" cols="60" name="cat_description"
id="cat_description"><?php echo $item->getCat_description(); ?>
</textarea></li>
<li><label for="cat_image" >Image</label><br />
<input type="text" name="cat_image" id="cat_image"
value="<?php echo $item->getCat_image(); ?>" /></li>
</ul>
<?php
// create token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1,1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="cat_id" id="cat_id"
value="<?php echo $item->getCat_id(); ?>" />
<input type="hidden" name="task" id="task" value="category.maint" />
<input type='hidden' name='token' value='<?php echo $token; ?>'/>
<input type="submit" name="save" value="Save" />
<a class="cancel" href="index.php?content=categories">Cancel</a>
</fi eldset>
</form>

	14. In includes/init.php add a case block in the switch statement for category.maint to process the category maintenance form:
case 'category.maint' :
// process the maint
$results = maintCategory();
$message .= $results[1];
// If there is redirect information
// redirect to that page
if ($results[0] == 'categorymaint') {
// pass on new messages
if ($results[1]) {
$_SESSION['message'] = $results[1];
}
header("Location: index.php?content=categorymaint");
exit;
}
break;
15. Add the function maintCategory() to includes/functions.php:
function maintCategory() {
$results = '';
if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
// check the token
$badToken = true;
if (!isset($_POST['token'])
|| !isset($_SESSION['token'])
|| empty($_POST['token'])
|| $_POST['token'] !== $_SESSION['token']) {
$results = array('','Sorry, go back and try again.
There was a security issue.');
$badToken = true;
} else {
$badToken = false;
unset($_SESSION['token']);
// Put the sanitized variables in an associative array
// Use the FILTER_FLAG_NO_ENCODE_QUOTES
// to allow quotes in the description
$item = array ('cat_id' => (int) $_POST['cat_id'],
'cat_name' => fi lter_input(INPUT_POST,'cat_name',
FILTER_SANITIZE_STRING),
'cat_description' => fi lter_input(INPUT_POST,'cat_description',
FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
'cat_image' => fi lter_input(INPUT_POST,'cat_image',
FILTER_SANITIZE_STRING)
);
// Set up a Category object based on the posts
$category = new Category($item);
$results = $category->addRecord();
}
}
return $results;
}

	16. Go to the new entry screen and add the lot categories.

	17. Change content/catnav.php to use the categories in the categories table rather than hardcoded links:
<?php
/**
* catnav.php
*
* Menu for the categories
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/
$items = Category::getCategories();
?>
<h3 class="element-invisible">Lot Categories</h3>
<ul class="catnav">
<?php foreach ($items as $i=>$item) : ?>
<li><a href="index.php?content=<?php echo
htmlspecialchars(strtolower($item->getCat_name())); ?>&sidebar=catnav">
<?php echo htmlspecialchars($item->getCat_name()); ?></a></li>
<?php endforeach; ?>
</ul>