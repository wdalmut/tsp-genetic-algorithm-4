<?php
require_once __DIR__ . '/vendor/autoload.php';

use Gen\Point;
use Gen\Place;
use Gen\Life;
use Gen\Roadmap;
use Gen\Mutation;
use Gen\Recombination;

$roadmap = new Roadmap([
    new Place('sanremo', new Point(43.815967,7.776057)),
    new Place('napoli', new Point(40.851775, 14.268124)),
    new Place('cuneo', new Point(44.384477, 7.542671)),
    new Place('roma', new Point(41.902783, 12.496366)),
    new Place('salerno', new Point(40.682441, 14.768096)),
    new Place('torino', new Point(45.070312, 7.686856)),
    new Place('imperia', new Point(43.889686, 8.039517)),
    new Place('ventimiglia', new Point(43.791237, 7.607586)),
    new Place('milano', new Point(45.465422, 9.185924)),
    new Place('sassari', new Point(40.725927, 8.555683)),
    new Place('bassano del grappa', new Point(45.765728, 11.7272747)),
    new Place('cosenza', new Point(39.2666557, 16.287521)),
    new Place('bari', new Point(41.1171488, 16.8719083)),
    new Place('alberobello', new Point(40.7864131, 17.240936)),
    new Place('ragusa', new Point(36.9269273, 14.7255129)),
    new Place('messina', new Point(38.1938137, 15.5540152)),
    new Place('villa stellone', new Point(44.9235415, 7.7441408)),
    new Place('l\'aquila', new Point(42.3498479, 13.3995091)),
    new Place('genova', new Point(44.4466254, 9.1456153)),
    new Place('ovada', new Point(44.6361571, 8.6396762)),
    new Place('savona', new Point(44.3425496, 8.4293891)),
]);


$life = new Life(new Mutation(), new Recombination());
$roadmap = $life->getShortestPath($roadmap);

$data = [];
foreach ($roadmap->places as $place) {
    $data[] = [
        "lat" => $place->point->latitude,
        "lng" => $place->point->longitude,
    ];
}

$data = json_encode($data) . PHP_EOL;

echo <<<EOF
<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 100%; }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script type="text/javascript">

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 43.71, lng: 7.77},
    zoom: 8
  });

  var flightPlanCoordinates = {$data};
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?callback=initMap">
    </script>
</body>
</html>

EOF;

