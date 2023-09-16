<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../Assets/BackGround/Favicon.ico">
  <link rel="stylesheet" href="../Assets/Common/styles.css">
  <title>授权平台</title>
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
          <h2>生成psd</h2>
          <form method="POST">
            <div class="inputBox">
              <input type="text" name="adminpass" placeholder="GM码">
            </div>
            <div class="inputBox">
              <input type="text" name="uid" placeholder="要授权的id">
            </div>
            <div class="inputBox">
              <input type="submit" value="授权" name="addpsd">
            </div>
          </form>
          <p class="forget">返回主页 <a href="index.html">点击这里</a></p>
        </div>
      </div>
    </div>
  </section>

  <?php
  include("../Function/Method.php");
  if (isset($_POST["addpsd"])) {
    $back = $database->select("fuli", "*");
    if ($_POST["adminpass"] == '888888') {
      $database->insert("fuli", [
        "uid" => $_POST["uid"],
        "last" => date("Y-m-d", $time)
      ]);
      echo "<font size='4' color='#00BFFF'>授权成功!";
    } else {
      echo "<font size='4' color='#00BFFF'>GM码错误!";
    }
  }
  ?>
</body>
</html>