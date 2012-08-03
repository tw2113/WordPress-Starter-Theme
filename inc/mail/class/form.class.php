<?php 

/**
 * Form makes/validates forms
 * V1.0
 *
 * This generates HTML5 forms & validates them.
 *
 * $form->setInputField($attr, $cuteName='', $label=false)
 * $form->setSelectField($attr, $cuteName='', $label=false)
 * $form->setTextArea($attr, $cuteName='', $label=false)
 * $form->setHtmlSnippet($html='')
 * $form->isSent()
 * $form->validInput()
 * $form->getInputValue($name)
 * $form->setInputValue($name, $value=false)
 * $form->getAttrs($attrs)
 * $form->display($echo=true)
 *
 * @author Mike Rogers <mike.r@fullondesign.co.uk>
 */
class form{
	public $fields,  $form_attr, $attr;
	private $form_method;
	
	public function __construct($form_attr=''){
		// Set some deafult attributes
		$defaults = array('name'=>'form-name', 'method'=>'post', 'action'=>'', 'enctype'=>'application/x-www-form-urlencoded');
		$this->form_attr = array_merge($defaults, parseAStr($form_attr));

		// Set a hidden field to figure out if this form has been posted.
		$this->setInputField(array('name'=>$this->form_attr['name'], 'type'=>'hidden', 'value'=>'true'));
		
		// quickly stripslashes from post data:
		if(is_array($_POST)){
			foreach($_POST as $key => $value){
				$_POST[$key] = stripslashes($value);
			}
		}
	}
	
	public function setInputField($attr, $cuteName='', $label=false){
		$defaults = array('name'=>'field-name', 'type'=>'text', 'value'=>'', 'placeholder'=>'');
		$attr = array_merge($defaults, parseAStr($attr));
		$name = $attr['name'];
		
		// set the field class
		$this->fields[$name] = new inputField($attr, $cuteName, $label);
		
		return $this->fields[$name];
	}
	
	public function setSelectField($attr, $cuteName='', $label=false){
		$defaults = array('name'=>'field-name', 'value'=>'');
		$attr = array_merge($defaults, parseAStr($attr));
		$name = $attr['name'];
		
		// set the field class
		$this->fields[$name] = new selectField($attr, $cuteName, $label);
		return $this->fields[$name];
	}
	
	public function setTextArea($attr, $cuteName='', $label=false){
		$defaults= array('name'=>'field-name', 'type'=>'text', 'value'=>'', 'placeholder'=>'');
		$attr = array_merge($defaults, parseAStr($attr));
		$name = $attr['name'];
		
		// set the field class
		$this->fields[$name] = new textArea($attr, $cuteName, $label);
		
		return $this->fields[$name];
	}
	
	public function setHtmlSnippet($html=''){
		$this->fields[] = new htmlSnippet($html);
		
		return $this->fields[$name];
	}
	
	// Check if the form has been sent.
	public function isSent(){
		if($this->form_attr['method'] == 'post'){
			if(isset($_POST[$this->form_attr['name']])){
				return true;
			}
			return false;
		}
		if(isset($_GET[$this->form_attr['name']])){
			return true;
		}
		return false;
	}
	
	
	public function validInput(){
		global $notices;
		
		
		if(is_array($this->fields)){foreach($this->fields as $field_key => $value){
			if(get_class($value) == 'textArea' || get_class($value) == 'inputField'){
			
				// If this is required and it's blank or it is the same as it's placeholder. Set it to flase and return a notice.
				if(isset($value->attr['required']) && ($this->getInputValue($value->attr['name']) === '' ||  $this->getInputValue($value->attr['name']) === $value->attr['placeholder'])){
					$this->setInputValue($value->attr['name']);
					$notices->add('"'.$value->cuteName.'" field cannot be blank');
					continue;
				}
				// If the field is blank & not required.
				if(!isset($value->attr['required']) && ($this->getInputValue($value->attr['name']) === '' ||  $this->getInputValue($value->attr['name']) === $value->attr['placeholder'])){
					continue;
				}
				
				
				if($value->attr['type'] === 'number' && filter_var($this->getInputValue($value->attr['name']), FILTER_VALIDATE_FLOAT) === false){
					$notices->add('"'.$value->cuteName.'" field must be a number');
					$this->setInputValue($value->attr['name']);
					continue;
				}elseif($value->attr['type'] === 'email' && $this->validateEmail($this->getInputValue($value->attr['name'])) === false){
					$notices->add('"'.$value->cuteName.'" field must be an email');
					$this->setInputValue($value->attr['name']);
					continue;
				}elseif($value->attr['type'] === 'regex' && filter_var($this->getInputValue($value->attr['name']), FILTER_VALIDATE_REGEXP, array('options'=>array("regexp"=>$value->attr['pattern']))) === false){
					$notices->add('"'.$value->cuteName.'" field is invalid');
					$this->setInputValue($value->attr['name']);
					continue;
				}
				
				// The input is valid, so we can put the users input in...
				$value->attr['value'] = $this->getInputValue($value->attr['name']);
			
			}elseif(get_class($value) == 'selectField'){
				if(is_array($value->options)){foreach($value->options as $option_key => $options){ // reset all options ot false;
						$value->options[$option_key]['selected'] = false;
					}
					$value->options[$this->getInputValue($value->attr['name'])]['selected'] = true;
				}
			}
		}}
		
		if(is_array($notices->notices)){
			return false;
		}
		return true;
	}
	
