// 定义一个全局对象，存放不同tab页面中各个datagrid对应的当前行号
// 而下面的所有方法，都加了一个参数： indexKey ，每个datagrid取一个唯一的key传进来即可
// 例如，菜单管理传入参数'menu'，代码管理传入参数'code'
// 这样 editIndex = { menu: 10, code: 15 } 就能清晰地分别开每个datagrid当前行了
var editIndex = {}; 

// 判断目前在编辑的行是否可结束编辑
// 主要是对各输入字段的校验（字段的校验规则在初始化datagrid时指定）
// parameters: datagridId（datagrid的id，例如'#dg'，注意前面加星号）
//             indexKey (该datagrid当前编辑行在对象editIndex中的key)
// return: 通过校验返回true，否则false
// 本方法提供给以下其他方法调用
function endEditing( datagridId, indexKey ){
	//console.log(editIndex);
	//console.log(indexKey);
	//console.log(editIndex[indexKey]);
    if (editIndex[indexKey] == undefined){return true;}	// 当前没有编辑的行直接返回true
    if ($(datagridId).datagrid('validateRow', editIndex[indexKey])){  //校验通过
        $(datagridId).datagrid('endEdit', editIndex[indexKey]);		// 完成编辑
        editIndex[indexKey] = undefined;
        return true;
    } else {
        return false;		//未通过校验
    }
}

// 点击数据行的时候所做的操作
// parameters: datagridId（datagrid的id，例如'#dg'，注意前面加星号）
//             index: 当前点击的行
//             indexKey (该datagrid当前编辑行在对象editIndex中的key)
// 使用方法：     $('#dgCode').datagrid({
//onClickRow: function(index){ 
//    onClickRow('#dgCode', index ,'code');
//}
//});
function onClickRow(datagridId, index, indexKey){
    if (editIndex[indexKey] != index){	// 点击的行和当前编辑的行不一样时
        if (endEditing( datagridId, indexKey )){	// 当前编辑的行可结束编辑时
            $(datagridId).datagrid('selectRow', index) // 选中当前点击行
                    .datagrid('beginEdit', index);	   // 并开始编辑
            editIndex[indexKey] = index;							// 当前编辑行变成点击的行
            return true;
        } else {	// 当前编辑行不可结束
            $(datagridId).datagrid('selectRow', editIndex[indexKey]); // 继续留在当前编辑的行 
        }
    }
    return false;
}

// 新增行
// parameters: datagridId（datagrid的id，例如'#dg'，注意前面加星号）
//             indexKey (该datagrid当前编辑行在对象editIndex中的key)
// 使用方法： 点击新增按钮时调用
// 例如: <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append('#dgCode','code');">新增</a>
function append( datagridId ,indexKey ){
    if (endEditing( datagridId, indexKey )){ // 首先还是要判断是否能结束当前编辑行
        $(datagridId).datagrid('appendRow',{ /*status:'P'*/}); 	// 新增一行再最后
        editIndex[indexKey] = $(datagridId).datagrid('getRows').length-1;
        $(datagridId).datagrid('selectRow', editIndex[indexKey])  	// 并选中新增的行
                .datagrid('beginEdit', editIndex[indexKey]);          // 并开始编辑
    }
}

// 删除行
// parameters: datagridId（datagrid的id，例如'#dg'，注意前面加星号）
//             indexKey (该datagrid当前编辑行在对象editIndex中的key)
// 使用方法： 点击删除按钮时调用
// 例如: <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit('#dgCode','code');">删除</a>
function removeit( datagridId, indexKey ){
    if (editIndex[indexKey] == undefined){ return; } // 当前没有选中行，什么也不做，直接返回
    $( datagridId ).datagrid('cancelEdit', editIndex[indexKey]) // 取消当前编辑行的编辑
            .datagrid('deleteRow', editIndex[indexKey]); // 并删除当前行
    editIndex[indexKey] = undefined;
}

