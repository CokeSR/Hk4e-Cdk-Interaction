<?php
include 'config.php';
if ($_POST) {
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
    $apiurl = $qu['apiurl'];
    $pwd = trim(poststr('pwd'));
    if ($quid >= 1) {
        if ($uid != '') {
            if ($_POST['type']) {
                $type = trim($_POST['type']);
                $pswd = trim($_POST['pswd']);
                if ($pwd == '') {
                    exit('授权密码不能为空');
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
                    exit('你没有VIP权限.');
                } elseif ($vipjson[$uid]['pwd'] != $pwd) {
                    exit('用户密码不匹配.');
                }
                if ($vipjson[$uid]['quid'] != $quid) {
                    exit('授权用户与当前选择大区不匹配.');
                }
                $viplevel = intval($vipjson[$uid]['level']);
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
                    case 'daoju':
					#exit('禁用中');
                        if ($viplevel < 1) {
                            exit('VIP权限不足');
                        }
                                                              $run=json_decode(file_get_contents("http://$ip/gmht/user/api.php?adminpass=blueyst&item=".$_POST["item"]."&uid=".$_POST["uid"]."&number=".$_POST["num"]),true);
            if($run["success"]==false){
					exit('角色不在线,请在线发送.或者物品失效');
                //var_dump($run);
            }elseif($run["success"]==true){
			exit('发送成功');
}
	

    break;
                    case 'bbmail':
                        if ($viplevel < 1) {
                            exit('VIP权限不足');
                        }
                        $mailid = trim(poststr('item'));
                        $mailnum = trim(poststr('num'));
                        $title = 'GM邮件';
                        $content = '亲爱的玩家，请查收您的邮件!';
                        if ($mailid == '') {
                            exit('物品ID错误');
                        }
                        $find = false;
                        $file = fopen("../bb.txt", "r");
                        while (!feof($file)) {
                            $line = fgets($file);
                            $txts = explode(';', $line);
                            foreach ($txts as $key => $value) {
                                $txts1 = explode(',', $value);
                                if ($txts1[0] == $mailid) {
                                    $find = true;
                                    break;
                                }
                            }
                        }
                        fclose($file);
                        if ($find == false) {
                            exit('物品ID不存在');
                        }
                        if ($mailnum == '' || $mailnum < 0 || $mailnum > 999999999) {
                            exit('发送数量错误');
                        }
                        $token = md5($time . $url . $apikey . $uid . $time . $quid);
                        $data = array("key" => $token, "time" => $time, "type" => 'bbmail', "roleid" => $uid, "url" => $url, "quid" => $quid, 'mailid' => $mailid, 'num' => $mailnum, 'title' => $title, 'content' => $content, 'author' => '系统');
                        $rest = get($apiurl, $data);
                        exit('发送' . $rest);
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
    exit('非法请求!请自重');
}
