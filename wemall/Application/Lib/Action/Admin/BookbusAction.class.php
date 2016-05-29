<?php

class BookbusAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// Bus予約
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "viewspot" );
	
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
	
		$results1 = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id asc")->select ();
		$results2 = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id asc")->select ();
		// 地域信息取得
		$citylist = R("Api/Api/getCityList");
		$spotlist = R("Api/Api/getSpotList");
		
		for($i = 0; $i < count ( $results1 ); $i ++) {
			// 取得city
			$cityid = $results1 [$i] ["cityid"];
			$city = M ("city")->where ( array ("id" => $cityid) )->find ();
			$results1 [$i] ["cityname"] = $city['name'];
		}
		for($i = 0; $i < count ( $results2 ); $i ++) {
		    // 取得spot
		    $spotid = $results2 [$i] ["$spotid"];
		    $spot = M ("viewspot")->where ( array ("id" => $spotid) )->find ();
		    $results2 [$i] ["spotname"] = $spot['name'];
		}
		
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "results", $results1 );
		$this->assign ( "results", $results2 );
		$this->assign ( "citylist", $citylist );
		$this->assign ( "spotlist", $spotlist );
		$this->display ();
	}
	
	// 追加BUS
	public function addBus() {
	    $data ["cityid"] = $_POST ["cityid"]; //分类
	    $data ["name"] = $_POST ["viewname"]; //名称
	    if (isset($_POST ["editorValue"])) {
	        $data ["description"] = $_POST ["editorValue"]; //详细
	    }
	    
	    if ($_POST["viewid"]) {
	        $data ["id"] = $_POST["viewid"]; //商品id
	        M ("viewspot")->save($data);
	        $this->success ( "修改景点成功！" );
	    }else{
	        $result = M("viewspot")->add($data);
	        $this->success ( "添加景点成功！" );
	    }
	}
	
	//删除BUS
	public function delBus() {


	}
	
	// 取得BUS　id
	public function getBus() {

	}
}

?>