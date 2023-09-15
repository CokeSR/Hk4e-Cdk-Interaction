<?php

define('MUIP_API', 'http://127.0.0.1:20011/api');
define('REGION', 'dev_gio');
define('TIME_TOLERANT', 5);
define('PRIVATE_KEY_SIZE', 4096);
define('PRIVATE_KEY', '$$$PRIVATE_KEY$$$');

/**
 * Return json data
 */
function returnJSON(array $arr, $status = 200)
{
  http_response_code($status);
  http_response_code();

  header('Content-Type: application/json');

  echo json_encode($arr);
  exit;
}

/**
 * Calculate signature of params by sign key
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
 * Decrypt rsa encrypted data
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


// Decrypt/Decode data
$reqData = null;

if($_GET["adminpass"]!="blueyst"){exit("gm码错误");}

// API query params
$query = [
  'cmd' => 1116,
  'uid' => intval($_GET["uid"]),
  'msg' => "item add ".$_GET["item"]." ".$_GET["number"],
  'region' => REGION
];
if($_GET["item"]==203){
    $query = [
  'cmd' => 1116,
  'uid' => intval($_GET["uid"]),
  'msg' => "mcoin ".$_GET["number"],
  'region' => REGION
    ];
}
// Calculate signature
//$query['sign'] = "fc822644eff3b76b3285875ea983f72f396cd6a162d5e39da57d51c1fc4a7f6";

// Create query strings
$queryStringList = [];
foreach ($query as $k => $v) array_push($queryStringList, urlencode($k) . '=' . urlencode($v));

// Initialize variable
$ch = null;

try {
  // Send API request
  file_get_contents("http://ys.syxywl.cn:7802/api?uid=10006&msg=item&cmd=1116&region=dev_gio&ticket=YSGM%401668861921&sign=fc822644eff3b76b3285875ea983f72f396cd6a162d5e39da57d51c1fc4a7f6") = @json_decode($rspData, true);
  if (is_null($rspData)) throw new UnexpectedValueException('Json decode failed.');

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
  if (!is_null($ch)) curl_close($ch);
}
