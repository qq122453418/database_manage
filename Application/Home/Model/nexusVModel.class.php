<?php
namespace Home\Model;
use Think\Model\ViewModel;
class nexusVModel extends ViewModel{
	public $viewFields = array(
     'nexus'=>array('id' => 'a_id','field1id','table1id','field2id','table2id','_type' => 'inner'),
     'tables'=>array('id'=>'table1id','tablename'=>'tablename1', '_as' => 'tables1', '_on'=>'Blog.category_id=Category.id'),
     'User'=>array('name'=>'username', '_on'=>'Blog.user_id=User.id'),
   );
}
?>