<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>USER PAGE / DRIVER PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .img-driver {
            filter: drop-shadow(1px 1px 60px black)
        }
    </style>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-6 bg-warning">
                    <div class="card border-0 bg-warning  rounded-0" style="min-height: 100vh">
                        <div class="card-header border-0 bg-warning">
                            <h5 class="text-center mt-4 display-3 fw-bold">GO TAX APP</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-5 justify-content-between">
                                <div
                                    class="col-md-4
                                col-4 bg-warning shadow ms-4 p-2 rounded-4">
                                    <img class="im-fluid img-driver " width="50px"
                                        src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png" alt="img">
                                    <span class="fw-bold ms-4">Driver Name</span>
                                </div>
                                <div class="col-md-4 bg-warning text-center  shadow me-4 p-2 rounded-4">
                                    <span class="bg-dark badge shadow">Your Income</span>
                                    <h6 class="mt-3 text-center">Rp. 500.000.000.00</h6>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="card bg-warning shadow border-0">
                                    <div class="card-body">
                                        <div class="rounded-4" id='map' style='width: 100%; height: 300px;'></div>
                                    </div>
                                    <div class="card-footer border-0 bg-warning">
                                        <span class="badge bg-success rounded-pill"><i
                                                class="fa-solid fa-map-location"></i> Your mileage : 10023120 KM</span>
                                        <span class="badge bg-success rounded-pill" style="float: right">
                                            Rating : <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        mapboxgl.accessToken =
            'pk.eyJ1IjoicmlkZXJ1bm5lcm15IiwiYSI6ImNrOHptdGloeTE3NXIzc213aXEybDRkY2UifQ.5a1AaVjCXWW36GJ9TLjLKg';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [104.0202701633349, 1.1041324827115204],
            zoom: 12.16
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
