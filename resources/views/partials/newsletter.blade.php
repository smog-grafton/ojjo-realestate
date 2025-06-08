<!-- Newsletter section start -->
<div class="our-newslatters">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Newsletter title and description -->
                <h3>Get Newsletter</h3>
                <p>Stay updated with the latest property opportunities, market insights, and exclusive deals across East Africa. Join our community of smart investors.</p>
                
                <!-- Newsletter subscription form -->
                <div class="form-info">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input field -->
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-md btn-message btn-4">Subscribe Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter section end --> 