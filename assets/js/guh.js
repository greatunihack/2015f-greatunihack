/**
 * Created by Sami Alabed on 09/09/15.
 */

(function () {
  function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var locationLatLon = new google.maps.LatLng(53.4622928, -2.2288835); //todo change to venue latln
    var mapOptions = {
      center: locationLatLon,
      zoom: 18, //18 when confirm venue
      mapTypeControl: true,
      scrollwheel: false,
      navigationControl: false,
      streetViewControl: false,
      draggable:false,
      disableDefaultUI: true,
      styles: [
        {"stylers": [{"hue": "#00AAFF"}]},
        {"featureType": "road", "elementType": "labels", "stylers": [{"visibility": "on"}]},
        {
          "featureType": "road", "elementType": "geometry", "stylers": [{"lightness": 100},
          {"visibility": "simplified"}]
        }]
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
      position: locationLatLon,
      map: map,
      title: 'GreatUniHack 2015'
    });
  }

  google.maps.event.addDomListener(window, 'load', initialize);

})();
