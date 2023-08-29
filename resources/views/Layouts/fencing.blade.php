    @extends('template')
    @section('header')
        Map Geofencing
    @endsection

    @section('content')
        <style>
            .mapboxgl-canvas canvas {
                width: 500px;
                height: 100px;
            }

            canvas {
                width: 500px;
                height: 100px;
            }

            .mapboxgl-map .feature-vertex .mode-simple_select .mouse-none {
                width: 500px;
                height: 100px;
            }
        </style>
        <section>
            <div class="modal fade" id="modal-insert">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Taxi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="fencingForm">
                                <div class="row mb-5">
                                    <div class="col">
                                        <div id="map" style="width: 100%; height:300px;"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="longitude1" id="longitude1" placeholder="Longitude 1">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="latitude1" id="latitude1" placeholder="Latitude 1">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="longitude2" id="longitude2" placeholder="Longitude 2">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="latitude2" id="latitude2" placeholder="Latitude 2">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="country" class="form-label">Country</label>
                                        <select name="country" id="country" class="form-control">
                                            <!-- Opsi negara akan diisi secara dinamis menggunakan JavaScript -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="state" class="form-label">State</label>
                                        <select name="state" id="state" class="form-control">
                                            <!-- Opsi provinsi akan diisi secara dinamis menggunakan JavaScript -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="city" class="form-label">City</label>
                                        <select name="city" id="city" class="form-control">
                                            <!-- Opsi kota akan diisi secara dinamis menggunakan JavaScript -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active">active</option>
                                            <option value="non active">non active</option>
                                        </select>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Taxi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="fencingForm">
                                <div class="row mb-5">
                                    <div class="col">
                                        <div id="map" style="width: 100%; height:300px;"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="edit_longitude1" id="edit_longitude1" placeholder="Longitude 1">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="edit_latitude1" id="edit_latitude1" placeholder="Latitude 1">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="edit_longitude2" id="edit_longitude2" placeholder="Longitude 2">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3 input-group">
                                            <input type="text"
                                                class="form-control rounded-0 border-top-0 border-left-0 border-right-0 border-black"
                                                name="edit_latitude2" id="edit_latitude2" placeholder="Latitude 2">
                                            <button class="btn btn-outline-danger shadow-sm rounded-pill">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="country" class="form-label">Country</label>
                                        <select name="edit_country" id="edit_country" class="form-control">
                                            <!-- Opsi negara akan diisi secara dinamis menggunakan JavaScript -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="state" class="form-label">State</label>
                                        <select name="edit_state" id="edit_state" class="form-control">
                                            <!-- Opsi provinsi akan diisi secara dinamis menggunakan JavaScript -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="city" class="form-label">City</label>
                                        <select name="edit_city" id="edit_city" class="form-control">
                                            <!-- Opsi kota akan diisi secara dinamis menggunakan JavaScript -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="edit_status" id="edit_status" class="form-control">
                                            <option value="active">active</option>
                                            <option value="non active">non active</option>
                                        </select>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal-insert">add new
                        location</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <table id="fencingTable" class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Geofencing</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                            </tbody>
                        </table>
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
                center: [104.02027016313349, 1.1041324827115204],
                zoom: 11.15
            });

            // Inisialisasi Mapbox Draw
            var draw = new MapboxDraw({
                displayControlsDefault: false,
                controls: {
                    polygon: true,
                    line_string: true,
                    trash: true,
                }
            });
            map.addControl(new mapboxgl.NavigationControl());
            map.addControl(draw);


            // Array untuk menyimpan koordinat
            var coordinatesArray = [];

            function updateFormInput(coordinates) {
                if (coordinates.length >= 2) {
                    document.getElementById('longitude1').value = coordinates[0][0];
                    document.getElementById('latitude1').value = coordinates[0][1];
                    document.getElementById('longitude2').value = coordinates[1][0];
                    document.getElementById('latitude2').value = coordinates[1][1];
                }
            }
            const style = 'dark-v10';
            map.setStyle(`mapbox://styles/mapbox/${style}`)

            // Ketika geometri selesai digambar, tampilkan hasil di form
            map.on('draw.create', function(e) {
                var feature = e.features[0];

                if (feature.geometry.type === 'Polygon') {
                    var coordinates = feature.geometry.coordinates[0];
                    updateFormInput(coordinates);
                } else if (feature.geometry.type === 'LineString') {
                    var coordinates = feature.geometry.coordinates;
                    updateFormInput(coordinates);
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                callApi();
                loadCities();
                loadCountries();
                loadStates();
                $('#fencingForm').on('submit', function(e) {
                    e.preventDefault();

                    var longitude1 = $('#longitude1').val();
                    var latitude1 = $('#latitude1').val();
                    var longitude2 = $('#longitude2').val();
                    var latitude2 = $('#latitude2').val();

                    var geofencing = {
                        coordinates: [
                            [
                                [parseFloat(longitude1), parseFloat(latitude1)],
                                [parseFloat(longitude1), parseFloat(latitude2)],
                                [parseFloat(longitude2), parseFloat(latitude2)],
                                [parseFloat(longitude2), parseFloat(latitude1)],
                                [parseFloat(longitude1), parseFloat(latitude1)]
                            ]
                        ]
                    };

                    var countryId = $('#country').val();
                    var stateId = $('#state').val();
                    var cityId = $('#city').val();
                    var status = $('#status').val();

                    var requestData = {
                        geofencing: JSON.stringify(geofencing),
                        country_id: countryId,
                        state_id: stateId,
                        city_id: cityId,
                        status: status
                    };

                    $.ajax({
                        url: "{{ url('http://127.0.0.1:8000/api/storeFencing') }}",
                        method: "POST",
                        data: requestData,
                        success: function(response) {
                            callApi();
                            $('#modal-insert').modal('hide');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });

            });




            function callApi() {
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getFencing') }}",
                    method: "GET",
                    success: function(response) {
                        var data = response.data;
                        var tableBody = $('#tableBody');
                        tableBody.empty();

                        $.each(data, function(index, item) {
                            var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.geofencing}</td>
                                    <td>${item.country.country_name}</td>
                                    <td>${item.state.state_name}</td>
                                    <td>${item.city.city_name}</td>
                                    <td>${item.status}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteFencing(${item.id})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });

                        // Initialize DataTables
                        fencingTable = $('#fencingTable').DataTable({
                            responsive: true,
                            paging: true,
                            pageLength: 10,
                            searching: true
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function deleteFencing(id) {
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: `{{ url('http://127.0.0.1:8000/api/deleteFencing') }}/${id}`,
                        method: 'DELETE',
                        success: function(response) {
                            alert(response.message);
                            callApi();
                        },
                        error: function(error) {
                            console.log(error);
                            alert('An error occurred while deleting the record.');
                        }
                    });
                }
            }



            function loadCities() {
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataCity') }}",
                    method: "GET",
                    success: function(response) {
                        var citySelect = $('#city');
                        citySelect.empty(); // Kosongkan opsi sebelum diisi ulang
                        $.each(response.data, function(index, city) {
                            citySelect.append(new Option(city.city_name, city.id));
                        });
                    }
                });
            }

            function loadCountries() {
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataCountry') }}",
                    method: "GET",
                    success: function(response) {
                        var countrySelect = $('#country');
                        countrySelect.empty(); // Kosongkan opsi sebelum diisi ulang
                        $.each(response.data, function(index, country) {
                            countrySelect.append(new Option(country.country_name, country.id));
                        });
                    }
                });
            }

            function loadStates() {
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataState') }}",
                    method: "GET",
                    success: function(response) {
                        var stateSelect = $('#state');
                        stateSelect.empty(); // Kosongkan opsi sebelum diisi ulang
                        $.each(response.data, function(index, state) {
                            stateSelect.append(new Option(state.state_name, state.id));
                        });
                    }
                });
            }
        </script>
    @endsection
