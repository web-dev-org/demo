<?php

class SpotcontrolAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "viewspot" );
	
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
	
		$results = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id asc")->select ();
		// 地域信息取得
		$prefeturelist = R("Api/Api/getPrefetureList");
		
		for($i = 0; $i < count ( $results ); $i ++) {
			// 取得商品基本信息
			$prefetureid = $results [$i] ["prefetureid"];
			$prefeture = M ("prefeture")->where ( array ("id" => $prefetureid) )->find ();
			$results [$i] ["prefeturename"] = $prefeture['name'];
		}
		
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "results", $results );
		$this->assign ( "prefeturelist", $prefeturelist );
		$this->display ();
	}
	
	public function delViewSpot() {
		$id = $_GET ["id"];
		$count = M("viewspot")->where(array("id" => $id))->count();
		
		if ( $count > 1 ) {
			//$result = M ("view_spot")->where (array("id" => $id))->delete();
		} else {
			//$result = M ("view_spot")->where (array("id" => $unitid))->delete();
		}
		
		if ( $result !== false ) {
			$this->success ( "删除景点成功！" );
		} else {
			$this->error ( "删除景点失败！" );
		}
	}

	public function addViewSpot() {
		$data ["prefetureid"] = $_POST ["prefetureid"]; //分类
		$data ["name"] = $_POST ["viewname"]; //名称
		if (isset($_POST ["editorValue"])) {
			$data ["description"] = $_POST ["editorValue"]; //详细	
		}

		if ($_POST["viewid"]) {
			$data ["id"] = $_POST["viewid"]; //商品id
			M ("view_spot")->save($data);
			$this->success ( "修改景点成功！" );
		}else{
			$result = M("view_spot")->add($data);
			$this->success ( "添加景点成功！" );
		}
	}
}

?>