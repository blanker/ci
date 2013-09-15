 <div style="padding:10px;">
    <table id="dgCode" title="系统代码列表" style="width:850px;height:auto"
            toolbar="#toolbarCode" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="50">编号</th>
                <th field="codeName" width="100" editor="{type:'validatebox',options:{required:true}}">代码名称</th>
                <th field="codeValue" width="100" editor="{type:'validatebox',options:{required:true}}">代码取值</th>
                <th field="codeText" width="150" editor="{type:'validatebox',options:{required:true}}">代码含义</th>
                <th field="description" width="150" editor="{type:'text',options:{}}">描述</th>
                <th field="parentValue" width="100" editor="{type:'text',options:{}}">上级代码</th>
                <th field="sortNum" width="80" editor="{type:'numberbox',options:{required:true}}">显示顺序</th>
                <th field="makeTime" width="80" data-options="formatter:showTimeAsDate">加入时间</th>
                <th field="modifyTime" width="80" data-options="formatter:showTimeAsDate">修改时间</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarCode">
        <div style="margin-bottom: 5px; padding: 3px 5px; border:1px solid #ddd;">
            <label for='searchCodeName'>代码名称</label><input id='searchCodeName' class="easyui-validatebox" style="width:80px;"/>
            <label for='searchCodeValue'>代码取值</label><input id='searchCodeValue' class="easyui-validatebox" style="width:80px;"/>
            <label for='searchCodeText'>代码含义</label><input id='searchCodeText' class="easyui-validatebox" style="width:80px;"/>
            <!--
            <label for='searchCodeStartDate'>加入时间</label><input id='searchCodeStartDate' class="easyui-datebox" style="width:90px">
            <label for='searchCodeEndDate'>到</label><input id='searchCodeEndDate' class="easyui-datebox" readonly="true" style="width:90px">
            -->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-search" plain="true" onclick="$('#dgCode').datagrid('reload');">查询</a>
        </div>
        <div style="border:1px solid #ddd; padding:5px;">
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-plus',plain:true" onclick="append('#dgCode','code');">新增</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-minus',plain:true" onclick="removeit('#dgCode','code');">删除</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-save',plain:true" onclick="accept('#dgCode','code','<?=base_url();?>manager/system/commit_code','id');">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-undo',plain:true" onclick="reject('#dgCode','code');">撤销更改</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    editIndex['code'] = undefined;
    $(function(){
        $('#dgCode').datagrid({
            url: '<?=base_url();?>manager/system/get_code_list',
            onClickRow: function(index){ 
                onClickRow('#dgCode', index ,'code');
            },
            onBeforeLoad: function (param){
                param['codeName'] = $.trim($('#searchCodeName').val());
                param['codeValue'] = $.trim($('#searchCodeValue').val());
                param['codeText'] = $.trim($('#searchCodeText').val());
                //param['codeStartDate'] = $.trim( $('#searchCodeStartDate').datebox('getValue') );
                //param['codeEndDate'] = $.trim($('#searchCodeEndDate').val());
                //console.log(param);
                //$('#searchCodeStartDate').datebox('getValue');
            }
        });
    });
</script>