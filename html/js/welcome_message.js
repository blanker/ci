$(function(){
    console.log('welcome');
    $('#frmLogin').on('submit',function(){
        console.log('login');
        if ( $.trim($('#userId').val()) === ''){
            $.messager.alert('提示','请输入用户名或手机号');
            $('#userId').focus();
            return false;
        }
        if ( $.trim($('#password').val()) === ''){
            $.messager.alert('提示','请输入密码');
            $('#password').focus();
            return false;
        }
        var encryptedPassword=$.md5($.trim($('#password').val()));
        //console.log(encryptedPassword);
        var request = $.ajax({  
            url: base_url+"manager/home/login_check",  
            type: "POST",  
            data: {
                userId : $.trim($('#userId').val()),
                encryptedPassword: encryptedPassword
            },  
            dataType: "json",
            cache: false
        }); 
        request.done(function(data) {  
            console.log(data);
            if (data.status === 'OK'){
                location.href=$('#frmLogin').attr('action');
            } else {
                $.messager.alert('注意','登录出错了<br/>'+data.msg+'','warning');
            }
        }); 
        request.fail(function(jqXHR, textStatus) {  
            $.messager.alert('错误','登录出错了<br/>['+textStatus+']','error');
        });
        
        return false;
    });
});
