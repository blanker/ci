<div style="padding:10px;">
    <table id="dgUser" title="用户列表" style="width:700px;height:auto"
            toolbar="#toolbarUser" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
            data-options="" pageSize="20">
        <thead>
            <tr>
                <th field="id" width="100">用户编号</th>
                <th field="userId" width="140">用户ID</th>
                <th field="userName" width="140">姓名</th>
                <th field="mobileNo" width="140">手机号码</th>
                <th field="address" width="180">地址</th>
                <th field="custType" width="140" formatter="showNameOfCustType" editor="{type:'validatebox',options:{required:true}}">客户类型</th>
                <th field="makeTime" width="120" formatter="showTimeAsDate">创建日期</th>
                <th field="makeType" width="120" formatter="showNameOfMakeType">创建方式</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarUser">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-user-add',plain:true" onclick="newUser();">新增用户</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-user-edit" plain="true" onclick="editUser();">修改信息</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-user-del" plain="true" onclick="destroyUser();">删除用户</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-unlock" plain="true" onclick="su_modifyPassword();">修改密码</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-key" plain="true" onclick="su_show_grant_window();">角色授权</a>
    </div>
</div>

<div id="dlgUser" class="easyui-dialog" style="width:400px;height:auto;padding:10px 20px;"
        closed="true" buttons="#dlgUser-buttons">
    <div class="ftitle">用户信息</div>
    <form id="fmUser" method="post" novalidate>
        <div class="fitem">
            <label>用户ID:</label>
            <input name="userId" id='userId' class="easyui-validatebox" required="true">
        </div>
        <div class="fitem">
            <label>姓名:</label>
            <input name="userName" id='userName' class="easyui-validatebox" required="true">
        </div>
        <div class="fitem">
            <label>手机号码:</label>
            <input name="mobileNo" id='mobileNo' class="easyui-validatebox" required="true">
        </div>
        <div class="fitem">
            <label>地址:</label>
            <input name="address" id='address' class="easyui-validatebox" required="true">
        </div>
        <div class="fitem">
            <label>客户类型:</label>
            <select name="custType" id='sysUserCustType' />
        </div>
        <div class="fitem fitemPassword">
            <label>密码:</label>
            <input type='password' name="password" id='password' class="easyui-validatebox" required="true">
        </div>
        <div class="fitem fitemPassword">
            <label>确认密码:</label>
            <input type='password' name="passwordRepeat" id='passwordRepeat' class="easyui-validatebox" required="true" validType="equals['#password']">
        </div>
        <input type="hidden" name="makeType" id="makeType" value="2" />
        <input type="hidden" id="encryptedPass" name="encryptedPass" />
        <input type="hidden" id="editSystemUserid" name="id"/>
    </form>
</div>
<div id="dlgUser-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-ok" onclick="saveUser()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-cancel" onclick="javascript:$('#dlgUser').dialog('close')">取消</a>
</div>

<div id="su_dlgModifyPassword" class="easyui-dialog" style="width:400px;height:auto;padding:10px 20px;"
        closed="true" buttons="#su_dlgModifyPassword-buttons">
    <div class="ftitle">修改密码</div>
    <form id="su_fmModifyPassword" method="post" novalidate>
        <div class="fitem fitemPassword">
            <label>新密码:</label>
            <input type='password' name="password" id='su_newPpassword' class="easyui-validatebox" required="true">
        </div>
        <div class="fitem fitemPassword">
            <label>确认密码:</label>
            <input type='password' name="passwordRepeat" id='su_newPpasswordRepeat' class="easyui-validatebox" required="true" validType="equals['#su_newPpassword']">
        </div>
        <input type="hidden" id="su_modifyPassword_encryptedPass" name="encryptedPass" />
        <input type="hidden" id="su_modifyPassword_id" name="id" />
    </form>
</div>
<div id="su_dlgModifyPassword-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-ok" onclick="su_saveNewPassword()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-action-cancel" onclick="javascript:$('#su_dlgModifyPassword').dialog('close')">取消</a>
</div>

