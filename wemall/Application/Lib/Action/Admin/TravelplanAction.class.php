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

		$this->assign("agencylist", $agencylist);
		$this->assign("agentlist", $agentlist);
		$this->assign("citylist", $citylist);
        $this->assign("starlist", $starlist);
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
        $data['id'] = $_POST['groupid'];

        $travelplan = M("travelplan");
        if ($data['id'] != '') {
        	//$travelplan->save($data);
        	$data['name'] = session('data')['name'];
        	session('data', $data);
        } else {
            $groupmap = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			$count = $travelplan->where(array("begindate"=>$data['begindate'], "agencyid"=>$data['agencyid'], "agentid"=>$data['agentid']))->count();
			$agency = M('agency')->where(array("id"=>$data['agencyid']))->find();
			$agent = M('agent')->where(array("id"=>$data['agentid']))->find();
			$data['name'] = sprintf("POLO %s - %s - %s - %s团", $data['begindate'], $agency['name'], $agent['name'], $groupmap[$count]);
			//$data['id'] = $travelplan->add($data);
			$data['id'] = '0';
			session('data', $data);
		}

        $result = array();
        $result['groupid'] = $data['id'];
        $result['groupname'] = $data['name'];
        $this->ajaxReturn($result, "OK", 1);
	}

    public function getHotelList() {
        //&#9679;&#9650;
    }

    public function savePlan() {
        
    }

	public function getSpotList() {
		$cityid = $_POST['cityid'];
		$spotlist = M('viewspot')->where(array("cityid"=>$cityid))->select();
		$this->ajaxReturn($spotlist, "OK", 1);
	}
}

?>