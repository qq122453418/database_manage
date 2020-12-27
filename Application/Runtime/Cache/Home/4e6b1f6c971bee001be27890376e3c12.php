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
					<th>数据库<br />table_schema</th>
					<th>表明名称<br />table_name</th>
					<th>引擎<br />engine</th>
					<th>字符编码<br />table_collation</th>
					<th>注释<br />table_comment</th>
					<th style="width:200px;"></th>
				</tr>
				<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key;?><tr class="yirubianse gehangbianse">
					<td><a href="/database/index.php/Home/Index/tables/database/<?php echo ($v["table_schema"]); ?>"><?php echo ($v["table_schema"]); ?></a></td>
					<td>
						<a href="/database/index.php/Home/Index/tableinfo/database/<?php echo ($v["table_schema"]); ?>/table_name/<?php echo ($v["table_name"]); ?>"><?php echo ($v["table_name"]); ?></a>
					</td>
					<td>
						<?php echo ($v["engine"]); ?>
					</td>
					<td>
						<?php echo ($v["table_collation"]); ?>
					</td>
					<td>
						<?php echo ($v["table_comment"]); ?>
					</td>
					<td>
						<a href="/database/index.php/Home/Index/tableinfo/table_name/<?php echo ($v["table_name"]); ?>/database/<?php echo ($v["table_schema"]); ?>" class="btn btn-info btn-xs">详情</a>
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