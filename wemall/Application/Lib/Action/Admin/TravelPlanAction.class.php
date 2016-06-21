<?php

class TravelPlanAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// TRAVEL予約
	public function index() {
		import('ORG.Util.Page');
		$agencylist = M('agency')->select();
		$agentlist = M('agent')->select();
		$citylist = M('city')->select();
        $starlist = array("0"=>"三星", "1"=>"四星", "2"=>"五星");
        $blist = array("选择早餐", "酒店提供", "日式早餐");
        $llist = array("选择午餐", "酒店提供", "日式午餐");
        $dlist = array("选择晚餐", "酒店提供", "日式晚餐");
        

		$this->assign("agencylist", $agencylist);
		$this->assign("agentlist", $agentlist);
		$this->assign("citylist", $citylist);
        $this->assign("starlist", $starlist);
        $this->assign("blist", $blist);
        $this->assign("llist", $llist);
        $this->assign("dlist", $dlist);
		$this->display();
	}
	
	// 追加TRAVEL
	public function makeList() {
		$data['begindate'] = $_POST['begindate'];
		$data['enddate'] = $_POST['enddate'];
		$data['number'] = $_POST['number'];
		$data['flight'] = $_POST['flight'];
		$data['agencyid'] = $_POST['agencyid'];
		$data['agentid'] = $_POST['agentid'];

        $travelplan = M("travelplan");
        $groupmap = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    	$count = $travelplan->where(array("begindate"=>$data['begindate'], "agencyid"=>$data['agencyid'], "agentid"=>$data['agentid']))->count();
    	$agency = M('agency')->where(array("id"=>$data['agencyid']))->find();
    	$agent = M('agent')->where(array("id"=>$data['agentid']))->find();
    	$data['name'] = sprintf("POLO %s - %s - %s - %s团", $data['begindate'], $agency['name'], $agent['name'], $groupmap[$count]);
    	session('data', $data);

        $this->ajaxReturn($data['name'], "OK", 1);
	}

    public function getHotelList() {
        //&#9679;&#9650;
        $cityid = $_POST['cityid'];
        $level = $_POST['starid'];
        $hotellist = M('hotel_info')->where(array("cityid"=>$cityid, "level"=>$level))->select();
        $data = $hotellist;
        $this->ajaxReturn($data, "OK", 1);
    }

	public function getSpotList() {
		$cityid = $_POST['cityid'];
		$spotlist = M('viewspot')->where(array("cityid"=>$cityid))->select();
		$this->ajaxReturn($spotlist, "OK", 1);
	}
}

?>
