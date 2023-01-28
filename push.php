<?php

function push2phone($server,$phone,$data) {
$xml = "xml=".$data;
$post = "POST /servlet?push=xml HTTP/1.1\r\n";
$post .= "Host: $phone\r\n";
$post .= "Referer: $server\r\n";
$post .= "Connection: Keep-Alive\r\n";
$post .= "Content-Type: text/xml\r\n";
$post .= "Content-Length: ".strlen($xml)."\r\n\r\n";
$fp = @fsockopen ( $phone, 80, $errno, $errstr, 5);
if($fp) {
fputs($fp, $post.$xml);
flush();
fclose($fp);
}

}
##############################
$xml = "<YealinkIPPhoneTextScreen Beep=\"yes\">\n";
$xml .= "<Title>Push test</Title>\n";
$xml .= "<Text>This is a test for pushing text to a phone.</Text>\n";
$xml .= "</YealinkIPPhoneTextScreen>\n";
#The above 4 lines prefixed with “$xml =” constructs a TextScreen object to be pushed to the #phone.
#You can construct your own XML object using the same method.
push2phone("192.168.0.112","192.168.0.150",$xml);
?>
