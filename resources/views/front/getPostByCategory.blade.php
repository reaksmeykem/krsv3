@extends('master')
@section('content')
    @livewire('front.get-postby-category', ['categorySlug' => $categorySlug])
@endsection
