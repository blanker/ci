<div style="padding:10px;">
    <table id="dgRole" title="系统角色列表" style="width:700px;height:auto"
            toolbar="#toolbarRole" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="100">角色编号</th>
                <th field="roleName" width="300" editor="{type:'validatebox',options:{required:true}}">角色名称</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarRole">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-plus',plain:true" onclick="append('#dgRole', 'role');">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-minus',plain:true" onclick="removeit('#dgRole', 'role');">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-save',plain:true" onclick="accept('#dgRole','role','<?=base_url();?>manager/rights/commit_role','id');">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-undo',plain:true" onclick="reject('#dgRole', 'role');">撤销更改</a>
    </div>
</div>

<div style="padding:10px;">
    <table id="dgRoleRights" title="角色所拥有的权限" style="width:1700px;height:auto"
            toolbar="#toolbarRoleRights" pagination="false" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="60">权限编号</th>
                <th field="roleId" width="60">角色编号</th>
                <th field="menuId" width="60">菜单编号</th>
                <th field="menuName" width="150" formatter='showMenuNameById' editor="{type:'text'}">菜单名称</th>
                <th field="accessRights" width="60" align="center" formatter="showCheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">访问权限</th>
                <th field="rights01" width="60" align="center" formatter="showRights01CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限1</th>
                <th field="rights02" width="60" align="center" formatter="showRights02CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限2</th>
                <th field="rights03" width="60" align="center" formatter="showRights03CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限3</th>
                <th field="rights04" width="60" align="center" formatter="showRights04CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限4</th>
                <th field="rights05" width="60" align="center" formatter="showRights05CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限5</th>
                <th field="rights06" width="60" align="center" formatter="showRights06CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限6</th>
                <th field="rights07" width="60" align="center" formatter="showRights07CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限7</th>
                <th field="rights08" width="60" align="center" formatter="showRights08CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限8</th>
                <th field="rights09" width="60" align="center" formatter="showRights09CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限9</th>
                <th field="rights10" width="60" align="center" formatter="showRights10CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限10</th>
                <th field="rights11" width="60" align="center" formatter="showRights11CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限11</th>
                <th field="rights12" width="60" align="center" formatter="showRights12CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限12</th>
                <th field="rights13" width="60" align="center" formatter="showRights13CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限13</th>
                <th field="rights14" width="60" align="center" formatter="showRights14CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限14</th>
                <th field="rights15" width="60" align="center" formatter="showRights15CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限15</th>
                <th field="rights16" width="60" align="center" formatter="showRights16CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限16</th>
                <th field="rights17" width="60" align="center" formatter="showRights17CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限17</th>
                <th field="rights18" width="60" align="center" formatter="showRights18CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限18</th>
                <th field="rights19" width="60" align="center" formatter="showRights19CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限19</th>
                <th field="rights20" width="60" align="center" formatter="showRights20CheckBox" editor="{type:'checkbox',options:{on:1,off:0}}">权限20</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarRoleRights">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-plus',plain:true" onclick="appendRoleRights('#dgRoleRights', 'roleRights');">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-minus',plain:true" onclick="removeit('#dgRoleRights', 'roleRights');">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-save',plain:true" onclick="accept('#dgRoleRights','roleRights','<?=base_url();?>manager/rights/commit_role_rights','id');">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-action-undo',plain:true" onclick="reject('#dgRoleRights', 'roleRights');">撤销更改</a>
    </div>
</div>


<div id="dlgRoleRights" class="easyui-dialog" style="width:400px;height:auto;padding:10px 20px"
        closed="true" buttons="#dlgRoleRights-buttons">
    <form id="fmRoleMenus" method="post" novalidate>
    </form>
</div>
<div id="dlgRoleRights-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-ok" onclick="chooseNewMenu($('#fmRoleMenus').serializeArray());$('#dlgRoleRights').dialog('close');">确定</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-cancel" onclick="javascript:$('#dlgRoleRights').dialog('close');">取消</a>
</div>

