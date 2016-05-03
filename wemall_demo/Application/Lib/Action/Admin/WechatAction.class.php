<?php
class WechatAction extends Action {
	public function init() {
		import ( 'wechat', APP_PATH . 'Common', '.class.php' );
		$config = M ( "Wxconfig" )->where ( array (
				"id" => "1" 
		) )->find ();
		
		$options = array (
				'token' => $config ["token"], // 填写你设定的key
				'encodingaeskey' => $config ["encodingaeskey"], // 填写加密用的EncodingAESKey
				'appid' => $config ["appid"], // 填写高级调用功能的app id
				'appsecret' => $config ["appsecret"], // 填写高级调用功能的密钥
				);
		$weObj = new Wechat ( $options );
		return $weObj;
	}
	public function index() {
		$weObj = $this->init ();
		$weObj->valid ();
		$type = $weObj->getRev ()->getRevType ();
		switch ($type) {
			case Wechat::MSGTYPE_TEXT :
				$key = $weObj->getRev()->getRevContent();
				
				$isFlg = strpos($key,"dd");
				if ( $isFlg === false ) {
					
					$replay = M("Wxmessage")->where(array("key"=>$key))->select();
					for ($i = 0; $i < count($replay); $i++) {
						if ($replay[$i]["type"]==0) {
							$appUrl = 'http://' . $this->_server ( 'HTTP_HOST' ) . __ROOT__;
							$newsArr[$i] = array(
									'Title' => $replay[$i]["title"],
									'Description' => $replay[$i]["description"],
									'PicUrl' => $appUrl . '/Public/Uploads/'.$replay[$i]["picurl"],
									'Url' => $replay[$i]["url"].'&uid=' . $weObj->getRevFrom ()
							);
						}else{
							$weObj->text ( $replay[$i]["title"] )->reply ();
							exit ();
						}
					}
					$weObj->getRev ()->news ( $newsArr )->reply ();

				} else {
 					$orderId = explode("+",$key);
					if(count($orderId)>1) {
						$order = M("order")->where(array("orderid"=>$orderId[1]))->find();
							
						if ($order) {
							$message .= chr(10).'订单号:' . $order["orderid"];
							$message .= chr(10).'订单金额:' . $order["totalprice"];
							$message .= chr(10).'实付金额:' . $order["actualprice"];
						} else {
							$message = "您输入的订单号不存在，请确认后再查询";
						}
					} else {
						$message = "输入格式不正确，请按照此规则输入：dd+订单号";
					}
					$weObj->text ( $message )->reply ();
				}
				exit ();
				break;
			case Wechat::MSGTYPE_EVENT :
				$eventype = $weObj->getRev ()->getRevEvent ();
				if ($eventype ['event'] == "CLICK") {
					$appUrl = 'http://' . $this->_server ( 'HTTP_HOST' ) . __ROOT__;
					
					$news = M ( "Wxmessage" )->where ( array (
							"key" => $eventype ['key'],
							"type" => 0 
					) )->select ();
					
					if ($news) {
						for($i = 0; $i < count ( $news ); $i ++) {
							$newsArr[$i] = array(
								'Title' => $news[$i]["title"],
								'Description' => $news[$i]["description"],
								'PicUrl' => $appUrl . '/Public/Uploads/'.$news[$i]["picurl"],
								'Url' => $news[$i]["url"].'&uid=' . $weObj->getRevFrom ()
							);
						}

						$weObj->getRev ()->news ( $newsArr )->reply ();
					}
					
				}elseif ($eventype['event'] == "subscribe") {
    				$weObj->text ( "欢迎您关注农易联-全品类食材采购平台！" )->reply ();
				}
				exit();
				break;
			default :
				$weObj->text ( "help info" )->reply ();
		}
	}
	public function createMenu() {
        $menu = M("Wxmenu")->where(array("pid"=>"0"))->select();

        $index = 0;
        $childIndex = 0;
        $newmenu["button"] = array();
        foreach ( $menu as $row ) {
        	$childMenu = M("Wxmenu")->where(array("pid"=>$row["id"]))->select();
        	if ($childMenu) {
        		$newmenu["button"][$index]["name"] = $row["name"];
        		foreach( $childMenu as $cRow ) {
        			if ($cRow["type"] == "view") {
        				$newmenu["button"][$index]["sub_button"][$childIndex] = array('type'=>'view','name'=>$cRow["name"],'url'=>$cRow["url"]);
        			} else {
        				$newmenu["button"][$index]["sub_button"][$childIndex] = array('type'=>'click','name'=>$cRow["name"],'key'=>$cRow["key"]);
        			}
        			$childIndex++;
        		}
        		$index++;
        	} else {
        		if($row["type"] == "view"){
        			$newmenu["button"][$index] = array('type'=>'view','name'=>$row["name"],'url'=>$row["url"]);
        		}else{
        			$newmenu["button"][$index] = array('type'=>'click','name'=>$row["name"],'key'=>$row["key"]);
           		}
           		$index++;
        	}

        }

        $weObj = $this->init();
        $result = $weObj->createMenu($newmenu);
        
        if ($result) {
        	$this->success("重新创建菜单成功!");
        } else {
        	$this->error("创建菜单失败！");
        }
	}
}