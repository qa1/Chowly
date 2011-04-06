<?php
namespace chowly\models;

class ticket extends \lithium\data\Model{
	public $_schema = array(
		'_id' => array('type'=>'id'),
		'name' => array('type'=>'string','null'=>false),
		'email' => array('type'=>'string','null'=>false),
		'content' => array('type'=>'string'),
		'created' => array('type'=>'date'),
		'modified' => array('type'=>'date')
	);
	public $validates = array(
		'name' => array(
			array('notEmpty', 'message'=>'To better serve you, we need to know your name.')
		),
		'content' => array(
			array('notEmpty', 'message'=> 'You must tell us something...')
		),
		'email' => array(
			array('email', 'message' => 'We need a valid email for us to respond.')
		),
		'zip' => array(
			array('zip', 'skipEmpty'=>true, 'message' => 'Invalid Canadian postal code.')
		)
	);
	
}
?>