<?php
class OrderAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = D ( "Order" );
		
		$nowpage = isset($_GET["p"]) ? $_GET["p"] : "1";
		
		$where = array();
		if ( IS_POST ) {
			$orderid = $_POST["orderid"];
			$seTel = $_POST["seTel"];
			$seBuytime = $_POST["seBuytime"];
			$seStates = $_POST["seStates"];
			$seCity = $_POST["seCity"];
			$parameter = $_POST;
		} else if (IS_GET) {
			$orderid = $_GET["orderid"];
			$seTel = $_GET["seTel"];
			$seBuytime = $_GET["seBuytime"];
			$seStates = $_GET["seStates"];
			$seCity = $_GET["seCity"];
			$parameter = $_GET;
		}
		
		if ( $orderid ) {
			$where["orderid"] = $orderid;
		}
		if ( $seTel ) {
			$openid = M("member")->where(array("tel"=>$seTel))->getField("openid");
			$where["openid"] = $openid;
		}
		if ( $seBuytime ) {
			$startTime = $seBuytime." 00:00:00";
			$endTime = $seBuytime." 23:59:59";
			$where["buytime"] = array(array('gt',$startTime),array('lt',$endTime), 'and') ;
		}
		
		if ( $seStates != "4" && $seStates != "") {
			$where["states"] = $seStates;
		}
		if ( $seCity ) {
			$where["cityid"] = $seCity;
		}
		
		$this->assign ( "orderid", $orderid );
		$this->assign ( "seTel", $seTel );
		$this->assign ( "seBuytime", $seBuytime );
		$this->assign ( "seStates", $seStates );
		$this->assign ( "searchCity", $seCity );
		
		if ( $this->cityid != "0") {
			$where["cityid"] = $this->cityid;
			$cityList = M("city")->where(array("id"=>$this->cityid))->find();
		} else {
			$cityList = M("city")->where(array("pid"=>"0"))->select();
		}
				
		$count = $m->where($where)->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 10 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		
		
		foreach($parameter as $key=>$val) {
			$Page->parameter   .=   "$key=".urlencode($val).'&';
		}
				
		$show = $Page->show (); // 分页显示输出
	
		$result = $m->where($where)->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->select ();

		foreach ( $result as &$row ) {
			if ($row["paytype"]=="0") {
				$row["paytypename"] = "货到付款";
			}
			else if($row["paytype"]=="1"){
				$row["paytypename"] = "微信支付";
			}
				
			if ($row["paystates"]=="0") {
				$row["paystatesname"] = "未支付";
			}
			else if($row["paystates"]=="1"){
				$row["paystatesname"] = "已支付";
			}
				
			if ($row["states"]=="0") {
				$row["statesname"] = "未发货";
			}
			else if($row["states"]=="1"){
				$row["statesname"] = "已发货";
			}
			else if($row["states"]=="2"){
				$row["statesname"] = "已收货";
			}
			else if($row["states"]=="3"){
				$row["statesname"] = "冻结";
			}
			else if($row["states"]=="5"){
				$row["statesname"] = "客户取消";
			}
			
			$member = M("member")->where(array("openid"=> $row["openid"] ))->find();
			// 主城市名取得
			$city = M("city")->where(array("id"=>$member["pcityid"]))->getField("name");
			// 区域取得
			$area = M("city")->where(array("id"=>$member["cityid"]))->getField("name");
			$member["address"] = $city.$area.$member["address"];
			
			
			$row["memstorename"]=$member["storename"];
			$row["memname"]=$member["name"];
			$row["memaddress"]=$member["address"];
			$row["memtel"]=$member["tel"];
		}
		
		$session_page_name='order_'.$this->username;
		unset ( $_SESSION [$session_page_name] );
		
		$this->assign ( "cityid", $this->cityid );
		$this->assign ( "citylist", $cityList );
		$this->assign ( "result", $result );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign("nowpage",$nowpage);
		$this->display ();
	}
	
	/** 
	 * 更新订单
	 * **/
	public function updateorder() {
	
		$orderId =	$_POST ['orderId'];
		$productNum = $_POST ['productNum'];
			
		$upData["paystates"] = $_POST ['paystates'];
		$upData["states"] =	$_POST ['states'];
		$upData["actualprice"] = $_POST ['actualprice'];
		$upData["minusAmt"] = $_POST ['minusAmt'];
		$upData["totalprice"] = $_POST ['totalprice'];
		$outFlg = false;
		
		// 客户信息取得
		$orderList = M("order")->where(array("id"=>$orderId))->find();
		$member = M("member")->where(array("openid"=>$orderList["openid"]))->find();
		
		if ( $upData["actualprice"] != "" && $upData["actualprice"] > 0) {
			//原差额计算
			if ( $orderList["actualprice"] != "" && $orderList["actualprice"] > 0 ) {
				$oldAmt = ($orderList["actualprice"] + $orderList["minusAmt"]) - $orderList["totalprice"];
			} else {
				$oldAmt = 0;
			}
			$actPrice = $upData["actualprice"] + $upData["minusAmt"];
			
			if ( $upData["totalprice"] > $actPrice ) {
				$amt = $upData["totalprice"] - $actPrice;
				
				$memberUp["amt"] = $member["amt"] - $amt - $oldAmt;
			} else {
				$amt = $actPrice - $upData["totalprice"];
				
				$memberUp["amt"] = $member["amt"] + $amt - $oldAmt;
			}
			if ($memberUp["amt"] < 0 && abs($memberUp["amt"]) > $member["diffstandard"]) {
				$outFlg = true;
			}
		}
		
		$session_page_name='order_'.$this->username;
		if ( isset($_SESSION [$session_page_name]) ) {
			$info = $_SESSION [$session_page_name]["product"];
		} else {
			$orderInfo = M("order")->where(array("id"=>$orderId))->getField("info");
			$info = unserialize($orderInfo);
		}
		
		for ( $i=1; $i<=$productNum; $i++ ) {
			$numName = "sendNum_".$i;
			$unitIdName = "unitid_".$i;
			
			$unitId = $_POST [$unitIdName];
			$info[$unitId]["sendNum"] = $_POST [$numName];
		}
		
		$upData["info"] = serialize($info);
		
		$result = M("order")->where(array("id"=>$orderId))->save($upData);
		
		if ( $result ) {
			M("member")->where(array("openid"=>$orderList["openid"]))->save($memberUp);
			
			if ( $outFlg ){
				$this->success( "操作成功，注意：客户差额授信额度已不足！！。",U('Order/orderDetail',array("id"=>$orderId,'orderId'=>$_GET["orderId"],'tel'=>$_GET["tel"],'buyTime'=>$_GET["buyTime"],'states'=>$_GET["states"],'cityId'=>$_GET["cityId"],'pageIndex'=>$_GET["pageIndex"])) );
			}
			
			$this->success ( "操作成功",U('Order/orderDetail',array("id"=>$orderId,'orderId'=>$_GET["orderId"],'tel'=>$_GET["tel"],'buyTime'=>$_GET["buyTime"],'states'=>$_GET["states"],'cityId'=>$_GET["cityId"],'pageIndex'=>$_GET["pageIndex"])) );
		} else {
			$this->error ( "操作失败",U('Order/orderDetail',array("id"=>$orderId,'orderId'=>$_GET["orderId"],'tel'=>$_GET["tel"],'buyTime'=>$_GET["buyTime"],'states'=>$_GET["states"],'cityId'=>$_GET["cityId"],'pageIndex'=>$_GET["pageIndex"])) );
		}
		
	}
	
	/**
	 * 冻结状态
	 * **/
	public function del(){
		$id = $_GET['id'];
		$type = $_GET['type'];
		
		if ( $type == "0" ) {
			$data['states'] = "3";
		} else if( $type == "1" ) {
			$data['states'] = "0";
		}
		
		$result = M("order")->where(array("id"=>$id))->save($data);
		
		if ( $result !== false ) {
			$this->success ( "操作成功" );
		} else {
			$this->error("冻结失败");
		}
	}
	
	/**
	 * 订单详细
	 * **/
	public function orderDetail() {
		$id = $_GET ['id'];
		$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		
		$session_page_name='order_'.$this->username;
		if ( isset($_SESSION[$session_page_name]) ) {
			$pageSession = $_SESSION[$session_page_name];
			$seProduct = $pageSession["product"];
		}
						
		if ($id) {
			$result = M("order")->where(array("id"=>$id))->find();
			
			if ( isset($pageSession["totalPrice"]) ) {
				$result["totalprice"] = $pageSession["totalPrice"];
				$result["paystates"] = $pageSession["paystates"];
				$result["states"] = $pageSession["states"];
				$result["actualprice"] = $pageSession["actualprice"];
				$result["minusAmt"] = $pageSession["minusAmt"];
			}
			
			if ($result["paytype"]=="0") {
				$result["paytypename"] = "货到付款";
			}
			else if($result["paytype"]=="1"){
				$result["paytypename"] = "微信支付";
			}
			
			if ($result["paystates"]=="0") {
				$result["paystatesname"] = "未支付";
			}
			else if($result["paystates"]=="1"){
				$result["paystatesname"] = "已支付";
			}
			
			if ($result["states"]=="0") {
				$result["statesname"] = "未发货";
			}
			else if($result["states"]=="1"){
				$result["statesname"] = "已发货";
			}else if($result["states"]=="2"){
				$result["statesname"] = "已收货";
			}else if($result["states"]=="3"){
				$result["statesname"] = "冻结";
			}else if($result["states"]=="5"){
				$result["statesname"] = "客户取消";
			}
			$member = M("member")->where(array("openid"=> $result["openid"] ))->find();
			// 主城市名取得
			$city = M("city")->where(array("id"=>$member["pcityid"]))->getField("name");
			// 区域取得
			$area = M("city")->where(array("id"=>$member["cityid"]))->getField("name");
			$member["address"] = $city.$area.$member["address"];
			
			$result["memstorename"]=$member["storename"];
			$result["memname"]=$member["name"];
			$result["memaddress"]=$member["address"];
			$result["memtel"]=$member["tel"];
			
			//商品信息取得
			$product = unserialize($result["info"]);
						
			// 分页信息取得
			$pages = Array_chunk($product, 8, true);
			
			// 总页数取得
			$totalPage = count($pages);
			for( $j=1; $j <= $totalPage; $j++ ) {
				$pageList[$j-1]['page'] = $j;
			}
			
			$index = 0;
			$productList = array();
			foreach( $pages[$page-1] as $key => $value ){
				$pDetail = M("product_detail")->where(array("id"=>$key))->find();
				
				$productName = M("product")->where(array("id"=>$pDetail["productid"]))->getField("name");
				
				$value["unitid"] = $key;
				$value["lownum"] = $pDetail["lownum"];
				$value["unitname"] = $pDetail["name"];
				$value["productname"] = $productName;
								
				if ( isset($seProduct[$key]) ) {
					$value["sendNum"] = $seProduct[$key]["sendNum"];
				}
				
				$productList[$index] = $value;
				$index ++;
			}
		}				
						
		//取得查询条件	
		$this->assign ("orderId", $_GET["orderId"]);
		$this->assign ("tel", $_GET["tel"]);
		$this->assign ("buyTime", $_GET["buyTime"]);
		$this->assign ("states", $_GET["states"]);
		$this->assign ("cityId", $_GET["cityId"]);
		$this->assign ("pageIndex", $_GET["pageIndex"]);
		
		$this->assign ("pageList", $pageList);
		$this->assign ("page", $page);
		$this->assign ("totalPage", $totalPage);
		$this->assign ("count", count($productList));
		$this->assign ("result", $result);
		$this->assign ("product", $productList);
		$this->display ();
		
	}
	
	/**
	 * 订单换页
	 * **/
	public function changePage(){
		$page = $_POST["page"];
		$orderId = $_POST["orderId"];
		$dataNum = $_POST["dataNum"];
		$pagedata = $_POST ["pageData"];
		$totalPrice = $_POST ["totalPrice"];
		$paystates = $_POST ["paystates"];
		$states = $_POST ["states"];
		$actualprice = $_POST ["actualprice"];
		$minusAmt = $_POST ["minusAmt"];
		
		
		$session_page_name='order_'.$this->username;
		if ( isset($_SESSION[$session_page_name]) ) {
			$product = $_SESSION[$session_page_name]["product"];
		} else {
			$result = M("order")->where(array("id"=>$orderId))->find();
			//商品信息取得
			$product = unserialize($result["info"]);
		}
		
		if ($pagedata) {
			$pageJson = explode("|",$pagedata);
				
			for ( $i=0; $i<count($pageJson); $i++ ) {
				$pageDList[$i] = json_decode($pageJson[$i]);
			}
		}
		
		foreach ($pageDList as $row) {
			$sendNum = $row->sendNum;
			$id = $row->unitid;
				
			if ( isset($product[$id]) ) {
				$product[$id]["sendNum"] = $sendNum;
			}	
		}
		
		$sessionData["product"] = $product;
		$sessionData["totalPrice"] = $totalPrice;
		$sessionData["paystates"] = $paystates;
		$sessionData["states"] = $states;
		$sessionData["actualprice"] = $actualprice;
		$sessionData["minusAmt"] = $minusAmt;
		
		
		$_SESSION[$session_page_name] = $sessionData;
		
		$this->redirect(U('Order/orderDetail',array('id' => $orderId,'page' => $page,'orderId'=>$_GET["orderId"],'tel'=>$_GET["tel"],'buyTime'=>$_GET["buyTime"],'states'=>$_GET["states"],'cityId'=>$_GET["cityId"],'pageIndex'=>$_GET["pageIndex"])));
	}
	
	public function orderPrint() {
				
		$id = $_GET ['id'];

		$session_page_name='order_'.$this->username;
		if ( isset($_SESSION[$session_page_name]) ) {
			$pageSession = $_SESSION[$session_page_name];
			$seProduct = $pageSession["product"];
		}
		
		if ($id) {
			$result = M("order")->where(array("id"=>$id))->find();
				
			if ( isset($pageSession["totalPrice"]) ) {
				$result["totalprice"] = $pageSession["totalPrice"];
				$result["paystates"] = $pageSession["paystates"];
				$result["states"] = $pageSession["states"];
				$result["actualprice"] = $pageSession["actualprice"];
				$result["minusAmt"] = $pageSession["minusAmt"];
			}
				
			if ($result["paytype"]=="0") {
				$result["paytypename"] = "货到付款";
			}
			else if($result["paytype"]=="1"){
				$result["paytypename"] = "微信支付";
			}
				
			if ($result["paystates"]=="0") {
				$result["paystatesname"] = "未支付";
			}
			else if($result["paystates"]=="1"){
				$result["paystatesname"] = "已支付";
			}
				
			if ($result["states"]=="0") {
				$result["statesname"] = "未发货";
			}
			else if($result["states"]=="1"){
				$result["statesname"] = "已发货";
			}else if($result["states"]=="2"){
				$result["statesname"] = "已收货";
			}else if($result["states"]=="3"){
				$result["statesname"] = "冻结";
			}else if($result["states"]=="5"){
				$result["statesname"] = "客户取消";
			}
			$member = M("member")->where(array("openid"=> $result["openid"] ))->find();
			// 主城市名取得
			$city = M("city")->where(array("id"=>$member["pcityid"]))->getField("name");
			// 区域取得
			$area = M("city")->where(array("id"=>$member["cityid"]))->getField("name");
			$member["address"] = $city.$area.$member["address"];
				
			$result["memstorename"]=$member["storename"];
			$result["memname"]=$member["name"];
			$result["memaddress"]=$member["address"];
			$result["memtel"]=$member["tel"];
				
			//商品信息取得
			$product = unserialize($result["info"]);
			
			$index = 0;
			$productList = array();
			foreach( $product as $key => $value ){
				$pDetail = M("product_detail")->where(array("id"=>$key))->find();
		
				$productName = M("product")->where(array("id"=>$pDetail["productid"]))->getField("name");
		
				$value["unitid"] = $key;
				$value["lownum"] = $pDetail["lownum"];
				$value["unitname"] = $pDetail["name"];
				$value["productname"] = $productName;
		
				if ( isset($seProduct[$key]) ) {
					$value["sendNum"] = $seProduct[$key]["sendNum"];
				}
		
				$productList[$index] = $value;
				$index ++;
			}
		}
		
		//取得查询条件
		$this->assign ("orderId", $_GET["orderId"]);
		$this->assign ("tel", $_GET["tel"]);
		$this->assign ("buyTime", $_GET["buyTime"]);
		$this->assign ("states", $_GET["states"]);
		$this->assign ("cityId", $_GET["cityId"]);
		$this->assign ("pageIndex", $_GET["pageIndex"]);
		
		$this->assign ("count", count($productList));
		$this->assign ("result", $result);
		$this->assign ("product", $productList);
		$this->display ();

	}
	

	
}