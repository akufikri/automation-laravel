@extends('template')

@section('header')
    Dashboard
@endsection

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="lineChart"
                            style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-success">
                                <h6>Default Location GO TAX</h6>
                                <hr>
                                <div id='map' style='width: 100%; height: 200px;'></div>
                            </div>
                            <div class="callout callout-success">
                                <h6>NETWORK INDICATOR</h6>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p id="status"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table text-center table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Driver Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($taxi as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->driver_name }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $('#myTable').DataTable({
            responsive: true,
            searching: true
        });
    </script>
    <script>
        function checkInternetConnection() {
            const statusElement = document.getElementById("status");

            if (navigator.onLine) {
                statusElement.textContent = "You are connected to the internet.";
            } else {
                statusElement.textContent = "You are not connected to the internet.";
            }
        }

        // Check connection status when the page loads
        checkInternetConnection();

        // Check connection status when the network status changes
        window.addEventListener("online", checkInternetConnection);
        window.addEventListener("offline", checkInternetConnection);
    </script>
    <script>
        mapboxgl.accessToken =
            'pk.eyJ1IjoicmlkZXJ1bm5lcm15IiwiYSI6ImNrOHptdGloeTE3NXIzc213aXEybDRkY2UifQ.5a1AaVjCXWW36GJ9TLjLKg';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [104.02027016313349, 1.1041324827115204],
            zoom: 11.15
        });
    </script>
    <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
            var lineChartOptions = {
                responsive: true,
                maintainAspectRatio: true,
            };

            var totalAmount = {{ $totalAmount }}; // Total amount passed from the controller

            var lineChartData = {
                labels: ['Total Amount'],
                datasets: [{
                    label: 'Total Amount',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [totalAmount]
                }]
            };

            var lineChart = new Chart(lineChartCanvas, {
                type: 'bar', // Change the chart type to 'bar' or 'line' as needed
                data: lineChartData,
                options: lineChartOptions
            });
        });
    </script>
@endsection
