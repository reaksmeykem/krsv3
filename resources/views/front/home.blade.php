@extends('master')
@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
@endsection
@section('contentFrontend')
    @livewire('front.home')
@endsection
