//pemesanan
var lokasi = [];
var lokasiOrder = [];
var lokasiDriver;
var lokasiKoperasi;

var vrMaps;

var arrayDistance = [];

var progressbar;
var progressbar1;
var titleprogressbar;
var valuebar;
var width = 0;
var step = 0;

var colors = ["red", "green", "orange", "purple", "blue", "yellow", "pink"];

//=================================== mengambil data dari api ===================================//
function getDelivery(deliveryId){
  progressbar = document.getElementById("progressbar");
  valuebar = document.getElementById("valueBar");
  titleprogressbar = document.getElementById("titleprogressbar");
  progressbar1 = document.getElementById("progressbar1");

  $.ajax({
    type  : "GET",
    data  : "",
    // url   : "http://localhost/jualikan.id/backend/web/api/getExampleOrderData.php?id=" + koperasi_id,
    url   : "../backend/web/api/getTrackingById.php?id=" + deliveryId,
    success : function(result){
          var resultObj = JSON.parse(result);
          if (resultObj.driver.id != null) {
              var obj = [];
              obj.id = resultObj.koperasi.id;
              obj.name = resultObj.koperasi.name;
              obj.address = resultObj.koperasi.address;
              obj.lat = resultObj.koperasi.lat;
              obj.lng = resultObj.koperasi.lng;
              obj.status = 1;
              lokasi.push(obj);

              $.each(resultObj.order, function(key, value){
                  var data = [];
                  data.id = value.id;
                  data.name = value.name;
                  data.address = value.address;
                  data.lat = value.lat;
                  data.lng = value.lng;
                  data.status = 0;
                  lokasi.push(data);
              });

              var obj = [];
              obj.id = resultObj.koperasi.id;
              obj.name = resultObj.koperasi.name;
              obj.address = resultObj.koperasi.address;
              obj.lat = resultObj.koperasi.lat;
              obj.lng = resultObj.koperasi.lng;
              obj.status = 1;
              lokasi.push(obj);

              lokasiDriver = resultObj.driver;
              lokasiKoperasi = resultObj.lokasiKoperasi;
          }else {
            progressbar.style.display = 'none';
            valuebar.style.display = 'none';
            titleprogressbar.style.display = 'none';
            progressbar1.style.display = 'none';
          }
          countDistanceWithGoogleApi();
          console.log(lokasi);
      }
  });
}

function countDistanceWithGoogleApi(){

    step = 100 / (lokasi.length);
    progressbar.style.width = width + '%';

    // displayPesananTable();
    // displayDriverTable();
    // console.log(arrayLocation);
    // console.log(arrayDriver);
    countDistanceY(0);
}

function tambahProgress(){
    width = width + step;
    progressbar.style.width = width + '%';

    valuebar.style.marginLeft = (width-2.8) + '%';
    valuebar.innerHTML = Math.round(width) + '%';
}

//rekrusif looping untuk mencari distance antar lokasi
function countDistanceY(y){
    if (y < lokasi.length-1) {
        setTimeout(function(){
            getDistance(y);
            tambahProgress();
            y++;
            countDistanceY(y);
        }, 2400);
    }else{
        setTimeout(function(){
            selesaiMenghitungJarak();
            tambahProgress();
        }, 2400);
    }
}

//digunakan untuk selesai menghitung jarak
function selesaiMenghitungJarak(){
    progressbar.style.display = 'none';
    valuebar.style.display = 'none';
    titleprogressbar.style.display = 'none';
    progressbar1.style.display = 'none';

    var center = new google.maps.LatLng(lokasi[0].lat, lokasi[0].lng);
    var vrpCanvas = document.getElementById("map_tracking");
    vrpCanvas.style.height = "320px";
    vrpCanvas.style.width = "100%";
    vrMaps = new google.maps.Map(vrpCanvas, {
            center: center,
            zoom: 13,
            mapTypeId: 'roadmap',
        }
    );
    console.log(arrayDistance);
    displayMaps();
    displayDriver();
}

var icon_driver;
var markerDriver;

function displayDriver(){
    var database = firebase.database();
    var ref = database.ref();
    var id_driver = lokasiDriver.device_id;
    ref.on("value", function(snapshot){
        console.log(snapshot.val().Tracking[id_driver]);
        var obj = snapshot.val().Tracking[id_driver];
        routeMarker(obj.latitude, obj.longitude, obj.bearing);
    });
}

