@extends('layouts.layout')

@section('content')
    <div id="app">
        <product-list
        :subcategory = "{{ $sub }}"
        :category = "{{ $category_id }}"
        :products = "{{ json_encode($data) }}"
        :itemsimage = "{{ json_encode($items_image) }}"
        ></product-list>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection