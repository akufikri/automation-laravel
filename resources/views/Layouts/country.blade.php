@extends('template')
@section('header')
    Country
@endsection
@section('content')
    <!-- Modal -->
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
                    <form id="countryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="country_name" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="country_name" id="country_name">
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
                    <form id="editCountryForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Menggunakan metode PUT untuk permintaan -->
                        <input type="hidden" name="editId" id="editId">

                        <div class="mb-3">
                            <label for="editCountryName" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="editCountryName" id="editCountryName">
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

    <section>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalInsert">Add
                    Country</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Country Name</th>
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

            $('#countryForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/storeCountry') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modalInsert').modal('hide');
                        $('#countryForm')[0].reset();
                        callApi();
                    }
                });
            });

            $('#editCountryForm').submit(function(e) {
                e.preventDefault();

                var editData = {
                    country_name: $('#editCountryName').val(),
                };

                var editId = $('#editId').val();

                var formData = new FormData();
                formData.append('country_name', editData.country_name);

                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/updateCountry') }}/${editId}`,
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
                url: "http://127.0.0.1:8000/api/getCountry",
                method: 'GET',
                success: function(response) {
                    var data = response.data;
                    $("table tbody").html('');
                    data.forEach(function(item, index) {
                        $("table tbody").append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.country_name}</td>
                                <td>${item.created_at}</td>
                                <td>
                                    <button onclick="confirmDelete(${item.id})" class="btn btn-danger"><i class="fa fa-trash"></i></button>      
                                    <button onclick="showCountry(${item.id})" class="btn btn-success"><i class="fa fa-pencil"></i></button>      
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }

        function showCountry(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/showCountry') }}/${id}`,
                method: 'GET',
                success: function(response) {
                    var data = response.data;
                    $('#editId').val(id);
                    $('#editCountryName').val(data.country_name);
                    $('#editModal').modal('show');
                }
            });
        }

        function deleteCountry(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/deleteCountry') }}/${id}`,
                method: 'DELETE',
                success: function(response) {
                    alert(response.message);
                    callApi();
                }
            });
        }

        function confirmDelete(itemId) {
            var confirmed = confirm("Are you sure you want to delete this country?");
            if (confirmed) {
                deleteCountry(itemId);
            }
        }
    </script>
@endsection
