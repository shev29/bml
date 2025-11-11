//マップリンクごとの初期表示位置の設定
var POINT ={
	indonesia:{
		id: 'map_canvas_indonesia',
		lat: -1.793326,
		lng: 110.813965,
		zlevel: 5
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
		 iconUrl: 'image/marker.png',
		 iconSize: [27, 43],
		 popupAnchor: [0, -15]
	});
	var icon02 = L.icon({
		 iconUrl: 'image/marker.png',
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


	$this = $(this);


	//POINTに記載したエリアごとにツールチップ、地図を表示
	for (var i in POINT){
		(function(i){

			var point = POINT[i];
			$this.modalMap(point.id, point.lat, point.lng, point.zlevel);

		})(i);
	}

});
