@extends('layouts.layout')

@section('content')
    <div id="app">
        <br />
        <Themes 
        :themes = "{{ $themes }}"> 
        />
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection