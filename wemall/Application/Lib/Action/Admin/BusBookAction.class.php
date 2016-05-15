<?php

class BusBookAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// Bus予約
	public function index() {
		import ( 'ORG.Util.Page' );

		$this->display ();
	}
	
	// 追加BUS
	public function addBus() {
	
	}
	
	//删除BUS
	public function delBus() {


	}
	
	// 取得BUS　id
	public function getBus() {

	}
}

?>