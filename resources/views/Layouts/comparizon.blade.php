@extends('template')

@section('header')
    Comparizon Menu
@endsection

@section('content')
    {{-- Multiple Select --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <section>
        <div class="card">
            <div class="card-header">
                <form id="filterForm" method="POST" action="/compare">
                    @csrf
                    <div class="row justify-content-end">
                        <div class="col-md-9">
                            @isset($taxi)
                                <select name="drivers[]" id="drivers" multiple>
                                    @foreach ($taxi as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->driver_name }}</option>
                                    @endforeach
                                </select>
                            @endisset
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Compare</button>
                            <a href="/comparizon" class="btn btn-default">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart"
                        style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
    {{-- Multiple Select --}}
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>

    <script>
        $(function() {
            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartData = {
                labels: ['data1', 'data2'],
                datasets: [{
                    label: 'Compare Driver', // Ubah label sesuai kebutuhan
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {!! json_encode($data) !!} // Masukkan data dari $filteredData di sini
                }]
            };

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });
            $(window).on('load', function() {
                $('#drivers').val([]);
            });
        });
    </script>
    <script>
        new MultiSelectTag('drivers', {
            rounded: true,
            placeholder: 'Cari', // default Search...
            onChange: function(values) {
                console.log(values);
            }
        });
    </script>
@endsection
