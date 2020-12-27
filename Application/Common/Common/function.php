<?php
function md_password($str){
	return md5(md5($str));
}

/*用户积分明细记录*/
function record_jfmx($a = array()){
	$yunxu_param = array('shjid','uid','shz','shj','cz','bzh');
	$data=array();
	foreach($yunxu_param as $v){
	  if(isset($a[$v])){
		  $data[$v] = $a[$v];
	  }
	}
	if($data){
		$m = D('hyjfmx');
		
		$m -> create($data);
		
		$m -> add();
	}

  
}

//增加用户积分
function addyhjf($uid,$shjid,$jf){
	$map = array(
		'uid' => $uid,
		'shjid' => $shjid
	);
	$m = m('hyjf');
	$a = $m -> where($map) -> count();
	
	$data['uid'] = $uid;
	$data['shjid'] = $shjid;
	$data['jfz'] = $jf;
	
	if($a){
		$m -> where($map) -> setInc('jfz', $jf);
		//exit;
	}else{
		$m -> where($map) -> add($data);
	}
}

/*
	获取商家需要交纳的费用
	参数：商家id
	return：数组
*/
function get_shjkf($id){//
	$total = D('shjdjf') -> where(array('shjid' => $id)) -> sum('je');
	if(!$total) $total = 0;
	$arr = D('shjdjf') -> where(array('shjid' => $id)) -> select();
	
	$a = array(
		'list' => $arr,
		'total' => $total //待缴费总额
	);
	return $a;
}

/*
	根据点数计算可提现金额
*/
function jstxje($zje,$dsh){
	if($dsh <= 0 || $zje <=0){
		return 0;
	}
	$dsh = $dsh/100;
	$a = $zje - $zje*$dsh;
	return $a;
}


/*商家收支记录*/
function record_shzhi($a = array()){
	$yunxu_param = array('shjid','shz','shj','cz','bzh');
	$data=array();
	foreach($yunxu_param as $v){
	  if(isset($a[$v])){
		  $data[$v] = $a[$v];
	  }
	}
	if($data){
		$m = D('shjszmx');
		
		$m -> create($data);
		
		$m -> add();
	}

  
}

/*生成订单编标*/
function create_order_code(){
	return str_replace(array('.',' '),'',microtime()) . mt_rand(10000,90000);
}

/*
	上传函数
	$c:数组
	return:返回上传信息数组
*/
function upload($c=array()){
	$rootpath = realpath('./') . '/imgdata/';
	$savepath = '';
	$config = array(
		'maxSize'    =>    3145728,
		'rootPath'   =>    $rootpath,
		'savePath'   =>    $savepath,
		'saveName'   =>    array('uniqid',''),
		'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
		'autoSub'    =>    false,
		'subName'    =>    array('date','Ymd'),
	);
	
	$config = array_merge($config, $c);
	//print_r($config);exit;
	$upload = new \Think\Upload($config);// 实例化上传类
	
	$upinfo = $upload -> upload();
	
	if(!$upinfo){
		return array('error' => $upload -> getError());
	}else{
		return $upinfo;
	}
}

/*
	集合上传函数
	
	return:返回成功上传的数组
*/
function assemble_upload($inputname,$savepath=''){
	$rootpath = realpath('./') . '/imgdata/';
	
	$upload = new AssembleUpload($inputname);// 实例化上传类
	
	$upload -> set_size_max(3145728);
	$upload -> set_save_root($rootpath);
	$upload -> set_save_path($savepath);
	$upinfo = $upload -> upload();
	//echo $upload -> get_errornum();
	return $upload -> get_data();
}

/*
	单文件上传函数
	
	return:返回成功上传的数组
*/
function one_upload($inputname,$savepath=''){
	$rootpath = realpath('./') . '/imgdata/';
	
	$upload = new Upload($inputname);// 实例化上传类
	
	$upload -> set_size_max(3145728);
	$upload -> set_save_root($rootpath);
	$upload -> set_save_path($savepath);
	$upinfo = $upload -> upload();
	
	if($upinfo){
		return $upload;
	}else{
		
		return false;
	}
	
}



/*指定获取表单变量*/
function get_post_variant($yunxu_param=array(),$default=null,$filter=null){
	$data = array();
	foreach($yunxu_param as $v){
		$data[$v] = I('post.'.$v, null, $filter);
	}
	return $data;
}


//去除字符串的tags、两端空格
/*
$strs:数组  返回数组
$strs:字符串 返回字符串
*/
function untags($strs){
	if(is_array($strs)){
		foreach($strs as $k=>$v){
			$strs[$k]=trim(strip_tags($v));
		}
	}else{
		$strs=trim(strip_tags($strs));
	}
	return $strs;
}

/*检查是否开启魔术引号，并作相应处理*
$value:字符串、数组
*/
function stripslashes_deep($value){
	if(get_magic_quotes_gpc()){
		$value = is_array($value)?array_map('stripslashes_deep', $value):stripslashes($value);
	}
	return $value;
}

