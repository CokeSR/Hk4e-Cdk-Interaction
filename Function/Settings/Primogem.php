<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../Assets/BackGround/Favicon.ico">
  <link rel="stylesheet" href="../../Assets/Common/styles.css">
  <title>无限签到(免费领取1000原石)</title>
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
          <h2>无限签到(免费领取1000原石)</h2>
          <form method="POST">
            <div class="inputBox">
              <input type="number" name="uid" placeholder="请输入游戏UID">
            </div>
            <div class="inputBox">
              <input type="submit" value="签到领取" name="Primogem">
            </div>
            <div class="inputBox">
              <a href="index.html"><input value="返回上一页"></a>
            </div>
          </form>
          <?php
          include("../Method.php");
          if (isset($_POST["Primogem"])) {
            $back = $database->select("Primogem", "*", ["uid" => $_POST["uid"]]);
            if ($back[0]["last"] == date("Y-m-d")) {
              echo "<font size='4' color='#00BFFF'>您今天已经签到了";
            } elseif ($back[0]["uid"] == "") {
              $run = json_decode(file_get_contents("http://{{%IP_ADDRESS%}}:{{%WebSite_Port%}}/api/api.php?adminpass=blueyst&item=201&uid=" . $_POST["uid"] . "&number=1000"), true);
              if ($run["success"] == false) {
                echo "<font size='4' color='#00BFFF'>签到失败，请保证游戏在线";
              } elseif ($run["success"] == true) {
                echo "<font size='4' color='#00BFFF'>签到成功";
                $database->insert("Primogem", ["uid" => $_POST["uid"], "last" => date("Y-m-d")]);
              }
            } elseif ($back[0]["uid"] != "") {
              $run = json_decode(file_get_contents("http://{{%IP_ADDRESS%}}:{{%WebSite_Port%}}/api/api.php?adminpass=blueyst&item=201&uid=" . $_POST["uid"] . "&number=1000"), true);
              if ($run["success"] == false) {
                echo "<font size='5' color='red'>签到失败，请保证游戏在线</font>";
              } elseif ($run["success"] == true) {
                echo "<font size='4' color='#00BFFF'>签到成功";
                $database->update("Primogem", ["uid" => $_POST["uid"], "last" => date("Y-m-d")]);
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</body>
</html>