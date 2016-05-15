<?php

class BTravelplanAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// TRAVEL予約
	public function index() {
		import ( 'ORG.Util.Page' );

		$this->display ();
	}
	
	// 追加TRAVEL
	public function addBus() {
	
	}
	
	//删除TRAVEL
	public function delBus() {


	}
	
	// 取得TRAVELid
	public function getBus() {

	}
}

?>