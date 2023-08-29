@extends('template')

@section('header')
    Send Broadcast Email
@endsection

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    {{-- DATATABLE --}}
    <!--------------------------------------------->
    {{-- MODAL INSERT --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title"><i class="fa-solid fa-paper-plane"></i> Send Mail</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="send_mail" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <select name="user_id[]" id="" class="form-control" multiple>
                                @foreach ($user as $userData)
                                    <option value="{{ $userData->name }}|{{ $userData->email }}">{{ $userData->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" style="resize: none" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL INSERT --}}
    <!--------------------------------------------->
    <section>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary float-right" type="button" data-bs-toggle="modal"
                    data-bs-target="#modal-default">Create</button>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Queue</th>
                                <th>Payloads</th>
                                <th>Attempts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @if ($list->isEmpty())
                                <tr>
                                    <td colspan="4">all data has been sent</td>
                                </tr>
                            @else
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->queue }}</td>
                                        <td>{{ $item->payload }}</td>
                                        <td>{{ $item->attempts }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endsection
