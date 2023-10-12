<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Test map</title>
</head>
<body>
    <div id="map"  style="height: 400px;width:100%"></div>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -18.901962400133048, lng: 47.50662887703378 }, // Set the initial map center
                zoom: 8
            });
            var marker = new google.maps.Marker({
                position: { lat: -18.901962400133048, lng: 47.50662887703378 }, // Set the marker's position (same as the map's center in this example).
                map: map, // Set the map where the marker should be displayed.
                title: 'Marquuer aaron', // Set a title for the marker (optional).
            });
            var polygonDataGolbal = @json($point);
            var length = polygonDataGolbal.length;
            console.log(length);
            for (var x = 0; x < polygonDataGolbal.length; x++) {

                var polygonData = polygonDataGolbal[x];
                console.log(polygonData);
                var polygonCoordinates = [];
                var temp = polygonData.length;
                for (var i = x; i < polygonData.length; i++) {
                    //console.log("polygonData[i]");
                    polygonCoordinates.push({
                        lat: polygonData[i][0],
                        lng: polygonData[i][1]
                    });
                    console.log(polygonCoordinates);
                 }
                console.log(temp);

                 var polygon = new google.maps.Polygon({
                     paths: polygonCoordinates,
                     map: map,
                     fillColor: '#FF0000',
                     fillOpacity: 0.35,
                     strokeColor: '#007464',
                     strokeOpacity: 0.8,
                     strokeWeight: 2
                 });
            }
        }


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>

</body>
</html>
