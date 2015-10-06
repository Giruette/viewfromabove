<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" text="text/css" href="style.css">
        <title>View from Above</title>
    </head>
    <body>
        <span id="signinButton">
            <span
                class="g-signin"
                data-callback="signinCallback"
                data-clientid="YOUR_CLIENT_ID"
                data-cookiepolicy="single_host_origin"
                data-requestvisibleactions="http://schemas.google.com/AddActivity"
                data-scope="https://www.googleapis.com/auth/plus.login">
            </span>
        </span>
        <div id="mapcontain" class="mapcontain"></div>
<!--        <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            
//            var directionsDisplay;
//            var directionsService = new google.maps.DirectionsService();
            var map;
            
            function initializeMap(){
                getLocation();
                getWindowSize();
                
//                directionsDisplay = new google.maps.DirectionRenderer();
                
                function getWindowSize(){
                    var percentMarginLeft = (document.body.clientWidth * 0.01).toFixed(),
                        percentMarginTop = (window.innerHeight * 0.01).toFixed(),
                        windowMarginLeft = document.body.clientWidth - (percentMarginLeft * 2) + "px",
                        windowMarginTop = window.innerHeight - (percentMarginTop * 2) + "px";
                    mapcontain.style.width = windowMarginLeft;
                    mapcontain.style.height = windowMarginTop;
                    
                }

                function getLocation(){
                    if (navigator.geolocation) {
                        navigator.geolocation.watchPosition(showPosition);
                    } else {
                        body.innerHTML = "Geolocation is not supported by this browser.";
                    }
                    
                }

                function showPosition(position){
                    myLatitude = position.coords.latitude;
                    myLongitude = position.coords.longitude;
                    
                    var myLatitude, myLongitude;
                    var mapCanvas = mapcontain;
                    var mapOptions = {
                        center: new google.maps.LatLng(myLatitude, myLongitude),
                        zoom: 15,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }

                    map = new google.maps.Map(mapCanvas, mapOptions);
//                    directionsDisplay.setMap(map);
                    
                    var pImage = "profilesmall.png";
                    var marker = new google.maps.Marker({
                        position: {lat: myLatitude, lng: myLongitude},
                        map: map,
                        title: "I AM HERE!",
                        icon: pImage
                    });
                    
                    var markerClick = [];
                    
                    google.maps.event.addListener(map, 'click', function(event) {
                        deleteMarkers();
                        placeMarker(event.latLng);
                    });

                    function placeMarker(location) {
                        var marker = new google.maps.Marker({
                            position: location, 
                            map: map
                        });
                        markerClick.push(marker);
                        console.log(marker);
                    }
                    
                    function deleteMarkers(){
                        for(var i = 0; i < markerClick.length; i++){
                            markerClick[i].setMap(null);
                        }
                        markerClick = [];
                    }
                }
            }
            
            google.maps.event.addDomListener(window,'load',initializeMap);
            window.addEventListener("resize", initializeMap);
        </script>
    </body>
</html>