<?php

include 'config.php';
/*
接收图片消息
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1348831860</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<PicUrl><![CDATA[this is a url]]></PicUrl>
<MediaId><![CDATA[media_id]]></MediaId>
<MsgId>1234567890123456</MsgId>
</xml>
*/
function saveImage($receiveHttpRawPostObj)
{
    $imageName = $receiveHttpRawPostObj->CreateTime.'_'.$receiveHttpRawPostObj->FromUserName.'_'.$receiveHttpRawPostObj->CreateTime;
    echo 'success';
    //file_put_contents('tmp.txt', $imageName);
    //file_put_contents('GLOBALS.txt', $GLOBALS);
    $postData=remoteDownloadUrl($receiveHttpRawPostObj->PicUrl, $imageName);

    $reply = new textMessage();
    $reply->ToUserName = $receiveHttpRawPostObj->FromUserName;
    $reply->FromUserName = $receiveHttpRawPostObj->ToUserName;
    $reply->CreateTime = time();
    $reply->Content = 'image '.$receiveHttpRawPostObj->PicUrl.' saved as postData:'.$postData;
    $reply->sprintfXML();
    exit();
}

function remoteDownloadUrl($url, $name)
{
    //curl YOUR_DOMAIN/remote/php_download.php -d 'url=123&name=14234'
    $remoteDownloadPhp = REMOTEDOWNLOADPHP;
    $postData = '\'url='.urlencode($url).'&name='.$name.'\'';
    exec('curl '.$remoteDownloadPhp.' -d '.$postData);
    return $postData;
}
