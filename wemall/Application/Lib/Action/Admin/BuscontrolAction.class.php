<?php

class buscontrolAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// Bus管理
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "buscompany" );
	
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
	
		$results = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id asc")->select ();
		// 地域信息取得
		$citylist = R("Api/Api/getCityList");
		
		for($i = 0; $i < count ( $results ); $i ++) {
			// 取得商品基本信息
			$cityid = $results [$i] ["cityid"];
			$city = M ("city")->where ( array ("id" => $cityid) )->find ();
			$results [$i] ["cityname"] = $city['name'];
		}
		
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "results", $results );
		$this->assign ( "citylist", $citylist );
		$this->display ();
	}
	
	// 追加BUS会社
	public function addBus() {
	    $data ["cityid"] = $_POST ["cityid"]; //City
	    $data ["name"] = $_POST ["buscompanyname"]; //名称
	    $data ["tel"] = $_POST ["tel"]; //tel
	    $data ["fax"] = $_POST ["fax"]; //fax
	    $data ["contanter"] = $_POST ["contanter"]; //連絡先
	    if ($_POST["buscompanyid"]) {
	        $data ["id"] = $_POST["buscompanyid"]; //商品id
	        M ("buscompany")->save($data);
	        $this->success ( "修改BUS会社成功！" );
	    }else{
	        $result = M("buscompany")->add($data);
	        $this->success ( "添加BUS会社成功！" );
	    }
	}
	
	//删除BUS会社
	public function delBus() {
	    $id = $_GET ["id"];
	    $result = M ("buscompany")->where (array("id" => $id))->delete();
	    
	    if ( $result !== false ) {
	        $this->success ( "BUS会社の削除が成功！" );
	    } else {
	        $this->error ( "BUS会社の削除が失敗！" );
	    }

	}
	
	// 取得BUS
	public function getBus() {

	}
}

?>