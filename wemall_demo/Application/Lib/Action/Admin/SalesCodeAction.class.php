<?php

class SalesCodeAction extends PublicAction{
	private $randstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	function _initialize() {
		parent::_initialize ();
	}
	
	public function index(){
		import ( 'ORG.Util.Page' );
		
		$count = M("sales_code")->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 10 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
		$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		
		$result = M("sales_code")->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->select();
		
		foreach ( $result as &$row ) {
			if ($row["states"]==0) {
				$row["statesname"] = "无效";
			} else {
				$row["statesname"] = "有效";
			}
			
			$cityName = M("city")->where(array("id"=>$row["cityid"]))->getField("name");
			$row["cityname"] = $cityName;
		}
		
		//城市取得
		$cityList = M("city")->where(array("pid"=>"0"))->select();
		
		$this->assign ( "code", $result );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "cityList", $cityList );
		$this->display ();
	}
	
	public function addCode() {
		$codeId = $_POST["codeId"];
		$data["staffName"] = $_POST["staffName"];
		$data["cityid"] = $_POST["city"];
		$data["salesCode"] = $_POST["salesCode"];
		$data["states"] = $_POST["states"];
		
		$inFlg = M("sales_code")->where(array("salesCode" => $_POST["salesCode"]))->find();
		if ( $inFlg ) {
			$this->error ( "此邀请码已经存在请重新生成！" );
		}
		
		if ( $codeId ) {
			$result = M("sales_code")->where(array("id"=>$codeId))->save($data);			
		} else {
			$result = M("sales_code")->add($data);
		}
		
		if( $result !== false  ) {
			$this->success ( "操作成功" );
		} else {
			$this->error ( "操作失败" );
		}
	}
	
	public function makeSalesCode() {

		$salesCode = $this->randstr{rand(0, 51)} . $this->randstr{rand(0, 51)} . rand(100,999);
		
		$result["result"] = "succ";
		$result["code"] = $salesCode;
		
		$this->ajaxReturn($result);
	}
	
	public function del() {
		$id = $_GET["id"];	
	
		$result = M("sales_code")->where(array("id"=>$id))->delete();			
		
		if( $result !== false  ) {
			$this->success ( "操作成功" );
		} else {
			$this->error ( "操作失败" );
		}
	}
}
?>