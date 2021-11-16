@extends('layouts.layout')

@section('content')
   <div id="app">
    <Users
    :users = "{{ $users }}"
    :stores = "{{ $stores }}">
    </Users>
   </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection