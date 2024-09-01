@extends('master')
@section('contentFrontend')
    @livewire('front.get-postby-category', ['categorySlug' => $categorySlug])
@endsection
