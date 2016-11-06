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
    	session('travelplan', $data);

        $this->ajaxReturn($data['name'], "OK", 1);
	}

    public function getHotelList() {
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

    public function savePlan() {
        // update group name.
        $data = session('travelplan');
        $travelplan = M("travelplan");
        $groupmap = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $count = $travelplan->where(array("begindate"=>$data['begindate'], "agencyid"=>$data['agencyid'], "agentid"=>$data['agentid']))->count();
        $agency = M('agency')->where(array("id"=>$data['agencyid']))->find();
        $agent = M('agent')->where(array("id"=>$data['agentid']))->find();
        $data['name'] = sprintf("POLO %s - %s - %s - %s团", $data['begindate'], $agency['name'], $agent['name'], $groupmap[$count]);
        $tpid = $travelplan->add($data);
        session('travelplan', $data);

        $this->success ( "保存成功！" );
        // array count is list number.
        //$_POST['date'] = array[3]
        //    $_POST['date'][0] = (string) 2016/11/1
        //    $_POST['date'][1] = (string) 2016/11/2
        //    $_POST['date'][2] = (string) 2016/11/3
        //$_POST['week'] = array[3]
        //    $_POST['week'][0] = (string) 周二
        //    $_POST['week'][1] = (string) 周三
        //    $_POST['week'][2] = (string) 周四
        //$_POST['spotid'] = array[3]
        //    $_POST['spotid'][0] = array[1]
        //        $_POST['spotid'][0][0] = (string) 4
        //    $_POST['spotid'][1] = array[1]
        //        $_POST['spotid'][1][0] = (string) 5
        //    $_POST['spotid'][2] = array[2]
        //        $_POST['spotid'][2][0] = (string) 3
        //        $_POST['spotid'][2][1] = (string) 3
        //$_POST['hotelid'] = array[3]
        //    $_POST['hotelid'][0] = array[1]
        //        $_POST['hotelid'][0][0] = (string) 2
        //    $_POST['hotelid'][1] = array[2]
        //        $_POST['hotelid'][1][0] = (string) 3
        //        $_POST['hotelid'][1][1] = (string) 2
        //    $_POST['hotelid'][2] = array[1]
        //        $_POST['hotelid'][2][0] = (string) 2
        //$_POST['sroom'] = array[3]
        //    $_POST['sroom'][0] = array[1]
        //        $_POST['sroom'][0][0] = (string) 1
        //    $_POST['sroom'][1] = array[2]
        //        $_POST['sroom'][1][0] = (string) 0
        //        $_POST['sroom'][1][1] = (string) 1
        //    $_POST['sroom'][2] = array[1]
        //        $_POST['sroom'][2][0] = (string) 1
        //$_POST['troom'] = array[3]
        //    $_POST['troom'][0] = array[1]
        //        $_POST['troom'][0][0] = (string) 2
        //    $_POST['troom'][1] = array[2]
        //        $_POST['troom'][1][0] = (string) 2
        //        $_POST['troom'][1][1] = (string) 0
        //    $_POST['troom'][2] = array[1]
        //        $_POST['troom'][2][0] = (string) 2
        //$_POST['droom'] = array[3]
        //    $_POST['droom'][0] = array[1]
        //        $_POST['droom'][0][0] = (string) 3
        //    $_POST['droom'][1] = array[2]
        //        $_POST['droom'][1][0] = (string) 1
        //        $_POST['droom'][1][1] = (string) 2
        //    $_POST['droom'][2] = array[1]
        //        $_POST['droom'][2][0] = (string) 3
        //$_POST['breakfast'] = array[3]
        //    $_POST['breakfast'][0] = (string) 酒店提供
        //    $_POST['breakfast'][1] = (string) 酒店提供
        //    $_POST['breakfast'][2] = (string) 日式早餐
        //$_POST['lunch'] = array[3]
        //    $_POST['lunch'][0] = (string) 日式午餐
        //    $_POST['lunch'][1] = (string) 酒店提供
        //    $_POST['lunch'][2] = (string) 酒店提供
        //$_POST['dinner'] = array[3]
        //    $_POST['dinner'][0] = (string) 日式晚餐
        //    $_POST['dinner'][1] = (string) 日式晚餐
        //    $_POST['dinner'][2] = (string) 酒店提供
        //$_POST['localprice'] = (string) 123
        //$_POST['roomprice'] = (string) 12
    }
}

?>
