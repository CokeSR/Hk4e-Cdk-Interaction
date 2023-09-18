<?php
/**
 * 写死的muip设置
 */
define('MUIP_API', 'http://127.0.0.1:20011/api');
define('REGION', 'dev_gio');
define('TIME_TOLERANT', 3);
define('PRIVATE_KEY_SIZE', 4096);
define('PRIVATE_KEY', '$$$PRIVATE_KEY$$$');

/**
 * 返回json
 */
function returnJSON(array $arr, $status = 200)
{
  http_response_code($status);
  header('Content-Type: application/json');
  echo json_encode($arr);
  exit;
}

/**
 * http签名计算(sha256)
 */
function calcSign(array $params, string $key)
{
  $keys = array_keys($params);
  sort($keys);
  
  $paramStrList = [];
  
  foreach ($keys as $k) {
    $v = $params[$k];
    
    if ($v === '' || $v === 'sign') continue;
    array_push($paramStrList, $k . '=' . $v);
  }
  
  return hash('sha256', implode('&', $paramStrList) . $key);
}

/**
 * 解密RSA 
 */
function rsaDecrypt(string $ciphertext, string $key, int $keySize)
{
  $chunkSize = $keySize / 8;
  $chunkCount = ceil(strlen($ciphertext) / $chunkSize);
  $chunks = [];
  
  for ($i = 0; $i < $chunkCount; $i++) {
    $chunk = substr($ciphertext, $i * $chunkSize, $chunkSize);
    $chunkDecrypted = null;
    $decryptSucc = openssl_private_decrypt($chunk, $chunkDecrypted, $key);
    if (!$decryptSucc) throw new UnexpectedValueException(openssl_error_string());
    array_push($chunks, $chunkDecrypted);
  }
  
  return implode('', $chunks);
}
$reqData = null;

/**
 * 默认密码是blueyet
 */
if ($_GET["adminpass"] != "blueyst") {
  exit("gm码错误");
}

/**
 * API
 */
$query = [
  'cmd' => 1116,
  'uid' => intval($_GET["uid"]),
  'msg' => "item add " . $_GET["item"] . " " . $_GET["number"],
  'region' => REGION
];

if ($_GET["item"] == 203) {
  $query = [
    'cmd' => 1116,
    'uid' => intval($_GET["uid"]),
    'msg' => "mcoin " . $_GET["number"],
    'region' => REGION
  ];
}

/**
 * Url拼接
 */
$queryStringList = [];

foreach ($query as $k => $v) {
  array_push($queryStringList, urlencode($k) . '=' . urlencode($v));
}

$ch = null;

/**
 * 射出请求 :)
 */
try {
  $ch = curl_init(MUIP_API . '?' . implode('&', $queryStringList));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADEROPT, CURLHEADER_UNIFIED);
  $rspData = curl_exec($ch);
  curl_close($ch);

  $rspData = @json_decode($rspData, true);
  if (is_null($rspData)) {
    throw new UnexpectedValueException('Json decode failed.');
  }
  returnJSON([
    'success' => $rspData['retcode'] === 0,
    'message' => $rspData['msg'],
    'data' => $rspData['data']
  ]);
} catch (Exception $ex) {
  returnJSON([
    'success' => false,
    'message' => $ex->getMessage()
  ]);
} finally {
  if (!is_null($ch)) {
    curl_close($ch);
  }
}