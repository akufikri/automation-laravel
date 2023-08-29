@extends('template')
@section('header')
    City
@endsection
@section('content')
    <div class="modal fade" id="modalInsert">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Country</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cityForm">
                        @csrf
                        <div class="mb-3">
                            <label for="country_name" class="form-label">City Name</label>
                            <input type="text" class="form-control" name="city_name" id="city_name">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Country</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCityForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Menggunakan metode PUT untuk permintaan -->
                        <input type="hidden" name="editId" id="editId">

                        <div class="mb-3">
                            <label for="editCountryName" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="editCityName" id="editCityName">
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <section>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalInsert">add
                    city</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>City Name</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            callApi();

            $('#cityForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/storeCity') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modalInsert').modal('hide');
                        $('#cityForm')[0].reset();
                        callApi();
                    }
                });
            });

            $('#editCityForm').submit(function(e) {
                e.preventDefault();

                var editData = {
                    city_name: $('#editCityName').val(),
                };

                var editId = $('#editId').val();

                var formData = new FormData();
                formData.append('city_name', editData.city_name);

                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/updateCity') }}/${editId}`,
                    method: "POST", // Menggunakan metode PUT
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response.message);
                        $('#editModal').modal('hide');
                        callApi();
                    },
                    error: function(error) {
                        console.log(error.responseJSON);
                        // Tambahkan kode untuk menampilkan pesan error jika diperlukan
                    }
                });
            });

        });

        function callApi() {
            $.ajax({
                url: "http://127.0.0.1:8000/api/getCity",
                method: 'GET',
                success: function(response) {
                    var data = response.data;
                    $("table tbody").html('');
                    data.forEach(function(item, index) {
                        $("table tbody").append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.city_name}</td>
                                <td>${item.created_at}</td>
                                <td>
                                    <button onclick="confirmDelete(${item.id})" class="btn btn-danger"><i class="fa fa-trash"></i></button>      
                                    <button onclick="showCity(${item.id})" class="btn btn-success"><i class="fa fa-pencil"></i></button>      
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }

        function showCity(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/showCity') }}/${id}`,
                method: 'GET',
                success: function(response) {
                    var data = response.data;
                    $('#editId').val(id);
                    $('#editCityName').val(data.city_name);
                    $('#editModal').modal('show');
                }
            });
        }

        function deleteCity(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/deleteCity') }}/${id}`,
                method: 'DELETE',
                success: function(response) {
                    alert(response.message);
                    callApi();
                }
            });
        }

        function confirmDelete(itemId) {
            var confirmed = confirm("Are you sure you want to delete this city?");
            if (confirmed) {
                deleteCity(itemId);
            }
        }
    </script>
@endsection
