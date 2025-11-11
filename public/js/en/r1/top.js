/*********************************************
 * common.js
 * -------------------------------------------
 * @namespace
 * - VANTECTOP
 * @Util
 * @constructor
 * @module
 * - swapImg
 * @requires
 * - jquery.js
*********************************************/

var VANTECTOP = VANTECTOP || {};

/* -------------------------------------------
 * @Util
 * @constructor
------------------------------------------- */
VANTECTOP.Util = function(){
	this.ua = navigator.userAgent.toLowerCase();
	this.version = navigator.appVersion.toLowerCase();
	this.$w = $(window);
	this.$d = $(document);
	this.$h = $("html");
};

VANTECTOP.Util.prototype = {
	/*
	 * @method isMobile
	 * @return {Boolean} UAに["iphone","android, mobile"]が含まれるか
	 */
	isMobile: function(){
		var UA = {
			iPhone: this.ua.indexOf("iphone") != -1,
			AndroidMobile: this.ua.indexOf("android") != -1 && this.ua.indexOf("mobile") != -1,
		}
		return (UA.iPhone | UA.AndroidMobile) ? true : false;
	},
	/*
	 * @method isTablet
	 * @return {Boolean} UAに["ipad","android"]が含まれるか
	 */
	isTablet: function(){
		var UA = {
			iPad: this.ua.indexOf("ipad") != -1,
			Android: this.ua.indexOf("android") != -1 && this.ua.indexOf("mobile") == -1
		}
		return (UA.iPad | UA.Android) ? true : false;
	},
	/*
	 * @method isFontSizeCheck
	 * @param {Function} callback
	 * フォントサイズが変更したら　callback　を実行
	 */
	isFontSizeCheck: function(callback){
		var HTML_FS_WATCH = $('<div id="fontSizeWatcher">&nbsp;</div>'),
			CSS_OBJECT = {
				display: "block",
				visibility: "hidden",
				position: "absolute",
				top: "0",
				padding: "0"
			},
			$elm,
			interval = 500,
			currentSize = 0;
		
		// 監視用HTMLを生成する
		HTML_FS_WATCH.css(CSS_OBJECT).appendTo("body");
		$elm = $("#fontSizeWatcher");
		
		// 要素の高さを取得
		var getSize = function($elm){ return $elm.height(); };
		
		// 要素の高さを比較して、異なればcallbackを実行
		var fontSizeCheck = function(){
			var h = getSize($elm);
			
			if(h === currentSize){
				return false;
			} else {
				currentSize = h;
				callback();
			}
		};
		setInterval(fontSizeCheck, interval);
	},
	/*
	 * @method isWindowSizeCheck
	 * @param {Function} callback
	 * windowのリサイズ処理が完了したら　callback　を実行
	 */
	isWindowSizeCheck: function(callback){
		var resize = false,
				interval = 500;
		
		this.$w.bind("resize", function(){
			// リサイズされている間は、何もしない
			if(resize !== false){ clearTimeout(resize); }
			
			resize = setTimeout(function(){
				callback();
			}, interval);
		});
	}
};

/* -------------------------------------------
 * @module
------------------------------------------- */
VANTECTOP.module = function(){
	
	var u = new VANTECTOP.Util();
	
	return {
		/**
		 * @method initialize
		 * 初期化
		 */
		initialize: function(){
			$('#mainVisual .content .quickNews .newsWrapper .newsLinkBlock').addClass('bxslider');
			this.swapImg();
		},
		
		/*
		 * @method swapImg
		 * - ウィンドウ幅で画像切り替え
		 */
		swapImg: function(){
			/* vars
			------------------------------- */
			var $elm = $(".swap"),
				pcPrefixName = "pc_",
				spPrefixName = "sp_";

			if($elm.length == 0){
				return false;
			}
			
			/* function
			------------------------------- */
			var swap = function(img){
				
				/* width 640px以下で実行 */
				var windowWidth = $(window).width();
				var windowSm = 640;
				if (windowWidth <= windowSm) {
					
					img.attr("src", img.attr("src").replace(pcPrefixName, spPrefixName));
				} else {
					img.attr("src", img.attr("src").replace(spPrefixName, pcPrefixName));
				}
			};
			
			/* trigger
			------------------------------- */
			$elm.each(function(){
				var self = $(this);
				
				// ロード時
				u.$w.on("load", function(){
					swap(self);
				});
				// リサイズ時
				u.$w.on("orientationchange resize", function(){
					swap(self);
				});
			});
		}

	};
}();

$(function(){
	
	var u = new VANTECTOP.Util();
	VANTECTOP.module.initialize();
	
	/* -------------------------------------------
	 * @Mobile viewport
	 * for Mobile
	------------------------------------------- */ 
	if(u.isMobile()) {
		$("meta[name=viewport]").attr("content", "width=device-width,initial-scale=1,user-scalable=no");
	}
	/* -------------------------------------------
	 * @Tablet viewport
	 * for Tablet
	------------------------------------------- */ 
	if (u.isTablet()){
	}else{
		$("body").addClass("noTablet");
	}


	
});
$(window).load(function(){

	var u = new VANTECTOP.Util();
	
	$('.bxslider').bxSlider({
		auto: true,
		pager: false,
		pause: 7000,
		speed: 700,
		displaySlideQty: 1,
		moveSlideQty: 1,
		slideWidth: 834
	});

});

//スライダー
$(function(){
	$('#slideFade ul').bxSlider({
		mode: 'fade',
		auto: true,
		pager: true,
		controls: true,
		speed: 800,
		pause: 5000
	});
	
});


