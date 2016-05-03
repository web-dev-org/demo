<?php

class ProductAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// 商品显示
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "product_detail" );
	
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
	
		// 超级管理员全部查处，地域管理员只查处该地域数据。
		if ( $this->cityid != '0' ) {
			$where['cityid'] = $this->cityid;
			$result = $m->where($where)->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->select ();
			
			// 地域信息取得
			$city = M("city")->where($where)->find();
		} else {
			$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->select ();
			// 地域信息取得
			$city = M("city")->where(array("pid"=>"0"))->select();
		}
		
		for($i = 0; $i < count ( $result ); $i ++) {
			// 取得商品基本信息
			$productid = $result [$i] ["productid"];
			$aProduct = M ("product")->where ( array ("id" => $productid) )->find ();
			$result [$i] ["productname"] = $aProduct['name'];
			$result [$i] ["img"] = $aProduct['img'];
			$result [$i] ["info"] = $aProduct['info'];
			$result [$i] ["menuid"] = $aProduct['menuid'];
			$result [$i] ["feibiao"] = $aProduct['feibiao'];
			$result [$i] ["tuijian"] = $aProduct['tuijian'];
			
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
			$result[$i]["vprice"] = number_format(($result[$i]["bprice"] + $result[$i]["percent"] * $result[$i]["bprice"] * 0.01), 2);
			$result[$i]["nprice"] = 0;
			$result[$i]["amt"] = 0;
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
	
	// 追加商品
	public function addProduct() {
		
		/*  商品基本信息取得  */
		$data ["menuid"] = $_POST ["addmenuid"]; //分类
		$data ["name"] = $_POST ["addname"]; //名称
		if (isset($_POST ["editorValue"])) {
			$data ["info"] = $_POST ["editorValue"]; //详细	
		}
		$data ["feibiao"] = $_POST ["addfeibiao"]; //非标标识
		$data ["tuijian"] = $_POST ["addtuijian"]; //推荐
		
		// 单位
		$unitNum = intval($_POST ["addunitNum"]); //单位个数
		$data["unitnum"] = $unitNum;
		
		// 分类名取得
		$menuList = M("menu")->where(array("id" => $data ["menuid"]))->find();
		
		// 中间表数据数取得
		$dataCount =  M("product_mid")->where(array("username"=>$this->username))->count();
				
		if ($_POST["productid"]) {
			
			// 图片
			if ($_FILES ['addimage'] ['name'] !== '') {
				$img = $this->upload ();
				$picurl = $img [0] [savename];
				$data ["img"] = $picurl;
			}
			$data ["id"] = $_POST["productid"]; //商品id
			M ("product")->save($data);
			
			/*  商品详细取得  */
			for( $i=0; $i<$unitNum; $i++ ) {
				$unit = "addunit_".$i;
				$num = "addnum_".$i;
				$lownum = "lownum_".$i;
				
				$productD['productid'] =  $_POST["productid"]; // 商品id
				$productD['name'] =  $_POST [$unit]; //单位名
				$productD['num'] =  $_POST [$num];// 常用数量
				$productD['lownum'] =  $_POST [$lownum];// 常用数量
				$productD['states'] =  $_POST ['addstatus']; // 当前状态
				
				$where['id'] = $_POST ["unitid"];

				
				if ( $i == 0 ) { // 不是新追加单位
					M ("product_detail")->where($where)->save($productD);								
				} else { // 新追加单位
					if ( $this->cityid == '0' ) { //登录者为全地域管理员
						// 取得地域
						$city = M ( "city" )->where(array("pid"=>"0"))->select();
						foreach ($city as &$row) {
							$productD['cityid'] = $row['id'];
							//city取得
							$cityList = M("city")->where(array("id"=>$row['id']))->find();
							$result = M ("product_detail")->add($productD);
						}
						
					} else { // 登录者为地域管理员
						$productD['cityid'] = $this->cityid;
						//city取得
						$cityList = M("city")->where(array("id"=>$this->cityid))->find();
						$result = M ("product_detail")->add($productD);
					}
					
				}

			}

			$this->success ( "修改商品成功！" );
			
		}else{
			// 图片
			if ($_FILES ['addimage'] ['name'] !== '') {
				$img = $this->upload ();
				$picurl = $img [0] [savename];
				$data ["img"] = $picurl;
			} else {
				$this->error ( "未上传图片！" );
			}
			
			//city 取得
			$count = M( "city" )->count();
			if ($count == 0) {
				$this->error ( "请至少追加一个地域后，再追加商品！" );
			}

			// 追加商品基本表
			$result = M("product")->add($data);
			$productid = M("product")->getLastInsID();
						
			if ( $this->cityid == '0' ) { //登录者为全地域管理员
				// 取得地域
				$city = M ( "city" )->where(array("pid"=>"0"))->select();
					
				// 按地域不同生成商品详细
				foreach ($city as &$row) {
					for( $i=0; $i<$unitNum; $i++ ) {
						$unit = "addunit_".$i;
						$num = "addnum_".$i;
						$lownum = "lownum_".$i;
						
						$productD['name'] =  $_POST [$unit]; //单位
						$productD['productid'] =  $productid; //商品id
						$productD['num'] =  intval($_POST [$num]);// 常用数量
						$productD['lownum'] =  $_POST [$lownum];// 常用数量
						$productD['cityid'] =  $row['id'];// 城市id
						$productD['states'] =  $_POST ['addstatus']; // 当前状态
						
						$result = M("product_detail")->add($productD);
					}
				}
			} else { // 地域管理员
				for( $i=0; $i<$unitNum; $i++ ) {
					$unit = "addunit_".$i;
					$num = "addnum_".$i;
					$lownum = "lownum_".$i;
						
					$productD['name'] =  $_POST [$unit]; //单位名
					$productD['productid'] =  $productid; //商品id
					$productD['num'] =  $_POST [$num];// 常用数量
					$productD['lownum'] =  $_POST [$lownum];// 常用数量
					$productD['cityid'] =  $this->cityid;// 城市id
					$productD['states'] =  $_POST ['addstatus']; // 当前状态
					
					$result = M("product_detail")->add($productD);
				}
			}
			
			$this->success ( "添加商品成功！" );
		}
	}
	
	//删除商品
	public function delproduct() {
		$productid = $_GET ["productid"];
		$unitid = $_GET ["unitid"];
		$cityid = $_GET ["cityid"];

		$count = M("product_detail")->where(array("productid"=>$productid))->count();
		
		if ( $count > 1 ) {
			$result = M ("product_detail")->where (array("id"=>$unitid ) )->delete();
		} else {
			$result = M ( "product_detail" )->where ( array ( "id" => $unitid ) )->delete();
			$result = M ( "product" )->where ( array ( "id" => $productid ) )->delete ();
		}
		
		if ( $result !== false ) {
			$this->success ( "删除商品成功！" );
		} else {
			$this->error ( "删除商品失败！" );
		}

	}
	
	// 取得商品id
	public function getproduct() {
		$id = $_POST ["id"];
		$unitid = $_POST ["unitid"];
		$result = M ( "product" )->where ( array ("id" => $id) )->find ();
		$resultD = M ( "product_detail" )->where ( array ("id" => unitid) )->find ();
		
		
		if ($result) {
			$result['unit'] = $resultD['name'];
			$result['price'] = $resultD['vprice'];
			$result['unit'] = $resultD['name'];
			$result['states'] = $resultD['states'];
			$this->ajaxReturn ( $result );
		}
	}
}

?>