Deleting Data
==============
Add delete capabilities to the About Us page.
1. In the contents/about.php files add a Delete button in the <h2> tag:
<h2><?php echo htmlspecialchars($item->name()); ?>
<a class="button"
href="index.php?content=contactdelete&id=<?php echo
$item->getId(); ?>">Delete</a>
<a class="button" href="index.php?content=contactmaint&id=<?php echo i
$item->
getId(); ?>">Edit</a>
</h2>

2. Create the contents/contactdelete.php file. This is similar to the contactmaint.php file except that you just display the data instead of using labels and inputs. You won't have new items on this page, so you only need to look for existing items. The submit button is a Delete button instead of a Save and the task is contact.delete.
<?php
/**
* contactdelete.php
*
* Delete the Contacts
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/
$id = (int) $_GET['id'];
// Get the existing information for an existing item
$item = Contact::getContact($id);

?>
<h1>Contact Delete</h1>
<form action="index.php?content=about" method="post" name="maint" id="maint">
<fieldset class="maintform">
<legend><?php echo 'ID: '. $id ?></legend>
<ul>
<li><strong>First Name:</strong>
<?php echo htmlspecialchars($item->getFirst_name()); ?></li>
<li><strong>Last Name:</strong>
<?php echo htmlspecialchars($item->getLast_name()); ?></li>
<li><strong>Position:</strong>
<?php echo htmlspecialchars($item->getPosition()); ?></li>
<li><strong>Email:</strong>
<?php echo htmlspecialchars($item->getEmail()); ?></li>
<li><strong>Phone:</strong>
<?php echo htmlspecialchars($item->getPhone()); ?></li>
</ul>
<?php
// create token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1,1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="id" id="id" value="<?php echo $item->getId();
?>" />
<input type="hidden" name="task" id="task" value="contact.delete" />
<input type='hidden' name='token' value='<?php echo $token; ?>'/>
<input type="submit" name="delete" value="Delete" />
<a class="cancel" href="index.php?content=about">Cancel</a>
</fieldset>
</form>

3. In the includes/init.php file, add the contact.delete case to process the new task:
case 'contact.delete' :
// process the delete
$results = deleteContact();
$message .= $results[1];
// If there is redirect information
// redirect to that page
if ($results[0] == 'contactdelete') {
// pass on new messages
if ($results[1]) {
$_SESSION['message'] = $results[1];
}
header("Location: index.php?content=contactdelete&id=$results[2]");
exit;
}
break;

4. In the includes/functions.php file, add the deleteContact() function. This function checks the tokens and evokes the static deleteRecord() method in the Contact class.

Because the only piece of information you need to delete the row is the id, there is no need to create a whole object so you can use the static class method.

function deleteContact() {
$results = '';
if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
// check the token
$badToken = true;
if (!isset($_POST['token'])
|| !isset($_SESSION['token'])
|| empty($_POST['token'])
|| $_POST['token'] !== $_SESSION['token']) {
$results = array('',
'Sorry, go back and try again. There was a security issue.');
$badToken = true;
} else {
$badToken = false;
unset($_SESSION['token']);
// Delete the Contact from the table
$results = Contact::deleteRecord((int) $_POST['id']);
}
}
return $results;
}

5. In the includes/classes/contact.php file add the deleteRecord() method. This method deletes the row based on the id that is passed in as a parameter.
public static function deleteRecord($id) {
// Get the Database connection
$connection = Database::getConnection();
// Set up query
$query = 'DELETE FROM `contacts` WHERE id="'. (int) $id.'"';
// Run the query
if ($result = $connection->query($query)) {
$return = array('', 'Contact Record successfully deleted.', '');
return $return;
} else {
$return = array('contactdelete', 'Unable to delete Contact.', (int)
$id);
return $return;
}
}

6. Check your changes and verify them. Test that you can delete items.

Now, repeat the same steps to add delete capabilities to the Lot Categories page. 

1. In the contents/categories.php files add a Delete button just above the Edit button:
<a class="button edit"
href="index.php?content=categorydelete&cat_id=<?php echo
$item->getCat_id(); ?>">Delete</a>

2. Create the contents/categorydelete.php file. This is similar to the categorymaint.php file except that you just display the data instead of using labels and inputs. You won't have new items on this page, so you only need to look for existing items. The submit button is a Delete button instead of a Save and the task is category.delete.
<?php
/**
* categorydelete.php
*
* Delete for the Categories table
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/
$id = (int) $_GET['cat_id'];
// Get the existing information for an existing item
$item = Category::getCategory($id);
?>
<h1>Category Delete</h1>
<form action="index.php?content=categories" method="post" name="maint"
id="maint">
<fieldset class="maintform">
<legend><?php echo 'ID: '. $id ?></legend>
<ul>
<li><strong>Category:</strong>
<?php echo htmlspecialchars($item->getCat_name()); ?></li>
<li><strong>Description</strong><br />
<?php echo htmlspecialchars($item->getCat_description()); ?></li>
<li><strong>Image:</strong>
<?php echo htmlspecialchars($item->getCat_image()); ?></li>
</ul>
<?php
// create token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1,1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="cat_id" id="cat_id"
value="<?php echo $item->getCat_id(); ?>" />
<input type="hidden" name="task" id="task" value="category.delete" />
<input type='hidden' name='token' value='<?php echo $token; ?>'/>
<input type="submit" name="delete" value="Delete" />
<a class="cancel" href="index.php?content=categories">Cancel</a>
</fieldset>
</form>

3. In the includes/init.php file, add the category.delete case to process the new task:
case 'category.delete' :
// process the maint
$results = deleteCategory();
$message .= $results[1];
// If there is redirect information
// redirect to that page
if ($results[0] == 'categorydelete') {
// pass on new messages
if ($results[1]) {
$_SESSION['message'] = $results[1];
}
header("Location: index.php?content=categorydelete&cat_id=$results[2]");
exit;
}
break;

4. In the includes/functions.php file, add the deleteCategory() function. This function checks the tokens and evokes the static deleteRecord() method in the Category class. Because the only piece of information you need to delete the row is the id, there is no need to create a whole object so you can use the static class method.
function deleteCategory() {
$results = '';
if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
// check the token
$badToken = true;
if (!isset($_POST['token'])
|| !isset($_SESSION['token'])
|| empty($_POST['token'])
|| $_POST['token'] !== $_SESSION['token']) {
$results = array('',
'Sorry, go back and try again. There was a security issue.');
$badToken = true;
} else {
$badToken = false;
unset($_SESSION['token']);
// Delete the Category from the table
$results = Category::deleteRecord((int) $_POST['cat_id']);
}
}
return $results;
}

5. In the includes/classes/category.php file, add the deleteRecord() method. This method deletes the row based on the id that is passed in as a parameter. 
public static function deleteRecord($id) {
// Get the Database connection
$connection = Database::getConnection();
// Set up query
$query = 'DELETE FROM `categories` WHERE cat_id="'. (int) $id.'"';
// Run the query
if ($result = $connection->query($query)) {
$return = array('', 'Category Record successfully deleted.', '');
return $return;
} else {
$return = array('categorydelete', 'Unable to delete Category.', (int)
$id);
return $return;
}
}

6. Check your changes and verify that they them. Test that you can delete items.


The rest of this section turns the pages dealing with the lots from static to dynamic. First you change the multiple pages that display lots into a single page and then you add the CRUD for the tables.

Merge the content/gents.php, content/sporting.php, and content/women.php pages into a single content/lots.php page where you get the information from the database. Change the lot categories links in the content/categories.php file and in the content/catnav.php file to work with the new content/lots.php.

1. Copy contents/gents.php to a new file called contents/lots.php and add documentation
at the beginning of the file:
/**
* lots.php
*
* Content for Lots pages
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/

2. The category id, that is, the value of the primary key from the categories table and the matching value in the lots table, is in the URL. Retrieve it with $_GET['cat_id']. The lots are all in this category that you use when you retrieve the lots. Category::getCategory ($cat_id_in) creates an object containing the information from the categories table for that category.
// Get the Category
$cat_id_in = (int) $_GET['cat_id'];
$category = Category::getCategory($cat_id_in);

3. Follow that with the code to load the $lots array using the static getLots() method from the Lot class. This replaces the hardcoded assignments of the existing $lots array. Pass in the category id so you can use it in the getLots() method. If nothing is returned, initialize $lots to an array so that later use of the variable doesn't create errors.
// Get the lot information
$lots = Lot::getLots($cat_id_in);
if (empty($lots)) {
$lots = array();
}
?>

4. In the <h1> header, replace the "Gents" text with the category name and add a link to the new data entry page. Give it the class button for the CSS styling.
<h1>Product Category: <?php echo $category->getCat_name(); ?>
<a class="button"
href="index.php?content=lotmaint&cat_id=<?php echo $cat_id_in; ?>&lot_
id=0">
Add</a>
</h1>

5. In the <li> block change all the $lot array notations to use get methods for the object. For instance, change $lot['image'] to $lot->getLot_image(). Add an Edit button linking to the maintenance page and a Delete button to link to the delete page.
<div class="list-photo">
<?php // Set up the images
$image = 'images/'. $lot->getLot_image();
$image_t = 'images/thumbnails/'. $lot->getLot_image();
if (!is_file($image_t)) :
$image_t = 'images/thumbnails/nophoto.jpg';
endif;
if (is_file($image)) :
?>
<a href="<?php echo $image; ?>">
<img src="<?php echo $image_t; ?>" alt="" />
</a>
<?php else : ?>
<img src="<?php echo $image_t; ?>" alt="" />
<?php endif; ?>
</div>
<div class="list-description">

<h2><?php echo ucwords($lot->getLot_name()); ?></h2>
<p><?php echo htmlspecialchars($lot->getLot_description()); ?></p>
<p><strong>Lot:</strong> #<?php echo $lot->getLot_number(); ?>
<strong>Price:</strong> $
<?php echo number_format($lot->getLot_price(),2); ?>
<a class="button edit"
href="index.php?content=lotdelete&cat_id=<?php echo $cat_id_in; ?>&lot_
id=<?php i
echo $lot->getLot_id(); ?>">Delete
</a>
<a class="button edit"
href="index.php?content=lotmaint&cat_id=<?php echo $cat_id_in; ?>&lot_
id=<?php i
echo $lot->getLot_id(); ?>">Edit
</a></p></div>

6. In the includes/classes/lot.php file, add the getLots() public static method to retrieve the rows and fill the array. Use the parameter of $cat_id to select the correct lots. Rather than directly creating the Category object, use the fetch_array(MYSQLI_ASSOC) to retrieve the row. Use that array to create a new Lot object that is added as an element in the $items array.
static public function getLots($cat_id) {
// clear the results
$items = '';
// Get the connection
$connection = Database::getConnection();
// Set up the query
$query = 'SELECT * FROM `lots`
WHERE cat_id="'. (int) $cat_id.'" ORDER BY lot_id';
// Run the query
$result_obj = '';
$result_obj = $connection->query($query);
// Loop through getting associative arrays,
// passing them to a new version of this class,
// and making a regular array of the objects
try {
while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
$items[]= new Lot($result);
}
// pass back the results
return($items);
}
catch(Exception $e) {
return false;
}
}

7. Change the links in the content/categories.php file to use the lots page along with the category id to the URL parameters:
<h2>
<a href="index.php?content=lots&cat_id=<?php echo (int) $item->getCat_id(); i
?>&amp;sidebar=catnav">
...
<a class="button display"
href="index.php?content=lots&cat_id=<?php echo (int) $item->getCat_id(); i
?>&amp;sidebar=catnav">Display Lots</a>

8. Change the link in the content/catnav.php file to use the lots page along with the category id in the URL parameters:
<li><a href="index.php?content=lots&cat_id=<?php echo
(int) $item->getCat_id(); ?>&sidebar=catnav"><?php echo
htmlspecialchars($item->getCat_name()); ?></a></li>

Now, create a lots maintenance page so you can add and change lots in the lots table.

1. Create content/lotmaint.php, which is the form for adding the lots. The category id is in the URL. Use $_GET to get the id and save it. This is used to select the right category to the new lot and for navigating back to the right lot page when saving or canceling. Because it's not displayed on the form, insert it in a hidden <input> so that it is available when you update the database. You also display a drop-down list of valid categories, which you create next in this Try It section. The rest of the file is similar to the maintenance files for contacts and categories.
<?php
/**
* lotmaint.php
*
* Maintenance for the Lots table
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/
// Get the Category the new lot will be in
$cat_id_in = (int) $_GET['cat_id'];
// Get the lot id. If it doesn't exist or is 0, then this is a new lot
$id = (int) $_GET['lot_id'];
// Is this an existing item or a new one?
if ($id) {
// Get the existing information for an existing item
$item = Lot::getLot($id);
// set up the category dropdown
$cat_dropdown = Category::getCat_DropDown($item->getCat_id());
} else {
// Set up for a new item
$item = new Lot;
// set up the category dropdown
$cat_dropdown = Category::getCat_DropDown($cat_id_in);
}
?>
<h1>Lot Maintenance</h1>

<form
action="index.php?content=lots&cat_id=<?php echo $cat_id_in;
?>&sidebar=catnav" method="post" name="maint" id="maint">
<fieldset class="maintform">
<legend><?php echo ($id) ? 'Id: '. $id : 'Add a Lot' ?></legend>
<ul>
<li><label for="lot_name" class="required">Lot Name</label><br />
<input type="text" name="lot_name" id="lot_name" class="required"
value="<?php echo $item->getLot_name(); ?>" /></li>
<li><label for="lot_description">Lot Description</label><br />
<textarea rows="5" cols="60" name="lot_description"
id="lot_description"><?php echo $item->getLot_description(); ?></
textarea>
</li>
<li><label for="lot_image" >Lot Image File</label><br />
<input type="text" name="lot_image" id="lot_image"
value="<?php echo $item->getLot_image(); ?>" /></li>
<li><label for="lot_number">Lot Number</label><br />
<input type="text" name="lot_number" id="lot_number"
value="<?php echo $item->getLot_number(); ?>" /></li>
<li><label for="lot_price" >Lot Price</label><br />
<input type="text" name="lot_price" id="lot_price"
value="<?php echo $item->getLot_price(); ?>" /></li>
<li><?php echo $cat_dropdown; ?></li>
</ul>
<?php
// create token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1,1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="cat_id_in" id="cat_id_in"
value="<?php echo $cat_id_in; ?>" />
<input type="hidden" name="lot_id" id="lot_id"
value="<?php echo $item->getLot_id(); ?>" />
<input type="hidden" name="task" id="task" value="lot.maint" />
<input type='hidden' name='token' value='<?php echo $token; ?>'/>
<input type="submit" name="save" value="Save" />
<a class="cancel"
href="index.php?content=lots&cat_id=<?php echo $cat_id_in; i
?>&sidebar=catnav">Cancel
</a>
</fieldset>
</form>

2. In the includes/classes/category.php, add the getCat_DropDown() method to create the <select> drop-down. A category id is passed in, which is used to assign which category shows as selected. If no category id is passed then the first option is set as selected. The existing getCategories() method is used to get a list of categories. The HTML is collected in an array called $html. When that array is passed back, it is imploded with \n. 

Imploding takes the array and turns it into a single string variable, putting a \n between each element. The \n is a newline character, which creates a new line for each section when you view the source of the web page. Without the newline character, the entire drop-down would appear as a single line in the source code. It does not affect what shows when you view the web page.
public static function getCat_DropDown($selected = '') {
// set up first option for selection if none selected
$option_selected = '';
if (!$selected) {
$option_selected = ' selected="selected"';
}
// Get the categories
$items = self::getCategories();
$html = array();
$html[] = '<label for="cat_id">Choose Lot Category</label><br />';
$html[] = '<select name="cat_id" id="cat_id">';
foreach ($items as $i=>$item) {
// If the selected parameter equals the current category id
// then fl ag as selected
if ((int) $selected == (int) $item->getCat_id()) {
$option_selected = ' selected="selected"';
}
// set up the option line
$html[] = '<option value="' . $item->getCat_id()
. '"' . $option_selected . '>'
. $item->getCat_name() . '</option>';
// clear out the selected option fl ag
$option_selected = '';
}
$html[] = '</select>';
return implode("\n", $html);
}

3. In the includes/init.php file add a case block in the switch statement for lot.maint to process the lot maintenance form. This calls the maintLot() function.
case 'lot.maint' :
// process the maint
$results = maintLot();
$message .= $results[1];
// If there is redirect information
// redirect to that page
if ($results[0] == 'lotmaint') {
// pass on new messages
if ($results[1]) {
$_SESSION['message'] = $results[1];
}
$cat_id_in = (int) $_GET['cat_id'];
header("Location: index.php?content=lotmaint&cat_id=$cat_id_in i
&lot_id=$results[2]");
exit;
}
break;

4. Add the function maintLot() to includes/functions.php. Check that the token is good and then initialize an array with the information from the form. Create a Lot object with the data. If there is a lot id then this is an existing lot, so update the table with the maintRecord() method. Otherwise, create a new row with AddRecord().
function maintLot() {
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
$item = array ('lot_id' => (int) $_POST['lot_id'],
'lot_name' => filter_input(INPUT_POST,'lot_name',
FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
'lot_description' => filter_input(INPUT_POST,'lot_description',
FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
'lot_image' => filter_input(INPUT_POST,'lot_image',
FILTER_SANITIZE_STRING),
'lot_number' => (int) $_POST['lot_number'],
'lot_price' => filter_input(INPUT_POST,'lot_price',
FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION),
'cat_id' => (int) $_POST['cat_id']
);
// Set up a Lot object based on the posts
$lot = new Lot($item);
if ($lot->getLot_id()) {
$results = $lot->editRecord();
} else {
$results = $lot->addRecord();
}
}
}
return $results;
}

5. In includes/classes/lot.php add the addRecord() method to add rows to the lots table. When preparing numeric data for insertion in the database, force the variables to the proper case rather than using the Database::prep() method.
/**
* Add item
* @return array
*/
public function addRecord() {
// Verify the fields
if ($this->_verifyInput()) {
// Get the Database connection
$connection = Database::getConnection();
// Prepare the data
$query = "INSERT INTO
lots(lot_name, lot_description, lot_image, lot_number, lot_price,
cat_id)
VALUES ('" . Database::prep($this->lot_name) . "',
'" . Database::prep($this->lot_description) ."',
'" . Database::prep($this->lot_image) . "',
'" . (int) $this->lot_number . "',
'" . (fl oat) $this->lot_price . "',
'" . (int) $this->cat_id . "'
)";
// Run the MySQL statement
if ($connection->query($query)) {
$return = array('', 'Lot Record successfully added.');
// add success message
return $return;
} else {
// send fail message and return to categorymaint
$return = array('lotmaint', 'No Lot Record Added. Unable to create
record.');
return $return;
}
} else {
// send fail message and return to categorymaint
$return = array('lotmaint',
'No Lot Record Added. Missing required information.');
return $return;
}
}

6. Add the _verifyInput() method to verify that a category name was entered: 
protected function _verifyInput() {
$error = false;
if (!trim($this->lot_name)) {
$error = true;
}
if ($error) {
return false;
} else {
return true;
}
}

7. Add the editRecord() method to update records using prepared statements:
/**
* Edit existing item
* @return array
*/
public function editRecord() {
// Verify the fields
if ($this->_verifyInput()) {
// Get the Database connection
$connection = Database::getConnection();
// Prepare the data
// Set up the prepared statement
$query = 'UPDATE `lots`
SET lot_name=?, lot_description=?, lot_image=?, lot_number=?,
lot_price=?, cat_id=?
WHERE lot_id=?';
$statement = $connection->prepare($query);
// bind the parameters
$statement->bind_param('sssidii',
$this->lot_name, $this->lot_description, $this->lot_image,
$this->lot_number, $this->lot_price, $this->cat_id, $this->lot_id);
// Run the MySQL statement
if ($statement) {
$statement->execute();
$statement->close();
// add success message
$return = array('', 'Lot Record successfully added.');
// add success message
return $return;
} else {
$return = array('lotmaint',
'No Lot Record Added. Unable to create record.',
'');
return $return;
}
} else {
	// send fail message and return to categorymaint
$return = array('lotmaint',
'No Lot Record Added. Missing required information.',
(int) $this->lot_id);
return $return;
}
}

8. Test adding in lot rows. When you know you can successfully add lots, you can either add all the lots here or import the insertlots.sql file in phpMyAdmin as a shortcut.

9. Delete the contents/gents.php, contents/sporting.php, and contents/women.php files. Now, add the Delete page and delete processing for the lots table.

	1. Create contents/lotdelete.php. This page is similar to the contents/lotmaint.php file, but it displays the data from the table without allowing changes. Rather than submitting a Save button, you submit a Delete button.
<?php
/**
* lotdelete.php
*
* Delete for the Lots
*
* @version 1.2 2018-04-27
* @package Smithside Auctions
* @copyright Copyright (c) 2018 Smithside Auctions
* @license GNU General Public License
* @since Since Release 1.0
*/
// Save the category so you return to the right lots page
$cat_id_in = (int) $_GET['cat_id'];
// Get the lot id. If it doesn't exist or is 0, then this is a new lot
$id = (int) $_GET['lot_id'];
// Get the existing information for an existing item
$item = Lot::getLot($id);
// get the Category name for the lot
$cat_name = Category::getCategory($item->getCat_id())->getCat_name();
?>
<h1>Lot Delete</h1>
<form action="index.php?content=lots&cat_id=<?php echo $cat_id_in; i
?>&sidebar=catnav"
method="post" name="maint" id="maint">
<fieldset class="maintform">
<legend><?php echo 'ID: '. $id ?></legend>
<ul>
<li><strong>Lot Name: </strong>
<?php echo htmlspecialchars($item->getLot_name()); ?></li>
<li><strong>Lot Description: </strong><br />
<?php echo htmlspecialchars($item->getLot_description()); ?></li>
<li><strong>Lot Image File: </strong>
<?php echo htmlspecialchars($item->getLot_image()); ?></li>
<li><strong>Lot Number: </strong>
<?php echo (int) $item->getLot_number(); ?></li>
<li><strong>Lot Price: </strong>
<?php echo number_format($item->getLot_price(),2); ?></li>
<li><strong>Category: </strong>
<?php echo htmlspecialchars($cat_name); ?></li>
</ul>
<?php
// create token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1,1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="cat_id_in" id="cat_id_in"
value="<?php echo $cat_id_in; ?>" />
<input type="hidden" name="lot_id" id="lot_id"
value="<?php echo $item->getLot_id(); ?>" />
<input type="hidden" name="task" id="task" value="lot.delete" />
<input type='hidden' name='token' value='<?php echo $token; ?>'/>
<input type="submit" name="delete" value="Delete" />
<a class="cancel"
href="index.php?content=lots&cat_id=<?php echo $cat_id_in; ?> i
&sidebar=catnav">Cancel</a>
</fieldset>
</form>

	2. In the includes/init.php file, add the lot.delete case to process the delete form, which calls the deleteLot() function. The catalog id is also used in the URL to select the appropriate pages.
case 'lot.delete' :
// process the delete
$results = deleteLot();
$message .= $results[1];
// If there is redirect information
// redirect to that page
if ($results[0] == 'lotdelete') {
// pass on new messages
if ($results[1]) {
$_SESSION['message'] = $results[1];
}
$cat_id_in = (int) $_GET['cat_id'];
header("Location:
index.php?content=lotdelete&cat_id=$cat_id_in&lot_id=$results[2]");
exit;
}
break;

	3. In the includes/functions.php file, add the deleteCategory() function, which calls the deleteRecord() method in the Lot class.
function deleteLot() {
$results = '';
if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
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
// Delete the Lot from the table
$results = Lot::deleteRecord((int) $_POST['lot_id']);
}
}
return $results;
}

	4. In the includes/classes/lot.php file, add the deleteRecord() method, which deletes the row from the lots table:
public static function deleteRecord($id) {
// Get the Database connection
$connection = Database::getConnection();
// Set up query
$query = 'DELETE FROM `lots` WHERE lot_id="'. (int) $id.'"';
// Run the query
if ($result = $connection->query($query)) {
$return = array('', 'Lot Record successfully deleted.', '');
return $return;
} else {
$return = array('lotdelete', 'Unable to delete Lot.', (int) $id);
return $return;
}
}

	5. Check all your changes and verify them. Test that you can delete items.




















