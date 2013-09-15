<div id="df_wizard" class="swMain" style='display:none;'>
  <ul>
    <li><a href="#df_step-1">
          <label class="stepNumber">1</label>
          <span class="stepDesc">
             第一步<br />
             <small>选择货源</small>
          </span>
      </a></li>
    <li><a href="#df_step-2">
          <label class="stepNumber">2</label>
          <span class="stepDesc">
             第二步<br />
             <small>选择车源</small>
          </span>
      </a></li>
    <li><a href="#df_step-3">
          <label class="stepNumber">3</label>
          <span class="stepDesc">
             第三步<br />
             <small>确认信息</small>
          </span>                   
       </a></li>
    <li><a href="#df_step-4">
          <label class="stepNumber">4</label>
          <span class="stepDesc">
             第四步<br />
             <small>发货</small>
          </span>                   
      </a></li>
  </ul>
  <div id="df_step-1">   
      <h2 class="StepTitle">第一步：选择货源</h2>
      <!-- begin 货源选择 -->
      <div style="padding:5px;">
            <table id="df_dg_freight" title="待车货源列表" style="width:1378px;height:auto"
                    toolbar="#df_toolbar_freight" pagination="true" idField="id"
                    rownumbers="true" fitColumns="true" singleSelect="true" striped="true"
                    data-options="" pageSize="20">
                <thead>
                    <tr>
                        <th field="checked" checkbox="true">选择</th>
                        <th field="id" width="50">编号</th>
                        <th field="freightName" width="150">货物名称</th>
                        <th field="freightState" width="80" formatter="df_showNameOfFreightState" styler="stylerState">状态</th>
                        <th field="originLocation" width="150" formatter="show_full_origin_location_of_dg">出发地</th>
                        <th field="destLocation" width="150" formatter="show_full_dest_location_of_dg">目的地</th>
                        <th field="originProvince" width="80" hidden='true'>省</th>
                        <th field="originCity" width="80" hidden="true">市</th>
                        <th field="originRegion" width="150" hidden="true">县</th>
                        <th field="destProvince" width="80" hidden="true">省</th>
                        <th field="destCity" width="80" hidden="true">市</th>
                        <th field="destRegion" width="150" hidden="true">县</th>
                        <th field="freightType" width="100" formatter="df_showNameOfFreightType">货物类型</th>
                        <th field="packType" width="100" formatter="df_showNameOfPackType">包装方式</th>
                        <th field="freightWeight" width="100" formatter='df_showNameOfFreightWeight'>重量</th>
                        <th field="freightVolumn" width="100" formatter='df_showNameOfFreightVolumn'>体积</th>
                        <th field="attention" width="100">注意事项</th>
                        <th field="makeTime" width="100" formatter="showTimeAsDate">创建时间</th>
                        <th field="createUserName" width="80">创建人</th>
                        <th field="auditTime" width="100" formatter="showTimeAsDate">审核时间</th>
                        <th field="auditUserName" width="80">审核人</th>
                    </tr>
                </thead>
            </table>
            <div id="df_toolbar_freight">
                <div style="margin-bottom: 5px; padding: 3px 5px; border:1px solid #ddd;">
                    <label for='df_sel_originProvince'>出发地:</label>
                    <input id='df_sel_originProvince' style="width:80px;"/>
                    <input id='df_sel_originCity' style="width:80px;"/>
                    <input id='df_sel_originRegion' style="width:80px;"/>
                    <input id='df_sel_freightType' style="width:120px;"/>
                    <input id='df_sel_packType' style="width:120px;"/>
                    <label for='df_tx_freightName'>名称:</label><input id='df_tx_freightName' class="easyui-validatebox" style="width:60px;"/>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-button-search" plain="true" onclick="$('#df_dg_freight').datagrid('reload');">查询</a>
                </div>
            </div>
        </div>
        <!-- end 货源选择 -->
  </div>
  <div id="df_step-2">
      <h2 class="StepTitle">Step 2 Content</h2> 
       <!-- step content -->
  </div>                      
  <div id="df_step-3">
      <h2 class="StepTitle">Step 3 Title</h2>   
       <!-- step content -->
  </div>
  <div id="df_step-4">
      <h2 class="StepTitle">Step 4 Title</h2>   
       <!-- step content -->                         
  </div>
