<?php
$t = time ();
?>
<!DOCTYPE html>
<html>   
<?php 
include 'head.php';
include_once './user/config.php';
?>    
<body>
			
 <div class="container">
   <br>
   <div class="row">
     <div class="container-fluid">
  <div class="modal-dialog">
    <div class="modal-content">
      <ul class="breadcrumb">	


						</li>		
			
      <div class="modal-body">
   <div class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-10">
					<h3><center>后台系统</center></h3>
                        <input type="password" id="pwd" name="pwd" class="form-control" maxlength="16" value="" placeholder="输入后台密码" required>
                    </div>
                </div>
				<div class="form-group">
                    <div class="col-sm-10">
                        <select id="qu" name="qu" class="form-control selectpicker" data-size="5" required>
						<?php
						foreach($quarr as $key=>$value){
							if($value['hidde']!=true){
								echo '<option value="'.$key.'">'.$value['name'].'</option>';
						}
						}
						?>
                        </select>
                    </div>
                </div>
				<div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" id="uid" name="uid" class="form-control" value="" placeholder="输入游戏UID" required>

                    </div>					
                </div>				
                <div class="form-group">
                    <div class="col-sm-10">
					<h3><center>发送物品</center></h3>
                        <select id="mailid" name="mailid" class="selectpicker show-tick form-control" data-live-search="true" data-size="5" title="选择物品">
                        <?php
    $file = fopen("pitem.txt", "r");
    while(!feof($file))
    {
      $line=fgets($file);
      $txts=explode(';',$line);
      echo '<option value="'.$txts[0].'" title="'.$txts[1].'『'.$txts[2].'』">'.$txts[1].'</option>';
    }
    fclose($file);
    ?>					
                        </select>
                    </div>
                </div>

				
				
				<div class="form-group">
                    <div class="col-sm-10">					    
                        <input type="text" id="mailnum" name="mailnum" class="form-control" min="0" max="99999999" value="" placeholder="数量" required>
                    </div>
                </div>				
                <div class="form-group">
                    <div class="col-sm-10">						
						<button type="submit" class="btn btn-primary btn-block" onclick="send_mail()">发送背包</button>
						<hr>
						<button type="submit" class="btn btn-danger btn-block" onclick="g(1)">重置任务</button>
						重置任务：任务从头开始做
						<button type="submit" class="btn btn-danger btn-block" onclick="g(2)">重置账号</button>
						重置账号：账号恢复初始化授权不变
						<button type="submit" class="btn btn-danger btn-block" onclick="g(3)">清理背包</button>
						清理背包：装备的圣遗物不会被清理
						<button type="submit" class="btn btn-danger btn-block" onclick="g(4)">无限体力</button>
						无限体力；下线失效(可重复使用)
					
						<button type="submit" class="btn btn-danger btn-block" onclick="g(5)">自杀</button>
						自杀：当前角色自杀
						<button type="submit" class="btn btn-danger btn-block" onclick="g(6)">无敌</button>
						无敌；所有角色无敌
						<button type="submit" class="btn btn-danger btn-block" onclick="g(7)">无限Q技能</button>
						无限Q技能；无限释放Q技能
						<button type="submit" class="btn btn-danger btn-block" onclick="g(8)">解锁多人游戏</button>
						解锁多人游戏；解锁联机模式
						<button type="submit" class="btn btn-danger btn-block" onclick="g(19)">解锁主世界所有锚点</button>
						解锁主世界所有锚点；解锁锚点
						<button type="submit" class="btn btn-danger btn-block" onclick="g(9)">全解锁角色以及物品</button>
						全解锁角色以及物品；解锁全角色以及物品
						<button type="submit" class="btn btn-danger btn-block" onclick="g(10)">解锁当前角色全部命座</button>
						解锁当前角色全部命座；解锁当前角色全部命座
						<button type="submit" class="btn btn-danger btn-block" onclick="g(17)">当前角色突破90级</button>
						当前角色突破90级；当前角色突破90级
						<button type="submit" class="btn btn-danger btn-block" onclick="g(18)">当前角色突破等级6</button>
						当前角色突破等级6；
						<button type="submit" class="btn btn-danger btn-block" onclick="g(11)">创世结晶+9999</button>
						创世结晶+9999；创世结晶+9999
						<button type="submit" class="btn btn-danger btn-block" onclick="g(12)">精锻用魔矿+5000</button>
						精锻用魔矿+5000；精锻用魔矿+5000
						<button type="submit" class="btn btn-danger btn-block" onclick="g(13)">祝圣精华+5000</button>
						祝圣精华+5000；祝圣精华+5000
						<button type="submit" class="btn btn-danger btn-block" onclick="g(14)">大英雄经验+5000</button>
						大英雄经验+5000；上限8000个，使用完再领取
						<button type="submit" class="btn btn-danger btn-block" onclick="g(15)">一键99999999原石</button>
						一键99999999原石
						<button type="submit" class="btn btn-danger btn-block" onclick="g(16)">一键99999999摩拉</button>
						一键99999999摩拉
						
						<button type="submit" class="btn btn-danger btn-block" onclick="g(20)">冒险等级60级</button>
						冒险等级60级

						
 <p>	<hr> <p>
						<h3><center>自助授权</center></h3>
						 <p> <center> 	★后台系统授权过的才能用 ★</p> </center> 	
						 <p> <center> 醒目吧原神  </center></p> <p> 
				<li class=”list-group-item”> <center>链接:<a href="http://baidu.com" target=”_blank”><font color=”#0000FF″><B><U>http://baidu.com</U> </B></font></center> </li>
   </div>
 </div>
 <script src="js/playermsg.js?v=<?php echo $t;?>"></script>
</body>
</html>