@extends('template')
@section('header')
    Avilable Status
@endsection
@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <section>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Driver Name</th>
                                    <th>License Plate</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($available as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->driver_name }}</td>
                                        <td>{{ $item->license_plate }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
