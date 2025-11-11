/* **************************************************

Name: header_sg_en.js

Description: JavaScript for Header

Create: 2014.07.23
Update: XXXX.XX.XX

Copyright 2014 Hitachi, Ltd.

***************************************************** */

(function($){

var hd = {
	"common"	: "http://www.hitachi.com/js/en/r1/hd_common.js",
	"search"	: "js/en/r1/hd_search_sg_en.js",
	"network"	: "http://www.hitachi.com/js/en/r1/hd_network.js",
	"products"	: "http://www.hitachi.com.sg/js/en/r1/hd_products_sg_en.js",
	"about"		: "http://www.hitachi.com.sg/js/en/r1/hd_about_sg_en.js"
}

var hd1 = '<script type="text/javascript" src="';
var hd2 = '" charset="utf-8"></script>';
$("head").append(hd1 + hd.search + hd2 + hd1 + hd.network + hd2 + hd1 + hd.products + hd2 + hd1 + hd.about + hd2 + hd1 + hd.common + hd2);

})(jQuery);
