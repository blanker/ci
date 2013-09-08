 <div style="padding:10px;">
    <table id="dgMenuRights" title="系统菜单权限列表" style="width:1200px;height:auto"
            toolbar="#toolbarMenuRights" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="50">编号</th>
                <th field="menuId" width="60">菜单编码</th>
                <th field="menuName" width="100">菜单名称</th>
                <th field="rights01" width="60" editor="{type:'validatebox'}">权限01</th>
                <th field="rights02" width="60" editor="{type:'validatebox'}">权限02</th>
                <th field="rights03" width="60" editor="{type:'validatebox'}">权限03</th>
                <th field="rights04" width="60" editor="{type:'validatebox'}">权限04</th>
                <th field="rights05" width="60" editor="{type:'validatebox'}">权限05</th>
                <th field="rights06" width="60" editor="{type:'validatebox'}">权限06</th>
                <th field="rights07" width="60" editor="{type:'validatebox'}">权限07</th>
                <th field="rights08" width="60" editor="{type:'validatebox'}">权限08</th>
                <th field="rights09" width="60" editor="{type:'validatebox'}">权限09</th>
                <th field="rights10" width="60" editor="{type:'validatebox'}">权限10</th>
                <th field="rights11" width="50" editor="{type:'validatebox'}">权限11</th>
                <th field="rights12" width="50" editor="{type:'validatebox'}">权限12</th>
                <th field="rights13" width="50" editor="{type:'validatebox'}">权限13</th>
                <th field="rights14" width="50" editor="{type:'validatebox'}">权限14</th>
                <th field="rights15" width="50" editor="{type:'validatebox'}">权限15</th>
                <th field="rights16" width="50" editor="{type:'validatebox'}">权限16</th>
                <th field="rights17" width="50" editor="{type:'validatebox'}">权限17</th>
                <th field="rights18" width="50" editor="{type:'validatebox'}">权限18</th>
                <th field="rights19" width="50" editor="{type:'validatebox'}">权限19</th>
                <th field="rights20" width="50" editor="{type:'validatebox'}">权限20</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarMenuRights">
        <div style="border:1px solid #ddd; padding:5px;">
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit('#dgMenuRights','menurights');">删除</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept('#dgMenuRights','menurights','<?=base_url("manager/rights/commit_menu_rights");?>','id');">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject('#dgMenuRights','menurights');">撤销更改</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    editIndex['menurights'] = undefined;
    $(function(){
        $('#dgMenuRights').datagrid({
            url: '<?=base_url();?>manager/rights/get_menu_rights_list',
            onClickRow: function(index){ 
                onClickRow('#dgMenuRights', index ,'menurights');
            }
        });
    });
</script>