<div id="su_w_grant" class="easyui-window" title="用户授权" data-options="modal:true,collapsible:false,minimizable:false,maximizable:false,closed:true,iconCls:'icon-key'" style="width:500px;height:500px;padding:10px;">
     <div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'north'" style="padding:0px;height:150px;">
            <table id="su_dgUserRole" title="用户现有角色列表" style="height:auto"
                pagination="false" idField="id"
                rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
                data-options="">
                <thead>
                    <tr>
                        <th field="id" hidden="true" width="60">id</th>
                        <th field="roleId" width="60">角色编码</th>
                        <th field="userId" hidden="true" width="60">userId</th>
                        <th field="roleName" width="170">角色名称</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div data-options="region:'center',split:true" style="padding:0px;">
            <div style="text-align:center;">
                <a class="easyui-linkbutton" title='删除角色' data-options="plain:true,iconCls:'icon-fastdown'" href="javascript:void(0)" onclick="su_remove_user_role()"></a>
                <a class="easyui-linkbutton" title='添加角色' data-options="plain:true,iconCls:'icon-fastup'" href="javascript:void(0)" onclick="su_add_user_role()"></a>
            </div>
            <table id="su_dgSysRole" title="系统角色列表" style="height:auto"
                pagination="true" idField="id"
                rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
                data-options="" pageSize="10" pageList='[10]'>
                <thead>
                    <tr>
                        <th field="id" width="60">角色编号</th>
                        <th field="roleName" width="170">角色名称</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div data-options="region:'south',border:false" style="text-align:right;padding:5px 0 0;">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-action-ok'" href="javascript:void(0)" onclick="accept('#su_dgUserRole','userRoleRights','<?=base_url();?>manager/rights/commit_user_role_rights','id');">保存</a>
            <a class="easyui-linkbutton" data-options="iconCls:'icon-action-cancel'" href="javascript:void(0)" onclick="$('#su_w_grant').window('close');">关闭</a>
        </div>
    </div>
</div>
    
