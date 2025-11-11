//マップリンクごとの初期表示位置の設定

$(function(){
	var u = new VANTEC.Util();
	if (u.isMobile()){
		$(".mapType01").show();
		$(".mapType02").hide();
	} else {
		$(".mapType01").hide();
		$(".mapType02").show();
	}
});

var POINT02 ={
	all:{
		id: 'map_canvas_all',//マップの描画対象id
		lat: 40.828988,//緯度を定義
		lng: 138.744136,//経度を定義
		zlevel: 2//ズームレベルを定義
	}
};

var POINT ={
	america:{
		id: 'map_canvas_america',//マップの描画対象id
		lat: 37.090240,//緯度を定義
		lng: -95.712891,//経度を定義
		zlevel: 4//ズームレベルを定義
	},
	england:{
		id: 'map_canvas_england',
		lat: 54.244307,
		lng: -2.411133,
		zlevel: 5
	},
	russia:{
		id: 'map_canvas_russia',
		lat: 61.714563,
		lng: 101.321777,
		zlevel: 3
	},
	japan:{
		id: 'map_canvas_japan',
		lat: 38.520156,
		lng: 139.949707,
		zlevel: 5
	},
	china:{
		id: 'map_canvas_china',
		lat: 38.526460,
		lng: 103.409180,
		zlevel: 4
	},
	india:{
		id: 'map_canvas_india',
		lat: 21.212315,
		lng: 78.975586,
		zlevel: 5
	},
	thailand:{
		id: 'map_canvas_thailand',
		lat: 13.205088,
		lng: 102.596191,
		zlevel: 6
	},
	indonesia:{
		id: 'map_canvas_indonesia',
		lat: -1.793326,
		lng: 110.813965,
		zlevel: 5
	},
	netherlands:{
		id: 'map_canvas_netherlands',
		lat: 52.179815,
		lng: 2.962164,
		zlevel: 7
	},
	mexico:{
		id: 'map_canvas_mexico',
		lat: 24.021120,
		lng: -102.342773,
		zlevel: 5
	},
	philippines:{
		id: 'map_canvas_philippines',
		lat: 12.879721,
		lng: 121.774017,
		zlevel: 5
	},
	myanmar:{
		id: 'map_canvas_myanmar',
		lat: 21.916221,
		lng: 95.955974,
		zlevel: 5
	},
	australia:{
		id: 'map_canvas_australia',
		lat: -25.274398,
		lng: 133.775136,
		zlevel: 4
	},
	vietnam:{
		id: 'map_canvas_vietnam',
		lat: 16.348143,
		lng: 108.145363,
		zlevel: 6
	},
	czechRepublic:{
		id: 'map_canvas_czechRepublic',
		lat: 49.817492,
		lng: 15.472962,
		zlevel: 7
	},
	turkey:{
		id: 'map_canvas_turkey',
		lat: 38.963745,
		lng: 35.243322,
		zlevel: 5
	},
	hongKong:{
		id: 'map_canvas_hongKong',
		lat: 22.396428,
		lng: 114.109497,
		zlevel: 9
	},
	korea:{
		id: 'map_canvas_korea',
		lat: 35.907757,
		lng: 127.766922,
		zlevel: 6
	},
	malaysia:{
		id: 'map_canvas_malaysia',
		lat: 4.210484,
		lng: 101.975766,
		zlevel: 5
	},
	singapore:{
		id: 'map_canvas_singapore',
		lat: 1.352083,
		lng: 103.819836,
		zlevel: 8
	},
	taiwan:{
		id: 'map_canvas_taiwan',
		lat: 23.69781,
		lng: 120.960515,
		zlevel: 7
	}
};


var marker = [];
var infoWindow = [];

