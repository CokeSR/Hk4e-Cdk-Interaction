<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../Assets/BackGround/Favicon.ico">
  <link rel="stylesheet" href="../../Assets/Common/styles.css">
  <title>新手福利</title>
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
          <h2>新手福利</h2>
          <form method="POST">
            <div class="inputBox">
              <input type="number" name="uid" placeholder="请输入游戏UID">
            </div>
            <div class="inputBox">
              <input type="submit" value="新人福利-1000原石" name="NewPlayer">
            </div>
            <div class="inputBox">
              <a href="index.html"><input value="返回上一页"></a>
            </div>
          </form>
          <?php
          include("../Method.php");
          if (isset($_POST["NewPlayer"])) {
            $back = $database->select("NewPlayer", "*", ["uid" => $_POST["uid"]]);
            if ($back[0]["uid"] == "") {
              $run = json_decode(file_get_contents("http://{{%IP_ADDRESS%}}:{{%WebSite_Port%}}/api/api.php?adminpass=blueyst&item=201&uid=" . $_POST["uid"] . "&number=1000"), true);
              if ($run["success"] == false) {
                echo "<font size='5' color='red'>领取失败，请保证游戏在线";
              } elseif ($run["success"] == true) {
                echo "<font size='4' color='#00BFFF'>领取成功";
                var_dump($run);
                $database->insert("NewPlayer", ["uid" => $_POST["uid"], "time" => date("Y-m-d")]);
              }
            } else {
              echo "<font size='4' color='#00BFFF'>您已经领取过了";
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</body>
</html>