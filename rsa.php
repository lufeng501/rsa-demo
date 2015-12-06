<?php
/**
 * rsa 加密解密demo
 */

header("Content-type: text/html; charset=utf-8");

$privateKey = '-----BEGIN RSA PRIVATE KEY-----
MIICXgIBAAKBgQCzgNUDlBrfwx5URycLsuan4OL7Rnza+1Clpz/jqnS/nrCjV3+3
hs+z4I5Xgkj0BXvKtisWPLD3MlWFEb8YdO3uV5xH45XXIHQ/ha6++gMOcbFbaMhk
5eCGwly0yUmpptxsqmIPfkucvhZ8OGgBKFAUUxgLusmCtHxqYe3OveNP3wIDAQAB
AoGBAJuPK4slX8DJHFCXNPxLdt7H4o02Qd+YagSVE6YeQ30IbjWwD2uh9gABu/mU
W9q1odlD08U6pXYkdb6TaZMtSj+OJf2E6WDryErL+gAWHEMuYc1YJI7G3EJ0AkKh
BlB7gH8Rm5O/blOHrTx+xHc0IDbNJrQzKnR63mtuy9Ul9gSRAkEA4rGWvI+UqSoc
f0mxgZIgMcLC+EH1qDQLWRNKqB0oiVTP68lPs//Bjp5rP3j6EOXa2djrDBjy/qpm
sTzmnCpzSQJBAMq1eopulca3/nfrhdPeUyxC+dh2bdG2H0A/chxo5IqQlYJ1w+2S
Ofxh+8vi89CjIsEloKPgvjP4c9a8tR4SAecCQBg0ylm8Iy2lF4HoBpJFXjayC0uj
D240kHmke7ZT1r5DVihhSKd5ydtGw0D11A313VahuQeDqn7TB0Aptp46UjECQQCY
8q+ATgpSwzeM8jeq8eBd0DdF/a3FAx63UmfeScLPTmKQ6hyoX6HC7YeYgiinLsAl
bie0HvpEql11FDOwebPXAkEAx9WYDVdb3xQZqxs/QNhYDrqskZQRC+MeflT/d2x1
SNTkkqtY7ZCtREIh19IHMJqYoFE7mkPjY7KkXALmOMayGg==
-----END RSA PRIVATE KEY-----';

$publicKey = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCzgNUDlBrfwx5URycLsuan4OL7
Rnza+1Clpz/jqnS/nrCjV3+3hs+z4I5Xgkj0BXvKtisWPLD3MlWFEb8YdO3uV5xH
45XXIHQ/ha6++gMOcbFbaMhk5eCGwly0yUmpptxsqmIPfkucvhZ8OGgBKFAUUxgL
usmCtHxqYe3OveNP3wIDAQAB
-----END PUBLIC KEY-----';

//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
$pi_key =  openssl_pkey_get_private($privateKey);
//这个函数可用来判断公钥是否是可用的
$pu_key = openssl_pkey_get_public($publicKey);

if(!$pi_key || !$pu_key){
	echo "秘钥不可用";
	die;
}

//原始数据
$data = "RSA是目前最有影响力的加密算法";

echo "私钥：<br>".$privateKey."<br><br>";
echo "公钥：<br>".$publicKey."<br><br>";

$encrypted = ""; 
$decrypted = ""; 
echo "原始数据:",$data,"<br><br>";

/**
 * 私钥进行加密，公钥进行解密
 */
openssl_private_encrypt($data,$encrypted,$pi_key);//私钥加密
echo "private key 加密:<br>";
echo $encrypted."<br>";
openssl_public_decrypt($encrypted,$decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来
echo "public key 解密:";
echo $decrypted,"<br><br>";

echo "========================<br>";
/**
 * 公钥进行加密，私钥进行解密
 */
openssl_public_encrypt($data,$encrypted,$pu_key);//公钥加密
echo "public key 加密:<br>";
echo $encrypted,"<br>";
openssl_private_decrypt($encrypted,$decrypted,$pi_key);//私钥解密
echo "private key 解密:";
echo $decrypted,"<br>";