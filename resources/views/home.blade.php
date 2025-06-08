@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('partials.hero-section')
    @include('partials.featured-properties')
    @include('partials.services-section')
    @include('partials.recent-properties')
    @include('partials.popular-cities')
    {{-- Meet Our Agents Section --}}
    @include('partials.agents')
    {{-- Customer Testimonials Section --}}
    @include('partials.testimonials')
    {{-- Latest Blog Section --}}
    @include('partials.blog-section')
    {{-- Newsletter Subscription Section --}}
    @include('partials.newsletter')
@endsection 