/*
去除特殊字符（字母、数字、汉字以外字符）
$strs:数组  返回数组
$strs:字符串 返回字符串
*/
function special_char($strs){
	$arr_code = array('~', '!', '@', '#', '$', '%', '^', '&', '*', '_', '+', '|', '-', '=', '\\','{', '}', '[', ']', ':', ';', '"', '\'', '<', '>', ',', '.', '?', '/', '“', '”','’', '‘', '【', '】', '~', '！', '￥', '……', '——', '、', '《', '》', '。',PHP_EOL, chr(10), chr(13), "\t", chr(32));
	if(is_array($strs)){
		foreach($strs as $k=>$v){
			$strs[$k]=str_replace($arr_code,'',$v);
		}
	}else{
		$strs=str_replace($arr_code,'',$strs);
	}
	return $strs;
}
//将二维数组转换为一维数组(主要用于select取出的数据)
/*
$arr:要处理的二维数组
$field1:第二维数组的键值，它的值将作为新数组的值
$field2:第二维数组的键值，它的值将作为新数组的键（可选）
*/
function array_transform($arr,$field1,$field2=null){
	$newarr=array();
	if(!$field2){
		foreach($arr as $v){
			$newarr[]=$v[$field1];
		}
	}else{
		foreach($arr as $v){
			$newarr[$v[$field2]]=$v[$field1];
		}
	}
	return $newarr;
}

//重新设置数组的键值(主要用于select取出的数据)
/*
$arr:要处理的二维数组
$field:第二维数组的键值，它的值将作为第一维数组的键
*/
function array_reset_key($arr,$field){
	$newarr=array();
	foreach($arr as $v){
		$newarr[$v[$field]]=$v;
	}
	return $newarr;
}

//将无限分类数据进行等级分组
/*
$arr:要处理的二维数组(select去除的数据)
$parent_field:表示上一级别的字段，例如：表示 父id 的字段
return：返回包涵同等级分类的二维数组
*/
function grade_group($arr,$parent_field){
	$newarr=array();
	foreach($arr as $v){
		if($v[$parent_field]!=''&&$v[$parent_field]!=null){
			if(!isset($newarr[$v[$parent_field]])){
				$newarr[$v[$parent_field]]=array();
			}
			array_push($newarr[$v[$parent_field]],$v);
		}
	}
	return $newarr;
}

/*
多行文本域提交的属性信息转换为数组
*/
function shx_to_array($str){
	$shx_arr = explode(PHP_EOL, $str);
	
	$data = array();
	$shx = array();
	$i = 0;
	foreach($shx_arr as $v){
		$v = trim(str_replace('：', ':', $v), "\r\n:");
		if($v){
			$al = strpos($v, ':');
			//var_dump(strstr($v, ':'));
			if($al && $al > 0){
				$data[$i]['column'] = trim(strstr($v, ':', true),':');
				$data[$i]['value'] = trim(strstr($v, ':'), ':');
			}else{
				$data[$i]['column'] = trim($v, ':');
				$data[$i]['value'] = '';
			}
			$i += 1;
		}
	}
	return $data;
}

/*
多行文本域提交的属性信息转换为json
*/
function shx_to_json($str){
	$data = shx_to_array($str);
	$data = json_encode($data);
	return $data;
}


/*
将优惠活动属性数据转为多行文本域形式
每行一条属性，属性名、值用':'分割
*/
function shx_to_textarea($json){
	$arr = json_decode($json, true);
	$str_arr = array();
	$str = "";
	if(is_array($arr)){
		
		foreach($arr as $v){
			$str[] = $v['column'] . ':' . $v['value'];
		}
		$str = implode("\r\n", $str);
	}else{
		$str = $arr;
	}
	return $str;
}

/*
将优惠活动属性数据转为多行显示，属性名、值用':'分割。
*/
function shx_to_rows($json, $hhf = "<br />"){
	$arr = json_decode($json, true);
	$str_arr = array();
	$str = "";
	if(is_array($arr)){
		foreach($arr as $v){
			$str[] = $v['column'] . ':' . $v['value'];
		}
		$str = implode($hhf, $str);
	}else{
		$str = $arr;
	}
	return $str;
}

/*
	将数组的值转换成int类型
*/
function arr_value_to_int($arr){
	foreach($arr as $k => $v){
		$arr[$k] = intval($v);
	}
	return $arr;
}

/*
	将数组的值转换成大写
*/
function arr_value_to_upper($arr){
	foreach($arr as $k => $v){
		$arr[$k] = strtoupper($v);
	}
	return $arr;
}


