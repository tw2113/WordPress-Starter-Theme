<?php

/**
 * Notices helps manage errors/notices.
 *
 * Notices is a bit like Exception, but does not stop
 * the stack and allows for mutilple issues.
 *
 * $notices->add($notice)
 * $notices->display()
 *
 * @author Mike Rogers <mike.r@fullondesign.co.uk>
 */
class notices{
	public $notices;
	
	public function __construct(){
		$this->notices = false;
	}
	
	/**
	 * Adds the Notice
	 *
	 * @param string $notice - The notice you want to put into the array.
	 * @return $this
	 */
	public function add($notice){
		$this->notices[] = $notice;
		return $this;
	}
	
	/**
	 * Displays the notices
	 *
	 */
	public function display(){
		if(is_array($this->notices)){
			echo '<ul id="notices">';
				foreach($this->notices as $notice){
					echo '<li>'.$notice.'</li>';
				}
			echo '</ul>';
		}
	}
}
?>
