
$(document).ready(function () {
    $('#closeEventInfos').on('click',function () {
        $('#eventInfosContainer').html('');
        $('#eventInfos').hide();
    })
});

document.getElementById("map").style.height= document.documentElement.clientHeight+"px";
var styles = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":60}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"lightness":30}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#96de6b"},{"lightness":40}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#b6c54c"},{"lightness":40},{"saturation":-40}]},{}];


var map = null;
var image = '../img/icones/cursor_map.png';

function initMap() {

    // Create a new StyledMapType object, passing it the array of styles,
    // as well as the name to be displayed on the map type control.
    var styledMap = new google.maps.StyledMapType(styles,
        {name: "Styled Map"});

    // Create a map object, and include the MapTypeId to add
    // to the map type control.
    var mapOptions = {
        zoom: 11,
        center: new google.maps.LatLng(lat,lng),
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
    };
    map = new google.maps.Map(document.getElementById('map'),
        mapOptions);

    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');


    for ( i = 0 ; i < markers.length ; i++){
        latLng = new google.maps.LatLng(markers[i][0], markers[i][1]);
        var marker = new google.maps.Marker({
            position: latLng,
            title: markers[i][2],
            visible: true,
            icon: image
        });
        marker.set('eventId',markers[i][3]);
        marker.setMap(map);

        google.maps.event.addListener(marker, 'click', function() {
            loadEventInfos(this.get('eventId'));
        });
    }
}

function loadEventInfos(eventId)
{
    $.ajax({
        url: getEventInfosPath.replace('id',eventId),
        method: "POST"
    }).done(function(data) {
        $('#eventInfos').show();
        $('#eventInfosContainer').html(data);
    });
}
