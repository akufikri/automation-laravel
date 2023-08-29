@extends('template')
@section('header')
    Transactions
@endsection
@section('content')
    <div class="modal fade" id="modalInsert">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Transactions Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/insert_trans" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="country_name" class="form-label">Rider</label>
                            <select name="taxi_id" class="form-control" id="">
                                @foreach ($taxi as $taxi)
                                    <option value="{{ $taxi->id }}">{{ $taxi->driver_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nominal</label>
                            <input type="number" class="form-control" name="amount" id="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Payment</label>
                            <input type="text" class="form-control" name="payment_methode" id="">
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
                <div class="row">
                    <div class="col">
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalInsert">
                            <i class="fa-solid fa-plus"></i> Create</button>
                    </div>
                    <div class="col-md-2">
                        <select id="currencySelect" class="form-control">
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="IDR">IDR</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Rider</th>
                            <th>Nominal</th>
                            <th>Transaction Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var storedCurrency = localStorage.getItem('selectedCurrency');
            if (storedCurrency) {
                $('#currencySelect').val(storedCurrency);
                updateTable(storedCurrency);
            }

            callApi();
        });


        function callApi() {
            var currencySelect = $('#currencySelect');

            currencySelect.on('change', function() {
                var selectedCurrency = $(this).val();
                localStorage.setItem('selectedCurrency', selectedCurrency);
                updateTable(selectedCurrency);
            });

            currencySelect.trigger('change');
        }

        function deleteTransaction(id) {
            $.ajax({
                method: "DELETE",
                url: `{{ url('http://127.0.0.1:8000/api/deleteTransaction') }}/${id}`,
                success: function(response) {
                    alert(response.message);
                    callApi();
                }
            });
        }


        function updateTable(selectedCurrency) {
            $.ajax({
                url: "{{ url('http://127.0.0.1:8000/api/getTransactions') }}",
                method: "GET",
                success: function(response) {
                    var tableData = response.data;
                    var tableBody = $('#tableBody');
                    tableBody.empty();

                    $.each(tableData, function(index, data) {
                        var originalAmount = data.amount;
                        var convertedAmount = convertToCurrency(originalAmount,
                            selectedCurrency);

                        var row = `
                            <tr>
                                <td>${index+1}</td> 
                                <td>${data.taxi.driver_name}</td>     
                                <td class="converted-amount" data-amount="${originalAmount}" data-currency="${selectedCurrency}">${convertedAmount}</td>     
                                <td>${data.transaction_time}</td>     
                                <td>
                                    <button onclick="deleteTransaction(${data.id})" class="btn btn-danger">DELETE</button>
                                </td>     
                            </tr>
                        `;

                        tableBody.append(row);
                    });
                }
            });
        }

        $('#currencySelect').on('change', function() {
            var selectedCurrency = $(this).val();
            $('.converted-amount').each(function() {
                var originalAmount = parseFloat($(this).data('amount'));
                var convertedAmount = convertToCurrency(originalAmount, selectedCurrency);
                $(this).text(convertedAmount);
            });
        });

        function convertToCurrency(amount, currencyCode) {
            // Set conversion rules based on currency code
            var currencySymbol = '';
            switch (currencyCode) {
                case 'USD':
                    currencySymbol = '$';
                    break;
                case 'EUR':
                    currencySymbol = '€';
                    break;
                case 'IDR':
                    currencySymbol = 'Rp';
                    break;
                    // Add more cases for other currencies if needed
                default:
                    currencySymbol = currencyCode;
                    break;
            }
            var exchangeRates = {
                USD: 1, // Example exchange rate for USD (1 USD = 1 USD)
                EUR: 0.85, // Example exchange rate for EUR (1 EUR = 0.85 USD)
                IDR: 14000 // Example exchange rate for IDR (1 IDR = 0.0000714 USD)
                // You need to replace these with actual exchange rates
            };

            var selectedExchangeRate = exchangeRates[currencyCode];
            var convertedAmount = amount * selectedExchangeRate;
            return convertedAmount.toFixed(2) + ' ' + currencyCode;
            return currencySymbol + ' ' + new Intl.NumberFormat('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        }
    </script>
@endsection
