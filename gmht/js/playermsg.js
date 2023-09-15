var pwd = '';
var uid = '';
var qu = $('#qu').val();
$('#pwd').change(function() {
    pwd = $(this).val();
});
  $('#uid').change(function(){
	  uid=$.trim($(this).val());
  });
  $('#qu').change(function(){
	  qu=$.trim($(this).val());
  });
$(".selectpicker").selectpicker({
    header:'请选择',
    showIcon:true,
    multipleSeparator:'#',
    maxOptions:4,
    maxOptionsText:'最多选4个',
});

/**
帐号充值
*/
function chargebtn() {
	if (pwd == '') {
        layer.msg('请输入授权密码');
        return false;
    }
	  if(uid==''){
		  layer.msg('游戏账号不能为空');
		  return false;
	  }
	  var chargenum=$('#chargenum').val();
	  if(chargenum==''){
		  layer.msg('充值数量不能为空');
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
	$.post("user/query.php", {
		type:'charge',uid:uid,chargenum:chargenum,qu:qu,pwd:pwd,chargetype:chargetype				
	},
	function(data) {
		
		layer.msg(data);
		
	});
}
/**
发道具邮件
*/
function send_mail() {
	if (pwd == '') {
        layer.msg('请输入授权密码');
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
	  var title='GM邮件';
	  var content='亲爱的玩家，请查收您的邮件!';
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
	$.post("user/query.php", {
		type:'daoju',uid:uid,item:mailid,num:mailnum,qu:qu,pwd:pwd,title:title,content:content			
	},
	function(data) {
		layer.msg(data);
		
	});
	
}