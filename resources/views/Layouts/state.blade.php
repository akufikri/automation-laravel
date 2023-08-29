@extends('template')
@section('header')
    State
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
                    <form id="stateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="country_name" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="state_name" id="state_name">
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
                    <form id="editStateForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Menggunakan metode PUT untuk permintaan -->
                        <input type="hidden" name="editId" id="editId">

                        <div class="mb-3">
                            <label for="editCountryName" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="editStateName" id="editStateName">
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
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalInsert">add
                    state</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>State Name</th>
                            <th>Created At</th>
                            <th>Action</th>
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

            $('#stateForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ url('http://127.0.0.1:8000/api/storeState') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response.message)
                        $('#modalInsert').modal('hide');
                        $('#stateForm')[0].reset();
                        callApi();
                    }
                });
            });

            $('#editStateForm').submit(function(e) {
                e.preventDefault();

                var editData = {
                    state_name: $('#editStateName').val(),
                };

                var editId = $('#editId').val();

                var formData = new FormData();
                formData.append('state_name', editData.state_name);

                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/updateState') }}/${editId}`,
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

                    }
                });
            });

        });

        function callApi() {
            $.ajax({
                url: "http://127.0.0.1:8000/api/getState",
                method: 'GET',
                success: function(response) {
                    var data = response.data;
                    $("table tbody").html('');
                    data.forEach(function(item, index) {
                        $("table tbody").append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.state_name}</td>
                                <td>${item.created_at}</td>
                                <td>
                                    <button onclick="confirmDelete(${item.id})" class="btn btn-danger"><i class="fa fa-trash"></i></button>      
                                    <button onclick="showState(${item.id})" class="btn btn-success"><i class="fa fa-pencil"></i></button>      
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }

        function showState(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/showState') }}/${id}`,
                method: 'GET',
                success: function(response) {
                    var data = response.data;
                    $('#editId').val(id);
                    $('#editStateName').val(data.state_name);
                    $('#editModal').modal('show');
                }
            });
        }

        function deleteState(id) {
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/deleteState') }}/${id}`,
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
                deleteState(itemId);
            }
        }
    </script>
@endsection
