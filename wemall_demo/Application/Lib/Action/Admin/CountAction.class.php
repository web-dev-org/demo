<?php
class CountAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		if( IS_POST ) {
			$states = $_POST["orderStates"];
			$startTime = $_POST["startTime"]." 00:00:00";
			$endTime = $_POST["endTime"]." 23:59:59";
			
			$where["buytime"] =  array(array('egt',$startTime),array('elt',$endTime)) ;
			$where["states"] = $states;
			if ( $this->cityid != "0" ) {
				$where["cityid"] = $this->cityid;
			}
			
			$orders = M("order")->where($where)->select();
			
			$result = array();
			$index = 0;
			foreach ( $orders as $order ) {
				$info = unserialize($order["info"]);
									
				foreach( $info as $key=>$value ) {
					$existFlg = false;
					$proDetail = M("product_detail")->where(array("id"=>$key))->find();
					$product = M("product")->where(array("id"=>$proDetail["productid"]))->find();
					$menu = M("menu")->where(array("id"=>$product["menuid"])) ->find();
			
					$data["menuId"] = $menu["id"];
					$data["menuName"] = $menu["name"];
					$data["productId"] = $proDetail["id"];
					$data["price"] = $proDetail["vprice"];
					$data["unitName"] = $proDetail["name"];
					$data["productName"] = $product["name"];
										
					if ( $value["sendNum"] != null && $value["sendNum"] != "" ) {
						$data["num"] = $value["sendNum"];
					} else {
						$data["num"] = $value["buyNum"];
					}
								
					if( $result ){
						for ( $i=0; $i < $index; $i++ ) {
							if ( $result[$i]["menuId"] == $data["menuId"] ) {
								$isFlg = false;
								foreach ($result[$i]["product"] as &$row) {
									if ( $row["productId"] == $data["productId"] ) {
										$row["num"] += $data["num"];
										$isFlg = true;
										$existFlg = true;
										break;
									}
								}
									
								if (!$isFlg) {
									$result[$i]["product"][] = $data;
									$existFlg = true;
									break;
								}
							}
						}
					}
					if( !$existFlg ){
						$result[$index]["menuId"] = $data["menuId"];
						$result[$index]["menuName"] = $data["menuName"];
						$result[$index]["product"][] = $data;
						$index ++;
					}
				}
			}
						
