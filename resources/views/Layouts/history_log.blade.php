@extends('template')
@section('header')
    History Login
@endsection
@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <section>
        <div class="card table-responsive">
            <div class="card-header">
            </div>
            <div class="card-body ">
                <table id="myTable" class="table table-bordered text-center ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Ip Address</th>
                            <th>Browser</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($his_login as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td>{{ $item->ip_address }}</td>
                                <td>{{ $item->browser }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure you want to delete this history?')"
                                        href="deleteHistory/{{ $item->id }}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $('#myTable').DataTable({
            responsive: true,
            searching: true
        });
    </script>
@endsection
