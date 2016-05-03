<?php
define("TOKEN","beijingshengxianxiadan");
class wechatCallback {
	
	public function valid()
	{
		$echoStr = $_GET["echostr"];
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
	
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
	
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	public function responseMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$RX_TYPE = trim($postObj->MsgType);
	
			switch ($RX_TYPE)
			{
				case "text":
					$resultStr = $this->receiveText($postObj);
					break;
				case "image":
					$resultStr = $this->receiveImage($postObj);
					break;
				case "location":
					$resultStr = $this->receiveLocation($postObj);
					break;
				case "voice":
					$resultStr = $this->receiveVoice($postObj);
					break;
				case "video":
					$resultStr = $this->receiveVideo($postObj);
					break;
				case "link":
					$resultStr = $this->receiveLink($postObj);
					break;
				case "event":
					$resultStr = $this->receiveEvent($postObj);
					break;
				default:
					$resultStr = "unknow msg type: ".$RX_TYPE;
					break;
			}
			echo $resultStr;
		}else {
			echo "";
			exit;
		}
	}
	
	private function receiveText($object)
	{
		$funcFlag = 0;
		$contentStr = "你发送的是文本，内容为：".$object->Content;
		$resultStr = $this->transmitText($object, $contentStr, $funcFlag);
		return $resultStr;
	}
	
	private function receiveImage($object)
	{
		$funcFlag = 0;
		$contentStr = "你发送的是图片，地址为：".$object->PicUrl;
		$resultStr = $this->transmitText($object, $contentStr, $funcFlag);
		return $resultStr;
	}
	
	private function receiveLocation($object)
	{
		$funcFlag = 0;
		$contentStr = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
		$resultStr = $this->transmitText($object, $contentStr, $funcFlag);
		return $resultStr;
	}
	
	private function receiveVoice($object)
	{
		$funcFlag = 0;
		$contentStr = "你发送的是语音，媒体ID为：".$object->MediaId;
		$resultStr = $this->transmitText($object, $contentStr, $funcFlag);
		return $resultStr;
	}
	
	private function receiveVideo($object)
	{
		$funcFlag = 0;
		$contentStr = "你发送的是视频，媒体ID为：".$object->MediaId;
		$resultStr = $this->transmitText($object, $contentStr, $funcFlag);
		return $resultStr;
	}
	
	private function receiveLink($object)
	{
		$funcFlag = 0;
		$contentStr = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
		$resultStr = $this->transmitText($object, $contentStr, $funcFlag);
		return $resultStr;
	}
	
	private function receiveEvent($object)
	{
		$contentStr = "";
		switch ($object->Event)
		{
			case "subscribe":
				$contentStr = "欢迎关注方倍工作室";
				break;
			case "unsubscribe":
				$contentStr = "";
				break;
			case "CLICK":
				switch ($object->EventKey)
				{
					default:
						$contentStr = "你点击了: ".$object->EventKey;
						break;
				}
				break;
			default:
				$contentStr = "receive a new event: ".$object->Event;
				break;
		}
		$resultStr = $this->transmitText($object, $contentStr);
		return $resultStr;
	}
	
	private function transmitText($object, $content, $flag = 0)
	{
		$textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
		$resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
		return $resultStr;
	}
	
}

?>