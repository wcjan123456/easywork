<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">$(function(){
	var th = $(".top").height();
	th = 111-th
	var wh = $(window).height()-th;
	$("#settingTabs").tabs({
		height:wh,
		onSelect:function(t,i){
			var ni = i+1;
			$("#tabs"+ni).datagrid({
				autoRowHeight:false,
				singleSelect:true,
				striped:true,
				rownumbers:true,
				method:'get',
				fitColumns:true,
				nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
				border:false,
				url:'__ACTION__/gid/'+ni+'/json/1',
				onDblClickRow:function(e,rowIndex,rowData){
					var se = $(this).datagrid('getSelected');
					var idd = se['id'];
					$("#addSetting").dialog({
						title:'编辑参数',
						resizable:true,
						width:450,
						height:275,
						href:'__URL__/add/act/edit/id/'+idd,
						onOpen:function(){
							cancel['Setting'] = $(this);
							cancel['tabs'] = $("#tabs"+ni);
						},
						onClose:function(){
							//$("#tabs"+ni).datagrid('reload');
							cancel['Setting'] = null;
						}
					});
				},
				toolbar:[{
				iconCls: 'icon-add',
					text : '新增',
					handler: function(){
						$("#addSetting").dialog({
							title:'新增参数',
							resizable:true,
							width:450,
							height:275,
							href:'__URL__/add/act/add',
							onOpen:function(){
								cancel['Setting'] = $(this);
								cancel['tabs'] = $("#tabs"+ni);
							},
							onClose:function(){
								//$("#tabs"+ni).datagrid('reload');
								cancel['Setting'] = null;
							}
						});
					}
				},'-',{
					iconCls: 'icon-edit',
					text : '编辑',
					handler: function(){
						var se = $("#tabs"+ni).datagrid('getSelected');
						var idd = se['id'];
						$("#addSetting").dialog({
							title:'编辑参数',
							resizable:true,
							width:450,
							height:275,
							href:'__URL__/add/act/edit/id/'+idd,
							onOpen:function(){
								cancel['Setting'] = $(this);
								cancel['tabs'] = $("#tabs"+ni);
							},
							onClose:function(){
								//$("#tabs"+ni).datagrid('reload');
								cancel['Setting'] = null;
							}
						});
					}
				},'-',{
					iconCls: 'icon-cancel',
					text : '删除',
					handler: function(){
						var se = $("#tabs"+ni).datagrid('getSelected');
						var idd = se['id'];
						$.messager.confirm('提示','确定删除吗！',function(r){
							if(r==true){
								$.messager.progress();
								$.get('__URL__/del/id/'+idd, function(data){
									$.messager.progress('close');
									if(data==1){
										$.messager.alert('提示','删除数据成功！','info',function(){
											$("#tabs"+ni).datagrid('reload');
										});
									}else if(data==2){
										$.messager.alert('提示','系统参数不能刪除！','warning');
									}else if(data==0){
										$.messager.alert('提示','刪除数据失败！','warning');
									}else{
										$.messager.alert('提示','您没有刪除权限！','warning');
									}
								});
							}
						});	
					}
				},'-',{
					iconCls: 'icon-json',
					text : '更新配置',
					handler: function(){
						$.get('__URL__/json', function(data){
							if(data==1){
								$.messager.alert('提示','更新配置文件成功！','info');
							}else{
								$.messager.alert('提示','更新配置文件失败！','warning');
							}
						});
					}
				},'-',{
					iconCls: 'icon-reload',
					text : '重载',
					handler: function(){
						$("#tabs"+ni).datagrid('reload');
					}
				}]
			});
		}
	});
});
</script><div class="con" onselectstart="return false;" style="-moz-user-select:none;"><div id="settingTabs" class="easyui-tabs"><div title="基础设置" data-options="fit:true"><table id="tabs1" class="easyui-datagrid" data-options=""><thead><tr><th data-options="field:'name',width:220">参数标签</th><th data-options="field:'vals',width:700">参数值</th><th data-options="field:'keyword',width:190">参数名</th></tr></thead></table></div><div title="性能设置" data-options="fit:true"><table id="tabs2" class="easyui-datagrid" data-options=""><thead><tr><th data-options="field:'name',width:220">参数标签</th><th data-options="field:'vals',width:700">参数值</th><th data-options="field:'keyword',width:190">参数名</th></tr></thead></table></div><div title="文件设置" data-options="fit:true"><table id="tabs3" class="easyui-datagrid" data-options=""><thead><tr><th data-options="field:'name',width:220">参数标签</th><th data-options="field:'vals',width:700">参数值</th><th data-options="field:'keyword',width:190">参数名</th></tr></thead></table></div><div title="全局设置" data-options="fit:true"><table id="tabs4" class="easyui-datagrid" data-options=""><thead><tr><th data-options="field:'name',width:220">参数标签</th><th data-options="field:'vals',width:700">参数值</th><th data-options="field:'keyword',width:190">参数名</th></tr></thead></table></div></div></div><div id="addSetting"></div>