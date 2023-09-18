<?php
include './Settings/Config.php';

if (!$_POST) {
    exit('非法请求，请自重');
}

$checknum = trim(poststr('checknum'));
$quid = trim(poststr('qu'));
$qu = $quarr[$quid];
$uid = trim(poststr('uid'));
$gid = $qu['gid'];
$manageurl = $qu['manageurl'];
$dbip = $qu['host'];
$dbname = $qu['dbname'];
$dbuser = $qu['user'];
$dbpwd = $qu['pwd'];
$quname = $qu['name'];
$num = $qu['num'];
$item = $qu['item'];
$chargenum = $qu['chargenum'];
$mailnum = $qu['mailnum'];

if ($checknum != $gmcode) {
    exit('GM码不对');
}

if ($quid < 1 || $quid == '') {
    exit('区号错误');
}

if ($uid == '') {
    exit('账号错误');
}

if (!$_POST['type']) {
    exit('请求类型不存在！');
}

$type = trim($_POST['type']);
switch ($type) {
    case 'charge':
        $run = json_decode(file_get_contents("http://$ip/Function/SendCommand.php?adminpass=blueyst&item=201&uid=".$_POST["uid"]."&number=".$_POST["chargenum"]), true);
        if ($run["success"] == false) {
            exit('角色不在线，请在线发送或物品失效');
        } elseif ($run["success"] == true) {
            exit('发送成功');
        }
        break;
    case 'mail':
        $run = json_decode(file_get_contents("http://$ip/Function/SendCommand.php?adminpass=blueyst&item=".$_POST["item"]."&uid=".$_POST["uid"]."&number=".$_POST["num"]), true);
        if ($run["success"] == false) {
            exit('角色不在线，请在线发送或物品失效');
        } elseif ($run["success"] == true) {
            exit('发送成功');
        }
        break;
    case 'addczvip':
        $pwd = trim(poststr('pwd'));
        if ($pwd == '') {
            exit('玩家后台的授权密码不能为空');
        }
        $vipfile = '../Assets/DataBase/data-' . $quid . '.json';
        $fp = fopen($vipfile, "a+");
        if (filesize($vipfile) > 0) {
            $str = fread($fp, filesize($vipfile));
            fclose($fp);
            $vipjson = json_decode($str, true);
            if ($vipjson == null) {
                $vipjson = array();
            }
        } else {
            $vipjson = array();
        }
        if (!$vipjson[$uid]) {
            $vipjson[$uid] = array('pwd' => $pwd, 'level' => 0, 'quid' => $quid);
            file_put_contents($vipfile, json_encode($vipjson, 320));
            exit('加入VIP成功.');
        } else {
            exit('该游戏账号已经是VIP了.');
        }
        break;
    case 'addvip':
        $pwd = trim(poststr('pwd'));
        if ($pwd == '') {
            exit('玩家后台的授权密码不能为空');
        }
        $vipfile = '../Assets/DataBase/data-' . $quid . '.json';
        $fp = fopen($vipfile, "a+");
        if (filesize($vipfile) > 0) {
            $str = fread($fp, filesize($vipfile));
            fclose($fp);
            $vipjson = json_decode($str, true);
            if ($vipjson == null) {
                $vipjson = array();
            }
        } else {
            $vipjson = array();
        }
        if (!$vipjson[$uid] || intval($vipjson[$uid]['level'] == 0)) {
            $vipjson[$uid] = array('pwd' => $pwd, 'level' => 1, 'quid' => $quid);
            file_put_contents($vipfile, json_encode($vipjson, 320));
            exit('加入或升级VIP成功.');
        } else {
            exit('该游戏账号已经是VIP了.');
        }
        break;
        case 'cancelvip':
            $vipfile = '../Assets/DataBase/data-' . $quid . '.json';
            $vipjson = loadVipJson($vipfile);
        
            if (isset($vipjson[$uid])) {
                unset($vipjson[$uid]);
                saveVipJson($vipfile, $vipjson);
                exit('取消成功.');
            } else {
                exit('该游戏账号并未授权.');
            }
        break;
        case 'editpwd':
            $data = array("key" => $token, "time" => $time, "type" => 'queryrole', "roleid" => $uid, "port" => $port, "ip" => $ip);
            $rest = get($url, $data);
            if (strpos($rest, 'success') === false) {
                exit('校验失败');
            }
            $pwd = trim(poststr('pwd'));
            if ($pwd == '') {
                exit('玩家后台的授权密码不能为空');
            }
            $vipfile = '../Assets/DataBase/data-' . $quid . '.json';
            $vipjson = loadVipJson($vipfile);
            if (isset($vipjson[$uid])) {
                $vipjson[$uid]['pwd'] = $pwd;
                saveVipJson($vipfile, $vipjson);
                exit('修改成功.');
            } else {
                exit('该游戏账号并未授权.');
            }
            break;
        default:
            exit('系统异常，请重试!');
            break;


//新增的两个辅助函数 loadVipJson() 和 saveVipJson()，用于加载和保存 VIP 数据
function loadVipJson($vipfile) {
    $vipjson = [];
    if (file_exists($vipfile)) {
        $str = file_get_contents($vipfile);
        $vipjson = json_decode($str, true);
        if ($vipjson === null) {
            $vipjson = [];
        }
    }
    return $vipjson;
}

function saveVipJson($vipfile, $vipjson) {
    file_put_contents($vipfile, json_encode($vipjson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}