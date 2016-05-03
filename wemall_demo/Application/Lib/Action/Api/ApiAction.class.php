<?php
class ApiAction extends Action {
	public function login($username, $password) {
		$where ["username"] = $username;
		$where ["password"] = md5 ( $password );
		$result = M ( "user" )->where ( $where )->find ();
		if ($result) {
			return $result ["username"];
		}
	}
	public function getsetting() {
		$result = M ( "Info" )->find ();
		if ($result) {
			return $result;
		}
	}
	public function setting($name, $notification) {
		$data ["id"] = 1;
		$data ["name"] = $name;
		$data ["notification"] = $notification;
		$result = M ( "Info" )->save ( $data );
		if ($result) {
			return $result;
		}
	}
	public function getalipay() {
		$result = M ( "Alipay" )->find ();
		if ($result) {
			return $result;
		}
	}
	public function setalipay($alipayname, $partner, $key) {
		$select = M("Alipay")->select();
		if ($select) {
			$data ["id"] = 1;
			$data ["alipayname"] = $alipayname;
			$data ["partner"] = $partner;
			$data ["key"] = $key;
			$result = M ( "Alipay" )->save ( $data );
		}else{
			$data ["alipayname"] = $alipayname;
			$data ["partner"] = $partner;
			$data ["key"] = $key;
			$result = M ( "Alipay" )->add ( $data );
		}
		if ($result) {
			return $result;
		}
	}
	public function getarraymenu() {
		$result = M ( "Menu" )->select ();
		import ( 'Tree', APP_PATH . 'Common', '.php' );
		$tree = new Tree (); // new 之前请记得包含tree文件!
		$tree->tree ( $result ); // 数据格式请参考 tree方法上面的注释!
		// 如果使用数组, 请使用 getArray方法
		$result = $tree->getArray ();
		// 下拉菜单选项使用 get_tree方法
		// $tree->get_tree();
		if ($result) {
			return $result;
		}
	}
	public function getmenu() {
		$result = M ( "Menu" )->select ();
		if ($result) {
			return $result;
		}
	}
	public function addmenu($parent, $name, $addmenu) {
		if ($addmenu == 0) {
			$data ["name"] = $name;
			$data ["pid"] = $parent;
			$result = M ( "Menu" )->add ( $data );
			if ($result && $parent != "0") {
				//追加地域百分比
				$where["pid"]="0";
				$res = M ( "City" )->where($where)->select();
				$menuid = M("Menu")->getLastInsID();					
				foreach ($res as $row) {
					$cityData["cityid"]=$row["id"];
					$cityData ["menuid"] = $menuid;
					$cityData ["percent"] = 0.00;
					M ( "Menu_percent" )->add ( $cityData );
				}
				return $result;
			}
		} else {
			$data ["id"] = $addmenu;
			$data ["name"] = str_replace ( "│ ", "", $name );
			$data ["pid"] = $parent;
			$result = M ( "Menu" )->save ( $data );
			if ($result) {
				return $result;
			}
		}
	}
	public function delmenu($id) {
		$result = M ( "Menu" )->where ( array (
				'id' => $id
		) )->delete ();
		M ( "Menu" )->where ( array ('pid' => $id) )->delete ();
		if ($result) {
			M ( "Menu_percent" )->where ( array (
				'menuid' => $id
			) )->delete ();
			return $result;
		}
	}
	public function getmenuvalue($menu_id) {
		$result = M ( "Menu" )->where ( array (
				"id" => $menu_id 
		) )->find ();
		if ($result) {
			return $result ["name"];
		}
	}
	