// 保存更改
// parameters: datagridId（datagrid的id，例如'#dg'，注意前面加星号）
//             indexKey (该datagrid当前编辑行在对象editIndex中的key)
//             url ( 保存的url )
//             ids 主键字段(可选)
//                 考虑到数据行数据量可能较大，当删除的时候，其实服务器端只需要知道主键即可
//				   为了减轻网络压力，前端只传递删除的主键数组即可
//                 1、单主键的情况，参数传入字符串,例如是'id'，此时传递到服务器端的就是一个id数组：['44445','4444','3333','1002']或者['usera','userb','userc','userd']
//                 2、组合字段做主键时，参数传入数组，例如['userid','mobile']，传递到服务器端的就是一个对象数组:[{userid:'usera',mobile:'135'},{userid:'userb',mobile:'136'}]
//                 3、不传入参数，或者传入任何返回false的表达式，删除数据依然把整条数据传递给服务器端
// 使用方法： 点击保存按钮时调用
// 例如: <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept('#dgCode','code','<?=base_url();?>manager/system/commit_code','id');">保存</a>
function accept( datagridId, indexKey, url, ids ){
	// 还是先判断是否可结束编辑才能继续保存
	if ( !endEditing( datagridId , indexKey) ) return; 
	// 判断一下，没有更改，则不用保存
	if ( $(datagridId).datagrid('getChanges').length === 0 ) return;
	
    // 分别获得新增行、删除行、更改行的数据	
    var inserted = $( datagridId ).datagrid('getChanges','inserted');
    var deleted  = $( datagridId ).datagrid('getChanges','deleted');
    var updated  = $( datagridId ).datagrid('getChanges','updated');
    var deletedId = [];		// 
    if ( ids ) { // 设置了主键字段，才重新组装删除行的数据
    	if ( $.isArray(ids) ) { // 组合主键的，只返回包含组合主键和值的对象
    		deletedId = $.map( deleted, function(row ){
    			var newRow = {};
				$.each( ids,function(idx, id){
					newRow[id] = row[id];
				});
    			return newRow ;
			});
    	} else { // 只有一个主键字段的，只返回主键的值，连主键都不用返回
			deletedId = $.map( deleted, function(row ){  
				return row[ids] ;
			});
    	}
    } else {
    	deletedId = deleted;
    }
    
    $('#w').window('open');
    
    $.ajax({
        url: url,
        dataType: 'json',
        method: 'POST',
        data : {
            inserted: $.toJSON(inserted),
            updated: $.toJSON(updated),
            deleted: $.toJSON(deletedId)
        }
    }).done(function(data){
        if (data.status === 'OK') { // 提交成功
        	$(datagridId).datagrid('acceptChanges');
        	$(datagridId).datagrid('reload');  // 刷新datagrid
        }
        
    }).fail(function(resp){
    	$.messager.alert('出错了',resp.responseText);
    }).always(function(){
    	$('#w').window('close');
    });
}

// 撤销更改
// parameters: datagridId（datagrid的id，例如'#dg'，注意前面加星号）
//             indexKey (该datagrid当前编辑行在对象editIndex中的key)
// 使用方法： 点击撤销更改按钮时调用
// <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject('#dgCode','code');">撤销更改</a>
function reject( datagridId, indexKey ){
    $( datagridId ).datagrid('rejectChanges');
    editIndex[indexKey] = undefined;
}

// 
function getChanges(datagridId){
    var rows = $(datagridId).datagrid('getChanges');
    alert(rows.length+' rows are changed!');
}

function showTimeAsDate( value,row,index ){
	if (value)
		return value.substring(0,10);
	return value;
}

function showCheckBox(value,row,index){
	if ( value && value == 1){
		return '<input type="checkbox" checked="checked"/>';
	} else {
		return '<input type="checkbox"/>';
	}
}

//extend the 'equals' rule
$.extend($.fn.validatebox.defaults.rules, {
    equals: {
        validator: function(value,param){
            return value == $(param[0]).val();
        },
        message: '密码不匹配.'
    }
});

function ConvertFormToJSON(form){
    var array = jQuery(form).serializeArray();
    var json = {};
    
    jQuery.each(array, function() {
        json[this.name] = this.value || '';
    });
    
    return json;
}