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
          <h2>生成CDK</h2>
          <form method="POST">
            <div class="inputBox">
              <input type="text" name="adminpass" placeholder="GM码">
            </div>
            <div class="inputBox">
              <input type="text" name="cdk" placeholder="要生成的CDK">
            </div>
            <div class="inputBox">
              <input type="number" name="item" placeholder="生成物品ID">
            </div>
            <div class="inputBox">
              <input type="number" name="number" placeholder="物品数量">
            </div>
            <div class="inputBox">
              <input type="submit" value="生成CDK" name="addcdk">
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
  $back = $database->select("cdk", "*");
  $id = intval($back[count($back) - 1]["id"]) + 1;
  if ($_POST["adminpass"] == '888888') {
    $database->insert("cdk", ["id" => $id, "cdk" => $_POST["cdk"], "item" => $_POST["item"], "number" => intval($_POST["number"]), "start" => 1]);
    echo "<font size='4' color='#00BFFF'>CDK生成成功!";
  } else {
    echo "<font size='4' color='#00BFFF'>GM码错误!";
  }
}
?>
</body>
</html>