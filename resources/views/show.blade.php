@extends('layouts.master')
@section('page-title', 'Decrypt Encrypted Message')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title text-center pb-3">Decrypt Encrypted Message</h5>
                    <div class="text-center">
                        <form method="POST" action="{{ route('messages.decrypt') }}">
                            @csrf
                            <label class="mb-2" for="encrypted_string">Identifier</label><br>
                            <input type="text" class="form-control" id="identifier" name="identifier"><br><br>
                            <label class="mb-2" for="decryption_key">Decryption Key</label><br>
                            <input type="text" class="form-control" id="decryption_key" name="decryption_key"><br><br>
                            <button type="submit" class="btn btn-primary">Decrypt Message</button>
                        </form>
                        <div class="mt-3">
                            <p>Want to Encrypt a Message <a href="{{route('messages.create')}}"> click here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('text'))
    <div class="row mt-3">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title text-center pb-3">Decrypted Message</h5>
                    <div class="text-center">
                        <p>{{ session('text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div>
    </div>
    @endsection
