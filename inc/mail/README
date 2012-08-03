## Building & displaying the form

To create the form, call the class.

`$myForm = new form();`

then add a few inputs

`$myForm->setInputField(array('name'=>'your-name', 'required'=>true), 'Your Name', true);`
`$myForm->setInputField(array('name'=>'submit', 'value'=>'Submit', 'type'=>'Submit'));`

Then to display the form, use this code:

`$myForm->display();`

## Validating the form

Validating the form is really easy, the best way to do it is:

`if($myForm->isSent() && $myForm->validInput()){`
` // The form is ok - work with data here `
` } `
