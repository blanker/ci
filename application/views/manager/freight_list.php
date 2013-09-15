<div style="padding:10px;">
    <table id="fl_dgFreight" title="货源列表" style="width:1200px;height:auto"
            toolbar="#fl_toolbarFreight" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="50">编号</th>
                <th field="freightName" width="150">货物名称</th>
                <th field="freightState" width="80" formatter="fl_showNameOfFreightState" styler="stylerState">状态</th>
                <th field="originLocation" width="150" formatter="show_full_origin_location_of_dg">出发地</th>
                <th field="destLocation" width="150" formatter="show_full_dest_location_of_dg">目的地</th>
                <th field="originProvince" width="80" hidden='true'>省</th>
                <th field="originCity" width="80" hidden="true">市</th>
                <th field="originRegion" width="150" hidden="true">县</th>
                <th field="destProvince" width="80" hidden="true">省</th>
                <th field="destCity" width="80" hidden="true">市</th>
                <th field="destRegion" width="150" hidden="true">县</th>
                <th field="freightType" width="100" formatter="fl_showNameOfFreightType">货物类型</th>
                <th field="packType" width="100" formatter="fl_showNameOfPackType">包装方式</th>
                <th field="freightWeight" width="100" formatter='fl_showNameOfFreightWeight'>重量</th>
                <th field="freightVolumn" width="100" formatter='fl_showNameOfFreightVolumn'>体积</th>
                <th field="attention" width="100">注意事项</th>
                <th field="makeTime" width="100" formatter="showTimeAsDate">创建时间</th>
                <th field="createUserName" width="80">创建人</th>
                <th field="auditTime" width="100" formatter="showTimeAsDate">审核时间</th>
                <th field="auditUserName" width="80">审核人</th>
            </tr>
        </thead>
    </table>
    <div id="fl_toolbarFreight">
        <div style="margin-bottom: 5px; padding: 3px 5px; border:1px solid #ddd;">
            <input id="fl_sel_freightState" style='width:80px;'>
            <label for='fl_sel_originProvince'>出发地:</label>
            <input id='fl_sel_originProvince' style="width:80px;"/>
            <input id='fl_sel_originCity' style="width:80px;"/>
            <input id='fl_sel_originRegion' style="width:80px;"/>
            <input id='fl_sel_freightType' style="width:120px;"/>
            <input id='fl_sel_packType' style="width:120px;"/>
            <label for='fl_tx_freightName'>名称:</label><input id='fl_tx_freightName' class="easyui-validatebox" style="width:60px;"/>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-search" plain="true" onclick="$('#fl_dgFreight').datagrid('reload');">查询</a>
        </div>
        <div style='padding:5px 5px;'>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-button-add-blue',plain:false" onclick="fl_new_freightSource()">发布货源</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-doc-edit-blue',plain:false" onclick="fl_edit_freightSource()">修改货源</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-button-remove-blue',plain:false" onclick="fl_del_freightSource()">删除货源</a>
        </div>
    </div>
</div>

