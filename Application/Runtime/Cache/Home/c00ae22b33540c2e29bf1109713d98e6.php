<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<title><?php echo ($page_title); ?></title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/database/Public/bootstrap-3.3.7/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="/database/Public/bootstrap-3.3.7/css/bootstrap-theme.min.css" />
<link rel="stylesheet" type="text/css" href="/database/Public/css/style.css" />
<script src="/database/Public/jquery-1.11.3/jquery.min.js" /></script>
<script src="/database/Public/bootstrap-3.3.7/js/bootstrap.min.js" /></script>
<script src="/database/Public/js/ajaxform.js" /></script>
<script src="/database/Public/js/gehanghuanse.js" /></script>

<script src="/database/Public/js/mytool.js" /></script>
	
</head>
<body>
	<div id="top">放假打算离开房间爱上</div>
	<div id="fdasfrergfsgf" class="clearfix">
		<div id="left">
			<div class="list-group">
				<a href="/database/index.php/Home/Index/index" class="list-group-item active">
					数据库
				</a>
				<a href="/database/index.php/Home/Index/adddatabase" class="list-group-item active">
					数据库关系
				</a>
				<a href="/database/index.php/Home/Index/nexus" class="list-group-item active">
					关系列表
				</a>
			</div>
		</div>
		<div id="right">
			
	<div class="panel panel-default">
		<div class="panel-heading">
			表信息
		</div>
		
		<div class="panel-body">
			<table class="table table-condensed table-hover table-bordered table-striped success">
				<tr>
					<th></th>
					<th>数据库</th>
					<th>主表</th>
					<th>主表外键</th>
					<th>关联表</th>
					<th>关联表字段</th>
					<th>关联类型</th>
					<th style="width:200px;"></th>
				</tr>
				<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key;?><tr class="yirubianse gehangbianse">
					<td>
						<?php echo ($key); ?>
					</td>
					<td><a href="/database/index.php/Home/Index/tables/database/<?php echo ($databases[$v['databaseid']]['basename']); ?>"><?php echo ($databases[$v['databaseid']]['basename']); ?></a></td>
					<td>
						<a href="/database/index.php/Home/Index/tableinfo/database/<?php echo ($v["table_schema"]); ?>/table_name/<?php echo ($v["maintable"]); ?>"><?php echo ($v["maintable"]); ?></a>
					</td>
					<td>
						<?php echo ($v["mainfield"]); ?>
					</td>
					<td>
						<?php echo ($v["addendumtable"]); ?>
					</td>
					<td>
						<?php echo ($v["addendumfield"]); ?>
					</td>
					<td>
						<?php switch($v["type"]): case "1": ?>inner join<?php break;?>
							<?php case "2": ?>left join<?php break;?>
							<?php case "3": ?>right join<?php break; endswitch;?>
					</td>
					<td>
						<a href="/database/index.php/Home/Index/setnexus/id/<?php echo ($v["id"]); ?>/" class="btn btn-info btn-xs">编辑</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
		</div>
	</div>
	

		</div>
	</div>
	<script>
	$('#right').width($(document).width()-200-10);
</script>
</body>
</html>