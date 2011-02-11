<?php
namespace chowly\controllers;

use chowly\models\Ticket;
use li3_flash_message\extensions\storage\FlashMessage;

class TicketsController extends \chowly\extensions\action\Controller{
	public function add(){
		$ticket = Ticket::create();
		if($this->request->data){
			if($ticket->save($this->request->data)){
				$this->redirect(array('Tickets::received'));
			}else{
				FlashMessage::set('Sorry, there is something wrong with the provided information.');
			}
		}
		
		$isRestaurant = false;
		
		if(in_array('restaurants',$this->request->args)){
			$isRestaurant = true;
		}
		return compact('ticket','isRestaurant');
	}
	public function received(){}
}
?>