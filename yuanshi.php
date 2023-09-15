<!DOCTYPE html>

<style type="text/css">
	body{
		background: url("") no-repeat center center fixed;
                /*兼容浏览器版本*/
                -webkit-background-size: cover;
                -o-background-size: cover;                
                background-size: cover;
	}
	</style>
	
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usr/css/yst.css">
    <style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* 使用flex布局，让内容垂直和水平居中 */

section {
    /* 相对定位 */
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    /* linear-gradient() 函数用于创建一个表示两种或多种颜色线性渐变的图片 */
    background: linear-gradient(to bottom, #f1f4f9, #dff1ff);
}

/* 背景颜色 */

section .color {
    /* 绝对定位 */
    position: absolute;
    /* 使用filter(滤镜) 属性，给图像设置高斯模糊*/
    filter: blur(200px);
}

/* :nth-child(n) 选择器匹配父元素中的第 n 个子元素 */

section .color:nth-child(1) {
    top: -350px;
    width: 600px;
    height: 600px;
    background: #ff359b;
}

section .color:nth-child(2) {
    bottom: -150px;
    left: 100px;
    width: 500px;
    height: 500px;
    background: #fffd87;
}

section .color:nth-child(3) {
    bottom: 50px;
    right: 100px;
    width: 500px;
    height: 500px;
    background: #00d2ff;
}

.box {
    position: relative;
}

/* 背景圆样式 */

.box .circle {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    /* backdrop-filter属性为一个元素后面区域添加模糊效果 */
    backdrop-filter: blur(5px);
    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-right: 1px solid rgba(255, 255, 255, 0.2);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    /* 使用filter(滤镜) 属性，改变颜色。
    hue-rotate(deg)  给图像应用色相旋转 
    calc() 函数用于动态计算长度值 
    var() 函数调用自定义的CSS属性值x*/
    filter: hue-rotate(calc(var(--x) * 70deg));
    /* 调用动画animate，需要10s完成动画，
    linear表示动画从头到尾的速度是相同的，
    infinite指定动画应该循环播放无限次*/
    animation: animate 10s linear infinite;
    /* 动态计算动画延迟几秒播放 */
    animation-delay: calc(var(--x) * -1s);
}

/* 背景圆动画 */

@keyframes animate {
    0%, 100%, {
        transform: translateY(-50px);
    }
}

.box .circle:nth-child(1) {
    top: -50px;
    right: -60px;
    width: 100px;
    height: 100px;
}

.box .circle:nth-child(2) {
    top: 150px;
    left: -100px;
    width: 120px;
    height: 120px;
    z-index: 2;
}

.box .circle:nth-child(3) {
    bottom: 50px;
    right: -60px;
    width: 80px;
    height: 80px;
    z-index: 2;
}

.box .circle:nth-child(4) {
    bottom: -80px;
    left: 100px;
    width: 60px;
    height: 60px;
}

.box .circle:nth-child(5) {
    top: -80px;
    left: 140px;
    width: 60px;
    height: 60px;
}

/* 登录框样式 */

.container {
    position: relative;
    width: 400px;
    min-height: 400px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(5px);
    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-right: 1px solid rgba(255, 255, 255, 0.2);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.form {
    position: relative;
    width: 100%;
    height: 100%;
    padding: 50px;
}

/* 登录标题样式 */

.form h2 {
    position: relative;
    color: #fff;
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 5px;
    margin-bottom: 30px;
    cursor: pointer;
}

/* 登录标题的下划线样式 */

.form h2::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: -10px;
    width: 0px;
    height: 3px;
    background: #fff;
    transition: 0.5s;
}

.form h2:hover:before {
    width: 53px;
}

.form .inputBox {
    width: 100%;
    margin-top: 20px;
}

/* 输入框样式 */

.form .inputBox input {
    width: 100%;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.2);
    outline: none;
    border: none;
    border-radius: 30px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-right: 1px solid rgba(255, 255, 255, 0.2);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 16px;
    letter-spacing: 1px;
    color: #0000FF;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.form .inputBox input::placeholder {
    color: #black;
}

/* 登录按钮样式 */

.form .inputBox input[type="submit"] {
    background: #fff;
    color: #666;
    max-width: 1000px;
    margin-bottom: 20px;
    font-weight: 600;
    cursor: pointer;
}

.forget {
    margin-top: 6px;
    color: #fff;
    letter-spacing: 1px;
}

.forget a {
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    
}</style>
    <title>无限签到</title>
  </head>
  <body>
    <section>
      <div class="color">
      </div>
      <div class="color">
      </div>
      <div class="color">
      </div>
      <div class="box">
        <div class="circle" style="--x:0">
        </div>
        <div class="circle" style="--x:1">
        </div>
        <div class="circle" style="--x:2">
        </div>
        <div class="circle" style="--x:3">
        </div>
        <div class="circle" style="--x:4">
        </div>
        <div class="container">
          <div class="form">
            <h2>无限签到(免费领取1000原石)</h2>
            <form method="POST">
              <div class="inputBox">
                <input type="number" name="uid" placeholder="请输入游戏UID">
              </div>
              <div class="inputBox">
                <input type="submit" value="签到领取" name="yuanshi">
              </div>
              <div class="inputBox">
                <a href="index.html"> <input value="                返回上一页" ></a>
              </div>
            </form>
            <?php
include("./Medoo.php");
if(isset($_POST["yuanshi"])){
    $back=$database->select("yuanshi","*",["uid"=>$_POST["uid"]]);
    if($back[0]["last"]==date("Y-m-d")){
        echo "<font size='4' color= '#00BFFF'>您今天已经签到了";
    }elseif($back[0]["uid"]==""){
        $run=json_decode(file_get_contents("http://34.tlapple.com:81/api/api.php?adminpass=blueyst&item=201&uid=".$_POST["uid"]."&number=1000"),true);
        if($run["success"]==false){
            echo "<font size='4' color= '#00BFFF'>签到失败,请保证游戏在线";
        }elseif($run["success"]==true){
            echo "<font size='4' color= '#00BFFF'>签到成功";
            $database->insert("yuanshi",["uid" => $_POST["uid"],"last"=>date("Y-m-d")]);
        }
    }elseif($back[0]["uid"]!=""){
        $run=json_decode(file_get_contents("http://34.tlapple.com:81/api/api.php?adminpass=blueyst&item=201&uid=".$_POST["uid"]."&number=1000"),true);
        if($run["success"]==false){
            echo "<font size=5 color=red>签到失败，请保证游戏在线</font>";
        }elseif($run["success"]==true){
           echo "<font size='4' color= '#00BFFF'>签到成功";
            $database->update("yuanshi",["uid" => $_POST["uid"],"last"=>date("Y-m-d")]);
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

