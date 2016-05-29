<?php

class HotelAction extends PublicAction {
	
	function _initialize() {
		parent::_initialize ();
	}
	
	// 商品显示
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "hotel_info" );
	
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
	
		// 查地域数据。

		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->select ();
		
		for($i = 0; $i < count ( $result ); $i ++) {
				
			//地域取得
			$cityRe = M("city")->where(array("id"=> $result [$i] ["city_id"]))->find();
			$result [$i] ["cityname"] = $cityRe["name"];
				
			if ( $result [$i]["level"] == "0" ) {
				$result [$i]["levelname"] = "三星";
			} else if ( $result [$i]["level"] == "1" ){
				$result [$i]["levelname"] = "四星";
			} else {
				$result [$i]["levelname"] = "五星";
			}
		}
		
		
		// 地域信息取得
		$city = M("city")->where(array("pid"=>"0"))->select();
	
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "result", $result );
		$this->assign ( "city", $city );
		$this->display ();
	}
	
	// 追加商品
	public function addHotel() {
		
		$data ["city_id"] = $_POST ["city"]; //分类
		$data ["name"] = $_POST ["name"]; //名称
		if (isset($_POST ["editorValue"])) {
			$data ["summary"] = $_POST ["editorValue"]; //详细	
		}
		$data ["level"] = $_POST ["level"]; 
		$data ["address"] = $_POST ["address"]; 
		
		if (isset($_POST ["B_flg"])) {
			$data["B_flg"] = $_POST ["B_flg"];
		}
		if (isset($_POST ["L_flg"])) {
			$data["L_flg"] = $_POST ["L_flg"];
		}
		if (isset($_POST ["S_flg"])) {
			$data["S_flg"] = $_POST ["S_flg"];
		}
		$data["S_price"] = $_POST ["S_price"];
		$data["T_price"] = $_POST ["T_price"];
		$data["D_price"] = $_POST ["D_price"];
		
		if ($_POST["hotel_id"]) {
			
			$data ["id"] = $_POST["hotel_id"];
			M ("hotel_info")->save($data);

			$this->success ( "修改酒店成功！" );
			
		}else{
			
			//city 取得
			$count = M( "city" )->count();
			if ($count == 0) {
				$this->error ( "请至少追加一个地域后，再追加酒店！" );
			}

			// 追加酒店信息
			$result = M("hotel_info")->add($data);
			$this->success ( "添加酒店成功！" );
		}
	}
	
	//删除商品
	public function delproduct() {
		$hotelid = $_GET ["hotel_id"];

		$result = M ( "hotel_info" )->where ( array ( "id" => $hotelid ) )->delete ();
		
		if ( $result !== false ) {
			$this->success ( "删除商品成功！" );
		} else {
			$this->error ( "删除商品失败！" );
		}

	}
}

?>