<div id="fl_dlg_edit" class="easyui-dialog" style="width:400px;height:auto;padding:10px 20px"
        closed="true" buttons="#fl_dlg_edit-buttons">
    <div class="ftitle">货源信息</div>
    <form id="fl_fm_freightSource" method="post" novalidate>
        <div class="fitem">
            <label>出发省:</label>
            <input name="originProvince" id='fl_edit_originProvince' class="easyui-combobox" required="true" validType='selectValue["出发省","#fl_edit_originProvince"]'>
        </div>
        <div class="fitem">
            <label>出发市:</label>
            <input name="originCity" id='fl_edit_originCity' class="easyui-combobox" required="true" validType='selectValue["出发市","#fl_edit_originCity"]'>
        </div>
        <div class="fitem">
            <label>出发县:</label>
            <input name="originRegion" id='fl_edit_originRegion' class="easyui-combobox" required="true">
        </div>
        <div class="fitem">
            <label>目的省:</label>
            <input name="destProvince" id='fl_edit_destProvince' class="easyui-combobox" required="true" validType='selectValue["目的省","#fl_edit_destProvince"]'>
        </div>
        <div class="fitem">
            <label>目的市:</label>
            <input name="destCity" id='fl_edit_destCity' class="easyui-combobox" required="true" validType='selectValue["目的市","#fl_edit_destCity"]'>
        </div>
        <div class="fitem">
            <label>目的县:</label>
            <input name="destRegion" id='fl_edit_destRegion' class="easyui-combobox" required="true">
        </div>
        <div class="fitem">
            <label>货物名称:</label>
            <input name="freightName" class='easyui-validatebox' required="true" >
        </div>
        <div class="fitem">
            <label>货物类型:</label>
            <input name="freightType" id="fl_edit_freightType" class="easyui-combobox" required="true" validType='selectValue["货物类型","#fl_edit_freightType"]'>
        </div>
        <div class="fitem">
            <label>包装方式:</label>
            <input name="packType" id="fl_edit_packType" class="easyui-combobox" required="true" validType='selectValue["包装方式","#fl_edit_packType"]'>
        </div>
        <div class="fitem">
            <label>重量:</label>
            <input name="freightWeight" class='easyui-numberbox' required="true" data-options="min:0,precision:4">吨
        </div>
        <div class="fitem">
            <label>体积:</label>
            <input name="freightVolumn" class='easyui-numberbox' required="true" data-options="min:0,precision:4" >米<sup style='font-size:9px;'>3</sup>
        </div>
        <div class="fitem">
            <label>注意事项:</label>
            <input name="attention" class='easyui-validatebox'>
        </div>
        <input type='hidden' name='id' value='fl_edit_id'/>
    </form>
</div>
<div id="fl_dlg_edit-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-check-blue" onclick="fl_save_freightSource()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-cross" onclick="javascript:$('#fl_dlg_edit').dialog('close')">取消</a>
</div>

