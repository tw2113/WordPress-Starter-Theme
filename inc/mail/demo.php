<?php
/**
 * HTML5 Form Class
 *
 * A simple form class to make building / validating forms easier.
 *
 * @author Mike Rogers <mike.r@fullondesign.co.uk>
 * @since 21/08/2011
 */
 
include('func/functions.func.php');
include('class/notices.class.php');
include('class/form.class.php');

// Set up the classes.
$notices = new notices();
$myForm = new form();

// Add some fields to the form.
// This is a standard text input field, with a label of "Your Name"
$myForm->setInputField(array('name'=>'your-name', 'required'=>true), 'Your Name', true);

// This is an email field.
$myForm->setInputField(array('name'=>'your-email', 'type'=>'email'), 'Your Email (Optional)', true);

// This is a select field.
$options = $myForm->setSelectField(array('name'=>'your-gender', 'value'=>'female'), 'Your Gender', TRUE);
// You can add options like this:
$options->addOption('male', 'Male');
// Or if you don't want to create a new variable, like this:
$myForm->fields['your-gender']->addOption('female', 'Female');
$myForm->fields['your-gender']->addOption('other', 'Other');

$myForm->setTextArea(array('name'=>'your-comments'), 'Comments', true);

$myForm->setInputField(array('name'=>'submit', 'value'=>'Submit', 'type'=>'Submit'));

$myForm->setHtmlSnippet('Thanks for looking at my form!');


if($myForm->isSent() && $myForm->validInput()){
	// It's been sent and it's valid. Do something with the data.
	// Use $_POST['name'] to access data, but you can also use $myForm->getInputValue('name')
	$notices->add('The form has worked!');
}
?>
<html lang="en" class="no-js">
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>PHP - HTML5 Form Class</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="css/style.css?v=1"> 
</head> 
<body>
<h1>PHP - HTML5 Form Class</h1>
<?php
	if(is_array($notices->notices)){ // If there is an notice to display.
		$notices->display();
	}
	
	$myForm->display();
?>
</body>
</html>
