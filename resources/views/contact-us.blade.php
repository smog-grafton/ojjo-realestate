@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Contact Us</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Contact Us</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Contact 2 start -->
<div class="contact-2 content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>Contact Us</h1>
            <p>We're here to assist you! Whether you have questions about buying or selling property, booking accommodations, or simply need expert advice, reach out to us today.</p>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 contact-info">
                    <i class="fa fa-map-marker"></i>
                    <h5>Office Address</h5>
                    <p>9G4R+GJ7, Nabweru Rd, Kampala</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 contact-info">
                    <i class="fa fa-phone"></i>
                    <h5>Phone Number</h5>
                    <p>+256 778162705</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 contact-info">
                    <i class="fa fa-envelope"></i>
                    <h5>Email Address</h5>
                    <p>info@ojjorealestate.com</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 contact-info">
                    <i class="fa fa-whatsapp"></i>
                    <h5>WhatsApp</h5>
                    <p>+256 756 192203</p>
                </div>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="form-section">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group name">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group email">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group subject">
                                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" value="{{ old('subject') }}">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group number">
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group message">
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Write message">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="send-btn">
                                    <button type="submit" class="btn btn-4 bh-55">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="opening-hours">
                        <h3>Opening Hours</h3>
                        <ul class="day">
                            <li><strong>Sunday</strong> <span class="text-red"> closed</span></li>
                            <li><strong>Monday</strong> <span> 8 AM - 6 PM</span></li>
                            <li><strong>Tuesday </strong> <span> 8 AM - 6 PM</span></li>
                            <li><strong>Wednesday </strong> <span> 8 AM - 6 PM</span></li>
                            <li><strong>Thursday </strong> <span> 8 AM - 6 PM</span></li>
                            <li><strong>Friday </strong> <span> 8 AM - 6 PM</span></li>
                            <li><strong>Saturday </strong> <span> 8 AM - 6 PM</span></li>
                        </ul>
                        <h3>Follow Us</h3>
                        <ul class="social-list clearfix">
                            <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="instagram-bg"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact 2 end -->

<!-- Maps start -->
<div class="section maps">
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d127671.72034333821!2d32.45901802485437!3d0.3561026317316871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x177dbbac1d2aa439%3A0x2f22b472aec0d111!2s9G4R%2BGJ7%2C%20Nabweru%20Rd%2C%20Kampala!3m2!1d0.356103!2d32.541419999999995!5e0!3m2!1sen!2sug!4v1749453122136!5m2!1sen!2sug" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<!-- Maps end -->
@endsection 