/*------------------------------------------------------
プラグイン
--------------------------------------------------------*/
$.fn.modalMap = function(id, lat, lng, zlevel) {


	var tiles = L.tileLayer( '//mt{s}.googleapis.com/vt?x={x}&y={y}&z={z}',{
		attribution: ' Map data &copy <a href="http://googlemaps.com" target="_blank">Google</a> ',
		subdomains: [ 0, 1, 2, 3 ],
		maxZoom: 18,
	});
	
	var map = L.map(id, {center: L.latLng(lat, lng), zoom: zlevel, layers: [tiles]});
	
	var markers = L.markerClusterGroup();

	var icon01 = L.icon({
		 iconUrl: '/japanese/network/img/marker.png',
		 iconSize: [27, 43],
		 popupAnchor: [0, -15]
	});
	var icon02 = L.icon({
		 iconUrl: '/japanese/network/img/marker02.png',
		 iconSize: [27, 43],
		 popupAnchor: [0, -15]
	});
			
	var windowWidth = $(window).width();
	var windowSm = 640;

	for (var j = 0; j < markerData.length; j++) {
		var area = markerData[j].area;
		var data = markerData[j].data;
		for (var d = 0; d < data.length; d++) {
			var name = data[d]['name'];
			var warehouse = data[d]['warehouse'];
			var address = data[d]['address'];
			var hpUrl = data[d]['hp_url'];
			var photo = data[d]['photo'];
			var group = data[d]['group'];
			var tel = data[d]['tel'];
			var lat = data[d]['lat'];
			var lng = data[d]['lng'];

			if((group == 'バンテックグループ')||(group == 'VANTEC Group')) {
				var marker = L.marker(new L.LatLng(lat, lng), {icon: icon01});
				var classType = "type01";
			} else if((group == '日立物流グループ')||(group == 'Hitachi Transport System Group')) {
				var marker = L.marker(new L.LatLng(lat, lng), {icon: icon02});
				var classType = "type02";
			}

			if (windowWidth <= windowSm) {
				if(!photo) {
					marker.bindPopup('<div class="infoBlock"><p class="subHeading">' + group + '</p><div class="heading02 '+ classType +'">' + name + '</div><div class="infoWrap"><div class="left"><span>' + warehouse + '</span><br>' + address + '<br>' + tel + '<br>' + '<a href="' + hpUrl + '" target="_blank">' + hpUrl + '</a></div></div></div>');
				} else {
					marker.bindPopup('<div class="infoBlock"><p class="subHeading">' + group + '</p><div class="heading02 '+ classType +'">' + name + '</div><div class="infoWrap"><div class="right"><img src="' + photo + '"></div><div class="left"><span>' + warehouse + '</span><br>' + address + '<br>' + tel + '<br>' + '<a href="' + hpUrl + '" target="_blank">' + hpUrl + '</a><br>' + '</div></div></div>');
				}
			} else {
				if(!photo) {
					marker.bindPopup('<div class="infoBlock"><p class="subHeading">' + group + '</p><div class="heading02 '+ classType +'">' + name + '</div><div class="infoWrap"><div class="left"><span>' + warehouse + '</span><br>' + address + '<br>' + tel + '<br>' + '<a href="' + hpUrl + '" target="_blank">' + hpUrl + '</a></div></div></div>',{minWidth:430,maxHeight:500});
				} else {
					marker.bindPopup('<div class="infoBlock"><p class="subHeading">' + group + '</p><div class="heading02 '+ classType +'">' + name + '</div><div class="infoWrap"><div class="right"><img src="' + photo + '"></div><div class="left"><span>' + warehouse + '</span><br>' + address + '<br>' + tel + '<br>' + '<a href="' + hpUrl + '" target="_blank">' + hpUrl + '</a><br>' + '</div></div></div>',{minWidth:430,maxHeight:500});
				}
			}
		
			markers.addLayer(marker);
		}
	}

	map.addLayer(markers);

};




/*------------------------------------------------------
モーダル表示
--------------------------------------------------------*/
$(function(){

var u = new VANTEC.Util();
if (u.isMobile()){
	$this = $(this);
	for (var i in POINT02){
		(function(i){
			
			var point = POINT02[i];
			$this.modalMap(point.id, point.lat, point.lng, point.zlevel);
			
		})(i);
	}
} else {
	for (var j = 0; j < markerData.length; j++) {
		var area = markerData[j].area;
		var data = markerData[j].data;
		var length = data.length;
	
		if(j < 9){
			modalNum = "0"+(j+1);
		} else {
			modalNum = j+1;
		}
	
		var $tooltip = $(".tooltip");
		$tooltip.find('a[href="#modalMap'+modalNum+'"]').find(".mapNum").html(data.length);
	
	
	}


	var $mapButton = $('.modalMapLink'),
	$this = $(this);
	
	//モーダルの表示
	var windowWidth = $(window).width();
	var windowSm = 640;

	
	//POINTに記載したエリアごとにツールチップ、地図を表示
	for (var i in POINT){
		(function(i){
			
			if (u.isMobile()) {
				/* -----------------------
				* SP時のモーダル
				------------------------ */
				step = 'modalMapLink button_' +  i;
				$('area').removeClass(step);
				$('area').removeAttr('href');
				$('.tip_' + i).click(function() {
					$('.tooltip').css("display","none");
					$('#tooltip_' + i).css({
						'display' : "block",
						'left' : "50%",
						//'top' : "50%",
						'top' : "0",
						'margin-left' : -75
					});
				})
				
				//クリックでモーダル上に地図を表示
				$('.button_' +  i).colorbox({
					inline: true,
					fixed: true,
					maxWidth: '100%',
					maxHeight: '100%',
					onComplete:function(){ //モーダルが表示された後に地図を生成
						var point = POINT[i];
						$this.modalMap(point.id, point.lat, point.lng, point.zlevel);
					}
				});
				
			} else if(u.isTablet()) {
				/* -----------------------
				* TB時
				------------------------ */
				//クリックでモーダル上に地図を表示
				$('.button_' +  i).colorbox({
					inline:true,
					fixed: true,
					innerWidth: '1100px',
					innerHeight: '740px',
					onComplete:function(){ //モーダルが表示された後に地図を生成
						var point = POINT[i];
						$this.modalMap(point.id, point.lat, point.lng, point.zlevel);
					}
				});
			} else {
				/* -----------------------
				* PC時のモーダル
				------------------------ */
				//hoverでツールチップを表示
				$('.tip_' + i).hover(
					function() {
						$('#' + 'tooltip_' + i).css("display","block");
						window.document.onmousemove =moveEvent;
						function moveEvent( evt ){
							moveEventValue = ( evt ) ? evt : window.event;
							moveObj= $('#tooltip_' + i).css({
								'left' : moveEventValue.offsetX-80,
								'top' : moveEventValue.offsetY-150
								//'left' : moveEventValue.pageX-80,
								//'top' : moveEventValue.pageY-150
							});
						}
					}, function() {
						$('#tooltip_' + i).css("display","none");
					}
				);
				
				//クリックでモーダル上に地図を表示
				$('.button_' +  i).colorbox({
					inline:true,
					fixed: true,
					innerWidth: '1100px',
					innerHeight: '740px',
					onComplete:function(){ //モーダルが表示された後に地図を生成
						var point = POINT[i];
						$this.modalMap(point.id, point.lat, point.lng, point.zlevel);
					}
				});
				
			}
			
		})(i);
	}
}



});
