<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../Assets/BackGround/Favicon.ico">
  <link rel="stylesheet" href="../Assets/Common/styles.css">
  <title>CDK兑换</title>
</head>
<body>
  <section>
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
    <div class="box">
      <div class="circle" style="--x:0"></div>
      <div class="circle" style="--x:1"></div>
      <div class="circle" style="--x:2"></div>
      <div class="circle" style="--x:3"></div>
      <div class="circle" style="--x:4"></div>
      <div class="container">
        <div class="form">
          <h2>兑换CDK</h2>
          <form method="POST" action="process_cdk.php">
            <div class="inputBox">
              <input type="number" name="uid" placeholder="请输入游戏UID">
            </div>
            <div class="inputBox">
              <input type="text" name="cdk" placeholder="请输入CDK">
            </div>
            <div class="inputBox">
              <input type="submit" value="兑换CDK" name="usecdk">
            </div>
            <div class="inputBox">
              <input value="本服每个新人都赠送原石22W">
              <input value="如果你是花钱买的，那你就被骗拉">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php
include("../Settings/Method.php");
if(isset($_POST["usecdk"])){
    $back = $database->select("cdk", "*", ["cdk" => $_POST["cdk"]]);
    $used = $database->select("used_cdk", "*", ["cdk" => $_POST["cdk"], "uid" => $_POST["uid"]]);
    $use = $database->select("used_cdk", "*");
    $back6 = $database->select("used_cdk", "*");
    $id = intval($back6[count($back6) - 1]["id"]) + 1;
    $back1 = $back[0];
    if(empty($back1)){
        echo "<font size='10' color='#00BFFF'>CDK不存在!";
    } elseif(empty($used[0])){
        if($back1["start"] == 1){
            $run = json_decode(file_get_contents("http://{{%IP_ADDRESS%}}:{{%WebSite_Port%}}/Function/SendCommand.php?adminpass=blueyst&item=".$back1["item"]."&uid=".$_POST["uid"]."&number=".$back1["number"]), true);
            if($run["success"] == false){
                echo "<font size='4' color='#00BFFF'>玩家不在线,请在线后兑换<br>";
                var_dump($run);
            } elseif($run["success"] == true){
                echo "<font size='4' color='#00BFFF'>CDK兑换成功!,内容直接到账背包!<br>";
                echo "<font size='4' color='#00BFFF'>兑换得到的物品:".$back1["item"]."x".$back1["number"]."<br>";
                $database->update("cdk", ["start" => 0], ["cdk" => $_POST["cdk"]]);
                $database->insert("used_cdk", [
                    "id" => $id,
                    "cdk" => $_POST["cdk"],
                    "uid" => $_POST["uid"],
                    "item" => $back1["item"],
                    "number" => intval($back1["number"])
                ]);
            }
	    }elseif($back1["start"]==2){
            $run=json_decode(file_get_contents("http://{{%IP_ADDRESS%}}:{{%WebSite_Port%}}/Function/SendCommand.php?adminpass=blueyst&item=".$back1["item"]."&uid=".$_POST["uid"]."&number=".$back1["number"]),true);
            if($run["success"]==false){
                echo "<font size='4' color='#00BFFF'>玩家不在线,请在线后兑换<br>";
                var_dump($run);
            }elseif($run["success"]==true){
                echo "<font size='4' color='#00BFFF'>CDK兑换成功!,内容直接到账背包!<br>";
		        echo "<font size='4' color='#00BFFF'>兑换得到的物品:".$back1["item"]."x".$back1["number"]."<br>";
		        $database->insert("used_cdk",["id" => $id,"cdk"=>$_POST["cdk"],"uid"=>$_POST["uid"],"item" => $back1["item"],"number"=>intval($back1["number"])
		        ]);
            }
	    }else{
	        echo "<font size='4' color='#00BFFF'>CDK已被兑换!<br>";
	    }
	}else{
	    echo "<font size='4' color='#00BFFF'>CDK已被兑换!<br>";
	}
}
?>
</body>
</html>