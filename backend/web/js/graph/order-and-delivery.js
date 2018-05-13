var tanggal = [];
var tanggal1 = [];

var order_sukses = [];
var order_gagal = [];
var pengirman = [];

var order_sukses_value = [];
var order_gagal_value = [];
var pengirman_value = [];

function displayDelivery(id){
    $.ajax({
        type : "GET",
        data : "",
        url : "http://localhost/jualikan.id/backend/web/api/graph/order-delivery.php?id=" + id,
        success : function(result){

            var resultObj = JSON.parse(result);
            $.each(resultObj, function(id, val){

                console.log(val.order_berhasil);
                tanggal.push(val.date);
                order_sukses.push(val.order_berhasil);
                order_gagal.push(val.order_gagal);
                pengirman.push(val.delivery);

            });

            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Jumlah Order yang Sukses',
                    data: order_sukses,
                    fill: false,
                    borderColor: [
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 255, 0, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Jumlah Order yang Gagal',
                    data: order_gagal,
                    fill: false,
                    borderColor: [
                        'rgba(255, 0, 0, 1)',
                        'rgba(255, 0, 0, 1)',
                        'rgba(255, 0, 0, 1)',
                        'rgba(255, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Jumlah Pengiriman',
                    data: pengirman,
                    fill: false,
                    borderColor: [
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    });

    $.ajax({
        type : "GET",
        data : "",
        url : "http://localhost/jualikan.id/backend/web/api/graph/order-delivery-price.php?id=" + id,
        success : function(result){
            var resultObj = JSON.parse(result);

            $.each(resultObj, function(id, val){

              console.log(val.order_berhasil);


              tanggal1.push(val.date);
              order_sukses_value.push(val.order);
              pengirman_value.push(val.delivery);

            });

            var ctx1 = document.getElementById("myChart1").getContext('2d');
            var myChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: tanggal1,
                datasets: [{
                    label: 'Jumlah Order Sukses',
                    data: order_sukses_value,
                    fill: false,
                    borderColor: [
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 255, 0, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Jumlah Pengiriman',
                    data: pengirman_value,
                    fill: false,
                    borderColor: [
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    });
}
