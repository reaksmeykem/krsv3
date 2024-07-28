@extends('dashboard.master')
@section('content')

    @livewire('dashboard.post.post-edit', ['post' => $post])

@endsection
