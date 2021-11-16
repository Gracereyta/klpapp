@extends('layouts.layout')

@section('content')
   <div id="app">
    <Cropper />
   </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection