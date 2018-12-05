

if (navigator.geolocation) {
    navigator.geolocation.watchPosition(function(position) {
        var x = position.coords.latitude;
        var y = position.coords.longitude;
        alert(x);
        alert(y);
    });
}else {
    alert( "Geolocation is not supported by this browser.");
}
