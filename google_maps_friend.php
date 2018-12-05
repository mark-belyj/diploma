
<?php
if ($id_running == $row_friends["profile_id"]) { // когда я захожу на странику к другу
    ?>
    <div id="map"></div>
    <script>
        function initMap() {
            var uluru = {lat: 54.936337699999996, lng: 82.8833677};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: uluru
            });
            var geo_fritnd_1 = new google.maps.Marker({
                position: {lat: <?=$lat?>, lng: <?=$lng?>},
                map: map
            });

            var info_friend_1 = new google.maps.InfoWindow({
                content: '<h1><?=$geo_head . '<br> ' . 'Дата:  ' . $geo_date?></h1>'
            });
            info_friend_1.open(map, geo_fritnd_1);
        }
    </script>
    <?php
}
?>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO59PBOzNvOVIxlZxQvTzVxC3HsIulHWc&callback=initMap">
</script>
