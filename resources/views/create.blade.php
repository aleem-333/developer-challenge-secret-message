@extends('layouts.master')
@section('page-title', 'Send Encrypted Message')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title text-center pb-3">Send Encrypted Message</h5>
                    <div class="text-center">
                        <form method="POST" action="{{ route('messages.store') }}">
                            @csrf
                            <label class="mb-2" for="text">Message Text:</label><br>
                            <textarea class="form-control" id="text" name="text" rows="4" cols="50"></textarea><br><br>
                            <label class="mb-2" for="recipient">Recipient:</label><br>
                            <input class="form-control" type="text" id="recipient" name="recipient"><br><br>
                            <label class="mb-2" for="expires_at">Expiry Date:</label><br>
                            <input class="form-control text-center" type="date" id="expires_at"
                                name="expires_at"><br><br>
                            <label class="mb-2" for="read_once">Read Once:</label>
                            <input class="" type="checkbox" id="read_once" name="read_once" value="1"><br><br>
                            <button type="submit" class="btn btn-primary">Store Message</button>
                        </form>
                        <div class="mt-3">
                            <p>Want to Decrypt a Message <a href="{{route('messages.show')}}"> click here</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any() || session('message'))
    <div class="row mt-3">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="text-center">
                        @if ($errors->any())
                        <div>
                            <h4>Errors:</h4>
                            <ul style="text-decoration:none">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @elseif (session('message'))
                        <div>
                            <h4>Message Stored:</h4>
                            <p>Identifier: {{ session('message')->recipient }}</p>
                            <p>Decryption Key: {{ session('message')->decryption_key }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