</div>

<link href="<?=base_url('html/js/jQuery-Smart-Wizard-3.3.1/styles/smart_wizard.css')?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=base_url('html/js/jQuery-Smart-Wizard-3.3.1/js/jquery.smartWizard.js')?>"></script>
<script type="text/javascript">
    var df_codeOfFreightSource = <?=$codes;?>;
    $(function(){
        $('#df_wizard').smartWizard({
            labelNext:'下一步', 
            labelPrevious:'上一步', 
            labelFinish:'完成',
            noForwardJumping: true
        });
        $('#df_wizard').show();
        
        /* begin 货源选择 */        
        //console.log(codeOfTruckList);
        $(function(){
            // 状态选择/货物类型/包装方式
            get_cb_options('#df_sel_freightState','--状态--', df_codeOfFreightSource, 'freightstate', 'auto');
            get_cb_options('#df_sel_freightType','--货物类型--', df_codeOfFreightSource, 'freighttype', 200);
            get_cb_options('#df_sel_packType','--包装方式--', df_codeOfFreightSource, 'packtype', 'auto');
            
            // 省市
            init_province_city_region('#df_sel_originProvince','#df_sel_originCity','#df_sel_originRegion');
            
            // datagrid
            $('#df_dg_freight').datagrid({
                url: '<?=base_url();?>manager/freight_source/get_freight_list',
                onBeforeLoad: function(param){
                    param['freightState'] = 1;    
                    if ( $('#df_sel_freightType').combobox('getValue') != -1 ){
                        param['freightType'] = $('#df_sel_freightType').combobox('getValue');    
                    }
                    if ( $('#df_sel_packType').combobox('getValue') != -1 ){
                        param['packType'] = $('#df_sel_packType').combobox('getValue');    
                    }
                    if ( $('#df_sel_originProvince').combobox('getValue') != -1 ){
                        param['originProvince'] = $('#df_sel_originProvince').combobox('getValue');
                        if ( $('#df_sel_originCity').combobox('getValue') != -1 ){
                            param['originCity'] = $('#df_sel_originCity').combobox('getValue');
                            if ( $('#df_sel_originRegion').combobox('getValue') != -1 ){
                                param['originRegion'] = $('#df_sel_originRegion').combobox('getValue');
                            }
                        }
                    }
                    
                    if ( $.trim( $('#df_tx_freightName').val() ) != '' ) {
                        param['freightName'] = $.trim($('#df_tx_freightName').val());
                    }
                    //console.log(param);
                }/*,
                onLoadSuccess: function(data){
                    //$("#df_wizard").smartWizard('fixHeight');
                }*/
            });
        });
        //console.log(mapProvince);
        /* end 货源选择*/
        
    });
    
    function df_showNameOfFreightState(value,row,index){
        return showNameOfCode(df_codeOfFreightSource,'freightstate',value);
    }
    function df_showNameOfFreightType(value,row,index){
        return showNameOfCode(df_codeOfFreightSource,'freighttype',value);
    }
    function df_showNameOfPackType(value,row,index){
        return showNameOfCode(df_codeOfFreightSource,'packtype',value);
    }
    
    function df_showNameOfFreightVolumn(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,4));
        if (value) return result+'米<sup style="font-size:9px">3</sup>'; 
        return value;
    }
    function df_showNameOfFreightWeight(value,row,index){
        var result = new Number(value).toFixed(get_xiaoshu_weishu(value,4));
        if (value) return result+'吨'; 
        return value;
    }
</script>
<style type="text/css">
    #df_wizard {
        width:980px;width:1400px;
    }
    #df_wizard .stepContainer div.content {
        width:968px;width:1388px;
        height:300px;height:500px;
    }
    #df_wizard .stepContainer {
      height:500px;
    }
</style>
