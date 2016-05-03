<?php
class CityAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}
	
	public function index() {
		$result = M ( "City" )->select ();
		
		foreach ( $result as &$row ) {
			if ($row["states"]==1) {
				$row["statesname"] = "启用";
			}
			else if($row["states"]==2){
				$row["statesname"] = "不启用";
			}
		}
		
		import ( 'Tree', APP_PATH . 'Common', '.php' );
		$tree = new Tree (); // new 之前请记得包含tree文件!
		$tree->tree ( $result ); // 数据格式请参考 tree方法上面的注释!
		$result = $tree->getArray ();
		
		$this->assign ( "city", $result );
		$this->assign ( "citylist", $result );
		$this->display ();
	}
	
	public function addcity() {
		$result = R ( "Api/Api/addcity", array (
				$_POST ['parent'],
				$_POST ['name'],
				$_POST ['tax'],
				$_POST ['rule'],
				$_POST ['states'],
				$_POST ['addcity']
		) );
		$this->success ( "操作成功" );
	}
	
	public function del() {
		$result = R ( "Api/Api/delcity", array (
				$_GET ['id'] 
		) );
		$this->success ( "删除成功" );
	}
	
	public function getcityid() {
		$id = $_POST ["id"];
		$result = M ( "City" )->where ( array (
				"id" => $id
		) )->find ();
		if ($result) {
			$this->ajaxReturn ( $result );
		}
	}
}