function excel_insert(array $data,$file,$tableheader=array()){

//    $data = [
//        '库房'=>[
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//        ],
//        '库房2'=>[
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//            ['库房编号','库房名词',1],
//        ],
//    ];
//    excel_insert($data,'s.xlsx');

    if(!$data||!$file){
		
        return false;
    }

    $sheet_id = 0;
    //创建excel操作对象
    $objPHPExcel = new PHPExcel();
    //获得文件属性对象，给下文提供设置资源
    $objPHPExcel->getProperties()->setCreator("")
        ->setLastModifiedBy("")
        ->setTitle("")
        ->setSubject("")
        ->setDescription("")
        ->setKeywords("")
        ->setCategory("");
    for($i=1;$i<count($data);$i++){
        $objPHPExcel->addSheet(new PHPExcel_Worksheet($objPHPExcel,'sheet'.$i));
    }
    foreach($data as $sheetName => $sheetData){
        $Sheet = $objPHPExcel->setActiveSheetIndex($sheet_id);
        $Sheet->setTitle($sheetName);
        $insert_id = 1;
		
		if($tableheader && is_array($tableheader)){
			
			//填充表头信息
			for($i = 0;$i < count($tableheader);$i++) {
				$Sheet->setCellValue(chr(65+$i).$insert_id,$tableheader[$i]);
			}
			$insert_id++;
		}
		
        foreach($sheetData as $rowData){
            if(is_array($rowData)&&$rowData){
				$j = 0;
                foreach($rowData as $id => $cellData){
                   // if(is_numeric($id)&&(is_string($cellData)||is_numeric($cellData))){
                        //$Sheet->setCellValue(chr(65+$id).$insert_id,$cellData);
                        $Sheet->setCellValue(chr(65+$j).$insert_id,$cellData);
						$j++;
                    //}else{
						
                    //    return false;
						
                   // }
                }
                $insert_id++;
            }else{
                return false;
            }
        }
        $sheet_id++;
    }
    try{
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);
    }catch (Exception $e){
		
        return false;
    }
}

/*
	下载并删除源文件
	$filePath:提供下载的文件
	$fileName:下载的文件时的保存名称
	
*/
function download($filePath, $fileName=''){
	if(!$filePath || !file_exists($filePath) || is_dir($filePath)){
		return false;
	}
	if(!$fileName){
		$fileName = time().mt_rand(0,10000).strrchr($filePath);
	}
	  
	$fp=fopen($filePath,"r");   
	$file_size=filesize($filePath);   
	//下载文件需要用到的头   
	Header("Content-type: application/octet-stream");   
	Header("Accept-Ranges: bytes");   
	Header("Accept-Length:".$file_size);   
	Header("Content-Disposition: attachment; filename=".$fileName);   
	$buffer=1024;  //设置一次读取的字节数，每读取一次，就输出数据（即返回给浏览器）  
	$file_count=0; //读取的总字节数  
	//向浏览器返回数据   
	while(!feof($fp) && $file_count<$file_size){   
	$file_con=fread($fp,$buffer);   
	$file_count+=$buffer;   
	echo $file_con;   
	}   
	fclose($fp);  
	  
	//下载完成后删除压缩包，临时文件夹  
	if($file_count >= $file_size)  
	{  
		unlink($filePath); 
	} 
}

//分页
function page($total, $pa="", $listRows=25 ){
	$page = new Mypage($total, $listRows, $pa);
	//var_dump($page);exit;
	$info = $page -> get_page_info();
	
	return $info;
}

//筛选参数过滤（过滤掉无数据的参数）
function guolvcsh($pa){
	$arr = array();
	foreach($pa as $k => $v){
		if(mb_strlen($v,'utf-8')){
			$arr[$k] = $v;
		}
	}
	return $arr;
}

//组合刷选参数
function createmap($arr,$gdcs=null){
	$par = guolvcsh($_GET);
	$map = array();
	foreach($par as $k => $v){
		if(!array_key_exists($k,$arr)){
			continue;
		}
		$a = explode('|',$arr[$k]);
		if(strtolower($a[0]) == 'like'){
			if(isset($a[1]) && function_exists($a[1])){
				$map[$k] = array($a[0], '%'.$a[1]($v).'%');
			}else{
				$map[$k] = array($a[0], '%'.$v.'%');
			}
		}else{
			if(isset($a[1]) && function_exists($a[1])){
				$map[$k] = array($a[0], $a[1]($v));
			}else{
				$map[$k] = array($a[0], $v);
			}
		}
	}
	//print_r($par);
	if($gdcs){
		return array($map,$gdcs);
	}else{
		return $map;
	}
}

//组合区间查询参数
function createmap_qj($start,$end,$func=null){
	$map = array();
	$a = 0;
	$s = I('get.'.$start);
	$e = I('get.'.$end);
	if(strlen($s)){
		$a += 1;
		$func ? $s = $func($s) : '';
	}
	if(strlen($e)){
		$a += 2;
		$func ? $e = $func($e) : '';
		
	}
	if($a == 1){
		$map = array('EGT',$s);
	}
	if($a == 2){
		$map = array('ELT',$e);
	}
	if($a == 3){
		$map = array(array('EGT',$s),array('ELT',$e));
	}
	return $map;
}

?>