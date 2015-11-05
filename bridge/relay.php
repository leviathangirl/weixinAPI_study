<?php

if (isset($_GET['echostr'])) {
    include '../wx_sample.20140819.php';
} else {
    include '../passiveReplyObj.php';
    include 'postRawData.fun.php';
    include 'config.php';
}

$receiveHttpRawPostData = $GLOBALS['HTTP_RAW_POST_DATA'];

if (empty($receiveHttpRawPostData)) {
    die('No HTTP_RAW_POST_DATA RECEIVED !');
}

libxml_disable_entity_loader(true);
$receiveHttpRawPostObj = simplexml_load_string($receiveHttpRawPostData, 'SimpleXMLElement', LIBXML_NOCDATA);
$msgtype = $receiveHttpRawPostObj->MsgType;

switch ($msgtype) {
case 'text':
relayText($receiveHttpRawPostObj,$relayTo);
break;

default:
replyReject($receiveHttpRawPostObj);
break;
}

function replyReject($receiveHttpRawPostObj)
{
    $reply = new textMessage();

    $reply->ToUserName = $receiveHttpRawPostObj->FromUserName;
    $reply->FromUserName = $receiveHttpRawPostObj->ToUserName;
    $reply->CreateTime = time();
    $reply->Content = 'Unsupport relaying message type.';
    $reply->sprintfXML();
    exit();
}

function relayText($receiveHttpRawPostObj,$relayTo)
{
    /*
接收文本消息格式
<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>
*/
    $reply = new textMessage();

    $reply->ToUserName = $receiveHttpRawPostObj->ToUserName;
    $reply->FromUserName = $receiveHttpRawPostObj->FromUserName;
    $reply->CreateTime = $receiveHttpRawPostObj->CreateTime;
    $reply->MsgType = $receiveHttpRawPostObj->MsgType;
    $reply->Content = $receiveHttpRawPostObj->Content;
    $reply->MsgId = $receiveHttpRawPostObj->MsgId;
    $reply->relayXML($relayTo);
    exit();
}
