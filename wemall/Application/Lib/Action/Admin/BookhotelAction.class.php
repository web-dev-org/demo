<?php

class BookhotelAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// Bus予約
	public function index() {
		import ( 'ORG.Util.Page' );

		$this->display ();
	}
	
	// 追加BUS
	public function addhotel() {
	
	}
	
	//删除BUS
	public function delhotel() {


	}
	
	// 取得BUS　id
	public function gethotel() {

	}
}

?>