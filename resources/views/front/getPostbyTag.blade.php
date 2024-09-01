@extends('master')
@section('contentFrontend')
    @livewire('get-post-by-tag', ['tag' => $tag])
@endsection
