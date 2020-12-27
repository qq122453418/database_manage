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
			数据库
		</div>
		<div class="panel-body">
			<form class="form-inline" id="jfldsahkfdas" method="post" action="/database/index.php/Home/Index/adddatabaseform">
				<div class="form-group">
					<label>名称</label>
					<input class="form-control" type="text" value="" name="basename" placeholder="数据库名称" />
					<input type="button" class="btn btn-info" value="添加" onclick="goForm('#jfldsahkfdas')" />
				</div>
			</form>
		</div>
		<div class="panel-body">
			<table class="table table-condensed table-hover table-bordered table-striped success">
				<tr>
					<th style="width:40px;">id</th>
					<th>名称</th>
					<th style="width:200px;">编辑</th>
					
				</tr>
				<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key;?><tr>
					<td><?php echo ($v["id"]); ?></td>
					<td>
						<input class="border_none" type="text" value="<?php echo ($v["basename"]); ?>" name="basename" readonly onclick="openInput(this)"/>
						<span class="btn btn-info btn-xs display_none" onclick="tjgg($(this).siblings('input'),{id:<?php echo ($v["id"]); ?>})">保存</span>
						<span class="btn btn-info btn-xs display_none" onclick="closeInput($(this).siblings('input'),true)">取消</span>
					</td>
					<td>
						<span href="/database/index.php/Home/Index/deletedatabase/id/<?php echo ($v["id"]); ?>" class="btn btn-danger btn-xs" onclick="getUrl(this)">删除</span>
						<a href="/database/index.php/Home/Index/showtables/id/<?php echo ($v["id"]); ?>" class="btn btn-info btn-xs">数据表</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
		</div>
	</div>
	<script>
		function tjgg(ele,data){
			var url = '/database/index.php/Home/Index/adddatabaseform';
			quickChange(ele,data,url);
		}
	</script>

		</div>
	</div>
	<script>
	$('#right').width($(document).width()-200-10);
</script>
</body>
</html>