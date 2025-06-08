@extends('layouts.app')

@section('title', 'Unsubscribed Successfully - Ojjo Estates')

@section('content')
<div class="inner-page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-page-content">
                    <h1>Newsletter Unsubscription</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Unsubscribed</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg">
                    <div class="card-body text-center py-5">
                        <!-- Success Icon -->
                        <div class="mb-4">
                            <i class="fa fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        <!-- Success Message -->
                        <h2 class="mb-3 text-success">Successfully Unsubscribed!</h2>
                        <p class="lead mb-4">
                            {{ session('success', 'You have been successfully unsubscribed from our newsletter.') }}
                        </p>
                        
                        <!-- Additional Information -->
                        <div class="alert alert-info mx-auto" style="max-width: 500px;">
                            <h5 class="alert-heading">What happens next?</h5>
                            <ul class="text-left mb-0">
                                <li>You will no longer receive newsletter emails from us</li>
                                <li>Your data remains secure and protected</li>
                                <li>You can resubscribe anytime using our newsletter forms</li>
                            </ul>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fa fa-home"></i> Back to Home
                            </a>
                            <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-building"></i> Browse Properties
                            </a>
                        </div>
                        
                        <!-- Feedback Section -->
                        <div class="mt-5 pt-4 border-top">
                            <h5>Help us improve</h5>
                            <p class="text-muted">
                                We'd love to hear why you unsubscribed. Your feedback helps us provide better content.
                            </p>
                            <a href="mailto:info@ojjoestates.com?subject=Newsletter Feedback" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-envelope"></i> Send Feedback
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .content-area {
        padding: 60px 0;
        background-color: #f8f9fa;
        min-height: 70vh;
    }
    
    .card {
        border: none;
        border-radius: 15px;
    }
    
    .alert-info {
        background-color: #e8f4fd;
        border-color: #b6d7ff;
        color: #0c5460;
    }
    
    .btn-lg {
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 8px;
    }
    
    .text-success {
        color: #28a745 !important;
    }
    
    @media (max-width: 768px) {
        .btn-lg {
            display: block;
            margin-bottom: 10px;
            width: 100%;
        }
        
        .me-3 {
            margin-right: 0 !important;
        }
    }
</style>
@endsection 