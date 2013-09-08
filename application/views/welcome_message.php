<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>掌上物流平台</title>

	<style type="text/css">
    * {font-size: 12px;}
	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
        font-size: 14px;        
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container, #download, #message{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	#frmLogin label, #frmLogin input, #frmLogin button {
	    font-size:medium;
	}
	#download {
	    text-align: center;
	    padding: 10px;
	    color: #808080;
	    font-size: medium;
	}
	#dowload a {
	    color: #808080;
        font-size: medium;
	}
    dt {
        padding: 3px 10px;
        font-size: medium;
    }
    dl {
        font-weight: bold;
        padding: 6px 10px;
        color: #00F;
        font-size: large;
    }
	</style>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>html/js/jquery-easyui-1.3.4/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>html/js/jquery-easyui-1.3.4/themes/icon.css">
    <?php echo $this->load->view("includes/jquery");?>
    <script type="text/javascript" src="<?=base_url();?>html/js/jquery-easyui-1.3.4/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>html/js/jquery-easyui-1.3.4/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="<?=base_url();?>html/js/jquery.md5.min.js"></script>
    <script type="text/javascript">var base_url='<?=base_url();?>';</script>
    <script type="text/javascript" src="<?=base_url();?>html/js/welcome_message.js"></script>
</head>
<body class="easyui-layout">

    <div data-options="region:'north'" style="height:100px;overflow: hidden;">
        <div class="easyui-panel" style="height:98px;line-height:98px;overflow: hidden;">
            <table style="padding:0px; margin:0px;font-size:medium;"><tr><td>
            <?=form_open(base_url().'manager/home/index',array('id'=>'frmLogin','style'=>'padding:0px;margin:0px;'));?>
            <?=form_label('帐号','userId');?>
            <?=form_input(array('name'=>'userId','id'=>'userId','class'=>'easyui-validatebox','size'=>'12','maxLength'=>"30",'data-options'=>"required:true"));?>
            <?=form_label('密码','password');?>
            <?=form_password(array('name'=>'password','id'=>'password','class'=>'easyui-validatebox','size'=>'12','maxLength'=>"30",'data-options'=>"required:true"));?>
            <?=form_submit(array('id'=>'btnSubmit'),"登录");?>
            <?=form_close();?>
            </td></tr></table>
        </div>
    </div>
    <div data-options="region:'south',split:true" style="height:50px;overflow: hidden;">
        <div style="text-align:center; height:42px;line-height:42px; padding:0px; margin:0px;font-size:large;">掌上物流平台版权所有 <span style="font-family: Arial;font-size:large;">&copy; zhangshangwuliu.com</span></div>
    </div>
    <div data-options="region:'east',split:true,collapsible:false" style="width:250px;">
        <div id="download">
            <?= anchor("/download/client/2013_8_31", "Android客户端下载", array( 'class'=>"easyui-linkbutton" ,'data-options'=>"iconCls:'icon-save'") ); ?>
        </div>
        <div id="message">
            <h1>功能说明</h1>
                
            <dl>2013-8-31</dl>
            <dt>1、客户端百度地图开发包更新到最新版2.1.3</dt>
            <dt>2、客户端百度定位开发包更新到最新版4.0</dt>
            
            <p></p>
            
            <dl>2013-8-16</dl>
            <dt>1、客户端可查询货源信息</dt>
            <dt>2、客户端可查询车源信息</dt>
            <dt>3、解决时区问题</dt>
            
            <p></p>
            
            <dl>2013-8-15</dl>
            <dt>1、客户端可发布货源信息</dt>
            
            <p></p>
            <dl>2013-7-30</dl>
            <dt>1、客户端可登录</dt>
            <dt>2、客户端可上传定位信息</dt>    
            <dt>3、客户端可注册用户</dt>
            <dt>4、客户端可发布车源信息</dt>
        </div>

    </div>
    <div data-options="region:'center'" style="padding:10px">
    </div>

</body>
</html>