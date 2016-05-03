<?php

class PriceAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// 商品显示
	public function index() {
		
		$m = M ( "product_detail" );
		
		$menuid = $_POST ["menuid"];
		$cityid = $_POST ["cityid"];
		$pagedata = $_POST ["curPageData"];
		$curPage = $_POST ["curPage"];
		$goPage = $_POST['page'];
		
		$session_page_name='page_'.$this->username;
		if ($pagedata) {
			$pageJson = explode("|",$pagedata);
			
			for ( $i=0; $i<count($pageJson); $i++ ) { 
				$pageDList[$i] = json_decode($pageJson[$i]);
			}
			
			$pageLists = $_SESSION[$session_page_name];
			
			$pageLists[$curPage] = $pageDList;
						
			$_SESSION[$session_page_name] = $pageLists;
		} else {
			unset ( $_SESSION [$session_page_name] );
		}
		
		$page = isset($_POST['page']) ? max(intval($_POST['page']), 1) : 1;		
		$offset = 12;
		$start = ($page - 1) * $offset;
		
		
		$whereMid["username"] = $this->username;
		if ( IS_POST && (!empty($menuid) && $menuid != '0' ) ) {

			if ( !empty($menuid) && $menuid != '0' ) {
				$menuList = M("menu")->where(array("id"=>$menuid))->find();
				if ( $menuList["pid"] == "0" ) {
					$idList = M("menu")->where(array("pid"=>$menuList["id"]))->getField("id",true);
					$mid = array('in', $idList);
				} else {
					$mid = $menuid;
				}
			}
			$whereMid['menuid'] = $mid;
		}

		if ( IS_POST && (!empty($cityid) && $cityid != '0' ) ) {
			$whereMid['cityid'] = $cityid;
		}
		
		$where = array();
		if ( IS_POST && (!empty($menuid) && $menuid != '0' ) ) {
			$productidL = M("product")->where( array("menuid" => $mid) )->getField("id", true);
			$where['productid'] = array('in', $productidL);
		}
		if ( $this->cityid != '0' ) {
			$where['cityid'] = $this->cityid;
		} else {
			if ( IS_POST && !empty($cityid) && $cityid != '0' ) {
				$where['cityid'] = $cityid;
			}
		}
		
		$count = $m->where($where)->count();

		// 总页数设定
		$totalPage = ceil($count / $offset);
		for( $j=1; $j <= $totalPage; $j++ ) {
			$pageList[$j-1]['page'] = $j;
		}
				
		$result = $m->where($where)->limit ($start, $offset)->select ();
		
		for($i = 0; $i < count ( $result ); $i ++) {
			// 取得商品基本信息
			$unitid = $result [$i] ["id"];
			$whereMid["id"] = $unitid;
			$midList = M("product_mid")->where($whereMid)->find();
			
			if ( $midList ) {
				$result [$i] = $midList;
			} else {
				$productid = $result [$i]["productid"];
				$aProduct = M ("product")->where ( array ("id" => $productid) )->find ();
				$result [$i] ["productname"] = $aProduct['name'];
				$result [$i] ["img"] = $aProduct['img'];
				$result [$i] ["info"] = $aProduct['info'];
				$result [$i] ["menuid"] = $aProduct['menuid'];
					
				//地域取得
				$cityRe = M("city")->where(array("id"=> $result [$i] ["cityid"]))->find();
				$result [$i] ["cityname"] = $cityRe["name"];
					
				//当前状态
				if ( $result [$i]["states"] == "1" ) {
					$result [$i]["statesname"] = "出售";
				} else {
					$result [$i]["statesname"] = "下架";
				}
					
				// 取得分类信息
				$menu_id = $aProduct["menuid"];
				$aMenu = M ( "Menu" )->where ( array ("id" => $menu_id) )->find ();
				$result [$i] ["menu"] = $aMenu['name'];
				//$result[$i]["vprice"] = number_format(($result[$i]["bprice"] + $result[$i]["percent"] * $result[$i]["bprice"] * 0.01), 2);
				$result[$i]["nprice"] = number_format(($result[$i]["bprice"] + $result[$i]["percent"] * $result[$i]["bprice"] * 0.01), 2);
				$result[$i]["amt"] = $result[$i]["nprice"] - $result[$i]["vprice"];
			}
			
			// 取得切换页的数据
			$pageDataLists = $_SESSION[$session_page_name];

			$pageDataList = $pageDataLists[$goPage];
			
			if ( $pageDataList ) {
				
				foreach ( $pageDataList as $row ) {
					if ( $row->id ==  $result[$i]["id"]) {
						if ($row->percent !=  $result[$i]["percent"] || $row->price !=  $result[$i]["bprice"]) {
							$result[$i]["percent"] = $row->percent;
							$result[$i]["bprice"] = $row->price;
							$result[$i]["check"] = $row->check;
							$result[$i]["nprice"] = number_format(($result[$i]["bprice"] + $result[$i]["percent"] * $result[$i]["bprice"] * 0.01), 2);
							$result[$i]["amt"] = number_format(($result[$i]["nprice"] - $result[$i]["vprice"]), 2);
						}
					}
				}
				
			}

			
		}
		
		$menu = R ( "Api/Api/getarraymenu" );
			
		// 地域信息取得
		if ( $this->cityid != '0' ) {
			// 地域信息取得
			$city = M("city")->where(array("cityid"=>$this->cityid))->find();
		} else {
			// 地域信息取得
			$city = M("city")->where(array("pid"=>"0"))->select();
		}
		
		$dataNum = count($result);
		
		$this->assign('pageList', $pageList);
		$this->assign('totalPage', $totalPage);
		$this->assign('page', $page);
		$this->assign ( "menu", $menu );
		$this->assign ( "priceList", $result );
		$this->assign ( "count", $count ); // data总数
		$this->assign ( "dataNum", $dataNum ); // 当前页data数
		$this->assign ( "city", $city );
		$this->assign ( "menuid", $menuid );
		$this->assign ( "cityid", $cityid );
		$this->assign ( "userCityid", $this->cityid );
		
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