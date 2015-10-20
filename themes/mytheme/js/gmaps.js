var map;
var markers = [];
function initMap() {
    
    var styles = [
        {
            stylers: [
              { hue: "#00ffe6" },
              { saturation: -20 }
            ]
        },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
              { lightness: 100 },
              { visibility: "simplified" }
            ]
        },{
            featureType: "road",
            elementType: "labels",
            stylers: [
              { visibility: "off" }
            ]
        }
    ];
    var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
   
    
    map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(-37.786334, 175.278580),
      zoom: 15,
      zoomControl: true,
      scaleControl: true,
      mapTypeControl: true,
      mapTypeControlOptions:{
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
            position: google.maps.ControlPosition.BOTTOM_LEFT
      },
      rotateControl: true,
      streetViewControl: false
    });
    map.setOptions({styles: styles});
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
    
    google.maps.event.addListener(map,'idle',function(){
        doAjax(getRangeArray(map.getBounds()));
    });
    google.maps.event.addListener(map,'zoom_changed',function(){
        doAjax(getRangeArray(map.getBounds()));
    });
    
}
//function doGetProperties(){
//    google.maps.event.addListener(map,'idle',function(){
//        doAjax(getRangeArray(map.getBounds()));
//    });
//}
function getRangeArray(bounds){
    var range_start = bounds.getNorthEast();
    var range_end = bounds.getSouthWest();
    var range = [range_start.lat(), range_start.lng(), range_end.lat(), range_end.lng()];
    return range;
}

function doAjax(range){
    $.ajax({
        url: 'map-view/doGetProperties',
        method: 'GET',
        data:{'range': range},
        success: function(data){
            //clear & del first
            clearMarkers();
            deleteMarkers();
            
            var jsonObj = $.parseJSON(data);
            var items = jsonObj.items;
            for(var i=0; i<items.length; i++){
                setMarker(items[i]);
            }
            //then add again
            showMarkers();
        },
        error: function(){
            alert('error');
        }

    });
}
function setMarker(property){
//    var marker = new google.maps.Marker({
//        position:{lat: parseFloat(property.Latitude), lng: parseFloat(property.Longitude)}
//    });
//    var marker = new CustomMarker(
//        {lat: parseFloat(property.Latitude), lng: parseFloat(property.Longitude)},
//        map,
//        null
//    );
    var marker = new RichMarker({
          position: new google.maps.LatLng(parseFloat(property.Latitude), parseFloat(property.Longitude)),
          flat: true,
          anchor: RichMarkerPosition.MIDDLE,
          content: '<div><img src="themes/mytheme/images/house.png" style="width:3rem;" /></div>'
    });
    google.maps.event.addListener(marker, 'click', function(event){
         $('.right-float-box').addClass('opened');
         //marker.setAnimation(google.maps.Animation.BOUNCE);
         $('.right-float-box').bind('click', function(){
                var float_box = $('.right-float-box');
                if(float_box.hasClass('opened')){
                    float_box.removeClass('opened');
                }
//                if(marker.getAnimation() !== null){
//                    marker.setAnimation(null);
//                }
         });
         setDrawerData(property);
    });
    markers.push(marker);

}



function setAllMarkers(map){
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function clearMarkers() {
    setAllMarkers(null);
}
function showMarkers() {
    setAllMarkers(map);
}
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

function setDrawerData(property){
    $('.property-address').html('Address: '+ property.Address);
    var status = property.Status == 0 ? 'OPEN' : 'SOLD';
    $('.property-status').html('Status: '+ status);
    //var count = property.BedRoomCount === 0 ? 'N/A' : 
    $('.property-bedroomcount').html('Bedroom: '+ (property.BedRoomCount==0? 'N/A' : property.BedRoomCount));
    $('.property-livingroomcount').html('Living Room: ' + (property.LivingRoomCount==0? 'N/A' : property.LivingRoomCount));
    $('.property-bathroomcount').html('Bathroom: '+ (property.BathRoomCount==0? 'N/A' : property.BathRoomCount));

}

google.maps.event.addDomListener(window, 'load', initMap);