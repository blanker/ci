 <div style="padding:10px;">
    <table id="dgMenu" title="菜单列表" style="width:700px;height:auto"
            toolbar="#toolbarMenu" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="50">编号</th>
                <th field="menuMain" width="60" editor="{type:'validatebox',options:{required:true}}">主菜单</th>
                <th field="menuName" width="80" editor="{type:'validatebox',options:{required:true}}">菜单名称</th>
                <th field="menuUrl" width="150" editor="{type:'validatebox',options:{required:true}}">菜单链接</th>
                <th field="sortNum" width="40" editor="{type:'numberbox',options:{required:true}}">显示顺序</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarMenu">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append('#dgMenu', 'menu');">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit('#dgMenu', 'menu');">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept('#dgMenu','menu','<?=base_url();?>manager/system/commit_menu','id');">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject('#dgMenu', 'menu');">撤销更改</a>
    </div>
</div>

<script type="text/javascript">
    editIndex['menu'] = undefined;
    $(function(){
        $('#dgMenu').datagrid({
            url: '<?=base_url();?>manager/system/get_menu_list',
            onClickRow: function(index){ 
                onClickRow('#dgMenu', index, 'menu' );
            }
        });
    });
</script>