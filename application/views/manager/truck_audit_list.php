 <div style="padding:10px;">
    <table id="tal_dgTruck" title="待审核车源列表" style="width:1400px;height:auto"
            toolbar="#tal_toolbarTruck" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="false" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="checked" checkbox="true">选择</th>
                <th field="id" width="50">编号</th>
                <th field="locProvince" width="60" formatter="show_province_of_dg">省</th>
                <th field="locCity" width="80" formatter="show_city_of_dg">市</th>
                <th field="locRegion" width="150" formatter="show_region_of_dg">县</th>
                <th field="driverName" width="70">姓名</th>
                <th field="driverSex" width="40" formatter="tal_showNameOfSex">性别</th>
                <th field="truckState" width="60" formatter="tal_showNameOfTruckState" styler="stylerState">状态</th>
                <th field="truckBrand" width="80">品牌</th>
                <th field="truckType" width="80" formatter="tal_showNameOfTruckType">车辆类型</th>
                <th field="bodyStruc" width="80" formatter="tal_showNameOfBodyStruc">车体结构</th>
                <th field="capacity" width="80" formatter="tal_showNameOfCapacity">载重量</th>
                <th field="truckLength" width="80" formatter="tal_showNameOfTruckLength">车长</th>
                <th field="truckVolumn" width="80" formatter="tal_showTruckVolumn">容积</th>
                <th field="plateNo" width="80">车牌号</th>
                <th field="runningToken" width="80">行车证号</th>
                <th field="drivingLicense" width="80">驾驶证号</th>
                <th field="licenseType" width="80" formatter="tal_showNameOfLicenseType">驾驶证类型</th>
                <th field="mobileNo" width="80">电话号码</th>
                <th field="freqLine" width="80">常跑路线</th>
                <th field="makeTime" width="100" formatter="showTimeAsDate">创建时间</th>
                <th field="createUserName" width="80">创建人</th>
            </tr>
        </thead>
    </table>
    <div id="tal_toolbarTruck">
        <div style="margin-bottom: 5px; padding: 3px 5px; border:1px solid #ddd;">
            <input id='tal_sel_locProvince' name='tal_sel_locProvince' style="width:80px;"/>
            <input id='tal_sel_locCity' name='tal_sel_locCity' style="width:80px;"/>
            <input id='tal_sel_locRegion' name='tal_sel_locRegion' style="width:80px;"/>
            <input id='tal_sel_truckType' name='tal_sel_truckType' style="width:80px;"/>
            <input id='tal_sel_truckLength' name='tal_sel_truckLength' style="width:80px;"/>
            <input id='tal_sel_capacity' name='tal_sel_capacity' style="width:80px;"/>
            <label for='tal_tx_driverName'>姓名</label><input id='tal_tx_driverName' class="easyui-validatebox" style="width:60px;"/>
            <label for='tal_tx_mobileNo'>电话</label><input id='tal_tx_mobileNo' class="easyui-validatebox" style="width:80px;"/>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-search" plain="true" onclick="$('#tal_dgTruck').datagrid('reload');">查询</a>
        </div>
        <div style='padding:5px 5px;'>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-button-check-blue',plain:false" onclick="tal_audit_truckInfo()">审核通过</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    var codeOfTruckAuditList = <?=$codes;?>;
    //console.log(codeOfTruckAuditList);
    $(function(){
        // 状态选择/车辆类型/车长/载重
        get_cb_options('#tal_sel_truckType','--类型--', codeOfTruckAuditList, 'trucktype', 200);
        get_cb_options('#tal_sel_truckLength','--车长--', codeOfTruckAuditList, 'trucklength', 200);
        get_cb_options('#tal_sel_capacity','--载重--', codeOfTruckAuditList, 'capacity', 'auto');
        
        // 省市
        init_province_city_region('#tal_sel_locProvince','#tal_sel_locCity','#tal_sel_locRegion');
        
        // datagrid
        $('#tal_dgTruck').datagrid({
            url: '<?=base_url();?>manager/truck_info/get_truck_list',
            onBeforeLoad: function(param){
                param['truckState'] = 0;
                if ( $('#tal_sel_truckType').combobox('getValue') != -1 ){
                    param['truckType'] = $('#tal_sel_truckType').combobox('getValue');    
                }
                if ( $('#tal_sel_truckLength').combobox('getValue') != -1 ){
                    param['truckLength'] = $('#tal_sel_truckLength').combobox('getValue');    
                }
                if ( $('#tal_sel_capacity').combobox('getValue') != -1 ){
                    param['capacity'] = $('#tal_sel_capacity').combobox('getValue');    
                }
                if ( $('#tal_sel_locProvince').combobox('getValue') != -1 ){
                    param['locProvince'] = $('#tal_sel_locProvince').combobox('getValue');
                    if ( $('#tal_sel_locCity').combobox('getValue') != -1 ){
                        param['locCity'] = $('#tal_sel_locCity').combobox('getValue');
                        if ( $('#tal_sel_locRegion').combobox('getValue') != -1 ){
                            param['locRegion'] = $('#tal_sel_locRegion').combobox('getValue');
                        }
                    }
                }
                
                if ( $.trim( $('#tal_tx_driverName').val() ) != '' ) {
                    param['driverName'] = $.trim($('#tal_tx_driverName').val());
                }
                if ( $.trim( $('#tal_tx_mobileNo').val() ) != '' ) {
                    param['mobileNo'] = $.trim($('#tal_tx_mobileNo').val());
                }
                //console.log(param);
            }
        });
    });
    //console.log(mapProvince);
    
    function tal_showNameOfSex(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'sex',value);
    }
    function tal_showNameOfTruckType(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'trucktype',value);
    }
    function tal_showNameOfCapacity(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'capacity',value);
    }
    function tal_showNameOfLicenseType(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'licensetype',value);
    }
    function tal_showNameOfTruckState(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'truckstate',value);
    }
    function tal_showNameOfBodyStruc(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'bodystruc',value);
    }
    function tal_showNameOfTruckLength(value,row,index){
        return showNameOfCode(codeOfTruckAuditList,'trucklength',value);
    }
    function tal_showTruckVolumn(value,row,index){
        if (value) return value+'米<sup style="font-size:9px">3</sup>'; 
        return value;
    }
    function tal_audit_truckInfo(){        
        var ids = $.map( $('#tal_dgTruck').datagrid('getSelections'), function(val, i) {
            return val['id'];
        });
        //console.log('ids:', ids);
        if (ids.length === 0) return;
        
        $.post('<?=base_url('manager/truck_info/commit_audit')?>', { ids: $.toJSON( ids ) }, function(result){
            if (result.status==='OK'){
                $('#tal_dgTruck').datagrid('reload');    // reload the user data
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
