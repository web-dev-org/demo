<?php

class PriceAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// 商品显示
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "view_spot" );
	
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
	
		// 超级管理员全部查处，地域管理员只查处该地域数据。
		if ( $this->cityid != '0' ) {
			$where['cityid'] = $this->cityid;
			$result = $m->where($where)->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id asc")->select ();
			
			// 地域信息取得
			$city = M("city")->where($where)->find();
		} else {
			$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id asc")->select ();
			// 地域信息取得
			$city = M("city")->where(array("pid"=>"0"))->select();
		}
		
		for($i = 0; $i < count ( $result ); $i ++) {
			// 取得商品基本信息
			$cityid = $result [$i] ["cityid"];
			$aCity = M ("city")->where ( array ("id" => $cityid) )->find ();
			$result [$i] ["cityname"] = $aCity['name'];
		}
		
		
		$menu = R ( "Api/Api/getarraymenu" );
		
		
		$this->assign ( "menu", $menu );
		$this->assign ( "addmenu", $menu );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "result", $result );
		$this->assign ( "count", $Pricecount );
		$this->assign ( "city", $city );
		$this->assign ( "usertype", $this->userType );
		$this->display ();
	}
	
	// 前发布确认画面
	public function updatePrice() {
		
		$where = array();
		if (IS_POST) {
			$menuid = $_POST ["menuid"];
			$cityid = $_POST ["cityid"];
			
			if ( !empty($cityid) && $cityid != "0") {
				$where["cityid"] = $cityid;	
			}
			if ( !empty($menuid) && $menuid != "0") {
				$menuidList = M("menu")->where(array("pid"=>$menuid))->getField("id",true);
				$where["menuid"] = array("in",$menuidList);
			}
			$this->assign ( "menuid", $menuid );
			$this->assign ( "cityid", $cityid );
		} else {
			if ( $this->cityid != "0" ) {
				$where["cityid"] = $this->cityid;
			}
		}
		
		$where["username"] = array("neq",$this->username);
		
		$menu = M("menu")->where(array("pid"=>"0"))->select();
		$city = M("city")->where(array("pid"=>"0"))->select();
		$result = M("product_mid")->where($where)->select();

		$this->assign ( "menu", $menu );		
		$this->assign ( "city", $city );	
		$this->assign ( "userCityid", $this->cityid );	
		$this->assign ( "result", $result );
		$this->display ();
		
	}
	
	// 发布商品价格方案
	public function confirmPrice() {
		$where = array();
		
		if (IS_POST) {
			$menuid = $_POST ["proClass"];
			$cityid = $_POST ["proCity"];
			
			if ( !empty($cityid) && $cityid != "0") {
				$where["cityid"] = $cityid;	
			}
			if ( !empty($menuid) && $menuid != "0") {
				$menuidList = M("menu")->where(array("pid"=>$menuid))->getField("id",true);
				$where["menuid"] = array("in",$menuidList);
			}
			$this->assign ( "menuid", $menuid );
			$this->assign ( "cityid", $cityid );
		} else {
			if ( $this->cityid != "0" ) {
				$where["cityid"] = $this->cityid;
			}
		}
		
		$where["username"] = array("neq",$this->username);
		
		$priceList = M("product_mid")->where($where)->select();
		
		foreach( $priceList as $row ) {
			$data["percent"] = $row["percent"];
			$data["bprice"] = $row["bprice"];
			$data["vprice"] = number_format(($row["bprice"] + $row["percent"] * $row["bprice"] * 0.01), 2);
			
			$result = M("product_detail")->where(array("id"=>$row["id"]))->save($data);
		}

		if ( $result !== false ) {
			// 删除中间表
			$del = M("product_mid")->where($where)->delete();
			$this->success ( "发布商品价格成功！", U('Admin/Price/updatePrice') );
		}
		
	}
	
	// 保存商品价格方案
	public function savePrice() {
		
		// 其他页数据保存
		$page = isset($_GET["page"]) ? intval($_GET["page"]) : 0;
		$session_page_name='page_'.$this->username;
		$pageLists = $_SESSION[$session_page_name];
				
		if ( $pageLists ) { 
			foreach($pageLists as $key=>$value){
				if ( $key != $page ) {
					foreach( $value as $row ) {
						$pageList = R ( "Admin/Price/addMidProduct", array ($row->check, $row->percent, $row->price,$row->id) );
						
						$midList = M("product_mid")->where(array("id" => $pageList["id"], "cityid" => $pageList["cityid"], "username"=>$pageList["username"]))->find();
						
						if ( !empty($row->check) ) {
								
							if ( $midList ){
								M("product_mid")->where(array("id" => $pageList["id"], "cityid" => $pageList["cityid"], "username"=>$pageList["username"]))->save($pageList);
							} else {
								M("product_mid")->add($pageList);
							}
						} else {
							if ( $midList ) {
								M("product_mid")->where(array("id" => $pageList["id"], "cityid" => $pageList["cityid"], "username"=>$pageList["username"]))->delete();
							}
						}
					}
				}
			}
		}
		
		// 当前页的数据保存
		$num = intval($_POST ["dataNum"]);
		for( $i=1; $i<=$num; $i++ ) {
			$checkname = "check_".$i;
			$percentname = "percent_".$i;
			$bpricename = "bprice_".$i;
			$unitidname = "unitid_".$i;
			$productidname = "productid_".$i;
				
			$check = $_POST [$checkname];
			$percent = floatval($_POST [$percentname]);
			$bprice = floatval($_POST [$bpricename]);
			$unitid = $_POST [$unitidname];

			$result = R ( "Admin/Price/addMidProduct", array ($check, $percent, $bprice, $unitid) );
				
			$midList = M("product_mid")->where(array("id" => $result["id"], "cityid" => $result["cityid"], "username"=>$result["username"]))->find();
			
			if ( !empty($check) ) {
					
				if ( $midList ){
					M("product_mid")->where(array("id" => $result["id"], "cityid" => $result["cityid"], "username"=>$result["username"]))->save($result);
				} else {
					M("product_mid")->add($result);
				}
			} else {
				if ( $midList ){
					M("product_mid")->where(array("id" => $result["id"], "cityid" => $result["cityid"], "username"=>$result["username"]))->delete();
				}
			}
		}
		
		// 清除页面保存数据
		unset ( $_SESSION [$session_page_name] );
		
		$this->success ( "商品价格方案保存成功！", U('Admin/Price/index') );
	}
	
	public function addMidProduct($check, $percent, $bprice, $unitid) {

		$detail = M("product_detail")->where(array( "id" => $unitid ))->find();
			
		$productList = M("product")->where(array( "id" => $detail["productid"] ))->find();
			
		$city = M("city")->where(array("id" => $detail["cityid"]))->find();
			
		if (!empty($check)) {
			$result["check"] = $check;
		}else{
			$result["check"] = "0";
		}
		$result["id"]=intval($detail["id"]);
		$result["name"] = $detail["name"];
		$result["cityid"]=intval($detail["cityid"]);
		$result["productname"] = $productList["name"];
		$result["percent"] = floatval($percent);
		$result["bprice"] = floatval($bprice);
		$result["vprice"] = $detail["vprice"];
		$result["nprice"] = floatval(number_format(($bprice + $percent * $bprice * 0.01), 2));
		$result["amt"] = floatval(number_format(($result["nprice"] - $result["vprice"]), 2));
		$result["cityname"] = $city["name"];
		$result["menuid"] = intval($productList["menuid"]);
			
		$aMenu = M ( "Menu" )->where ( array ("id" => $productList["menuid"]) )->find ();
		$result["menu"] = $aMenu['name'];
		$result["username"] = $this->username;
		
		return $result;
	}
	
}

?>