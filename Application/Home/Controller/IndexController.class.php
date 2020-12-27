<?php
namespace Home\Controller;
class IndexController extends C {
    public function index(){
		$basename = I('basename','','trim');
		$sql = "select table_schema from information_schema.tables where table_schema LIKE  '%{$basename}%' group by table_schema ";
		//$sql = "show databases like '%{$basename}%'";
		$list = D() -> query($sql);
		$this -> assign('list', $list);
        $this -> display();
    }
	//数据表
	public function tables(){
		$databasename = I('get.database','','trim');
		
		if(!$databasename){
			$this -> error('找不到该数据库');
		}
		$db = D();
		$sql = "SHOW DATABASES LIKE '{$databasename}'";
		$a = $db -> query($sql);
		if(!$a){
			$this -> error('数据库不存在');
		}
		$sql = "select * from information_schema.tables where table_schema='{$databasename}'";
		
		$list = $db -> query($sql);
		
		if(!$list){
			$this -> error('数据库中没有表信息');
		}else{
			$this -> assign('list',$list);
			$this -> display();
		}
		
	}
	function tableinfo(){
		$table_name = I('get.table_name','','trim');
		$database = I('get.database','','trim');
		$sql = "select * from information_schema.columns where table_schema = '{$database}' and table_name = '{$table_name}'";
		$list = D() -> query($sql);
		$this -> assign('list', $list);
		$this -> display();
	}
	
	
	/**设置数据库关系**/
	
	//数据库
	public function adddatabase(){
		$list = D('databases') -> order('id') -> select();
		
		$this -> assign('list',$list);
		$this -> display();
	}
	
	//添加、编辑 数据库接口
	public function adddatabaseform(){
		$id = I('post.id','','intval');
		$db = D('databases');
		
		$db -> create();
		if(!$db -> basename){
			$this -> error('名称不能为空');
		}
		if(strlen($id) > 0){
			$a = $db -> save();
		}else{
			$a = $db -> add();
		}
		if($a){
			$this -> success('操作成功');
		}else{
			$this -> error('操作失败');
		}
	}
	
	//删除数据库接口
	public function deletedatabase(){
		$id = I('get.id',null,'trim');
		
		if($id){
			$db = D();
			$a = $db -> table('__DATABASES__') -> delete($id);
			$b = $db -> table('__NEXUS__') -> where(array('databaseid' => $id)) -> delete();
			$c = $db -> table('__TABLES__') -> where(array('databaseid' => $id)) -> delete();
			if($a){
				$this -> success('操作成功');
			}else{
				$this -> error('操作失败');
			}
		}
	}
	
	/*
		查看数据表
	*/
	public function showtables(){
		$databaseid = I('id','','intval');
		$databasename = D('__databases__') -> where(array('id' => $databaseid)) -> getField('basename');
		
		if(!$databasename){
			$this -> error('访问的数据库不存才');
		}
		
		$sql = "select * from information_schema.tables a left join admindatabase.tables b on a.table_name = b.tablename left join admindatabase.databases c on a.table_schema = c.basename where a.table_schema='{$databasename}'";
		
		//"select * from admindatabase.databases a right join "
		
		$list = D() -> query($sql);
		if($list == false){
			$this -> error('数据库不存在');
		}
		//print_r($list);
		$this -> assign('list', $list);
		$this -> assign('databaseid',$databaseid);
		$this -> display();
	}
	
	//设置表字段的别名前缀
	public function setfieldaliasprefixdata(){
		$databaseid = I('databaseid', 0, 'intval');
		$tablename = I('tablename', null, 'trim');
		$where = array(
			'databaseid' => $databaseid,
			'tablename' => $tablename
		);
		$db = D('tables');
		$a = $db -> where($where) -> count();
		$db -> create();
		if($a){
			$b = $db -> where($where) -> save();
		}else{
			$b = $db -> where($where) -> add();
		}
		if($b){
			$this -> success('操作成功');
		}else{
			$this -> error('操作失败');
		}
	}
	
	/*
		表关系列表
	*/
	public function nexus(){
		$list = D('nexus') -> select();
		$databases = D('databases') -> select();
		$databases = array_reset_key($databases,'id');
		$this -> assign('list', $list);
		$this -> assign('databases', $databases);
		$this -> display();
	}
	
	/*
		设置表关系
	*/
	public function setnexus(){
		$nexusid = I('id','','intval');
		$db = D();
		if($nexusid){
			$info = $db -> table('__NEXUS__') -> where(array('id' => $nexusid)) -> find();
		}else{
			$databaseid = I('databaseid',null,'intval');
			$maintable = I('maintable', '', 'trim');
			$info['databaseid'] = $databaseid;
			$info['maintable'] = $maintable;
		}
		$this -> assign('info', $info);
		$this -> display();
	}
	
	/*
		设置表关系数据处理
	*/
	public function setnexusform(){
		
		if(IS_POST){
			$nexusid = I('post.id',null,'trim,intval');
			$db = D('nexus');
			$data = $db -> create();
			
			if(!$data['databaseid']){
				$this -> error('非法操作');
			}
			if(!$data['maintable']){
				$this -> error('主表不能为空');
			}
			if(!$data['mainfield']){
				$this -> error('主表外键不能为空');
			}
			if(!$data['addendumtable']){
				$this -> error('关联表不能为空');
			}
			if(!$data['addendumfield']){
				$this -> error('关联表字段不能为空');
			}
			if(!$data['type']){
				$this -> error('关联类型不能为空');
			}
			
			if($nexusid){
				$a = $db -> where(array('id' => $nexusid)) -> save();
			}else{
				if($db -> where(array('databaseid' => $db -> databaseid,'maintable' => $db -> maintable, 'addendumtable' => $db -> addendumtable)) -> count()){
					$this -> error('该表已进行了关联，请直接设置');
				}
				$a = $db -> add();
			}
			if($a){
				$this -> success('操做成功');
			}else{
				$this -> error('操作失败');
			}
		}
	}
	
	
	/**/
	
	
}