<?php

class MemberAction extends PublicAction{
	
	public function _initialize() {
		parent::_initialize ();
	}	
	
	public function index() {
		import ( 'ORG.Util.Page' );
		
		$m = M ( "member" );
		
		if ( $this->cityid != "0" ) {
			$where["pcityid"] = $this->cityid;
			$citylist = M("city")->where(array("id"=>$this->cityid))->find();
		} else {
			$citylist = M("city")->where(array("pid"=>"0"))->select();
		}
		
		if ( IS_POST ) {
			$cityid = $_POST["cityid"];
			$tel = $_POST["tel"];
			$salesCode = $_POST["seSalesCode"];
			$parameter = $_POST;

		}else if (IS_GET) {
			$cityid = $_GET["cityid"];
			$tel = $_GET["tel"];
			$salesCode = $_GET["seSalesCode"];
			$parameter = $_GET;
		}

		if ( !empty($cityid) ) {
			$where["pcityid"] = $cityid;
		}
		if ( !empty($tel) ) {
			$where["tel"] = $tel;
		}
		if ( !empty($salesCode) ) {
			$where["salescode"] = $salesCode;
		}
		
		
		$count = $m->where($where)->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		
		foreach($parameter as $key=>$val) {
			$Page->parameter   .=   "$key=".urlencode($val).'&';
		}
		
		$show = $Page->show (); // 分页显示输出
		
		$result = $m->where($where)->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		
		foreach ( $result as &$row ) {
			if ( $row["memlevel"] == "1" ) {
				$row["level"] = "1级会员";
			} else if( $row["memlevel"] == "2" ) {
				$row["level"] = "2级会员";
			} else if( $row["memlevel"] == "3" ) {
				$row["level"] = "3级会员";
			} else if( $row["memlevel"] == "4" ) {
				$row["level"] = "4级会员";
			} else {
				$row["level"] = "5级会员";
			}
			if ($row["states"] == "0" ) {
				$row["statesName"] = "无效";
			} else if( $row["states"] == "1" ) {
				$row["statesName"] = "有效";
			}
			
			// 主城市名取得
			$city = M("city")->where(array("id"=>$row["pcityid"]))->getField("name");
			// 区域取得
			$area = M("city")->where(array("id"=>$row["cityid"]))->find();
			$row["address"] = $city.$area["name"].$row["address"];
		}
		
		$this->assign ( "salesCode", $salesCode );
		$this->assign ( "searchCity", $cityid );
		$this->assign ( "tel", $tel );
		$this->assign ( "result", $result );
		$this->assign ( "cityid", $this->cityid );
		$this->assign ( "citylist", $citylist );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->display ();
	}
	
	
	public function updateMemInfo() {
		
		$data["id"] = $_POST["userid"];
		$data["memlevel"] = $_POST["memLevel"];
		$data["diffstandard"] = $_POST["diffNum"];
		$data["states"] = $_POST["memStates"];
		
		$result = M("member")->where(array("id"=>$data["id"]))->save($data);
		
		if ($result) {
			$this->success ( "修改成功" );
		} else {
			$this->error ( "修改失败" );
		}
	}
	
	
}

?>
