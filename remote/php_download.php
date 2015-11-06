<?php


if (!isset($_POST['url'])) {
    die('Wrong');
}
$url = $_POST['url'];
$name = $_POST['name'];
$image = file_get_contents($url);
file_put_contents('upload/'.$name, $image);
