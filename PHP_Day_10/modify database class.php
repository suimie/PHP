Continue modifying php pages. 

3. Create a constant in includes/init.php called MAGIC_QUOTES_ACTIVE that contains the result of get_magic_quotes_gpc(). This contains a 1 if magic quotes are on. Creating a constant once rather than running the function each time you need it is quicker.
define('MAGIC_QUOTES_ACTIVE', get_magic_quotes_gpc());

4. Create a public static method called prep() in includes/classes/database.php to prepare the data for insertion into the database. The data is passed to the function as a parameter.

To refer to the connection property, use the static construction of self::$_connection.
public static function prep($value) {
if (MAGIC_QUOTES_ACTIVE) {
// If magic quotes is active, remove the slashes
$value = stripslashes($value);
}
// Escape special characters to avoid SQL injections
$value = self::$_connection->real_escape_string($value);
return $value;
}


5. In the includes/init.php file, move the require_once 'includes/functions.php'; to just below the magic quotes constant.

6. Add processing to the includes/init.php file. This file works as the traffic cop to decide what task needs to be done. Up until now the implied task has been to display pages. Set up a switch to check for tasks with a case block where the condition is equal to contact.maint.
Break out at the end of the case block.

// Process based on the task. Default to display
$task = filter_input(INPUT_POST,'task', FILTER_SANITIZE_STRING);
switch ($task) {
case 'contact.maint' :
break;
}

7. Within the case block you created in step 5, run a function to process the task. The $results return consists of an array where the first element is a redirect to different content page, if any. The second element contains a message, which is assigned the $message variable.

If there is a redirect page, move the message to a SESSION variable and redirect. Change the code to this code:
// Process based on the task. Default to display
$task = filter_input(INPUT_POST,'task', FILTER_SANITIZE_STRING);
switch ($task) {
case 'contact.maint' :
// process the maint
$results = maintContact();
$message .= $results[1];
// If there is redirect information
// redirect to that page
if ($results[0] == 'contactmaint') {
// pass on new messages
if ($results[1]) {
$_SESSION['message'] = $results[1];
}
header("Location: index.php?content=contactmaint");
exit;
}
break;
}

8. Because you are using a SESSION variable you need to start the session at the very beginning of the file, just after the documentation:
session_start(); // starts new or resumes existing session 9. Add processing to check the SESSION for a message and move it to $message and then remove it from the SESSION with an unset. Put this before the task processing.

// Initialize message coming in
$message = '';
if (isset($_SESSION['message'])) {
$message = htmlentities($_SESSION['message']);
unset($_SESSION['message']);
}

10. Add the maintContact() function in includes/functions.php. Start by initializing
the $results variable. If the Save button was clicked and equals Save, check the token.
If there is a problem, put a message in the result. Otherwise, fi lter the data from the form
and put it in an array called $item. Use that array to create a new Contact object. Run the
addRecord() method of the object to add the row to the database, putting the results in
$results.
function maintContact() {
$results = '';
if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
// check the token
$badToken = true;
if (!isset($_POST['token'])
|| !isset($_SESSION['token'])
|| empty($_POST['token'])
|| $_POST['token'] !== $_SESSION['token']) {
$results = array('','Sorry, go back and try again. There was a i
security issue.');
$badToken = true;
} else {
$badToken = false;
unset($_SESSION['token']);
// Put the sanitized variables in an associative array
// Use the FILTER_FLAG_NO_ENCODE_QUOTES to allow names like O'Connor
$item = array ( 'id' => (int) $_POST['id'],
'fi rst_name' => filter_input(INPUT_POST,'first_name',
FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
'last_name' => filter_input(INPUT_POST,'last_name',
FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
'position' => filter_input(INPUT_POST,'position',
FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
'email' => filter_input(INPUT_POST,'email',
FILTER_SANITIZE_STRING),
'phone' => filter_input(INPUT_POST,'phone',
FILTER_SANITIZE_STRING)
);
// Set up a Contact object based on the posts
$contact = new Contact($item);
$results = $contact->addRecord();
}
}
return $results;
}

11. Add the public method addRecord() in includes/classes/contact.php. This function calls the method _verifyInput(). If the data is verified, get the database connection. Set up the data by creating the INSERT statement. Use the Database::prep() method to prepare the data. Create the array $result() where the first element is blank for normal processing, or contactmaint if there is an error where the user should stay on the contactmaint page.

The second element contains a success message or an error message. 

public function addRecord() {
// Verify the fields
if ($this->_verifyInput()) {
// Get the Database connection
$connection = Database::getConnection();
// Prepare the data
$query = "INSERT INTO contacts(first_name, last_name, position, email,
phone)
VALUES ('" . Database::prep($this->first_name) . "',
'" . Database::prep($this->last_name) . "',
'" . Database::prep($this->position) . "',
'" . Database::prep($this->email) . "',
'" . Database::prep($this->phone) . "')";
// Run the MySQL statement
if ($connection->query($query)) {
$return = array('', 'Contact Record successfully added.');
// add success message
return $return;
} else {
// send fail message and return to contactmaint
$return = array('contactmaint', 'No Contact Record Added. Unable to i
create record.');
return $return;
}
} else {
// send fail message and return to contactmaint
$return = array('contactmaint', 'No Contact Record Added. Missing i
required information.');
return $return;
}
}

12. Add the protected function _verifyInput() in includes/classes/contact.php. This
method checks that the required fields have been filled in. It returns false if there is an error.
protected function _verifyInput() {
$error = false;
if (!trim($this->first_name)) {
$error = true;
}
if (!trim($this->last_name)) {
$error = true;
}
if ($error) {
return false;
} else {
return true;
}
}
13. In index.php change the <div class="message"> section to just display the $message
variable:
<div class="message">
<?php echo $message; ?>
</div><!-- end message -->

