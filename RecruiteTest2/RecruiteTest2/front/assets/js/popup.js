/**
* @class
* 팝업을 호출을 편하고 레이어 팝업 호출과 일반 팝업 호출을 같이 사용하도록 하기 위하여  만듬
*
* @example
* 호출 type : layer 입력시 레이어 호출, 'browser' 일반 팝업창, 기본 browser
* var opts  = {'url' : 'index.html', 'width' : '600px', 'height' : '500px', 'left': '100px' , 'top' : '300px', 'type' : 'layer' };
* $.popup(opts);
*
* $('.layerpopup').popup(opts);
*
* @name jsyang.popup.sde.js
* @author JsYang <yakuyaku@gmail.com>
* @since 2010년 2월 19일 금요일
* @version 1.0
*/

(function($){

$.fn.popup = function(options) {

    var popup,popup_options;
    var $this = $(this);
    var opts  = $.extend({},$.fn.popup.defaults, options);

    if(opts.center) {
        opts.top  = $(window).height()/2- opts.height.replace('px','')/2;
        opts.left = $(window).width()/2 - opts.width.replace('px','')/2;
    }

    //popup options , layer , borwser
    if( opts.type == 'browser' ) {
        popup_options = "width=" + opts.width + ",height=" + opts.height;
        popup_options += ",left=" + opts.left + ",top=" + opts.top;
        popup_options += ",scrollbars="  + opts.scrollbars  + ",toolbar=" + opts.toolbar + ",menubars=" + opts.menubars;
        popup_options += ",locationbar=" + opts.locationbar + ",statusbar=" + opts.statusbar;
        popup_options += ",resizable="   + opts.resizable ;
        popup_options += ",titlebar=" + opts.titlebar;
    } else {
    	
        popup =  $("<div class='"+ opts.name + "'></div>").css({
            'display' : 'none',
            'position': 'absolute' ,
            'z-index' : '100000' ,
            'width'   :  opts.width,
            'height'  :  opts.height,
            'left'    :  opts.left,
            'top'     :  opts.top
        });

        var popIframe = $("<iframe src='" + opts.url +  "' width='100%' height='100%' marginwidth='0' marginheight='0' frameborder='0' scrolling='no' ></iframe>");
        popup.append(popIframe);
        $("body").prepend(popup);

    }

    var methods = {
        'open' : function() {
            if( opts.type == 'browser' )
            {
                popup = window.open(opts.url,opts.name,popup_options);
                if(!popup) {
                    alert(opts.message);
                    return false;
                }else {
                    popup.focus();
                }
            } else {
                popup.show();
           }
        },
        'close' : function() {
            if( opts.type == 'browser' ) {
                popup.close();
            } else {
				popup.hide();
            }
        },
        'getPopup' : function() {
            return pupup;
        }
    }

    // Click Event .
    if( $this.length > 0 ) {
		$this.css('cursor','pointer');
        $this.click(function(e){
            methods.open();
			e.preventDefault();
        });
    } else {
        methods.open();
    }

    return methods;
}


$.fn.popup.defaults = {
    'url'    : 'index.html' ,
    'type'   : 'browser'   ,
    'name'   : 'popup' ,
    'width'  : '300px' ,
    'height' : '300px' ,
    'scrollbars' : 'yes' ,
    'toolbar' : 'no'    ,
    'menubars' : 'no'   ,
    'locationbar' : 'no'  ,
    'statusbar'   : 'no'  ,
    'resizable'   : 'no' ,
    'titlebar'    : 'no'  ,
    'left'    : '0px'  ,
    'top'     : '0px'  ,
    'message' : '팝업차단을 해제해주세요.'  ,
    'center'  : true
};

$.extend({
    popup : function (options) {
        return $.fn.popup(options);
    }
});

})(jQuery);