	public function getarraycity() {
		$result = M ( "City" )->select ();
	
		import ( 'Tree', APP_PATH . 'Common', '.php' );
		$tree = new Tree (); // new 之前请记得包含tree文件!
		$tree->tree ( $result ); // 数据格式请参考 tree方法上面的注释!
		 
		// 如果使用数组, 请使用 getArray方法
		$result = $tree->getArray ();
	
		// 下拉菜单选项使用 get_tree方法
		// $tree->get_tree();
		if ($result) {
			return $result;
		}
	}
	public function addcity($parent,$name,$tax,$rule,$states,$addcity) {
		if ($addcity == 0) {
			$data ["name"] = $name;
			$data ["pid"] = $parent;
			$data ["tax"] = $tax;
			$data ["rule"] = $rule;
			$data ["states"] = $states;
			$result = M ( "City" )->add ( $data );
			if ($result && $parent == "0") {
				//追加地域百分比
					$where["pid"]=array('neq',0);
					$res = M ( "Menu" )->where($where)->select ();
					$cityid = M("City")->getLastInsID();
					foreach ($res as $row) {
						$cityData ["cityid"] = $cityid;
						$cityData["menuid"]=$row["id"];
						$cityData ["percent"] = 0.00;
						M ( "Menu_percent" )->add ( $cityData );
					}
				return $result;
				}
		} else {
			$data ["id"] = $addcity;
			$data ["name"] = str_replace ( "│ ", "", $name );
			$data ["pid"] = $parent;
			$data ["tax"] = $tax;
			$data ["rule"] = $rule;
			$data ["states"] = $states;
			
			$result = M ( "City" )->save ( $data );
			if ($result) {
				return $result;
			}
		}
		
	}
	public function delcity($id) {
		$result = M ( "City" )->where ( array (
				'id' => $id
		) )->delete ();
		M ( "City" )->where ( array ('pid' => $id) )->delete ();
		if ($result) {
		 M ( "Menu_percent" )->where ( array (
					'cityid' => $id
			) )->delete ();
			return $result;
		}
	}
	public function getcityvalue($city_id) {
		$result = M ( "City" )->where ( array (
				"id" => $city_id
		) )->find ();
		if ($result) {
			return $result ["name"];
		}
	}
	
	public function getgood() {
		$result = M ( "Good" )->select ();
		if ($result) {
			return $result;
		}
	}
	public function addgood($data) {
		if ($data["id"]) {
			$result = M ( "Good" )->save($data);
		}else{
			$result = M ( "Good" )->add($data);
		}
		
		if ($result) {
			return $result;
		}
	}
	public function delgood($id) {
		$result = M ( "Good" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($result) {
			return $result;
		}
	}
	public function updateorder( $paystates,$states,$actualprice,$updateorder) {
		$data ["id"] = $updateorder;
		$data ["paystates"] = $paystates;
		$data ["states"] = $states;
		$data ["actualprice"] = $actualprice;
		$result = M ( "Order" )->save ( $data );
		if ($result) {
			return $result;
		}
	}

	public function delorder($id) {
		$reuslt = M ( "Order" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($reuslt) {
			return $reuslt;
		}
	}
	
	public function gettheme() {
		$m = M ( "Info" );
		$result = $m->find ();
		if ($result) {
			return $result;
		}
	}
	
	public function getuser($uid) {
		$m = M ( "User" );
		$where["uid"] = $uid;
		$result = $m->where($where)->find ();
		if ($result) {
			return $result;
		}
	}
	
	public function addactive($parent,$name,$tax,$rule,$states,$addcity) {
		if ($addcity == 0) {
			$data ["name"] = $name;
			$data ["pid"] = $parent;
			$data ["tax"] = $tax;
			$data ["rule"] = $rule;
			$data ["states"] = $states;
			$result = M ( "City" )->add ( $data );
			if ($result) {
				return $result;
			}
		} else {
			$data ["id"] = $addcity;
			$data ["name"] = str_replace ( "│ ", "", $name );
			$data ["pid"] = $parent;
			$data ["tax"] = $tax;
			$data ["rule"] = $rule;
			$data ["states"] = $states;
				
			$result = M ( "City" )->save ( $data );
			if ($result) {
				return $result;
			}
		}
	}
}