<script type="text/javascript" src="<?=base_url();?>html/js/jquery.md5.min.js"></script>
<script type="text/javascript">
    // 系统代码
    /*
    var codeOfSysUser = {
        custtype: {
            '0': '管理者',
            '1': '车源发布者',
            '2': '货源发布者'            
        },
        maketype: {
            '1': '手机客户端',
            '2': '网页客户端'
        }
    };*/
    //   
    var codeOfSysUser = <?=$codes;?>;
    //console.log(codeOfSysUser);
    function initSystemUser(){
        var optHtml = '';
        $.each(codeOfSysUser['custtype'], function(key, val){
            optHtml += '<option value="'+key+'">'+val+'</option>';
        });
        $('#sysUserCustType').html(optHtml);
    }
    // 用户编辑
    editIndex['user'] = undefined;
    var editUserUrl;
    $(function(){
        $('#dgUser').datagrid({
            url: '<?=base_url();?>manager/rights/get_user_list'
        });
        initSystemUser();
    });
    
    function newUser(){
        $('#dlgUser').dialog('open').dialog('setTitle','新增用户');
        $('#fmUser').form('clear');
        var firstOpt = $('#sysUserCustType').children('option')[0];
        $(firstOpt).attr('selected', 'selected');
        $('#makeType').val('2');
        $('.fitemPassword').show();
        $('.fitemPassword').find('input').validatebox('enableValidation');
        editUserUrl = '<?=base_url('manager/rights/save_user');?>';
    }
    function editUser(){
        var row = $('#dgUser').datagrid('getSelected');
        if (row){
            //console.log(row);
            $('.fitemPassword').hide();
            $('.fitemPassword').find('input').validatebox('disableValidation');
            $('#dlgUser').dialog('open').dialog('setTitle','编辑用户');
            $('#fmUser').form('load',row);
            $('#editSystemUserid').val(row['id']);
            editUserUrl = '<?=base_url('manager/rights/update_user');?>';
        }
    }
    function saveUser(){
        $('#encryptedPass').val( $.md5($.trim($('#password').val())).toUpperCase() );
        var data = ConvertFormToJSON( '#fmUser' );
        delete data['password'];
        delete data['passwordRepeat'];
        //console.log(data);
        if ( $('#fmUser').form('validate') ) {
            $.post( editUserUrl, { data: $.toJSON( data ) }, function(result){
                //console.log(result);
                if (result.status==='OK'){
                    $('#dlgUser').dialog('close');        // close the dialog
                    $('#dgUser').datagrid('reload');    // reload the user data
                    $.messager.show({    // show error message
                        title: '恭喜',
                        msg: '保存成功'
                    });
                } else {
                    $.messager.show({    // show error message
                        title: '出错了',
                        msg: result.msg
                    });
                }
            },'json')
            .fail(function(resp){
                $.messager.show({    // show error message
                    title: '出错了',
                    msg: resp.responseText
                });
            });
        }
    }
    function destroyUser(){
        var row = $('#dgUser').datagrid('getSelected');
        if (row){
            $.messager.confirm('确认','是否真的要删除选定的用户['+row['userName']+']?',function(r){
                if (r){
                    $.post('<?=base_url('manager/rights/destroy_user');?>',{id:row.id},function(result){
                        //console.log(result);
                        if (result.status === 'OK'){
                            $('#dgUser').datagrid('reload');    // reload the user data
                            $.messager.show({    // show error message
                                title: '恭喜',
                                msg: '删除成功'
                            });
                        } else {
                            $.messager.show({    // show error message
                                title: '出错了',
                                msg: result.msg
                            });
                        }
                    },'json')
                    .fail(function(resp){
                        $.messager.show({    // show error message
                            title: '出错了',
                            msg: resp.responseText
                        });
                    });
                }
            });
        }
    }
    
    function showNameOfCustType(value,row,index){
        return showNameOfCode(codeOfSysUser,'custtype',value);
    }
    function showNameOfMakeType(value,row,index){
        return showNameOfCode(codeOfSysUser,'maketype',value);
    }
    function su_modifyPassword(){
        var row = $('#dgUser').datagrid('getSelected');
        if (row){
            $('#su_dlgModifyPassword').dialog('open').dialog('setTitle','修改密码：用户['+row['userName']+']');
            $('#su_fmModifyPassword').form('clear');
            $('#su_modifyPassword_id').val(row['id']);
        }
    }
    function su_saveNewPassword(){
        $('#su_modifyPassword_encryptedPass').val( $.md5($.trim($('#su_newPpassword').val())).toUpperCase() );
        var data = ConvertFormToJSON( '#su_fmModifyPassword' );
        delete data['password'];
        delete data['passwordRepeat'];
        if ( $('#su_fmModifyPassword').form('validate') ) {
            var saveNewPwdUrl = '<?=base_url('manager/rights/save_new_password')?>';
            $.post( saveNewPwdUrl, { data: $.toJSON( data ) }, function(result){
                if (result.status==='OK'){
                    $('#su_dlgModifyPassword').dialog('close');        // close the dialog
                    $.messager.show({    // show error message
                        title: '恭喜',
                        msg: '修改密码成功'
                    });
                } else {
                    $.messager.show({    // show error message
                        title: '修改密码出错了',
                        msg: result.msg
                    });
                }
            },'json')
            .fail(function(resp){
                $.messager.show({    // show error message
                    title: '修改密码出错了',
                    msg: resp.responseText
                });
            });
        }
    }
    
    // 用户授权
    editIndex['userRoleRights'] = undefined;
    function su_show_grant_window(){
        var row = $('#dgUser').datagrid('getSelected');
        if (row){
            $('#su_dgSysRole').datagrid({
                url: '<?=base_url();?>manager/rights/get_role_list'            
            });
            $('#su_dgUserRole').datagrid({
                url: '<?=base_url();?>manager/rights/get_user_role',
                queryParams: { userId: row['id'] }
            });
            $('#su_w_grant').window('open');
        }
    }
    // 除去某个角色
    function su_remove_user_role(){
        var row = $('#su_dgUserRole').datagrid('getSelected');
        if (row){
            var index = $('#su_dgUserRole').datagrid("getRowIndex", row);
            $( '#su_dgUserRole' ).datagrid('deleteRow', index); // 并删除当前行
        }
    }
    // 添加某个角色
    function su_add_user_role(){
        var row = $('#su_dgSysRole').datagrid('getSelected');
        if (row){
            $userRoles = $('#su_dgUserRole').datagrid('getRows');
            var hasRole = false;
            $.each( $userRoles, function(idx, val){
                if ( val['roleId'] === row['id'] ) {
                    alert('该角色已经授权用户，不必重复授权');
                    hasRole = true;
                    return false;
                }
            });
            if ( !hasRole ) {
                $('#su_dgUserRole').datagrid('appendRow',{
                    roleId: row['id'],
                    roleName: row['roleName'],
                    userId: $('#dgUser').datagrid('getSelected')['id']
                });
            }
        }
    }
</script>
<style type="text/css">
#fmUser, #su_fmModifyPassword{
    margin:0;
    padding:10px 30px;
}
#dlgUser .ftitle, #su_fmModifyPassword .ftitle{
    font-size:14px;
    font-weight:bold;
    padding:5px 0;
    margin-bottom:10px;
    border-bottom:1px solid #ccc;
}
#dlgUser .fitem, #su_fmModifyPassword .fitem{
    margin-bottom:5px;
}
#dlgUser .fitem label, #su_fmModifyPassword .fitem label{
    display:inline-block;
    width:80px;
}
</style>        