var checknum = '';
var uid = '';
var qu = $('#qu').val();
$('#checknum').change(function() {
    checknum = $(this).val();
});
  $('#uid').change(function(){
	  uid=$.trim($(this).val());
  });
  $('#qu').change(function(){
	  qu=$.trim($(this).val());
  });
function chargebtn() {
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  } 
	  var chargenum=$('#chargenum').val();
	  if(chargenum=='' || chargenum<=0){
		  layer.msg('请输入充值数量');
		  return false;
	  }
	  var chargetype=$('#chargetype').val();
	  if(chargetype==''){
		  layer.msg('请选择操作类型');
		  return false;
	  }
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'charge',uid:uid,qu:qu,checknum:checknum,chargenum:chargenum,chargetype:chargetype		
	},
	function(data) {
		
		layer.msg(data);
		
	});
}
function send_mail() {
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  }
	  var mailid=$('#mailid').val();
	  if(mailid==''){
		  layer.msg('请选择物品');
		  return false;
	  }
	  var title=$('#title').val();
	  if(title==''){
		  title='GM邮件';
	  }
	  var content=$('#content').val();
	  if(content==''){
		  content='亲爱的玩家，请查收您的邮件!';
	  }
	  var mailnum=$('#mailnum').val();
	  if(mailnum=='' || isNaN(mailnum)){
		  layer.msg('数量不能为空');
		  return false;
	  }
	  if(mailnum<1 || mailnum>9999){
		  layer.msg('道具数量范围:1-9999');
		  return false;
	  }
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'mail',uid:uid,item:mailid,num:mailnum,qu:qu,checknum:checknum,title:title,content:content	
	},
	function(data) {
		layer.msg(data);
		
	});	
}
function send_allmail() {
	{
	   layer.confirm('<font color="red"><h2>警告！</h2><br/>请确认是否要执行全服邮件操作！该功能响应缓慢，请耐心等待。</font>',
 {
  btn: ['是的','算了'] //按钮
}, function(){
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	   var title=$('#title').val();
	  if(title==''){
		  title='GM全服邮件';
	  }
	  var content=$('#content').val();
	  if(content==''){
		  content='亲爱的玩家，请查收您的邮件!';
	  }
	  var mailid=$('#mailid').val();
	  if(mailid==''){
		  layer.msg('请选择物品');
		  return false;
	  }
	  var mailnum=$('#mailnum').val();
	  if(mailnum=='' || isNaN(mailnum)){
		  layer.msg('数量不能为空');
		  return false;
	  }
	  if(mailnum<1 || mailnum>9999){
		  layer.msg('道具数量范围:1-9999');
		  return false;
	  }
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'allmail',item:mailid,num:mailnum,qu:qu,checknum:checknum,uid:"1228689277",title:title,content:content		
	},
	function(data) {
		layer.msg(data);
		
	});
}, function(){
  layer.msg('小伙子想好再来吧');
});
}}

function shouquanbtn() {
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  }
	  var pwd = $('#pwd').val();
	  if(pwd==''){
		  layer.msg('玩家后台的授权密码不能为空');
		  return false;
	  }	 
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'addczvip',uid:uid,pwd:pwd,qu:qu,checknum:checknum		
	},
	function(data) {
		
		layer.msg(data);
		
	});
}
function shouquanbtn1() {
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  }
	  var pwd = $('#pwd').val();
	  if(pwd==''){
		  layer.msg('玩家后台的授权密码不能为空');
		  return false;
	  }	 
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'addvip',uid:uid,pwd:pwd,qu:qu,checknum:checknum		
	},
	function(data) {
		
		layer.msg(data);
		
	});
}
function unshouquan() {
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  }
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'quxiaovip',uid:uid,qu:qu,checknum:checknum		
	},
	function(data) {
		
		layer.msg(data);
		
	});
}
function editpwdbtn() {
	if (checknum == '') {
        layer.msg('请输入GM校验码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  }
	  var pwd = $('#pwd').val();
	  if(pwd==''){
		  layer.msg('玩家后台的授权密码不能为空');
		  return false;
	  }	
	$.ajaxSetup({
		contentType: "application/x-www-form-urlencoded; charset=utf-8"
	});
	$.post("../../Function/GmQuery.php", {
		type:'editpwd',uid:uid,qu:qu,checknum:checknum,pwd:pwd,		
	},
	function(data) {
		
		layer.msg(data);
		
	});
}