<input type="hidden" name="data_num"
  value="<?php echo count ( $dataProvider->getData () ) ?>"
>
<?php

if (! function_exists ( 'stats_standard_deviation' )) {
	/**
	 * This user-land implementation follows the implementation quite strictly;
	 * it does not attempt to improve the code or algorithm in any way.
	 * It will
	 * raise a warning if you have fewer than 2 values in your array, just like
	 * the extension does (although as an E_USER_WARNING, not E_WARNING).
	 *
	 * @param array $a        	
	 * @param bool $sample
	 *        	[optional] Defaults to false
	 * @return float bool standard deviation or false on error.
	 */
	function stats_standard_deviation(array $a, $sample = false) {
		$n = count ( $a );
		if ($n === 0) {
			trigger_error ( "The array has zero elements", E_USER_WARNING );
			return false;
		}
		if ($sample && $n === 1) {
			trigger_error ( "The array has only 1 element", E_USER_WARNING );
			return false;
		}
		$mean = array_sum ( $a ) / $n;
		$carry = 0.0;
		foreach ( $a as $val ) {
			$d = (( double ) $val) - $mean;
			$carry += $d * $d;
		}
		;
		if ($sample) {
			-- $n;
		}
		return sqrt ( $carry / $n );
	}
}

for($i = 0; $i < count ( $dataProvider->getData () ); $i ++) {
	$place = $dataProvider->getData ()[$i];
	$array_lat [] = $place->map_lat;
	$array_lag [] = $place->map_lag;
	
	?>

<input type="hidden" name="lat[<?php echo $i ?>]"
  value="<?php echo $place->map_lat ?>"
>
<input type="hidden" name="lag[<?php echo $i ?>]"
  value="<?php echo $place->map_lag ?>"
>
<input type="hidden" name="name[<?php echo $i ?>]"
  value="<?php echo $place->name ?>"
>
<input type="hidden" name="description[<?php echo $i ?>]"
  value="<?php echo $place->description ?>"
>
<input type="hidden" name="id[<?php echo $i ?>]"
  value="<?php echo $place->id ?>"
>

<?php
}

$sum_lat = array_sum ( $array_lat );
$sum_lag = array_sum ( $array_lag );
$avg_lat = $sum_lat / sizeof ( $array_lat );
$avg_lag = $sum_lag / sizeof ( $array_lag );
$dev_lat = stats_standard_deviation ( $array_lat );
$dev_lag = stats_standard_deviation ( $array_lag );
$big_dev = ($dev_lat >= $dev_lag) ? $dev_lat : $dev_lag;

if ($big_dev == 0) {
	$zoom_temp = 14;
} else if ($big_dev < 0.1) {
	$zoom_temp = 12 - ( int ) ($big_dev * 50);
} else {
	$zoom_temp = 10 - ( int ) ($big_dev * 5);
}
$zoom_factor = ($zoom_temp > 0) ? $zoom_temp : 6;


?>
<input type="hidden" name="avg_lat" value="<?php echo $avg_lat ?>">
<input type="hidden" name="avg_lag" value="<?php echo $avg_lag ?>">
<input type="hidden" name="zoom_factor"
  value="<?php echo $zoom_factor ?>"
>

<script type="text/javascript">
  var map;
  var markers = new Array();
  var infowindows = new Array();

  var data_num = $("input[name='data_num']").val();
  var avg_lat = $("input[name='avg_lat']").val();
  var avg_lag = $("input[name='avg_lag']").val();
  var zoom_factor = Number($("input[name='zoom_factor']").val());
  
  var places = new Array();

  var iterator = 0;


  //GET MARKERS DATA FROM HIDDEN FORM
  for( var i = 0; i < data_num; i++){
    var place_lat = $("input[name='lat["+i+"]']").val();
    var place_lag = $("input[name='lag["+i+"]']").val();
    var place_name = $("input[name='name["+i+"]']").val();
    var place_description = $("input[name='description["+i+"]']").val();
    var place_id = $("input[name='id["+i+"]']").val();
    places.push(new Array(place_name, place_lat, place_lag, i, place_description, place_id));
  }


  function initialize() {

    var myCenter = new google.maps.LatLng(avg_lat, avg_lag);
    var mapOptions = {
      center : myCenter,
      zoom : zoom_factor,
      mapTypeId : google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"),
        mapOptions);


    drop();

    google.maps.event.addListener(map, 'click', function(event) {
        for (var i = 0; i < places.length; i++){
          (function(i){
            markers[i].setAnimation(null);
            infowindows[i].close();
          }(i));
        }        
    });
  }

    function drop() {
      for (var i = 0; i < places.length; i++) {
        setTimeout(function() {
          addMarker();
        }, i * 200);
      }
    }


  function addMarker() {
        var place = places[iterator];
        var placeLocation = new google.maps.LatLng(place[1], place[2]);
        var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
    	'<a href="/storybox/places/'+place[5]+'"><h4 id="firstHeading" class="firstHeading">'+place[0]+'</h4></a>'+
        '</div>'+
	        '<div id="bodyContent">'+
        	'<p>'+place[4]+'</p>'+
	        '</div>'+
        '</div>';

      markers.push(new google.maps.Marker({
          position : placeLocation,
          draggable: false,
          animation : google.maps.Animation.DROP,
          map : map,
          title : place[0],
          zIndex : place[3]
      }));

      infowindows.push(new google.maps.InfoWindow({
          content : contentString,
          maxWidth: 300
      }));

      (function(i) {
          console.log(i);
      google.maps.event.addListener(markers[i], 'click', (function() {          
          if (markers[i].getAnimation() != null) {
            infowindows[i].close(map, markers[i]);
            markers[i].setAnimation(null);
              } else {
                infowindows[i].open(map, markers[i]);
                markers[i].setAnimation(google.maps.Animation.BOUNCE);
              }
        }));
      }(iterator));
      iterator++;
    }
</script>

<div id="map_canvas" style="width: 100%; height: 300px"></div>
