<?php

class SpotcontrolAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// Bus予約
	public function index() {
		import ( 'ORG.Util.Page' );

		$this->display ();
	}
	
	// 追加BUS
	public function addSpot() {
	
	}
	
	//删除BUS
	public function delSpot() {


	}
	
	// 取得BUS　id
	public function getSpot() {

	}
}

?>