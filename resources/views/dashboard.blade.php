@extends('layouts.layout')

@section('content')
    <div id="app">
        <dashboard
        :categories = "{{ $categories }}"
        :store = "{{ $store }}">
        </dashboard>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection