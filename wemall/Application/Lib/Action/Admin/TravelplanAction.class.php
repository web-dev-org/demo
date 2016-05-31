<?php

class TravelPlanAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// TRAVEL予約
	public function index() {
		$a = IS_POST;
		$b = IS_GET;
		import('ORG.Util.Page');
		$agencylist = M('agency')->select();
		$agentlist = M('agent')->select();

		$this->assign("agencylist", $agencylist);
		$this->assign("agentlist", $agentlist);
		$this->display();
	}
	
	// 追加TRAVEL
	public function makeList() {
		$begindate = strtotime($_POST['begindate']);
		$enddate = strtotime($_POST['enddate']);
		$number = $_POST['number'];
		$flight = $_POST['flight'];
		$agency = $_POST['agency'];
		$agent = $_POST['agent'];
        
        $data = array();
        $data['groupid'] = $this->makeGroupID($begindate, $agency, $agent);
        $this->ajaxReturn($data,"OK",1);
	}

	protected function makeGroupID($begindate, $agency, $agent) {
		return 'A';
	}
}

?>