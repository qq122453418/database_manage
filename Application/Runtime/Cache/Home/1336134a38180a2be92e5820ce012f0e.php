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
			
	<div class="clearfix panel panel-default">
		<div class="panel-heading">
			设置表关系 <a href="javascript:window.history.back(-1)">返回</a>
		</div>
		<div class="panel-body">
			<form id="jfldsahkfdas" class="form-horizontal" action="/database/index.php/Home/Index/setnexusform" method="post">
				<?php if(!empty($info["id"])): ?><input type="hidden" value="<?php echo ($info["id"]); ?>" name="id" /><?php endif; ?>
				<input type="hidden" value="<?php echo ($info["databaseid"]); ?>" name="databaseid" />
				<div class="form-group">
					<label class="col-xs-2 control-label">主表</label>
					<div class="col-xs-10">
						<input class="form-control" name="maintable" type="text" value="<?php echo ($info["maintable"]); ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">主表外键字段</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="mainfield" value="<?php echo ($info["mainfield"]); ?>" />
						<p class="help-block">多个字段用 ',' 分隔</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">关联表</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="addendumtable" value="<?php echo ($info["addendumtable"]); ?>" />
						<p class="help-block"></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">关联表字段</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="addendumfield" value="<?php echo ($info["addendumfield"]); ?>" />
						<p class="help-block">多个字段用 ',' 分隔</p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-2 control-label">关联类型</label>
					<div class="col-xs-4">
						<select class="form-control" name="type">
							<option value="1"<?php if(($info["type"]) == "1"): ?>selected<?php endif; ?>>inner join</option>
							<option value="2"<?php if(($info["type"]) == "2"): ?>selected<?php endif; ?>>left join</option>
							<option value="3"<?php if(($info["type"]) == "3"): ?>selected<?php endif; ?>>right join</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-2"></label>
					<div class="col-xs-10">
						<input type="button" class="btn btn-primary" value="提交" onclick="goForm('#jfldsahkfdas')" />
					</div>
				</div>
				
			</form>
		</div>
	</div>
	

		</div>
	</div>
	<script>
	$('#right').width($(document).width()-200-10);
</script>
</body>
</html>