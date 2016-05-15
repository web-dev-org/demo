<?php

class BackUserAction extends PublicAction{
	
	public function _initialize() {
		parent::_initialize ();
		
	}
	
	// 用户显示
	public function index() {
		import ( 'ORG.Util.Page' );
		
		$m = M ( "User" );
		
		if ( $this->cityid != "0" ){
			$cWhere["cityid"] = $this->cityid;
		}
		
		$count = $m->where($cWhere)->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		
		$result = $m->where($cWhere)->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		
		foreach ( $result as &$row ) {
			$role = unserialize($row["role"]);
			$row["role"] = json_encode($role);
			
			if( $row['states'] == "1" ) {
				$row['statesname'] = "关闭";
			} else {
				$row['statesname'] = "启用";
			}
			
			if ( $row["cityid"] == '0' ) {
				$row['cityname'] = "全地域";
			} else {
				$cityRe = M("city")->where(array("id" => $row["cityid"]))->find();
				$row['cityname'] = $cityRe["name"];
			}

		}
		
		$citylist = M("city")->where(array("pid" => "0"))->select();
		
		
		$this->assign ( "result", $result );
		$this->assign ( "citylist", $citylist );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->display ();
	}
	
	// 追加/更新管理员
	public function addUser() {
		$username = $_POST ['username']; // 用户名
		$password = $_POST ['password']; // 密码
		$states = $_POST ['states']; // 状态
		$cityid = $_POST ['cityid']; // city
		$adduser = $_POST ['adduser']; // id
		$role["set"] = empty($_POST ['set'])? "0": $_POST ['set']; // 用户权限
		$role["menu"] = empty($_POST ['menu'])? "0": $_POST ['menu'];
		$role["city"] = empty($_POST ['city'])? "0": $_POST ['city'];
		$role["cityPercent"] = empty($_POST ['cityPercent'])? "0": $_POST ['cityPercent'];
		$role["product"] = empty($_POST ['product'])? "0": $_POST ['product'];
		$role["BusBook"] = empty($_POST ['BusBook'])? "0": $_POST ['BusBook'];
		$role["price"] = empty($_POST ['price'])? "0": $_POST ['price'];
		$role["confirm"] = empty($_POST ['confirm'])? "0": $_POST ['confirm'];
		$role["order"] = empty($_POST ['order'])? "0": $_POST ['order'];
		$role["member"] = empty($_POST ['member'])? "0": $_POST ['member'];
		$role["weixin"] = empty($_POST ['weixin'])? "0": $_POST ['weixin'];
		$role["user"] = empty($_POST ['user'])? "0": $_POST ['user'];
		$role["active"] = empty($_POST ['active'])? "0": $_POST ['active'];
		$role["salesCode"] = empty($_POST ['salesCode'])? "0": $_POST ['salesCode'];
		$role["count"] = empty($_POST ['count'])? "0": $_POST ['count'];
		$role["countSale"] = empty($_POST ['countSale'])? "0": $_POST ['countSale'];
				
		if ($adduser == 0) {
			$data ["username"] = $username;
			$data ["password"] = md5($password);
			$data ["states"] = $states;
			$data ["role"] = serialize($role);
			$data ["cityid"] = $cityid;
			
			$result = M ( "user" )->add ( $data );
			
			$this->success ( "追加成功" );
		} else {
			
			$result = M("user")->where(array( "id" => $adduser ))->find();
			
			if( $password != $result["password"] ) {
				$data ["password"] = md5($password);
			}

			$data ["id"] = $adduser;
			$data ["username"] = $username;
			$data ["states"] = $states;
			$data ["role"] = serialize($role);
			$data ["cityid"] = $cityid;
			
			M ("user")->save ( $data );
			
			$this->success ( "修改成功" );
		}
	}
	
	// 删除管理员
	public function delUser() {
		$id = $_GET ['id'];
		$result = M ( "user" )->where ( array ('id' => $id) )->delete ();
		
		$this->success ( "操作成功" );
	}
	
}

?>