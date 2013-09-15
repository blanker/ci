<div style="padding:10px;">
    <table id="fal_dgFreight" title="待审核货源列表" style="width:1200px;height:auto"
            toolbar="#fal_toolbarFreight" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="false" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="checked" checkbox="true">选择</th>
                <th field="id" width="50">编号</th>
                <th field="freightName" width="150">货物名称</th>
                <th field="freightState" width="80" formatter="fal_showNameOfFreightState" styler="stylerState">状态</th>
                <th field="originLocation" width="150" formatter="show_full_origin_location_of_dg">出发地</th>
                <th field="destLocation" width="150" formatter="show_full_dest_location_of_dg">目的地</th>
                <th field="originProvince" width="80" hidden='true'>省</th>
                <th field="originCity" width="80" hidden="true">市</th>
                <th field="originRegion" width="150" hidden="true">县</th>
                <th field="destProvince" width="80" hidden="true">省</th>
                <th field="destCity" width="80" hidden="true">市</th>
                <th field="destRegion" width="150" hidden="true">县</th>
                <th field="freightType" width="100" formatter="fal_showNameOfFreightType">货物类型</th>
                <th field="packType" width="100" formatter="fal_showNameOfPackType">包装方式</th>
                <th field="freightWeight" width="100" formatter='fal_showNameOfFreightWeight'>重量</th>
                <th field="freightVolumn" width="100" formatter='fal_showNameOfFreightVolumn'>体积</th>
                <th field="attention" width="100">注意事项</th>
                <th field="makeTime" width="100" formatter="showTimeAsDate">创建时间</th>
                <th field="createUserName" width="80">创建人</th>
            </tr>
        </thead>
    </table>
    <div id="fal_toolbarFreight">
        <div style="margin-bottom: 5px; padding: 3px 5px; border:1px solid #ddd;">
            <label for='fal_sel_originProvince'>出发地:</label>
            <input id='fal_sel_originProvince' style="width:80px;"/>
            <input id='fal_sel_originCity' style="width:80px;"/>
            <input id='fal_sel_originRegion' style="width:80px;"/>
            <input id='fal_sel_freightType' style="width:120px;"/>
            <input id='fal_sel_packType' style="width:120px;"/>
            <label for='fal_tx_freightName'>名称:</label><input id='fal_tx_freightName' class="easyui-validatebox" style="width:60px;"/>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-search" plain="true" onclick="$('#fal_dgFreight').datagrid('reload');">查询</a>
        </div>
        <div style='padding:5px 5px;'>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-button-check-blue',plain:false" onclick="tal_audit_freightSource()">审核通过</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    var fal_codeOfFreightSource = <?=$codes;?>;
    //console.log(codeOfTruckList);
    $(function(){
        // 状态选择/货物类型/包装方式
        get_cb_options('#fal_sel_freightState','--状态--', fal_codeOfFreightSource, 'freightstate', 'auto');
        get_cb_options('#fal_sel_freightType','--货物类型--', fal_codeOfFreightSource, 'freighttype', 200);
        get_cb_options('#fal_sel_packType','--包装方式--', fal_codeOfFreightSource, 'packtype', 'auto');
        
        // 省市
        init_province_city_region('#fal_sel_originProvince','#fal_sel_originCity','#fal_sel_originRegion');
        
        // datagrid
        $('#fal_dgFreight').datagrid({
            url: '<?=base_url();?>manager/freight_source/get_freight_list',
            onBeforeLoad: function(param){
                param['freightState'] = 0;    
                if ( $('#fal_sel_freightType').combobox('getValue') != -1 ){
                    param['freightType'] = $('#fal_sel_freightType').combobox('getValue');    
                }
                if ( $('#fal_sel_packType').combobox('getValue') != -1 ){
                    param['packType'] = $('#fal_sel_packType').combobox('getValue');    
                }
                if ( $('#fal_sel_originProvince').combobox('getValue') != -1 ){
                    param['originProvince'] = $('#fal_sel_originProvince').combobox('getValue');
                    if ( $('#fal_sel_originCity').combobox('getValue') != -1 ){
                        param['originCity'] = $('#fal_sel_originCity').combobox('getValue');
                        if ( $('#fal_sel_originRegion').combobox('getValue') != -1 ){
                            param['originRegion'] = $('#fal_sel_originRegion').combobox('getValue');
                        }
                    }
                }
                
                if ( $.trim( $('#fal_tx_freightName').val() ) != '' ) {
                    param['freightName'] = $.trim($('#fal_tx_freightName').val());
                }
                //console.log(param);
            }
        });
    });
    //console.log(mapProvince);
    
    function fal_showNameOfFreightState(value,row,index){
        return showNameOfCode(fal_codeOfFreightSource,'freightstate',value);
    }
    function fal_showNameOfFreightType(value,row,index){
        return showNameOfCode(fal_codeOfFreightSource,'freighttype',value);
    }
    function fal_showNameOfPackType(value,row,index){
        return showNameOfCode(fal_codeOfFreightSource,'packtype',value);
    }
    
    function fal_showNameOfFreightVolumn(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,4));
        if (value) return result+'米<sup style="font-size:9px">3</sup>'; 
        return value;
    }
    function fal_showNameOfFreightWeight(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,4));
        if (value) return result+'吨'; 
        return value;
    }
    
    function tal_audit_freightSource(){        
        var ids = $.map( $('#fal_dgFreight').datagrid('getSelections'), function(val, i) {
            return val['id'];
        });
        //console.log('ids:', ids);
        if (ids.length === 0) return;
        
        $.post('<?=base_url('manager/freight_source/commit_audit')?>', { ids: $.toJSON( ids ) }, function(result){
            if (result.status==='OK'){
                $('#fal_dgFreight').datagrid('reload');    // reload the user data
                $.messager.show({    // show error message
                    title: '成功了',
                    msg: '审核通过'
                });
            } else {
                $.messager.show({    // show error message
                    title: '审核出错了',
                    msg: result.msg
                });
            }
        }, 'json')
        .fail(function(resp){
            $.messager.show({    // show error message
                title: '审核出错了',
                msg: resp.responseText
            });
        });
    }
</script>