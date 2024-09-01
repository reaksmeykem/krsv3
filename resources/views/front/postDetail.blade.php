@extends('master')
@section('contentFrontend')
    @livewire('front.post-detail', ['post' => $post])
@endsection
