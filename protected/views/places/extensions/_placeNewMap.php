<input type="hidden" name="data_num" value="<?php echo count ( $dataProvider->getData () ) ?>">
<?php


for($i = 0; $i < count ( $dataProvider->getData () ); $i ++) {
	$place = $dataProvider->getData ()[$i];
	$array_lat [] = $place->map_lat;
	$array_lag [] = $place->map_lag;
	
	
	?>

	<input type="hidden" name="lat[<?php echo $i ?>]" value="<?php echo $place->map_lat ?>">
	<input type="hidden" name="lag[<?php echo $i ?>]" value="<?php echo $place->map_lag ?>">
	<input type="hidden" name="name[<?php echo $i ?>]" value="<?php echo $place->name ?>">
	<input type="hidden" name="description[<?php echo $i ?>]" value="<?php echo $place->description ?>">
	
	<?php 
}

$sum_lat = array_sum ( $array_lat );
$sum_lag = array_sum ( $array_lag );
$avg_lat = $sum_lat / sizeof ( $array_lat );
$avg_lag = $sum_lag / sizeof ( $array_lag );


?>
<input type="hidden" name="avg_lat" value="<?php echo $avg_lat ?>">
<input type="hidden" name="avg_lag" value="<?php echo $avg_lag ?>">


<script type="text/javascript">
  var marker;
  var map;
  var markers = new Array();
  var infowindows = new Array();

  var data_num = $("input[name='data_num']").val();
  var avg_lat = $("input[name='avg_lat']").val();
  var avg_lag = $("input[name='avg_lag']").val();
  var beaches = new Array();

  function initialize() {
    var myCenter = new google.maps.LatLng(avg_lat, avg_lag);
    var mapOptions = {
      center : myCenter,
      zoom : 10,
      mapTypeId : google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"),
        mapOptions);

    setMarkers(map, beaches);
    google.maps.event.addListener(map, 'click', function(event) {
        for (var i = 0; i < beaches.length; i++){
          (function(i){
            markers[i].setAnimation(null);
            infowindows[i].close();
          }(i));
        }        
    });
  }

  for( var i = 0; i < data_num; i++){
	  var lat_sel = "map_lat["+i+"]";
    var map_lat = $("input[name='lat["+i+"]']").val();
    var map_lag = $("input[name='lag["+i+"]']").val();
    var map_name = $("input[name='name["+i+"]']").val();
    var map_description = $("input[name='description["+i+"]']").val();
    beaches[i] = Array(map_name, map_lat, map_lag, i, map_description);
  }
  //console.log(beaches);
  function setMarkers(map, locations) {
    // Add markers to the map   
    
    

    for (var i = 0; i < locations.length; i++) {
      (function(i) {

        var beach = locations[i];
        var myBeachLatLng = new google.maps.LatLng(beach[1], beach[2]);
        markers[i] = new google.maps.Marker({
          position : myBeachLatLng,
          animation : google.maps.Animation.DROP,
          map : map,
          title : beach[0],
          zIndex : beach[3]
        });
        
        infowindows[i] = new google.maps.InfoWindow({
          content : beach[0]
        });
        
        google.maps.event.addListener(markers[i], 'click', (function() {          
          if (markers[i].getAnimation() != null) {
            infowindows[i].close(map, markers[i]);
            markers[i].setAnimation(null);
              } else {
                infowindows[i].open(map, markers[i]);
                markers[i].setAnimation(google.maps.Animation.BOUNCE);
              }
        }));
         
      }(i));
    }
  }

</script>

<div id="map_canvas" style="width: 100%; height: 300px"></div>
