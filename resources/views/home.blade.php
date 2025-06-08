@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('partials.hero-section')
    @include('partials.featured-properties')
    @include('partials.services-section')
@endsection 