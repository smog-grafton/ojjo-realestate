@php
    use Illuminate\Support\Facades\Storage;

    // Use the 'image' column if it has content, otherwise fallback to 'images'
    $images = $property->images ?? [];
    $imageColumn = $property->image ?? [];
    $displayImages = !empty($imageColumn) ? $imageColumn : $images;
@endphp

<div id="propertiesDetailsSlider" class="carousel properties-details-sliders slide mb-30">
    <div class="heading-properties">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3>{{ $property->title }}</h3>
                    <p><i class="fa fa-map-marker"></i> {{ $property->location }}</p>
                </div>
                <div class="p-r">
                    <h3>${{ number_format($property->price) }}</h3>
                    <p>
                        @if($property->is_featured)
                            <span class="badge badge-primary">Featured</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- main slider carousel items -->
    <div class="carousel-inner">
        @if(!empty($displayImages))
            @foreach($displayImages as $index => $imagePath)
                <div class="item carousel-item {{ $index === 0 ? 'active' : '' }}" data-slide-number="{{ $index }}">
                    <img src="{{ Storage::url($imagePath) }}" class="img-fluid" alt="Property image {{ $loop->iteration }}">
                </div>
            @endforeach
        @else
            <div class="active item carousel-item" data-slide-number="0">
                <img src="{{ asset('img/properties/default-property.jpg') }}" class="img-fluid" alt="Default property image">
            </div>
        @endif

        <a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
        <a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div>
    
    <!-- main slider carousel nav controls -->
    <ul class="carousel-indicators smail-properties list-inline nav nav-justified">
        @if(!empty($displayImages))
            @foreach($displayImages as $index => $imagePath)
                <li class="list-inline-item {{ $index === 0 ? 'active' : '' }}">
                    <a id="carousel-selector-{{ $index }}" class="{{ $index === 0 ? 'selected' : '' }}" data-slide-to="{{ $index }}" data-target="#propertiesDetailsSlider">
                        <img src="{{ Storage::url($imagePath) }}" class="img-fluid" alt="Property thumbnail {{ $loop->iteration }}">
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>

<div class="property-meta clearfix mt-3">
    <ul>
        <li>
            <a href="#" class="add-to-wishlist {{ $isFavorited ? 'active' : '' }}" data-property-id="{{ $property->id }}">
                <i class="fa fa-heart"></i> Add to Favorites
            </a>
        </li>
        <li>
            <a href="#" class="share-property" data-toggle="modal" data-target="#sharePropertyModal">
                <i class="fa fa-share-alt"></i> Share
            </a>
        </li>
        <li>
            <a href="#" class="print-property" onclick="window.print()">
                <i class="fa fa-print"></i> Print
            </a>
        </li>
    </ul>
</div>

<!-- Share Property Modal -->
<div class="modal fade" id="sharePropertyModal" tabindex="-1" role="dialog" aria-labelledby="sharePropertyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sharePropertyModalLabel">Share This Property</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="share-links text-center">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('properties.show', $property->id)) }}" target="_blank" class="social-button facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($property->title) }}&url={{ urlencode(route('properties.show', $property->id)) }}" target="_blank" class="social-button twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('properties.show', $property->id)) }}&title={{ urlencode($property->title) }}" target="_blank" class="social-button linkedin">
                        <i class="fa fa-linkedin"></i>
                    </a>
                    @php
                        $firstImage = !empty($displayImages) ? $displayImages[0] : null;
                        $pinterestImage = $firstImage ? Storage::url($firstImage) : '';
                    @endphp
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('properties.show', $property->id)) }}&media={{ urlencode($pinterestImage) }}&description={{ urlencode($property->title) }}" target="_blank" class="social-button pinterest">
                        <i class="fa fa-pinterest"></i>
                    </a>
                    <a href="mailto:?subject={{ urlencode('Check out this property: ' . $property->title) }}&body={{ urlencode('I found this property and thought you might be interested: ' . route('properties.show', $property->id)) }}" class="social-button email">
                        <i class="fa fa-envelope"></i>
                    </a>
                </div>
                
                <div class="copy-link mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="propertyShareLink" value="{{ route('properties.show', $property->id) }}" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="copyShareLink">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Copy share link to clipboard
        $('#copyShareLink').on('click', function() {
            var copyText = document.getElementById("propertyShareLink");
            copyText.select();
            document.execCommand("copy");
            toastr.success('Link copied to clipboard!');
        });
    });
</script>
@endpush 