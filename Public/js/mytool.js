function goForm(eleid,otherdata,url,go)
{
	if($.type(go) === 'undefined'){
		go = true;
	}
	var a = new AJAXForm(eleid,otherdata);
	if(url){
		a.url = url;
	}
	a.success = function(){
		//console.log(a.result);return;
		if(a.result.status){
			
			alert(a.result.info);
			if(go)
			window.location.href=a.result.url;
		}else{
			alert(a.result.info);
		}
	};
	a.error = function(){
		alert('未知错误');
	};
	a.send();
}

function getUrl(eleid,otherdata)
{
	var url = $(eleid).attr('href');
	goForm(null,otherdata,url);
}


///////////////////////////////////////////////////////////////////////////////
/*
	快速修改
*/

function quickChange(ele,otherdata,url){
	var a = new AJAXForm($(ele).parent(),otherdata);
	a.url = url;
	a.success = function(result){
		alert(result.info);
		if(result.status){
			closeInput(ele);
		}
	}
	a.error = function(){
		alert('位置错误');
	}
	a.send();
	
}

/*
	打开input表单域
*/
function openInput(ele){
	
	if($(ele).siblings('.btn').css('display') == 'none'){
		//创建一个隐藏元素，保存初始值，以便关闭的时候能够回到初始值
		$(ele).parent().append('<span style="display:none;" class="jgfdopweripewkfdsjhg">'+$(ele).val()+'</span>');
		$(ele).removeClass('border_none').removeAttr('readonly');
		$(ele).siblings('.btn').removeClass('display_none');
	}
	
}

/*
	关闭input表单域
*/
function closeInput(ele,ref){
	if(ref){
		$(ele).val($(ele).siblings('.jgfdopweripewkfdsjhg').text());
	}
	$(ele).siblings('.jgfdopweripewkfdsjhg').remove();
	$(ele).addClass('border_none').attr('readonly',true);
	$(ele).siblings('.btn').addClass('display_none');
}


$(function(){
	//各行变色
	var ghhs = new Gehanghuanse();
	ghhs.gehangbianse('#f0f0f0','#fff');
	ghhs.yirubianse('#d8d8d8');
})