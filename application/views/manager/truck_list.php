 <div style="padding:10px;">
    <table id="tl_dgTruck" title="车源列表" style="width:1400px;height:auto"
            toolbar="#tl_toolbarTruck" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="50">编号</th>
                <th field="locProvince" width="60" formatter="show_province_of_dg">省</th>
                <th field="locCity" width="80" formatter="show_city_of_dg">市</th>
                <th field="locRegion" width="150" formatter="show_region_of_dg">县</th>
                <th field="driverName" width="70">姓名</th>
                <th field="driverSex" width="40" formatter="tl_showNameOfSex">性别</th>
                <th field="truckState" width="60" formatter="tl_showNameOfTruckState" styler="stylerState">状态</th>
                <th field="truckBrand" width="80">品牌</th>
                <th field="truckType" width="80" formatter="tl_showNameOfTruckType">车辆类型</th>
                <th field="bodyStruc" width="80" formatter="tl_showNameOfBodyStruc">车体结构</th>
                <th field="capacity" width="80" formatter="tl_showNameOfCapacity">载重量</th>
                <th field="truckLength" width="80" formatter="tl_showNameOfTruckLength">车长</th>
                <th field="truckVolumn" width="80" formatter="tl_showTruckVolumn">容积</th>
                <th field="plateNo" width="80">车牌号</th>
                <th field="runningToken" width="80">行车证号</th>
                <th field="drivingLicense" width="80">驾驶证号</th>
                <th field="licenseType" width="80" formatter="tl_showNameOfLicenseType">驾驶证类型</th>
                <th field="mobileNo" width="80">电话号码</th>
                <th field="freqLine" width="80">常跑路线</th>
                <th field="makeTime" width="100" formatter="showTimeAsDate">创建时间</th>
                <th field="createUserName" width="80">创建人</th>
                <th field="auditTime" width="100" formatter="showTimeAsDate">审核时间</th>
                <th field="auditUserName" width="80">审核人</th>
            </tr>
        </thead>
    </table>
    <div id="tl_toolbarTruck">
        <div style="margin-bottom: 5px; padding: 3px 5px; border:1px solid #ddd;">
            <input id="tl_sel_truckState" name="tl_sel_truckState" style='width:80px;'>
            <input id='tl_sel_locProvince' name='tl_sel_locProvince' style="width:80px;"/>
            <input id='tl_sel_locCity' name='tl_sel_locCity' style="width:80px;"/>
            <input id='tl_sel_locRegion' name='tl_sel_locRegion' style="width:80px;"/>
            <input id='tl_sel_truckType' name='tl_sel_truckType' style="width:80px;"/>
            <input id='tl_sel_truckLength' name='tl_sel_truckLength' style="width:80px;"/>
            <input id='tl_sel_capacity' name='tl_sel_capacity' style="width:80px;"/>
            <label for='tl_tx_driverName'>姓名</label><input id='tl_tx_driverName' class="easyui-validatebox" style="width:60px;"/>
            <label for='tl_tx_mobileNo'>电话</label><input id='tl_tx_mobileNo' class="easyui-validatebox" style="width:80px;"/>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-search" plain="true" onclick="$('#tl_dgTruck').datagrid('reload');">查询</a>
        </div>
        <div style='padding:5px 5px;'>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-button-add-blue',plain:false" onclick="tl_new_truckInfo()">发布车源</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-doc-edit-blue',plain:false" onclick="tl_edit_truckInfo()">修改车源</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-button-remove-blue',plain:false" onclick="tl_del_truckInfo()">删除车源</a>
        </div>
    </div>
</div>

<div id="tl_dlg_edit" class="easyui-dialog" style="width:400px;height:auto;padding:10px 20px"
        closed="true" buttons="#tl_dlg_edit-buttons">
    <div class="ftitle">车源信息</div>
    <form id="tl_fm_truckInfo" method="post" novalidate>
        <div class="fitem">
            <label>省市:</label>
            <input name="locProvince" id='tl_edit_locProvince' class="easyui-combobox" required="true" validType='selectValue["省市","#tl_edit_locProvince"]'>
        </div>
        <div class="fitem">
            <label>地市:</label>
            <input name="locCity" id='tl_edit_locCity' class="easyui-combobox" required="true" validType='selectValue["地市","#tl_edit_locCity"]'>
        </div>
        <div class="fitem">
            <label>区县:</label>
            <input name="locRegion" id='tl_edit_locRegion' class="easyui-combobox" required="true">
        </div>
        <div class="fitem">
            <label>姓名:</label>
            <input name="driverName" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>性别:</label>
            <input name="driverSex" id="tl_edit_driverSex" class="easyui-combobox" required="true" validType='selectValue["性别","#tl_edit_driverSex"]'>
        </div>
        <div class="fitem">
            <label>品牌:</label>
            <input name="truckBrand" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>车辆类型:</label>
            <input name="truckType" id="tl_edit_truckType" class="easyui-combobox" required="true" validType='selectValue["车辆类型","#tl_edit_truckType"]'>
        </div>
        <div class="fitem">
            <label>车体结构:</label>
            <input name="bodyStruc" id="tl_edit_bodyStruc" class="easyui-combobox" required="true" validType='selectValue["车体结构","#tl_edit_bodyStruc"]'>
        </div>
        <div class="fitem">
            <label>载重量:</label>
            <input name="capacity" id="tl_edit_capacity" class="easyui-combobox" required="true" validType='selectValue["载重量","#tl_edit_capacity"]'>
        </div>
        <div class="fitem">
            <label>车长:</label>
            <input name="truckLength" id="tl_edit_truckLength" class="easyui-combobox" required="true" validType='selectValue["车长","#tl_edit_truckLength"]'>
        </div>
        <div class="fitem">
            <label>容积:</label>
            <input name="truckVolumn" class='easyui-validatebox' required="true" >米<sup style='font-size:9px;'>3</sup>
        </div>
        <div class="fitem">
            <label>车牌号:</label>
            <input name="plateNo" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>行车证号:</label>
            <input name="runningToken" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>驾驶证号:</label>
            <input name="drivingLicense" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>驾照类型:</label>
            <input name="licenseType" id="tl_edit_licenseType" class="easyui-combobox" required="true" validType='selectValue["驾照类型","#tl_edit_licenseType"]'>
        </div>
        <div class="fitem">
            <label>电话号码:</label>
            <input name="mobileNo" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>常跑路线:</label>
            <input name="freqLine" class='easyui-validatebox'>
        </div>
        <input type='hidden' name='id' value='tl_edit_id'/>
    </form>
</div>
<div id="tl_dlg_edit-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-check-blue" onclick="tl_save_truckInfo()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-cross" onclick="javascript:$('#tl_dlg_edit').dialog('close')">取消</a>
</div>