<script type="text/javascript">
    // 所有菜单项
    var allMenus = [];
    var allMenuNames = {};
    <?php foreach($allMenus['rows'] as $menu):?>
        allMenus.push({ '<?=$menu->menuId?>': ['<?=$menu->menuName?>'] });
        var one = {};
        <?php 
        foreach($menu as $key => $value) :
            if ($value):
        ?>
                one['<?=$key?>'] = '<?=$value?>';
        <?php
            endif; 
        endforeach; 
        ?>
        allMenuNames['<?=$menu->menuId?>'] = one;
    <?php endforeach;?>
    
    // 角色编辑
    editIndex['role'] = undefined;
    $(function(){
        $('#dgRole').datagrid({
            url: '<?=base_url();?>manager/rights/get_role_list',
            onClickRow: function(index, data){ 
                if ( onClickRow('#dgRole', index, 'role' ) ) {
                    $('#dgRoleRights').datagrid('reload',
                        {  roleId: data['id'] }
                    );
                }
            }
        });
    });
    
    // 角色权限编辑
    editIndex['roleRights'] = undefined;
    $(function(){
        $('#dgRoleRights').datagrid({
            url: '<?=base_url();?>manager/rights/get_role_rights_list',
            queryParams: { roleId: 0 },
            onClickRow: function(index, row){
                if (onClickRow('#dgRoleRights', index, 'roleRights' )){
                    // 按照菜单ID，判断对应的20权限，都有哪些可编辑
                    checkEditRoleProperties(index, row['menuId']);
                }
            }
        });
    });
    
    // 显示对应菜单ID的名称
    function showMenuNameById(value,row,index){
        if (row){
            return allMenuNames[row['menuId']]['menuName'];
        } 
        return '';
    }
    
    // 根据菜单配置的权限，决定20个权限的显示
    function showRightsCheckBox(value,menuId,rights){
        if (allMenuNames[menuId][rights]) {
            if ( value && value == 1){
                return '<input title="'+allMenuNames[menuId][rights]+'" type="checkbox" checked="checked"/>';
            } else {
                return '<input title="'+allMenuNames[menuId][rights]+'" type="checkbox"/>';
            }
        } else {
            return '&nbsp;';
        }
    }
    
    <?php for($i=1; $i<=20; $i++): ?>
    function showRights<?=sprintf('%02d',$i);?>CheckBox(value,row,index){return showRightsCheckBox(value,row['menuId'],"rights<?=sprintf('%02d',$i);?>");}
    <?php endfor; ?>
    
    // 新增菜单权限
    function appendRoleRights( datagridId ,indexKey ){
        if (editIndex['role'] === undefined) return; 
        if (endEditing( datagridId, indexKey )){ // 首先还是要判断是否能结束当前编辑行
            var newMenusObj = jQuery.extend(true, {}, allMenuNames);
            $.each($(datagridId).datagrid('getRows'), function(idx, row){
                delete newMenusObj[row['menuId']];
            });
            var newMenus = [];
            $.each(allMenus, function(idx, menu){
                var menuId = Object.keys(menu)[0];
                if ( newMenusObj[menuId] != undefined ) {
                    newMenus.push(menu);
                }
            });
            if ( newMenus.length === 0 ) {
                alert('该角色已经拥有所有权限了');
            } else if ( newMenus.length === 1 ) {
                chooseNewMenu( [ { name: "radioMenu", value: Object.keys(newMenus[0])[0] } ] );
            } else {
                var html="";
                $.each(newMenus, function(idx, menu){
                    html += '<input type="radio" name="radioMenu" '+(idx==0?'checked="checked"':'')+' value="'+Object.keys(menu)[0]+'">'+ menu[Object.keys(menu)[0]] +'<br/>';
                });
                $('#fmRoleMenus').html(html);
                $('#dlgRoleRights').dialog('open').dialog('setTitle','请选择授权菜单');
            }
            
        }
    }
    
    // 新增菜单时选择了菜单项之后
    function chooseNewMenu( newMenu ){
        if (newMenu) {
            var menuId = newMenu[0]['value'];
            $('#dgRoleRights').datagrid('appendRow',
                { 
                    menuId: menuId, 
                    menuName: allMenuNames[menuId]['menuName'],
                    roleId: $('#dgRole').datagrid('getSelected')['id']
            });  // 新增一行再最后
            editIndex['roleRights'] = $('#dgRoleRights').datagrid('getRows').length-1;
            $('#dgRoleRights').datagrid('selectRow', editIndex['roleRights'])    // 并选中新增的行
                    .datagrid('beginEdit', editIndex['roleRights']);          // 并开始编辑
            // 按照菜单ID，判断对应的20权限，都有哪些可编辑
            checkEditRoleProperties(editIndex['roleRights'], menuId);
        }
    }
    
    function checkEditRoleProperties(index, menuId){
        /* 菜单名称不允许编辑 */
        var ed = $('#dgRoleRights').datagrid('getEditor', {index:index, field:'menuName'});
        if (ed && ed['target']) {
            $(ed['target']).attr('readonly', 'readonly' );
            $(ed['target']).attr('disabled', 'disabled' );
            $(ed['target']).val( allMenuNames[menuId]['menuName'] );                            
        }
        /* 20个权限，都判断一下是否运行选择 */
        <?php for($i=1; $i<=20; $i++): ?>
            var rights = 'rights<?=sprintf("%02d",$i);?>';
            ed = $('#dgRoleRights').datagrid('getEditor', {index:index, field:rights});
            if ( allMenuNames[menuId][rights] == undefined ) {                            
                if (ed && ed['target']) $(ed['target']).remove();
            } else {
                if (ed && ed['target']) $(ed['target']).attr('title', allMenuNames[menuId][rights] );
            }
        <?php endfor; ?>
    }
</script>