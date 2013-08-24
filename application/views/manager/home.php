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
</style>
<script type="text/javascript" src="<?=base_url();?>html/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>html/js/jquery-easyui-1.3.4/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>html/js/jquery-easyui-1.3.4/locale/easyui-lang-zh_CN.js"></script>
</head>
<body class="easyui-layout">
    <div data-options="region:'north'" style="height:150px"></div>
    <div data-options="region:'south',split:true" style="height:150px;"></div>
    <div data-options="region:'west',split:true" title="菜单" style="width:220px;">
        <div style="width:200px;height:auto;background:#7190E0;padding:5px;">
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
        </div>
    </div>
    <div data-options="region:'center',title:'Main Title',iconCls:'icon-ok'">
        <div class="easyui-tabs" data-options="fit:true,border:false,plain:true">
            <div title="About" data-options="closable:true,href:'_content.html'" style="padding:10px"></div>
            <div title="DataGrid" style="padding:5px" data-options="closable:true">
                <table class="easyui-datagrid"
                        data-options="url:'datagrid_data1.json',method:'get',singleSelect:true,fit:true,fitColumns:true">
                    <thead>
                        <tr>
                            <th data-options="field:'itemid'" width="80">Item ID</th>
                            <th data-options="field:'productid'" width="100">Product ID</th>
                            <th data-options="field:'listprice',align:'right'" width="80">List Price</th>
                            <th data-options="field:'unitcost',align:'right'" width="80">Unit Cost</th>
                            <th data-options="field:'attr1'" width="150">Attribute</th>
                            <th data-options="field:'status',align:'center'" width="50">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>