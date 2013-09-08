<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>掌上物流平台后台数据管理</title>
<meta name="ContentType" content="Content-Type=text/html, charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>html/js/jquery-easyui-1.3.4/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>html/js/jquery-easyui-1.3.4/themes/icon.css">
<style type="text/css">
    .panel-body{
        background:#f0f0f0;
    }
    .panel-header{
        background:#fff url('<?=base_url();?>html/images/panel_header_bg.gif') no-repeat top right;
    }
    .panel-tool-collapse{
        background:url('<?=base_url();?>html/images/arrow_up.gif') no-repeat 0px -3px;
    }
    .panel-tool-expand{
        background:url('<?=base_url();?>html/images/arrow_down.gif') no-repeat 0px -3px;
    }
    a.menuAnch {
        text-decoration:none;
    }
    * { font-size: 14px; }
</style>
<?php echo $this->load->view("includes/jquery");?>
<?php echo $this->load->view("includes/jeasyui");?>
<script type="text/javascript" src="<?=base_url();?>html/js/manager/home.js"></script>
</head>
<body class="easyui-layout">
    <div data-options="region:'north'" style="height:60px"></div>
    <div data-options="region:'south',split:true" style="height:60px;"></div>
    <div data-options="region:'west',split:true" title="菜单" style="width:220px;">
        <div style="width:200px;height:auto;background:#7190E0;padding:5px;overflow:hidden">
            
            <?php 
            $lastMainMenu = '';
            for ($idx = 0; $idx < sizeof($menu); $idx++ ):
                $item = $menu[$idx];
                if ( $lastMainMenu !== $item->menuMain ):
                    if ($lastMainMenu !== ''){
                        echo '</div>';
                    }
                    echo '<div class="easyui-panel" title="'.$item->menuMain.'" collapsible="true" style="width:200px;height:auto;padding:10px;line-height:20px">';
                endif;
                echo '<a class="menuAnch" href="javascript:void(0);" menuId="'.$item->id.'" menuUrl="'.base_url().$item->menuUrl.'?sysmenuid='.$item->id.'">'.$item->menuName.'</a><br/>';
                $lastMainMenu = $item->menuMain;
                if ($idx === sizeof($menu) - 1){
                    echo '</div>';
                }
             endfor; 
             ?>
                
            <!--
            <div class="easyui-panel" title="Picture Tasks" collapsible="true" style="width:200px;height:auto;padding:10px;">
                View as a slide show<br/>
                Order prints online<br/>
                Print pictures
                
                
            </div>
            <br/>
            <div class="easyui-panel" title="File and Folder Tasks" collapsible="true" style="width:200px;height:auto;padding:10px;">
                Make a new folder<br/>
                Publish this folder to the Web<br/>
                Share this folder
            </div>
            <br/>
            <div class="easyui-panel" title="Other Places" collapsible="true" collapsed="true" style="width:200px;height:auto;padding:10px;">
                New York<br/>
                My Pictures<br/>
                My Computer<br/>
                My Network Places
            </div>
            <br/>
            <div class="easyui-panel" title="Details" collapsible="true" style="width:200px;height:auto;padding:10px;">
                My documents<br/>
                File folder<br/><br/>
                Date modified: Oct.3rd 2010
            </div>
            -->
        </div>
    </div>
    <div data-options="region:'center',iconCls:'icon-ok'">
        <div id="tabMain" class="easyui-tabs" data-options="fit:true,border:false,plain:true">
            <div title="主页" data-options="closable:false,href:'_content.html'" style="padding:10px"></div>
        </div>
    </div>
    <div id="w" class="easyui-window" title="请稍候..." 
        data-options="modal:true,closed:true,closable:false,minimizable:false,maximizable:false,iconCls:'icon-save'" 
        style="width:200px;height:80px;padding:10px;">
        保存中，请不要刷新页面
    </div>
</body>
</html>