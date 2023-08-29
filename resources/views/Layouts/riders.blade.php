    @extends('template')
    @section('header')
        Riders
    @endsection
    @section('content')
        <section>
            <div class="modal fade" id="modal-insert">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Riders</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="taxiForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-label">Users</label>
                                        <select class="form-control" name="user_id" id="user_id">
                                            <option value="">Select Users</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-lable">Taxi</label>
                                        <select class="form-control" name="taxi_id" id="taxi_id">
                                            <option value="">Select Taxi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-label">start location</label>
                                        <input type="text" class="form-control" name="start_location"
                                            id="start_location">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-label">end location</label>
                                        <input type="text" class="form-control" name="end_location" id="end_location">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-control">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="Pending">Pending</option>
                                            <option value="On Going">On Going</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Cancelled">Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="fomr-label">start time</label>
                                        <input type="date" class="form-control" name="start_time" id="start_time">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="fomr-label">end time</label>
                                        <input type="date" class="form-control" name="end_time" id="end_time">
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
            <!-- Edit Rider Modal -->
            <div class="modal fade" id="modalEdit">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Rider</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm">
                                @csrf
                                <input type="hidden" name="editRidersId" id="editRidersId">
                                <div class="form-group">
                                    <label for="editUserId">User</label>
                                    <select class="form-control" name="editUserId" id="editUserId">
                                        <!-- Populate options using JavaScript/ajax -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editTaxiId">Taxi</label>
                                    <select class="form-control" name="editTaxiId" id="editTaxiId">
                                        <!-- Populate options using JavaScript/ajax -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editStartLocation">Start Location</label>
                                    <input type="text" class="form-control" name="editStartLocation"
                                        id="editStartLocation">
                                </div>
                                <div class="form-group">
                                    <label for="editEndLocation">End Location</label>
                                    <input type="text" class="form-control" name="editEndLocation"
                                        id="editEndLocation">
                                </div>
                                <div class="form-group">
                                    <label for="editStatus">Status</label>
                                    <select class="form-control" name="editStatus" id="editStatus">
                                        <option value="Pending">Pending</option>
                                        <option value="On Going">On Going</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editStartTime">Start Time</label>
                                    <input type="datetime-local" class="form-control" name="editStartTime"
                                        id="editStartTime">
                                </div>
                                <div class="form-group">
                                    <label for="editEndTime">End Time</label>
                                    <input type="datetime-local" class="form-control" name="editEndTime"
                                        id="editEndTime">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" onclick="updateRiders()" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header ">
                            <div class="btn-group float-right border-0 shadow-sm">
                                <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                <button class="btn btn-primary " type="button" data-toggle="modal"
                                    data-target="#modal-insert">add riders</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="riderTable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Taxi</th>
                                        <th>Start Loc</th>
                                        <th>End Loc</th>
                                        <th>Status</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(function() {
                callApi();

                $('#taxiForm').on('submit', function(event) {
                    event.preventDefault(); // Mencegah submit form biasa
                    var formData = $(this).serialize(); // Mengambil data formulir yang sudah di-serialize
                    saveRiderData(formData); // Panggil fungsi untuk menyimpan data
                });


            });

            $(document).ready(function() {
                // Load users
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataUsers') }}",
                    method: "GET",
                    success: function(response) {
                        var userSelect = $('#user_id');
                        $.each(response.data, function(index, user) {
                            userSelect.append(new Option(user.name, user.id));
                        });
                    }
                });

                // Load taxis
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataTaxi') }}",
                    method: "GET",
                    success: function(response) {
                        var taxiSelect = $('#taxi_id');
                        $.each(response.data, function(index, taxi) {
                            taxiSelect.append(new Option(taxi.driver_name, taxi.id));
                        });
                    }
                });
            });
            $(document).ready(function() {
                // Load users
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataUsers') }}",
                    method: "GET",
                    success: function(response) {
                        var userSelect = $('#editUserId');
                        $.each(response.data, function(index, user) {
                            userSelect.append(new Option(user.name, user.id));
                        });
                    }
                });

                // Load taxis
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getDataTaxi') }}",
                    method: "GET",
                    success: function(response) {
                        var taxiSelect = $('#editTaxiId');
                        $.each(response.data, function(index, taxi) {
                            taxiSelect.append(new Option(taxi.driver_name, taxi.id));
                        });
                    }
                });
            });

            function callApi() {
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/getRiders') }}", // Replace with your API endpoint
                    method: "GET",
                    success: function(response) {
                        var rideData = response.data;
                        var tableBody = $('#tableBody');
                        tableBody.empty();

                        $.each(rideData, function(index, data) {
                            var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${data.user.name}</td>
                                    <td>${data.taxi.driver_name}</td>
                                    <td>${data.start_location}</td>
                                    <td>${data.end_location}</td>
                                    <td>${data.status}</td>
                                    <td>${formatDateTime(data.start_time)}</td>
                                    <td>${data.end_time ? formatDateTime(data.end_time) : ''}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteRiders(${data.id})"><i class="fa fa-trash"></i></button>    
                                            <button onclick="showRider(${data.id})" class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr
                            `;

                            tableBody.append(row);
                        });
                        riderTable = $('#riderTable').DataTable({
                            responsive: true,
                            paging: true,
                            pageLength: 10,
                            searching: true
                        });
                    }
                });
            }

            function deleteRiders(id) {
                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/deleteRiders') }}/${id}`,
                    method: "DELETE",
                    success: function(response) {
                        alert(response.message);
                        callApi();
                    }
                });
            }

            function showRider(id) {
                // Load data rider berdasarkan ID menggunakan Ajax
                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/showRiders') }}/${id}`,
                    method: "GET",
                    success: function(response) {
                        var rider = response.data;

                        // Mengisi nilai ke dalam form edit
                        $('#editUserId').val(rider.user_id);
                        $('#editTaxiId').val(rider.taxi_id);
                        $('#editRidersId').val(id);
                        $('#editStartLocation').val(rider.start_location);
                        $('#editEndLocation').val(rider.end_location);
                        $('#editStatus').val(rider.status);
                        $('#editStartTime').val(rider.start_time);
                        $('#editEndTime').val(rider.end_time);
                        // Menampilkan modal edit
                        $('#modalEdit').modal('show');

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function updateRiders() {
                var editId = $('#editRidersId').val();
                var editUserId = $('#editUserId').val();
                var editTaxiId = $('#editTaxiId').val();
                var editStartLocation = $('#editStartLocation').val();
                var editEndLocation = $('#editEndLocation').val();
                var editStatus = $('#editStatus').val();
                var editStartTime = $('#editStartTime').val();
                var editEndTime = $('#editEndTime').val();

                var formData = new FormData(); // Corrected line
                formData.append('user_id', editUserId);
                formData.append('taxi_id', editTaxiId);
                formData.append('start_location', editStartLocation);
                formData.append('end_location', editEndLocation);
                formData.append('status', editStatus);
                formData.append('start_time', editStartTime);
                formData.append('end_time', editEndTime);

                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/updateRiders') }}/${editId}`,
                    data: formData,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response.message);
                        $('#modalEdit').modal('hide');
                        callApi();
                    }
                });
            }



            function formatDateTime(datetime) {
                return datetime.substring(0, 16);
            }

            function saveRiderData(formData) {
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/storeRiders') }}", // Ganti dengan URL API yang benar
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        // Panggil kembali fungsi untuk memperbarui tampilan setelah data berhasil disimpan
                        callApi();
                        // Tutup modal setelah data berhasil disimpan
                        $('#modal-insert').modal('hide');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        </script>
    @endsection