	public function validateEmail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			return false;
		}
		
		// Next check the domain is real.
		$domain = explode("@", $email, 2);
		return checkdnsrr($domain[1]); // returns TRUE/FALSE;
	}
	
	public function getInputValue($name){
		if($this->form_attr['method'] === 'post'){
			return $_POST[$name];
		}
		return $_GET[$name];
	}
	
	public function setInputValue($name, $value=false){
		if($this->form_attr['method'] === 'post'){
			$_POST[$name] = $value;
			return true;
		}
		$_GET[$name] = $value;
		return true;
	}
	
	public function getAttrs($attrs){
		$return = '';
		if(is_array($attrs)){foreach($attrs as $key => $value){
			if(is_bool($value)){
				$return .= ' '.$key;
			}else{
				$return .= ' '.$key.'="'.$value.'"';
			}
		}}
		return $return;
	}
	
	public function display($echo=true){
		$return = '<form'.$this->getAttrs($this->form_attr).'>';
		if(is_array($this->fields)){foreach($this->fields as $field_key => $value){
			$return .= $value->getHTML();
		}}
		$return .= '</form>';
		return recho($return, $echo);
	}
}

class inputField extends form{
	public $attr, $cuteName, $label;
	
	public function __construct($attr, $cuteName='', $label=true){
		$this->attr = $attr;
		$this->cuteName = $cuteName;
		$this->label = $label;
	}
	
	public function getHTML(){
		$return = '<input'.parent::getAttrs($this->attr).'/>';
		if($this->label != false){
			$return = '<label for="'.$this->attr['name'].'">'.$this->cuteName.$return.'</label>';
		}
		return $return;
	}
}

class textArea extends inputField{

	public function getHTML(){
		// Quickly unset the attr[value] so we can we can move it after the textarea.
		$value = $this->attr['value'];
		unset($this->attr['value']);
		
		$return = '<textarea'.parent::getAttrs($this->attr).'>'.$value.'</textarea>';
		
		// set $this->attr['value']  agan.
		$this->attr['value'] = $value;
		
		if($this->label != false){
			$return = '<label for="'.$this->attr['name'].'">'.$this->cuteName.$return.'</label>';
		}
		
		return $return;
	}
}

class selectField extends inputField{
	public $options;

	public function addOption($option, $displayName, $selected=false){
		if($this->attr['value'] == $option){
			$selected = true;
		}
		$this->options[$option] = array('displayName'=>$displayName, 'selected'=>$selected);
	}

	public function getHTML(){
		unset($this->attr['value']); // Remove the value attr
		
		$return = '<select'.parent::getAttrs($this->attr).'>';
		
		// Cycle through the options
		if(is_array($this->options)){foreach($this->options as $option => $values){
			$return .= '<option value="'.$option.'" '.(($values['selected'] == false) ? '' : 'selected').'>'.$values['displayName'].'</option>';
		}}
		
		$return .= '</select>';
		
		if($this->label != false){
			$return = '<label for="'.$this->attr['name'].'">'.$this->cuteName.$return.'</label>';
		}
		
		return $return;
	}
}

class htmlSnippet{
	public $html;
	public function __construct($html=''){
		$this->html = $html;
	}
	
	public function getHTML(){
		return $this->html;
	}
}
?>