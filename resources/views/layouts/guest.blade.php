@extends('layouts.app')
{{--@section('pageTitle', 'Overzicht')--}}
@section('navbar-top')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="jetstream">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@endsection


