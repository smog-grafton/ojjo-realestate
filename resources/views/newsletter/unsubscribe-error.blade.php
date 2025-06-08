@extends('layouts.app')

@section('title', 'Unsubscribe Error - Ojjo Estates')

@section('content')
<div class="inner-page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-page-content">
                    <h1>Newsletter Unsubscription</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Error</li>
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
                        <!-- Error Icon -->
                        <div class="mb-4">
                            <i class="fa fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                        </div>
                        
                        <!-- Error Message -->
                        <h2 class="mb-3 text-danger">Unsubscribe Failed</h2>
                        <p class="lead mb-4">
                            {{ session('error', 'We encountered an issue while trying to unsubscribe you from our newsletter.') }}
                        </p>
                        
                        <!-- Possible Reasons -->
                        <div class="alert alert-warning mx-auto" style="max-width: 500px;">
                            <h5 class="alert-heading">Possible reasons:</h5>
                            <ul class="text-left mb-0">
                                <li>The unsubscribe link may have expired</li>
                                <li>The link may have been used already</li>
                                <li>There might be a temporary system issue</li>
                                <li>The email address might not be in our database</li>
                            </ul>
                        </div>
                        
                        <!-- Help Section -->
                        <div class="mt-4 p-4 bg-light rounded">
                            <h5>Need help?</h5>
                            <p class="mb-3">
                                If you continue to receive newsletters and want to unsubscribe, please contact our support team directly.
                            </p>
                            
                            <!-- Contact Options -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="contact-option">
                                        <i class="fa fa-envelope text-primary mb-2" style="font-size: 1.5rem;"></i>
                                        <h6>Email Support</h6>
                                        <a href="mailto:info@ojjoestates.com?subject=Newsletter Unsubscribe Request" class="btn btn-outline-primary btn-sm">
                                            info@ojjoestates.com
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="contact-option">
                                        <i class="fa fa-phone text-success mb-2" style="font-size: 1.5rem;"></i>
                                        <h6>Phone Support</h6>
                                        <a href="tel:+256700000000" class="btn btn-outline-success btn-sm">
                                            +256 700 000 000
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fa fa-home"></i> Back to Home
                            </a>
                            <button onclick="history.back()" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-arrow-left"></i> Go Back
                            </button>
                        </div>
                        
                        <!-- Manual Unsubscribe Form -->
                        <div class="mt-5 pt-4 border-top">
                            <h5>Try Manual Unsubscribe</h5>
                            <p class="text-muted mb-3">
                                Enter your email address and we'll send you a new unsubscribe link.
                            </p>
                            
                            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="action" value="unsubscribe_request">
                                <div class="input-group" style="max-width: 400px; margin: 0 auto;">
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa fa-paper-plane"></i> Send Link
                                    </button>
                                </div>
                            </form>
                            
                            <small class="text-muted d-block mt-2">
                                We'll send you a new unsubscribe link if your email is in our database.
                            </small>
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
    
    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeaa7;
        color: #856404;
    }
    
    .contact-option {
        text-align: center;
    }
    
    .btn-lg {
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 8px;
    }
    
    .text-danger {
        color: #dc3545 !important;
    }
    
    .text-warning {
        color: #ffc107 !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
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
        
        .input-group {
            flex-direction: column;
        }
        
        .input-group .form-control,
        .input-group .btn {
            border-radius: 0.25rem !important;
            margin-bottom: 10px;
        }
    }
</style>
@endsection 