<script type="text/javascript">
    var codeOfTruckList = <?=$codes;?>;
    //console.log(codeOfTruckList);
    $(function(){
        // 状态选择/车辆类型/车长/载重
        get_cb_options('#tl_sel_truckState','--状态--', codeOfTruckList, 'truckstate', 'auto');
        get_cb_options('#tl_sel_truckType','--类型--', codeOfTruckList, 'trucktype', 200);
        get_cb_options('#tl_sel_truckLength','--车长--', codeOfTruckList, 'trucklength', 200);
        get_cb_options('#tl_sel_capacity','--载重--', codeOfTruckList, 'capacity', 'auto');
        
        // 省市
        init_province_city_region('#tl_sel_locProvince','#tl_sel_locCity','#tl_sel_locRegion');
        
        // datagrid
        $('#tl_dgTruck').datagrid({
            url: '<?=base_url();?>manager/truck_info/get_truck_list',
            onBeforeLoad: function(param){
                if ( $('#tl_sel_truckState').combobox('getValue') != -1 ){
                    param['truckState'] = $('#tl_sel_truckState').combobox('getValue');    
                }
                if ( $('#tl_sel_truckType').combobox('getValue') != -1 ){
                    param['truckType'] = $('#tl_sel_truckType').combobox('getValue');    
                }
                if ( $('#tl_sel_truckLength').combobox('getValue') != -1 ){
                    param['truckLength'] = $('#tl_sel_truckLength').combobox('getValue');    
                }
                if ( $('#tl_sel_capacity').combobox('getValue') != -1 ){
                    param['capacity'] = $('#tl_sel_capacity').combobox('getValue');    
                }
                if ( $('#tl_sel_locProvince').combobox('getValue') != -1 ){
                    param['locProvince'] = $('#tl_sel_locProvince').combobox('getValue');
                    if ( $('#tl_sel_locCity').combobox('getValue') != -1 ){
                        param['locCity'] = $('#tl_sel_locCity').combobox('getValue');
                        if ( $('#tl_sel_locRegion').combobox('getValue') != -1 ){
                            param['locRegion'] = $('#tl_sel_locRegion').combobox('getValue');
                        }
                    }
                }
                
                if ( $.trim( $('#tl_tx_driverName').val() ) != '' ) {
                    param['driverName'] = $.trim($('#tl_tx_driverName').val());
                }
                if ( $.trim( $('#tl_tx_mobileNo').val() ) != '' ) {
                    param['mobileNo'] = $.trim($('#tl_tx_mobileNo').val());
                }
                //console.log(param);
            }
        });
    });
    //console.log(mapProvince);
    
    function tl_showNameOfSex(value,row,index){
        return showNameOfCode(codeOfTruckList,'sex',value);
    }
    function tl_showNameOfTruckType(value,row,index){
        return showNameOfCode(codeOfTruckList,'trucktype',value);
    }
    function tl_showNameOfCapacity(value,row,index){
        return showNameOfCode(codeOfTruckList,'capacity',value);
    }
    function tl_showNameOfLicenseType(value,row,index){
        return showNameOfCode(codeOfTruckList,'licensetype',value);
    }
    function tl_showNameOfTruckState(value,row,index){
        return showNameOfCode(codeOfTruckList,'truckstate',value);
    }
    function tl_showNameOfBodyStruc(value,row,index){
        return showNameOfCode(codeOfTruckList,'bodystruc',value);
    }
    function tl_showNameOfTruckLength(value,row,index){
        return showNameOfCode(codeOfTruckList,'trucklength',value);
    }
    function tl_showTruckVolumn(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,2));
        if (value) return result+'米<sup style="font-size:9px">3</sup>'; 
        return value;
    }
    
    /* 管理车源 */
   var tl_edit_url;
   init_province_city_region('#tl_edit_locProvince','#tl_edit_locCity','#tl_edit_locRegion');
   get_cb_options('#tl_edit_driverSex','--性别--', codeOfTruckList, 'sex', 'auto');
   get_cb_options('#tl_edit_truckType','--车辆类型--', codeOfTruckList, 'trucktype', 200);
   get_cb_options('#tl_edit_bodyStruc','--车体结构--', codeOfTruckList, 'bodystruc', 200);
   get_cb_options('#tl_edit_truckLength','--车长--', codeOfTruckList, 'trucklength', 200);
   get_cb_options('#tl_edit_capacity','--载重量--', codeOfTruckList, 'capacity', 'auto');
   get_cb_options('#tl_edit_licenseType','--驾照类型--', codeOfTruckList, 'licensetype', 'auto');
   // 发布车源
   function tl_new_truckInfo(){
       $('#tl_fm_truckInfo').form('clear');
       $('#tl_edit_locProvince').combobox('select','-1');
       $('#tl_edit_driverSex,#tl_edit_truckType,#tl_edit_bodyStruc,#tl_edit_truckLength,#tl_edit_capacity,#tl_edit_licenseType')
           .combobox('select','-1');
       $('#tl_edit_id').val('0');
       $('#tl_dlg_edit').dialog('open').dialog('setTitle','发布车源');
       tl_edit_url = '<?=base_url('manager/truck_info/save_truck_info')?>';
    }
    // 修改车源
    function tl_edit_truckInfo(){
        var row = $('#tl_dgTruck').datagrid('getSelected');
        if (row){
            $('#tl_fm_truckInfo').form('load',row);
            $('#tl_edit_locProvince').combobox('select',row['locProvince']);
            $('#tl_edit_locCity').combobox('select',row['locCity']);
            if (row['locRegion'] != '0') {
                $('#tl_edit_locRegion').combobox('select',row['locRegion']);
            }
            $('#tl_edit_id').val( row['id']);
            
            $('#tl_dlg_edit').dialog('open').dialog('setTitle','修改车源');
            tl_edit_url = '<?=base_url('manager/truck_info/update_truck_info')?>';
        }
    }
    // 保存
    function tl_save_truckInfo(){
        if ( $('#tl_fm_truckInfo').form('validate') ){
            var data = ConvertFormToJSON( '#tl_fm_truckInfo' );
            $.post(tl_edit_url, { data: $.toJSON( data ) }, function(result){
                if (result.status==='OK'){
                    $('#tl_dlg_edit').dialog('close');        // close the dialog
                    $('#tl_dgTruck').datagrid('reload');    // reload the user data
                    $.messager.show({    // show error message
                        title: '恭喜',
                        msg: '保存成功'
                    });
                } else {
                    $.messager.show({    // show error message
                        title: '保存出错了',
                        msg: result.msg
                    });
                }
            }, 'json')
            .fail(function(resp){
                $.messager.show({    // show error message
                    title: '保存出错了',
                    msg: resp.responseText
                });
            });
        }
    }
    // 删除车源
    function tl_del_truckInfo(){
        var row = $('#tl_dgTruck').datagrid('getSelected');
        if (row){
            $.messager.confirm('删除确认','是否真的要删除车源['+row['driverName']+']?',function(r){
                if (r){
                    $.post('<?=base_url('manager/truck_info/del_truck_info')?>',{id:row['id']},function(result){
                        if (result.status==='OK'){
                            $('#tl_dgTruck').datagrid('reload');    // reload the user data
                            $.messager.show({    // show error message
                                title: '恭喜',
                                msg: '删除成功'
                            });
                        } else {
                            $.messager.show({    // show error message
                                title: '删除出错了',
                                msg: result.msg
                            });
                        }
                    },'json')
                    .fail(function(resp){
                        $.messager.show({    // show error message
                            title: '删除出错了',
                            msg: resp.responseText
                        });
                    });
                }
            });
        }
    }
</script>
<style type="text/css">
    #tl_fm_truckInfo{
        margin:0;
        padding:10px 30px;
    }
    #tl_fm_truckInfo .ftitle{
        font-size:14px;
        font-weight:bold;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
    }
    #tl_fm_truckInfo .fitem{
        margin-bottom:5px;
    }
    #tl_fm_truckInfo .fitem label{
        display:inline-block;
        width:80px;
    }
</style>