<?php
session_start();
$id = $_SESSION["profile_id"];
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!--<style>
#map {
margin-top: 100px;
height: 400px;
width: 100%;
}
</style>-->
<div id="map"></div>
<script>
    var my_x;
    var my_y;

    if (navigator.geolocation) {
        var location_timeout = setTimeout("geolocFail()", 10000); // del
        navigator.geolocation.watchPosition(function (position) {
                clearTimeout(location_timeout);

                my_x = position.coords.latitude;
                my_y = position.coords.longitude;
                $.get("https://myhomies.mcdir.ru/ajax_update_geo.php?x="+ my_x + "&y= " + my_y + "&id=<?=$id?>");


                initMap();


                // del
            }, function (error) {
                clearTimeout(location_timeout);
                geolocFail();
            },
            {
                maximumAge: 750000,
                timeout: Infinity,
                enableHighAccuracy: true
            });
    } else {
        alert("Geolocation is not supported by this browser.");
    }


    function initMap() {

        var uluru = {lat: 54.936337699999996, lng: 82.8833677};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: uluru
        });
        var geo_fritnd_1 = new google.maps.Marker({
            position: {lat: my_x, lng: my_y},
            map: map
        });

        var info_friend_1 = new google.maps.InfoWindow({
            content: '<h1>Я</h1>'
        });
        info_friend_1.open(map, geo_fritnd_1);
    }

</script>


<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO59PBOzNvOVIxlZxQvTzVxC3HsIulHWc&callback=initMap">
</script>
