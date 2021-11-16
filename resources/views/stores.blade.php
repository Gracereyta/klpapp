@extends('layouts.layout')

@section('content')
   <div id="app">
    <Stores
    :stores = "{{ $stores }}">
    </Stores>
   </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection