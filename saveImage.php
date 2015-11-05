<?php

/*
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
    $image=file_get_contents($receiveHttpRawPostObj->PicUrl);
    file_put_contents('upload/'.$imageName,$image);

    $reply = new textMessage();
    $reply->ToUserName = $receiveHttpRawPostObj->FromUserName;
    $reply->FromUserName = $receiveHttpRawPostObj->ToUserName;
    $reply->CreateTime = time();
    $reply->Content = 'image '.$receiveHttpRawPostObj->PicUrl.' saved.';
    $reply->sprintfXML();
    exit();
}