			$this->assign("startTime", $_POST["startTime"]);
			$this->assign("endTime", $_POST["endTime"]);
			$this->assign("seStates", $states);
			$this->assign("result", $result);
			$this->display();
		} else {
			$this->display ();
		}
	}
	
	/**
	 * 输出数据文件。
	 */
	public function outExcel() {
 		import('Application.Lib.ORG.PHPExcel');
 		date_default_timezone_set('Etc/GMT-8');     //这里设置了时区
		
		$states = $_POST["orderStates"];
		$startTime = $_POST["startTime"]." 00:00:00";
		$endTime = $_POST["endTime"]." 23:59:59";
		
		$where["buytime"] =  array(array('egt',$startTime),array('elt',$endTime)) ;
		$where["states"] = $states;
		if ( $this->cityid != "0" ) {
			$where["cityid"] = $this->cityid;
		}
		
		$orders = M("order")->where($where)->select();
		
		$result = array();
		$index = 0;
		foreach ( $orders as $order ) {
			$info = unserialize($order["info"]);
								
			foreach( $info as $key=>$value ) {
				$existFlg = false;
				$proDetail = M("product_detail")->where(array("id"=>$key))->find();
				$product = M("product")->where(array("id"=>$proDetail["productid"]))->find();
				$menu = M("menu")->where(array("id"=>$product["menuid"])) ->find();
		
				$data["menuId"] = $menu["id"];
				$data["menuName"] = $menu["name"];
				$data["productId"] = $proDetail["id"];
				$data["unitName"] = $proDetail["name"];
				$data["productName"] = $product["name"];
									
				if ( $value["sendNum"] != null && $value["sendNum"] != "" ) {
					$data["num"] = $value["sendNum"];
				} else {
					$data["num"] = $value["buyNum"];
				}
							
				if( $result ){
					for ( $i=0; $i < $index; $i++ ) {
						if ( $result[$i]["menuId"] == $data["menuId"] ) {
							$isFlg = false;
							foreach ($result[$i]["product"] as &$row) {
								if ( $row["productId"] == $data["productId"] ) {
									$row["num"] += $data["num"];
									$isFlg = true;
									$existFlg = true;
									break;
								}
							}
								
							if (!$isFlg) {
								$result[$i]["product"][] = $data;
								$existFlg = true;
								break;
							}
						}
					}
				}
				if( !$existFlg ){
					$result[$index]["menuId"] = $data["menuId"];
					$result[$index]["menuName"] = $data["menuName"];
					$result[$index]["product"][] = $data;
					$index ++;
				}
			}
		}
				
		$count = count($result); //数据行数;
			
 		vendor("Application.Lib.ORG.PHPExcel");
	
 		
		//导出类生成
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "开始日");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('B1', $_POST["startTime"]);//设置列的值
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "结束日");//设置列的值
		$objPHPExcel->getActiveSheet()->setCellValue('D1', $_POST["endTime"]);//设置列的值
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		
		
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "订单状态");//设置列的值
		if ( $states == "0" ) {
			$objPHPExcel->getActiveSheet()->setCellValue('F1', "未发货");//设置列的值
		} 
		else if ( $states == "1" ) {
			$objPHPExcel->getActiveSheet()->setCellValue('F1', "已发货");//设置列的值
		}
		else if ( $states == "2" ) {
			$objPHPExcel->getActiveSheet()->setCellValue('F1', "已收货");//设置列的值
		}
		else if ( $states == "3" ) {
			$objPHPExcel->getActiveSheet()->setCellValue('F1', "冻结");//设置列的值
		}
		else if ( $states == "5" ) {
			$objPHPExcel->getActiveSheet()->setCellValue('F1', "客户取消");//设置列的值
		}
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	
		$i=3;
		for($j=0;$j<$count;$j++)
		{
			// 设置分类名
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i,"分类：".$result[$j]['menuName']);
			$i++;
			// 设置title
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i,"商品ID")
				->setCellValue('B'.$i,"商品名称")
				->setCellValue('C'.$i,"单位名")
				->setCellValue('D'.$i,"商品售出数");
			$i++;
			
			$productList = $result[$j]['product'];
			// 设置数据
			for ($m=0;$m<count($productList);$m++) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i,$productList[$m]['productId'])
				->setCellValue('B'.$i,$productList[$m]['productName'])
				->setCellValue('C'.$i,$productList[$m]['unitName'])
				->setCellValue('D'.$i,$productList[$m]['num']);
				$i++;
			}
		}
	
		$objPHPExcel->getActiveSheet(0)->setTitle('orderCount');
		$objPHPExcel->setActiveSheetIndex(0);
	
		ob_clean();
		header("Content-type: text/csv");//重要
		header('Content-Disposition:attachment;filename="orderCount.csv"');
		header('Cache-Control: must-revalidate, post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	
	public function countSaleCode() {
		if( IS_POST ) {
			$startTime = $_POST["startTime"]." 00:00:00";
			$endTime = $_POST["endTime"]." 23:59:59";
			
			$result = M("sales_code")->select();
		
			$index = 0;
			foreach ($result as $row) {
				$userInfo = M("member")->where(array("salescode"=>$row["salesCode"]))->select();
				//总用户数
				$memberCount = count($userInfo);
					
				$orderMember = 0; //下单用户数
				$orderCount = 0; // 订单总数
				$orderTotal = 0; // 订单总金额
				foreach ( $userInfo as $user ) {
					$where["openid"] = $user["openid"];
					$where["states"] = "2";
					$where["buytime"] =  array(array('egt',$startTime),array('elt',$endTime)) ;
					$order = M("order")->where($where)->select();
					if ($order) {
						$orderMember = $orderMember + 1;
						$orderCount = $orderCount + count($order);
							
						$totalAmt = M("order")->field("sum(actualprice) as acPrice")->where($where)->group("openid")->find();
						$orderTotal = $orderTotal + $totalAmt["acPrice"];
					}
				}
					
				$data[$index]["name"] = $row["staffName"];
				$data[$index]["salesCode"] = $row["salesCode"];
				$data[$index]["totalMember"] = $memberCount;
				$data[$index]["orderMember"] = $orderMember;
				$data[$index]["orderFee"] = round($orderMember / $memberCount, 2);
				$data[$index]["orderCount"] = $orderCount;
				$data[$index]["totalAmt"] = round($orderTotal, 2);
				$data[$index]["perPrice"] = round($orderTotal / $orderCount, 2);
				$index++;
			}
			$this->assign("startTime", $_POST["startTime"]);
			$this->assign("endTime", $_POST["endTime"]);
			$this->assign("result", $data);
		}
		
		$this->display();
	
	}
	
}