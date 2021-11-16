@extends('layouts.layout')

@section('content')
    <div id="app">
        <makeup
        :category_id = "{{ $category_id }}"
        :subcategories = "{{ $subcategories }}"
        ></makeup>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection