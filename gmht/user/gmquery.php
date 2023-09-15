<?php
include 'config.php';

if ($_POST) {
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
    if ($checknum == $gmcode) {
        if ($quid >= 1 || $quid != '') {
            if ($uid != '') {
                if ($_POST['type']) {
                    $type = trim($_POST['type']);
                    switch ($type) {
                        case 'charge':
            $run=json_decode(file_get_contents("http://$ip/gmht/user/api.php?adminpass=blueyst&item=201&uid=".$_POST["uid"]."&number=".$_POST["chargenum"]),true);
            if($run["success"]==false){
				exit('角色不在线,请在线发送.或者物品失效');
                //var_dump($run);
            }elseif($run["success"]==true){
			exit('发送成功');
}
	

    break;
                        case 'mail':
                                       $run=json_decode(file_get_contents("http://$ip/gmht/user/api.php?adminpass=blueyst&item=".$_POST["item"]."&uid=".$_POST["uid"]."&number=".$_POST["num"]),true);
            if($run["success"]==false){
					exit('角色不在线,请在线发送.或者物品失效');
                //var_dump($run);
            }elseif($run["success"]==true){
			exit('发送成功');
}
	

    break;
                        case 'addczvip':
                            $pwd = trim(poststr('pwd'));
                            if ($pwd == '') {
                                exit('玩家后台的授权密码不能为空');
                            }
                            $vipfile = 'gmquery-' . $quid . '.json';
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
                            $vipfile = 'gmquery-' . $quid . '.json';
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
                        case 'quxiaovip':
                            $vipfile = 'gmquery-' . $quid . '.json';
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
                            if ($vipjson[$uid]) {
                                unset($vipjson[$uid]);
                                file_put_contents($vipfile, json_encode($vipjson, 320));
                                exit('取消成功.');
                            } else {
                                exit('该游戏账号并未授权.');
                            }
                        break;
                        case 'editpwd':
                            $data = array("key" => $token, "time" => $time, "type" => 'queryrole', "roleid" => $uid, "port" => $port, "ip" => $ip);
                            $rest = get($url, $data);
                            if (strstr($rest, 'success') == false) {
                                exit('校验失败');
                            }
                            $pwd = trim(poststr('pwd'));
                            if ($pwd == '') {
                                exit('玩家后台的授权密码不能为空');
                            }
                            $vipfile = 'gmquery-' . $quid . '.json';
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
                            if ($vipjson[$uid]) {
                                $vipjson[$uid] = array('pwd' => $pwd, 'level' => $vipjson[$uid]['level'], 'quid' => $quid);
                                file_put_contents($vipfile, json_encode($vipjson, 320));
                                exit('修改成功.');
                            } else {
                                exit('该游戏账号并未授权.');
                            }
                        break;
                        default:
                            exit('系统异常，请重试!');
                        break;
                    }
                } else {
                    exit('请求类型不存在！');
                }
            } else {
                exit('游戏账号错误');
            }
        } else {
            exit('区号错误');
        }
    } else {
        exit('GM码不对');
    }
} else {
    exit('非法请求!请自重');
}
