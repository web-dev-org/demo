<?php

class TravelPlanViewAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// TRAVEL予約
	public function index() {
		import ( 'ORG.Util.Page' );

		$this->display ();
	}
	
	// 追加TRAVEL
	public function addTravelPlan() {
	
	}
	
	//删除TRAVEL
	public function delTravelPlan() {


	}
	
	// 取得TRAVELPlan
	public function getTravelPlan() {

	}
}

?>