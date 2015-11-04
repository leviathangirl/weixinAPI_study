<?php

/*被动回复文本消息*/

/*
回复文本消息
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>
*/
class textMessage
{
    public $ToUserName, $FromUserName, $CreateTime, $MsgType, $Content;
    public function __construct($ToUserName = null, $FromUserName = null, $CreateTime = null, $MsgType = 'text', $Content = null)
    {
        $this->ToUserName = $ToUserName;
        $this->FromUserName = $FromUserName;
        $this->CreateTime = $CreateTime;
        $this->MsgType = $MsgType;
        $this->Content = $Content;
    }
    public function sprintfXML()
    {
        $textTpl = '<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[%s]]></MsgType>
      <Content><![CDATA[%s]]></Content>
      </xml>';
        $resultStr = sprintf($textTpl, $this->ToUserName, $this->FromUserName, $this->CreateTime, $this->MsgType, $this->Content);

        echo $resultStr;
    }
}
