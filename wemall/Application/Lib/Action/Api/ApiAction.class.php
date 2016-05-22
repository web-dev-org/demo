<?php
class ApiAction extends Action {
	public function login($username, $password) {
		$where ["username"] = $username;
		$where ["password"] = md5 ( $password );
		$result = M ( "admin" )->where ( $where )->find ();
		if ($result) {
			return $result ["username"];
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
}










