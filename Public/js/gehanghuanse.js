/*工具，需要jquery的支持*/
function Gehanghuanse(){
    /*隔行变色: 需要在隔行变色元素中添加‘gehangbianse’类
     * param:颜色字符串,不限参数
	 * 示例 
		var a = new Gehanghuanse();
		a.gehangbianse('#aaa','#000');
     * */
    this.gehangbianse = function () {
        var gehangbianse_el = $('.gehangbianse').get();
        if (gehangbianse_el.length > 0) {
            if (arguments.length > 0) {
                var ai = 0;
                for (var i = 0; i < gehangbianse_el.length; i++) {
                    if (ai > arguments.length - 1) {
                        ai = 0;
                    }
                    $(gehangbianse_el[i]).css({backgroundColor: arguments[ai]});
                    ai++;
                }
            } else {
                var bgcolor = '#f5f5f5';
                for (var i = 0; i < gehangbianse_el.length; i++) {
                    if (i % 2 == 0) {
                        bgcolor = '#f5f5f5';
                    } else {
                        bgcolor = '#ffffff';
                    }
                    $(gehangbianse_el[i]).css({backgroundColor: bgcolor});
                }
            }
        }
    };
	
    /*鼠标移入变色: 需要在移入变色的元素中添加‘yirubianse’类
     * param:颜色字符串
	 * 示例 
		var a = new Gehanghuanse();
		a.yirubianse('#aaa');
     * */
    this.yirubianse = function (bgcolor) {
        if (!bgcolor) {
            bgcolor = '#efefef';
        }
        var ____yirubianse = {yuanbgcolor: null, changebgcolor: bgcolor};
        $('.yirubianse').mouseover(____yirubianse, function () {
            ____yirubianse.yuanbgcolor = $(this).css('backgroundColor');
            $(this).css({backgroundColor: ____yirubianse.changebgcolor});
        }).mouseout(____yirubianse,function(){
            if(____yirubianse.yuanbgcolor){
                $(this).css({backgroundColor: ____yirubianse.yuanbgcolor});
            }else{
                $(this).css({backgroundColor:false});
            }
        })
    };
}
