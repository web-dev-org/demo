<?php
// 本类由系统自动生成，仅供测试用途
class StoreAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {

		if ($_SESSION ["wadmin"]) {
			$result = R ( "Api/Api/getsetting" );
			$this->assign ( "info", $result );
			
			$config = M("alipay")->find();
			if($config){
				$info = unserialize($config['info']);
				$this->assign('config',$info);
				$this->assign('id',$config["id"]);
			}
			$this->display();
		}
	}
	
	public function setting() {
		$result = R ( "Api/Api/setting", array (
				$_POST ["name"],
				$_POST ["notification"] 
		) );
		$this->success ( "修改成功");
	}

	public function setalipay(){
		
		//找出支付的配置文件
		$count = M("alipay")->count();
		
		if(IS_POST){
			$data["alipayname"] = "微信支付";
			$data["appid"] = strval(trim($_POST['appid']));
			$data["key"] = strval(trim($_POST['key']));
			$data["mchid"] = strval(trim($_POST['mchid']));
			$data["appsecret"] = strval(trim($_POST['appsecret']));
			$data["info"] = serialize($_POST);
			
			if($count > 0){
				$where["id"] = $_POST['alipayid'];
				M("alipay")->where($where)->save($data);
			}else{
				M("alipay")->add($data);
			}
				
			$this->success('设置成功');
		}
	}
}