<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../Assets/BackGround/Favicon.ico">
  <link rel="stylesheet" href="../Assets/Common/styles.css">
  <title>批量生成CDK</title>
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
          <h2>每张卡只能使用一次</h2>
          <form method="POST">
            <div class="inputBox">
              <input type="text" name="adminpass" placeholder="GM码">
            </div>
            <div class="inputBox">
              <input type="number" name="cdk_number" placeholder="要生成CDK的数量">
            </div>
            <div class="inputBox">
              <input type="number" name="item" placeholder="生成物品ID">
            </div>
            <div class="inputBox">
              <input type="number" name="number" placeholder="物品数量">
            </div>
            <div class="inputBox">
              <input type="submit" value="批量生成CDK" name="addcdk">
            </div>
          </form>
          <p class="forget">返回主页
            <a href="../DailySignIn.html">点击这里</a>
          </p>
        </div>
      </div>
    </div>
  </section>
<?php
  include("../Function/Method.php");
  if (isset($_POST["addcdk"])) {
    if ($_POST["adminpass"] == '888888') {
      $back = $database->select("cdk", "*");
      $id = intval($back[count($back) - 1]["id"]) + 1;
      echo "<font size='4' color='#00BFFF'>CDK奖励" . $_POST["item"] . "x" . $_POST["number"] . "<br>";
      echo "<font size='4' color='#00BFFF'>CDK:<br>";
      $tmp = array();
      while (count($tmp) < $_POST["cdk_number"]) {
        $tmp[] = mt_rand(10000000, 99999999);
        $tmp = array_unique($tmp);
      }
      for ($i = 0; $i < $_POST["cdk_number"]; $i++) {
        $awa = $tmp[$i];
        $back = $database->select("cdk", "*");
        $id = intval($back[count($back) - 1]["id"]) + 1;
        $database->insert("cdk", ["id" => $id, "cdk" => $awa, "item" => $_POST["item"], "number" => intval($_POST["number"]), "start" => 1]);
        echo "<font size='4' color='#00BFFF'>" . $awa . "<br>";
      }
    } else {
      echo "<font size='4' color='#00BFFF'>GM码错误!";
    }
  }
?>
</body>
</html>