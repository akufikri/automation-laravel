@extends('template')
@section('header')
    Pin Maps
@endsection
@section('content')
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" name="idPinMap" id="idPinMap">
                        <div class="form-group">
                            <label for="editPin">Pin Data</label>
                            <input type="text" class="form-control" id="edit_pin" name="edt_pin">
                        </div>
                        <div class="form-group">
                            <label for="editCountry">Country</label>
                            <select class="form-control" id="country_id" name="country_id"></select>
                        </div>
                        <div class="form-group">
                            <label for="editCity">City</label>
                            <select class="form-control" id="city_id" name="city_id"></select>
                        </div>
                        <div class="form-group">
                            <label for="editPlaceName">Place Name</label>
                            <input type="text" class="form-control" id="edit_place_name" name="edit_place_name">
                        </div>
                        <div class="form-group">
                            <label for="editPlaceAddress">Place Address</label>
                            <input type="text" class="form-control" id="edit_place_address" name="edit_place_address">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="updatePinMap()" class="btn btn-primary" id="saveChangesBtn">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="card">
            <div class="card-body">
                <div id="accordion">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                    Add new place (Pin maps)
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div id="map" style="width: 100%; height: 400px;"></div>
                                <form action="" class="mt-4">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="">Longitude</label>
                                            <input type="text" class="form-control" name="" id="longitude">
                                        </div>
                                        <div class="col">
                                            <label for="">Latitude</label>
                                            <input type="text" class="form-control" name="" id="latitude">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="">Country</label>
                                            <select name="country" class="form-control" id="country"
                                                name="country"></select>
                                        </div>
                                        <div class="col">
                                            <label for="">City</label>
                                            <select name="city" class="form-control" id="city"
                                                name="city"></select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="">Place Name</label>
                                            <input type="text" class="form-control" name="place_name"
                                                id="place_name">
                                        </div>
                                        <div class="col">
                                            <label for="">Place Address</label>
                                            <input type="text" class="form-control" name="place_address"
                                                id="place_address">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" id="submitBtn" class="btn btn-primary">submit</button>
                                            <button class="btn btn-default">reset field</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pin data</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Place Name</th>
                                    <th>Place Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pinTableBody"></tbody>
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
                point: true, // Menampilkan tombol untuk menggambar point
                trash: true,
            }
        });
        map.addControl(new mapboxgl.NavigationControl());
        map.addControl(draw);

        // Array untuk menyimpan koordinat
        var coordinatesArray = [];

        function updateFormInput(coordinates) {
            if (coordinates.length >= 1) { // Ubah ke 1 karena kita hanya ingin menampilkan satu point
                document.getElementById('longitude').value = coordinates[0];
                document.getElementById('latitude').value = coordinates[1];
            }
        }

        const style = 'dark-v10';
        map.setStyle(`mapbox://styles/mapbox/${style}`)

        // Ketika geometri selesai digambar, tampilkan hasil di form
        map.on('draw.create', function(e) {
            var coordinates = e.features[0].geometry.coordinates;
            updateFormInput(coordinates);
        });
    </script>
    <script>
        $(function() {
            callApi();
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getDataCity') }}",
                method: 'GET',
                success: function(response) {
                    var citySelect = $('#city');
                    citySelect.empty(); // Kosongkan opsi sebelum diisi ulang
                    $.each(response.data, function(index, city) {
                        citySelect.append(new Option(city.city_name, city.id));
                    });
                }
            });
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getDataCountry') }}",
                method: 'GET',
                success: function(response) {
                    var countrySelect = $('#country');
                    countrySelect.empty(); // Kosongkan opsi sebelum diisi ulang
                    $.each(response.data, function(index, country) {
                        countrySelect.append(new Option(country.country_name, country.id));
                    });
                }
            });

            $("#submitBtn").click(function(e) {
                e.preventDefault();

                var longitude = $("#longitude").val();
                var latitude = $("#latitude").val();
                var pin = longitude + ',' + latitude;

                var countryId = $("#country").val();
                var cityId = $("#city").val();
                var placeName = $("#place_name").val();
                var placeAddress = $("#place_address").val();

                var postData = {
                    pin: pin,
                    country_id: countryId,
                    city_id: cityId,
                    place_name: placeName,
                    place_address: placeAddress
                };

                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/storePinMap') }}",
                    method: "POST",
                    data: postData,
                    success: function(response) {
                        callApi();
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed. Status:', xhr.status);
                    }
                });
            });

        });



        function callApi() {
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getPinMap') }}",
                method: "GET",
                success: function(data) {
                    $('#pinTableBody').html('');
                    var data = data.data; // Ambil data dari properti "data"

                    if (Array.isArray(data)) {
                        data.forEach(function(item, index) {
                            $('#pinTableBody').append(`
                            <tr data-item-id="${ item.id }">
                                <td>${index + 1}</td>
                                  <td>
                                       ${item.pin}
                                    </td>
                                    <td>
                                       ${item.country.country_name}
                                    </td>
                                    <td>
                                        ${item.city.city_name}
                                    </td>
                                    <td>
                                        ${item.place_name}
                                    </td>
                                    <td>
                                        ${item.place_address}
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="deletePin(${item.id})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                 <button class="btn btn-success btn-edit" onclick="showPin(${item.id})">
                                    Edit
                                </button>   
                                </td>
                            </tr>
                        `);
                        });
                    } else {
                        console.error('Data is not an array:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed. Status:', xhr.status);
                }
            });
        }

        function showPin(id) {
            // Load data pin berdasarkan ID menggunakan Ajax
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/showPinMap') }}/${id}`,
                method: "GET",
                success: function(response) {
                    var pinData = response.data;

                    // Mengisi nilai ke dalam form edit
                    $('#idPinMap').val(id);
                    $('#edit_pin').val(pinData.pin);
                    $('#country_id').val(pinData.country_id); // Adjusted field
                    $('#city_id').val(pinData.city_id); // Adjusted field
                    $('#edit_place_name').val(pinData.place_name);
                    $('#edit_place_address').val(pinData.place_address);

                    // Menampilkan modal edit
                    $('#modalEdit').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function updatePinMap() {
            var idPinMap = $('#idPinMap').val();
            var edit_pin = $('#edit_pin').val();
            var country_id = $('#country_id').val();
            var city_id = $('#city_id').val();
            var edit_place_name = $('#edit_place_name').val();
            var edit_place_address = $('#edit_place_address').val();

            var formData = new FormData();
            formData.append('edit_pin', edit_pin);
            formData.append('country_id', country_id);
            formData.append('city_id', city_id);
            formData.append('edit_place_name', edit_place_name);
            formData.append('edit_place_address', edit_place_address);

            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/updatePinMap') }}/${idPinMap}`,
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                    $('#modalEdit').modal('hide')
                    callApi();
                }
            });
        }

        $(document).ready(function() {
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getDataCity') }}",
                method: 'GET',
                success: function(response) {
                    var citySelect = $('#city_id');
                    citySelect.empty(); // Kosongkan opsi sebelum diisi ulang
                    $.each(response.data, function(index, city) {
                        citySelect.append(new Option(city.city_name, city.id));
                    });
                }
            });
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getDataCountry') }}",
                method: 'GET',
                success: function(response) {
                    var countrySelect = $('#country_id');
                    countrySelect.empty(); // Kosongkan opsi sebelum diisi ulang
                    $.each(response.data, function(index, country) {
                        countrySelect.append(new Option(country.country_name, country.id));
                    });
                }
            });
        })


        function deletePin(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/deletePinMap') }}/${id}`,
                    method: "DELETE",
                    success: function(response) {
                        callApi();
                    },

                });
            }
        }
    </script>
@endsection
