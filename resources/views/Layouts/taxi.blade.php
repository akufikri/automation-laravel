@extends('template')
@section('header')
    Taxi
@endsection
@section('content')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Taxi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="taxiForm">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Driver</label>
                            <input class="form-control" type="text" name="driver_name">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">License Plate</label>
                                <input type="text" class="form-control" name="license_plate">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Status</label>
                                <select class="form-control" name="status" aria-label="Default select example">
                                    <option value="available">Available</option>
                                    <option value="booked">Booked</option>
                                    <option value="on ride">On ride</option>
                                    <option value="under maintence">under maintence</option>
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
    <!-- /.modal -->
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Taxi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" onsubmit="editTaxi(); return false;">
                        @csrf
                        <input type="hidden" name="editIdTaxi" id="editIdTaxi">
                        <div class="mb-3">
                            <label for="" class="form-label">Driver</label>
                            <input class="form-control" type="text" name="editDriverName" id="editDriverName">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">License Plate</label>
                                <input type="text" class="form-control" name="editLicensePlate" id="editLicensePlate">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Status</label>
                                <select class="form-control" name="editStatus" id="editStatus">
                                    <option value="available">Available</option>
                                    <option value="booked">Booked</option>
                                    <option value="on ride">On ride</option>
                                    <option value="under maintence">under maintence</option>
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
    <section>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-success shadow float-right" type="button" data-toggle="modal"
                            data-target="#modal-default"><i class="fa-solid fa-plus"></i> Create</button>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="taxiTable" class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Driver Name</th>
                                    <th>License Plate</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script></script>
    <script>
        $(function() {
            callApi();

            $('#taxiForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/storeTaxi') }}",
                    method: "POST",
                    data: formData,
                    processData: false, // Jangan memproses data FormData
                    contentType: false, // Jangan mengatur tipe konten
                    success: function(response) {
                        alert(response.message);
                        callApi();
                    }
                });
            });
        });

        function deleteTaxi(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/deleteTaxi') }}/${id}`,
                method: "DELETE",
                success: function(response) {
                    alert(response.message);
                    callApi(); // Memanggil kembali fungsi untuk memperbarui tampilan
                }
            });
        }

        function showTaxi(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/showTaxi') }}/${id}`,
                method: "GET",
                success: function(response) {
                    var taxiData = response.data; // Memuat data dari respons
                    $('#editIdTaxi').val(id); // Mengisi nilai ke input hidden
                    $('#editDriverName').val(taxiData.driver_name); // Mengisi nilai field form
                    $('#editLicensePlate').val(taxiData.license_plate); // Mengisi nilai field form
                    $('#editStatus').val(taxiData.status); // Mengisi nilai field form
                    $('#modalEdit').modal('show'); // Menampilkan modal
                }
            });
        }

        function editTaxi() {
            var editId = $('#editIdTaxi').val();
            var editDriverName = $('#editDriverName').val();
            var editLicensePlate = $('#editLicensePlate').val();
            var editStatus = $('#editStatus').val();

            var formData = new FormData();
            formData.append('driver_name', editDriverName);
            formData.append('license_plate', editLicensePlate);
            formData.append('status', editStatus);

            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/updateTaxi') }}/${editId}`,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                    $('#modalEdit').modal('hide');
                    callApi(); // Memanggil kembali fungsi untuk memperbarui tampilan
                }
            });
        }


        function callApi() {
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getTaxi') }}",
                method: "GET",
                success: function(response) {
                    var getTaxi = response.data;
                    var tableBody = $('#tableBody');

                    tableBody.empty();

                    $.each(getTaxi, function(index, data) {
                        var statusBadge = '';
                        if (data.status === 'available') {
                            statusBadge =
                                '<span class="badge badge-success p-2 rounded-pill"><i class="fa-solid fa-check"></i>  Available</span>';
                        } else if (data.status === 'booked') {
                            statusBadge =
                                '<span class="badge badge-primary rounded-pill p-2"><i class="fa-solid fa-car-side"></i>  Booked</span>';
                        } else if (data.status === 'on ride') {
                            statusBadge =
                                '<span class="badge badge-info rounded-pill p-2"><i class="fa-solid fa-car-rear"></i>  On Ride</span>';
                        } else if (data.status === 'under maintence') {
                            statusBadge =
                                '<span class="badge badge-warning rounded-pill p-2"><i class="fa-solid fa-gears"></i>  Under Maintenance</span>';
                        } else {
                            statusBadge = '<span class="badge badge-secondary">' + data
                                .status + '</span>';
                        }

                        var row = `<tr>
                            <td>${index + 1}</td>
                            <td>${data.driver_name}</td>
                            <td>${data.license_plate}</td>
                            <td>${statusBadge}</td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteTaxi(${data.id})"><i class="fa fa-trash"></i></button>
                                <button onclick="showTaxi(${data.id})"  class="btn btn-success"><i class="fa fa-pencil"></i></button>
                            </td>
                        </tr>`;

                        tableBody.append(row);
                    });

                    taxiTable = $('#taxiTable').DataTable({
                        responsive: true,
                        paging: true,
                        pageLength: 10,
                        searching: true,
                    });
                }
            });
        }
    </script>
@endsection
