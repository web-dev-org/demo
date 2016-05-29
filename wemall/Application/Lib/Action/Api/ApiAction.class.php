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
	public function getCityList() {
		return M("city")->select();
	}
	public function getSpotList() {
	    return M("viewspot")->select();
	}
	public function addcity($parent,$name,$rule,$addcity) {
		if ($addcity == 0) {
			$data ["name"] = $name;
			$data ["pid"] = $parent;
			$data ["rule"] = $rule;
			$result = M ( "City" )->add ( $data );
		} else {
			$data ["id"] = $addcity;
			$data ["name"] = str_replace ( "│ ", "", $name );
			$data ["pid"] = $parent;
			$data ["rule"] = $rule;
			
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










