<?php
class Menu_percentAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}
	
	public function index() {
		$menuid = $_POST ["menuid"];
		$cityid = $_POST ["cityid"];
		$pagedata = $_POST ["curPageData"];
		$curPage = $_POST ["curPage"];
		$goPage = $_POST['page'];
		
		$session_page_name='Menu_'.$this->username;
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
		$offset = 10;
		$start = ($page - 1) * $offset;
		
		$where = array();
		if ( IS_POST ) {
			if ( !empty($menuid) && $menuid != '0' ) {
				$menuList = M("menu")->where(array("id"=>$menuid))->find();
				if ( $menuList["pid"] == "0" ) {
					$menuidList = M("menu")->where(array("pid"=>$menuid))->getField("id",true);
					$where['menuid'] = array("in", $menuidList);
				} else {
					$where['menuid'] = $menuid;
				}
			}
			if ( !empty($cityid) && $cityid != '0' ) {
				$where['cityid'] = $cityid;
			}
		}
		
		if ( $this->cityid != '0' ) {
			$where['cityid'] = $this->cityid;
		 	// 地域信息取得
			$city = M("city")->where(array("cityid"=>$this->cityid))->find();
		} else {
			// 地域信息取得
			$city = M("city")->where(array("pid"=>"0"))->select();
		} 
		
		$count = M ( "Menu_percent" )->where($where)->count();
		
		$result = M ( "Menu_percent" )->where($where)->limit ($start, $offset)->order("cityid asc")->select ();
				
		foreach ( $result as &$menu ) {
			$cityList = M("City")->where(array("id"=> $menu["cityid"] ))->find();
			$menuList = M("Menu")->where(array("id"=> $menu["menuid"] ))->find();
			$menu["cityname"] = $cityList["name"];
			$menu["menuname"] = $menuList["name"];
			
			// 取得切换页的数据
			$pageDataLists = $_SESSION[$session_page_name];
			
			$pageDataList = $pageDataLists[$goPage];
				
			if ( $pageDataList ) {
			
				foreach ( $pageDataList as $row ) {
					if ( $row->id ==  $menu["id"] && $row->percent !=  $menu["percent"]) {
						$menu["percent"] = $row->percent;
						$menu["check"] = $row->check;
					}
				}
			
			}
			
		}
		
		// 总页数设定
		$totalPage = ceil($count / $offset);
		for( $j=1; $j <= $totalPage; $j++ ) {
			$pageList[$j-1]['page'] = $j;
		}
		
		$menuAll = M("menu")->where(array("pid"=>"0"))->select();
	
		$dataNum = count($result);
				
		$this->assign('pageList', $pageList);
		$this->assign('totalPage', $totalPage);
		$this->assign('page', $page);
		$this->assign ( "menu", $menuAll );
		$this->assign ( "menupercent", $result );
		$this->assign ( "city", $city );
		$this->assign ( "menuid", $menuid );
		$this->assign ( "cityid", $cityid );
		$this->assign ( "dataNum", $dataNum ); // 当前页data数
		$this->assign ( "usercity", $this->cityid );
		$this->display ();
	}
	
	public function saveMenuPercent() {

		// 其他页数据保存
		$page = isset($_GET["page"]) ? intval($_GET["page"]) : 0;
		$session_page_name='Menu_'.$this->username;
		$pageLists = $_SESSION[$session_page_name];
						
		if ( $pageLists ) {
			foreach($pageLists as $key=>$value){
				if ( $key != $page ) {
					foreach( $value as $row ) {
						if ( !empty($row->check) ) {
							$data["percent"]=$row->percent;
							$saveFlg = M ( "Menu_percent" )->where(array("id"=>$row->id))->save ( $data );
							
							if ( $saveFlg ) {
								$productidpage = M("Product")->where(array("menuid"=>$row->menuid))->getField("id",true);
									
								for( $j=0;$j<count($productidpage);$j++ ) {
									$where["cityid"] = $row->cityid;
									$where["productid"] = $productidpage[$j];
										
									$productDetail = M("product_detail")->where($where)->find();
									
									// 商品表百分比更新
									M("product_detail")->where($where)->save(array("percent"=>$row->percent));
									
									// 中间表保存
									$midList1 = $this->addMidProduct("1", $row->percent, $where);
									
									$midData1 = M("product_mid")->where(array("id" => $midList1["id"], "cityid" => $midList1["cityid"], "username"=>$midList1["username"]))->find();
										
									if ( $midData1 ){
										M("product_mid")->where(array("id" => $midList1["id"], "cityid" => $midList1["cityid"], "username"=>$midList1["username"]))->save($midList1);
									} else {
										M("product_mid")->add($midList1);
									}
								}
							}
						}
					}
				}
			}
		}
		
		// 当前页数据保存
		$index = $_POST["dataNum"];
		for ( $i=1; $i<=$index; $i++ ) {
			$percentName = "percent_".$i;
			$checkName = "check_".$i;
			$idName = "id_".$i;
			$menuidName = "menuid_".$i;   
			$cityidName = "cityid_".$i;
			
			$percent = $_POST[$percentName];
			$id = $_POST[$idName];
			$menuid = $_POST[$menuidName];
			$cityid = $_POST[$cityidName];
			$check = $_POST[$checkName];
			
			if ($check == "1" ) {
				$result = M ( "Menu_percent" )->where(array("id"=>$id))->save ( array("percent" => $percent) );	
				if ( $result ) {
					$productidList = M("Product")->where(array("menuid"=>$menuid))->getField("id",true);
					
					for( $j=0;$j<count($productidList);$j++ ) {
						$where["cityid"] = $cityid;
						$where["productid"] = $productidList[$j];

						// 商品表百分比更新
						M("product_detail")->where($where)->save(array("percent"=>$percent));
						
						// 中间表保存
						$midList = $this->addMidProduct("1", $percent, $where);
						
						$midData = M("product_mid")->where(array("id" => $midList["id"], "cityid" => $midList["cityid"], "username"=>$midList["username"]))->find();
						
						if ( $midData ){
							M("product_mid")->where(array("id" => $midList["id"], "cityid" => $midList["cityid"], "username"=>$midList["username"]))->save($midList);
						} else {
							M("product_mid")->add($midList);
						}
					}
				}
			}
		}
		$this->success ( "操作成功" );
	}
	
	
	public function addMidProduct($check, $percent, $where) {
	
		$detail = M("product_detail")->where($where)->find();
			
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
		$result["bprice"] = floatval($detail["bprice"]);
		$result["vprice"] = $detail["vprice"];
		$result["nprice"] = floatval(number_format(($detail["bprice"] + $percent * $detail["bprice"] * 0.01), 2));
		$result["amt"] = floatval(number_format(($result["nprice"] - $result["vprice"]), 2));
		$result["cityname"] = $city["name"];
		$result["menuid"] = intval($productList["menuid"]);
			
		$aMenu = M ( "Menu" )->where ( array ("id" => $productList["menuid"]) )->find ();
		$result["menu"] = $aMenu['name'];
		$result["username"] = $this->username;
	
		return $result;
	}
	
}