<script type="text/javascript">
    var fl_codeOfFreightSource = <?=$codes;?>;
    //console.log(codeOfTruckList);
    $(function(){
        // 状态选择/货物类型/包装方式
        get_cb_options('#fl_sel_freightState','--状态--', fl_codeOfFreightSource, 'freightstate', 'auto');
        get_cb_options('#fl_sel_freightType','--货物类型--', fl_codeOfFreightSource, 'freighttype', 200);
        get_cb_options('#fl_sel_packType','--包装方式--', fl_codeOfFreightSource, 'packtype', 'auto');
        
        // 省市
        init_province_city_region('#fl_sel_originProvince','#fl_sel_originCity','#fl_sel_originRegion');
        
        // datagrid
        $('#fl_dgFreight').datagrid({
            url: '<?=base_url();?>manager/freight_source/get_freight_list',
            onBeforeLoad: function(param){
                if ( $('#fl_sel_freightState').combobox('getValue') != -1 ){
                    param['freightState'] = $('#fl_sel_freightState').combobox('getValue');    
                }
                if ( $('#fl_sel_freightType').combobox('getValue') != -1 ){
                    param['freightType'] = $('#fl_sel_freightType').combobox('getValue');    
                }
                if ( $('#fl_sel_packType').combobox('getValue') != -1 ){
                    param['packType'] = $('#fl_sel_packType').combobox('getValue');    
                }
                if ( $('#fl_sel_originProvince').combobox('getValue') != -1 ){
                    param['originProvince'] = $('#fl_sel_originProvince').combobox('getValue');
                    if ( $('#fl_sel_originCity').combobox('getValue') != -1 ){
                        param['originCity'] = $('#fl_sel_originCity').combobox('getValue');
                        if ( $('#fl_sel_originRegion').combobox('getValue') != -1 ){
                            param['originRegion'] = $('#fl_sel_originRegion').combobox('getValue');
                        }
                    }
                }
                
                if ( $.trim( $('#fl_tx_freightName').val() ) != '' ) {
                    param['freightName'] = $.trim($('#fl_tx_freightName').val());
                }
                //console.log(param);
            }
        });
    });
    //console.log(mapProvince);
    
    function fl_showNameOfFreightState(value,row,index){
        return showNameOfCode(fl_codeOfFreightSource,'freightstate',value);
    }
    function fl_showNameOfFreightType(value,row,index){
        return showNameOfCode(fl_codeOfFreightSource,'freighttype',value);
    }
    function fl_showNameOfPackType(value,row,index){
        return showNameOfCode(fl_codeOfFreightSource,'packtype',value);
    }
    
    function fl_showNameOfFreightVolumn(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,4));
        if (value) return result+'米<sup style="font-size:9px">3</sup>'; 
        return value;
    }
    function fl_showNameOfFreightWeight(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,4));
        if (value) return result+'吨'; 
        return value;
    }
    
    /* 管理源 */
   var fl_edit_url;
   init_province_city_region('#fl_edit_originProvince','#fl_edit_originCity','#fl_edit_originRegion');
   init_province_city_region('#fl_edit_destProvince','#fl_edit_destCity','#fl_edit_destRegion');
   get_cb_options('#fl_edit_freightType','--货物类型--', fl_codeOfFreightSource, 'freighttype', 200);
   get_cb_options('#fl_edit_packType','--包装方式--', fl_codeOfFreightSource, 'packtype', 'auto');
   // 发布源
   function fl_new_freightSource(){
       $('#fl_fm_freightSource').form('clear');
       $('#fl_edit_originProvince, #fl_edit_destProvince').combobox('select','-1');
       $('#fl_edit_freightType,#fl_edit_packType').combobox('select','-1');
       $('#fl_edit_id').val('0');
       $('#fl_dlg_edit').dialog('open').dialog('setTitle','发布货源');
       tl_edit_url = '<?=base_url('manager/freight_source/save_freight_source')?>';
    }
    // 修改源
    function fl_edit_freightSource(){
        var row = $('#fl_dgFreight').datagrid('getSelected');
        if (row){
            if ( row['freightState'] > 1) {
                $.messager.alert('不能修改','货源状态['+fl_showNameOfFreightState(row['freightState'])+']不允许修改!','warning');
                return;
            }
            $('#fl_fm_freightSource').form('load',row);
            $('#fl_edit_originProvince').combobox('select',row['originProvince']);
            $('#fl_edit_destProvince').combobox('select',row['destProvince']);
            $('#fl_edit_originCity').combobox('select',row['originCity']);
            $('#fl_edit_destCity').combobox('select',row['destCity']);
            if (row['originRegion'] != '0') {
                $('#fl_edit_originRegion').combobox('select',row['originRegion']);
            }
            if (row['destRegion'] != '0') {
                $('#fl_edit_destRegion').combobox('select',row['destRegion']);
            }
            $('#fl_edit_id').val( row['id']);
            
            $('#fl_dlg_edit').dialog('open').dialog('setTitle','修改货源');
            tl_edit_url = '<?=base_url('manager/freight_source/update_freight_source')?>';
        }
    }
    // 保存
    function fl_save_freightSource(){
        if ( $('#fl_fm_freightSource').form('validate') ){
            var data = ConvertFormToJSON( '#fl_fm_freightSource' );
            $.post(tl_edit_url, { data: $.toJSON( data ) }, function(result){
                if (result.status==='OK'){
                    $('#fl_dlg_edit').dialog('close');        // close the dialog
                    $('#fl_dgFreight').datagrid('reload');    // reload the user data
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
    // 删除源
    function fl_del_freightSource(){
        var row = $('#fl_dgFreight').datagrid('getSelected');
        if (row){
            if ( row['freightState'] > 1) {
                $.messager.alert('不能删除','货源状态['+fl_showNameOfFreightState(row['freightState'])+']不允许删除!','warning');
                return;
            }
            $.messager.confirm('删除确认','是否真的要删除货源['+row['freightName']+']?',function(r){
                if (r){
                    $.post('<?=base_url('manager/freight_source/del_freight_source')?>',{id:row['id']},function(result){
                        if (result.status==='OK'){
                            $('#fl_dgFreight').datagrid('reload');    // reload the user data
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
    #fl_fm_freightSource{
        margin:0;
        padding:10px 30px;
    }
    #fl_fm_freightSource .ftitle{
        font-size:14px;
        font-weight:bold;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
    }
    #fl_fm_freightSource .fitem{
        margin-bottom:5px;
    }
    #fl_fm_freightSource .fitem label{
        display:inline-block;
        width:80px;
    }
</style>