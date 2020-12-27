function AJAXForm(eleid,otherdata)
{
	this.otherdata = '';//额外传输参数
	
    this.data = null;//通过元素获取的数据
	
	this.param = '';//最终参数（data,otherdata 的组合）
	
    this.type = "post";//请求方式(默认方式)
	
	this.url = window.location.href;//请求地址
	
	this.result = null;//返回的结果
	
	this.enctype = 'multipart/form-data';
	
	this.setotherdata  = function(otherdata){
		if(this.otherdata){
			this.otherdata = this.otherdata+'&'+$.param(otherdata);
		}else{
			this.otherdata = $.param(otherdata);
		}
		
	}
	
	if(otherdata){
		this.setotherdata(otherdata);
	}
	
    this.setele = function(eleid)
    {
        if(eleid)
        {
			if($(eleid).get(0).tagName == 'FORM'){
				var type = $.trim($(eleid).attr('method'));
				if(type){
					this.type = type;
				}
				
				var url = $.trim($(eleid).attr('action'));
				if(url){
					this.url = url;
				}
				
				var enctype = $.trim($(eleid).attr('enctype'));
				if(enctype){
					this.enctype = enctype;
				}
				var data = $(eleid).serialize();
				if(this.data){
					this.data = this.data + '&' + data;
				}else{
					this.data = data;
				}
			}else{
				var elebox = $(eleid),

				inputs = $(elebox).find('input').clone(false),

				textareas = $(elebox).find('textarea').clone(false),

				selects_from_ele = $(elebox).find('select'),

				_form = document.createElement('form');
				
				for(var i = 0; i<selects_from_ele.length; i++){
					var s = document.createElement('select');
					$(s).attr("name",$(selects_from_ele[i]).attr('name'));
					var op = document.createElement('option');
					$(op).attr('value', $(selects_from_ele[i]).val());
					$(op).attr('selected', 'selected');
					$(s).append(op);
					$(_form).append($(s));
				}
				
				$(_form).append(inputs);

				$(_form).append(textareas);
				
				var data = $(_form).serialize();
				if(this.data){
					this.data = this.data + '&' + data;
				}else{
					this.data = data;
				}
			}
            
        }
    }
    
    this.success = function(){};
	
	this.error = function(){};
    
    this.send = function(url,type,enctype)
    {
		this.param = this.data+'&'+ this.otherdata;
        if(!url) url = this.url;
        if(!enctype) enctype = this.enctype;
		if(!type) type = this.type;
        $.ajax({
            url:url,
            
            data:this.param,
            
            type:type,
			
			enctype: enctype,
            
            t:this,
            
            success:function(data)
            {
                this.t.result = data;
                
                this.t.success(data);
            },
			
			error:function(e){
				this.t.error(e);
			}
        });
    };
    
    if(eleid)
    {
        this.setele(eleid);
    }
    
}

