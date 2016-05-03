<?php
class ActiveAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}
	
	public function index() {
		import ( 'ORG.Util.Page' );
		
		$count = M ( "active" )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		
		$result = M ( "active" )->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->select ();
		foreach ( $result as &$row ) {
			if($row["activeType"]==1){
				$row["activeTypeName"] = "限时抢购";
			}
			else if($row["activeType"]==2){
				$row["activeTypeName"] = "预约购买";
			}
			else if($row["activeType"]==3){
				$row["activeTypeName"] = "特价维护";
			}
			else if($row["activeType"]==4){
				$row["activeTypeName"] = "购物车促销";
			}
			else if($row["activeType"]==5){
				$row["activeTypeName"] = "品类促销";
			}
			else if($row["activeType"]==6){
				$row["activeTypeName"] = "商品促销";
			}
			
			if ($row["openFlg"]==0) {
				$row["openName"] = "启用";
			}
			else if($row["openFlg"]==1){
				$row["openName"] = "不启用";
			}
			
			if ($row["preparFlg"]==1) {
				$row["preName"] = "可预付";
			}
			else if($row["preparFlg"]==2){
				$row["preName"] = "不可预付";
			}
			
			$city = M("city")->where(array("id" =>$row["cityId"]))->find();
			$row["cityName"] = $city["name"];
		}
		
		if ( $this->cityid == "0" ) {
			$city = M("city")->where(array("pid" => "0"))->select();
		} else {
			$city = M("city")->where(array("id" =>$this->cityid))->find();
		}
		
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "active", $result );
		$this->assign ( "usercity", $this->cityid );
		$this->assign ( "cxCity", $city );
		$this->assign ( "tCity", $city );
		$this->display ();
	}
	
	// 追加促销活动
	public function saveCxActive() {
		$data["activeName"] = $_POST["activename1"];
		$data["openFlg"] = $_POST["states1"];
		$data["startTime"] = $_POST["starttime1"];
		$data["endTime"] = $_POST["endtime1"];
		$data["cityId"] = $_POST["cityid1"];
		$data["activeType"] = $_POST["fullcuttype1"];
		$addFlg = $_POST["addactiveId1"];
		
		if ( $data["activeType"] == "5" ) {
			$addNum = $_POST["addMenuNum"];
		} else if ( $data["activeType"] == "6" ) {
			$addNum = $_POST["addProNum"];
		} else {
			$addNum = 1;
		}
		
		for ( $i=0; $i<$addNum; $i++ ) {
			
			if ($data["activeType"] == "4") {
				$info[$i]["id"] = "";
				$info[$i]["name"] = "";
				$info[$i]["fullAmt"] = $_POST["cartmoney_0"];
				$info[$i]["outPercent"] = $_POST["money1_0"];
				$info[$i]["outAmt"] = $_POST["money2_0"];
			} else {
				if ( $data["activeType"] == "5" ) {
					$idName = "menuId_".$i;
					$pNameName = "menuName_".$i;
					$fullName = "menuFull_".$i;
					$perName = "menuPer_".$i;
					$amtName = "menuAmt_".$i;
				} else if ( $data["activeType"] == "6" ) {
					$idName = "proId_".$i;
					$pNameName = "proName_".$i;
					$fullName = "proFull_".$i;
					$perName = "proPer_".$i;
					$amtName = "proAmt_".$i;
				}
					
				$info[$i]["id"] = $_POST[$idName];
				$info[$i]["name"] = $_POST[$pNameName];
				$info[$i]["fullAmt"] = $_POST[$fullName];
				$info[$i]["outPercent"] = $_POST[$perName];
				$info[$i]["outAmt"] = $_POST[$amtName];
			}
		}
		$data["info"] = serialize($info);
		
		if ( $addFlg == "0" ) {
			$map["startTime"] = array('between',array($_POST["starttime1"],$_POST["endtime1"]));
			$map["endTime"] = array('between',array($_POST["starttime1"],$_POST["endtime1"]));
			$map['_logic'] = 'or';
			$where['_complex'] = $map;
			$where['cityId']  = $_POST["cityid1"];
			
			$active = M("active")->where($where)->select();
			
			if ($active) {
				$this->error("在此期间内已经存在促销活动，请查询后再追加！",U("Active/index"));
			} else {
				$result = M("active")->add($data);
			}
			
		} else {
			$result = M("active")->where(array("id"=>$addFlg))->save($data);
		}
				
		if ( $result !== false ) {
			$this->success ( "操作成功" ,U("Active/index"));
		} else {
			$this->error("操作失败",U("Active/index"));
		}
	}
	
	public function addActive() {
		
		$addFlg = $_POST["addactiveId"];
		$data["activeName"] = $_POST["activename"];
		$data["openFlg"] = $_POST["states"];
		$data["startTime"] = $_POST["starttime"];
		$data["endTime"] = $_POST["endtime"];
		$data["cityId"] = $_POST["cityid"];
		$data["activeType"] = $_POST["actiontype"];
		$data["productId"] = $_POST["productid"];
		$data["productName"] = $_POST["productname"];
		$data["activePrice"] = $_POST["nprice"];
		$data["oldPrice"] = $_POST["productprice"];
		$data["stock"] = $_POST["storenum"];
		$data["lowBuy"] = $_POST["lowbuynum"];		
		$data["maxBuy"] = $_POST["maxbuynum"];		
		$data["preparFlg"] = $_POST["paystates"];
		$data["preparPay"] = $_POST["paypercent"];
		if (isset($_POST["info"])) {
			$data["info"] = $_POST["info"];
		}
		
		if ( $addFlg == "0" ) {
			
			$map["startTime"] = array('between',array($_POST["starttime"],$_POST["endtime"]));
			$map["endTime"] = array('between',array($_POST["starttime"],$_POST["endtime"]));
			$map["activeType"] = "3";
			$map["openFlg"] = "0";
			$map["cityId"] = $_POST["cityid"];
			$map["productId"] = $_POST["productid"];
			$exitFlg = M('active')->where($map)->find();
			if ($exitFlg) {
				$this->error("在此期间内，存在同一款商品的促销，请确认后再追加！",U("Active/index"));	
			}
			
			// 图片
			if ($_FILES ['activeimg'] ['name'] !== '') {
				$img = $this->upload ();
				$picurl = $img [0] [savename];
				$data ["activeImg"] = $picurl;
			}
// 			 else {
// 				$this->error ( "未上传图片！",U("Active/index") );
// 			}
			
			$result = M("active")->add($data);
		} else {
			// 图片
			if ($_FILES ['activeimg'] ['name'] !== '') {
				$img = $this->upload ();
				$picurl = $img [0] [savename];
				$data ["activeImg"] = $picurl;
			}
			
			$result = M("active")->where(array("id"=>$addFlg))->save($data);
		}
		
		if ( $result !== false ) {
			$this->success ( "操作成功",U("Active/index") );
		} else {
			$this->error("操作失败",U("Active/index"));
		}
	}
	
	// 取得商品名称
	public function findProductId() {
		$productId = $_POST["productId"];
		$cityId = $_POST["cityId"];
		
		if ( is_numeric($productId) ) {
			$product = M("product_detail")->where(array("id"=>$productId,"cityid"=>$cityId))->getField("productid");
			$productInfo = M("product")->where(array("id"=>$product))->select();
			$detail = M("product_detail")->where(array("id"=>$productId,"cityid"=>$cityId))->find();
		} else {
			$productInfo = M("product")->where(array("name"=>array("like",'%'.$productId.'%')))->select();
			$detail = M("product_detail")->where(array("cityid"=>$cityId,"productid"=>$productInfo[0]["id"]))->find();
		}
				
		if ( count($productInfo) == 1) {
			$result["result"] = "succ";
			$result["info"]["id"] = $detail["id"];
			$result["info"]["name"] = $productInfo[0]["name"];
			$result["info"]["price"] = $detail["vprice"];
		} else {
			$result["result"] = "fail";
			
			if (count($productInfo) == 0) {
				$result["reason"] = "您查询的商品不存在！";
			}else{
				$msge = "";
				for ($i=0;$i<count($productInfo);$i++) {
					$detailList = M("product_detail")->where(array("cityid"=>$cityId,"productid"=>$productInfo[$i]["id"]))->find();
					$msge .= chr(10)."id:".$detailList["id"].",单位:".$detailList["name"].",商品名:".$productInfo[$i]["name"];
				}
				$result["reason"] = "您查询的商品存在多个".$msge.chr(10)."请输入ID进行查询";
			}

		}

		$this->ajaxReturn($result);
	}
	
	// 取得商品名称
	public function findMenuId() {
		$menuId = $_POST["classId"];
	
		if ( is_numeric($menuId) ) {
			$menuInfo = M("menu")->where(array("id"=>$menuId))->find();
		} else {
			$menuInfo = M("menu")->where(array("name"=>array("like",'%'.$menuId.'%')))->find();
		}
				
		if ( $menuInfo) {
			$result["result"] = "succ";
			$result["info"] = $menuInfo;
		} else {
			$result["result"] = "fail";
		}
	
		$this->ajaxReturn($result);
	}
	
	// 取得活动data
	public function getActiveData() {
		$Id = $_POST["activeId"];
	
		$active = M("active")->where(array("id"=>$Id))->find();
	
		if ( $active) {
			$result["result"] = "succ";
			$result["info"] = unserialize($active["info"]);
		} else {
			$result["result"] = "fail";
		}
	
		$this->ajaxReturn($result);
	}
	
	public function del($id) {
		M ( "Active" )->where ( array ('id' => $id) )->delete ();
		$this->success ( "删除成功" );
	}
}