var RotateIcon = function(options){
    this.options = options || {};
    this.rImg = options.img || new Image();
    this.rImg.src = this.rImg.src || this.options.url || '';
    this.options.width = this.options.width || this.rImg.width || 52;
    this.options.height = this.options.height || this.rImg.height || 60;
    var canvas = document.createElement("canvas");
    canvas.width = this.options.width;
    canvas.height = this.options.height;
    this.context = canvas.getContext("2d");
    this.canvas = canvas;
};
RotateIcon.makeIcon = function(url) {
    return new RotateIcon({url: url});
};
RotateIcon.prototype.setRotation = function(options){
    var canvas = this.context,
        angle = options.deg ? options.deg * Math.PI / 180:
            options.rad,
        centerX = this.options.width/2,
        centerY = this.options.height/2;

    canvas.clearRect(0, 0, this.options.width, this.options.height);
    canvas.save();
    canvas.translate(centerX, centerY);
    canvas.rotate(angle);
    canvas.translate(-centerX, -centerY);
    canvas.drawImage(this.rImg, 0, 0);
    canvas.restore();
    return this;
};
RotateIcon.prototype.getUrl = function(){
    return this.canvas.toDataURL('image/png');
};

function routeMarker(lat, lng, rotation){
    console.log("rotation : " + rotation);
    rotation = 120;
    if (markerDriver != null) {
        markerDriver.setPosition(new google.maps.LatLng(lat, lng));
        markerDriver.setIcon( {
            url:server + "../frontend/web/img/icon_driver_motor.png",
            scaledSize: new google.maps.Size(20, 43),
        });
    }else {
        markerDriver = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: vrMaps,
            icon: {
                url:"../frontend/web/img/icon_driver_motor.png",
                scaledSize: new google.maps.Size(20, 43),
            },
        });
    }
    console.log(markerDriver);
}

//display maps untuk vrp
function displayMaps(){
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    var bounds = new google.maps.LatLngBounds();
    var imageOrder = "../frontend/web/img/order_green_marker.png";
    var imageKoperasi = "../frontend/web/img/icon_company.png";

    // //add marker koperasi
    // var posisi_koperasi = new google.maps.LatLng(arrayLocation[0].lat, arrayLocation[0].lng);
    // var marker = new google.maps.Marker({
    //     position: posisi_koperasi,
    //     map: vrMaps,
    //     icon: imageKoperasi,
    // });

    //add marker pesanan
    for (var j = 0; j < lokasi.length; j++) {
        var image = "";
        if (lokasi[j].status == 1) {
            image = imageKoperasi;
        }else {
            image = imageOrder;
        }
        var posisi_order = new google.maps.LatLng(lokasi[j].lat, lokasi[j].lng);
        var marker = new google.maps.Marker({
            position: posisi_order,
            map: vrMaps,
            icon: image,
        });
        google.maps.event.addListener(marker, 'click', (function(marker, j) {
            return function() {
                console.log(j);
                infoWindow.setContent("<div style='margin-bottom:0px;'>"+
                                      "<h4 style='margin-top:0px;'><b>" + lokasi[j].name +"</b></h4>"+
                                      "<p style='margin-top:-10px; margin-bottom:0px;'>" + lokasi[j].address + "</p></div>");
                infoWindow.open(vrMaps, marker);
            }
        })(marker, j));
        bounds.extend(marker.position);
    }
    for (var k = 0; k < arrayDistance.length; k++) {
        var renderDirections = new google.maps.DirectionsRenderer({
            directions: arrayDistance[k].steps,
            map: vrMaps,
            polylineOptions: {
              strokeColor: colors[0]
            },
            suppressMarkers: true
        });
    }
    vrMaps.fitBounds(bounds);
}

function getDistance(y){

    var origin = new google.maps.LatLng(lokasi[y].lat, lokasi[y].lng);
    var destination = new google.maps.LatLng(lokasi[y+1].lat, lokasi[y+1].lng);
    var directionsService = new google.maps.DirectionsService();

    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
    }, function (response, status){
        if (status == google.maps.DirectionsStatus.OK) {
            var legs = response.routes[0].legs[0].distance.value;
            var time = response.routes[0].legs[0].duration.value;
            var steps = response;
            // console.log("X = " + x + " | Y = " + y + " | Distance = " + legs + " | Time = " + time);
            // console.log(steps);
            var obj = [];
            obj.distance = legs;
            obj.duration = time;
            obj.steps = steps;
            arrayDistance.push(obj);

        }
    });
}
