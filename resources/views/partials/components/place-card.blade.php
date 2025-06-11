{{-- 
    Place card component for the popular places section
    Parameters:
    - place: The place model
    - size: 'small' for regular cards, 'tall' for the center feature card
--}}

<div class="col-lg-12 col-md-6 col-sm-12 cp-2">
    <div class="most-popular-box-1 {{ $size === 'tall' ? 'mpb-2' : '' }}">
        <div class="thumb-photo">
            @if($place->image)
                <img src="{{ Storage::url($place->image) }}" alt="{{ $place->name }}" class="img-fluid">
            @else
                <img src="{{ asset('assets/img/popular-places/placeholder.png') }}" alt="{{ $place->name }}" class="img-fluid">
            @endif
            <div class="content"></div>
            <div class="inner">
                <div class="info">
                    <h3><a href="{{ route('properties.index', ['city' => $place->name]) }}">{{ $place->name }}</a></h3>
                    <p>{{ $place->properties_count }} {{ Str::plural('Property', $place->properties_count) }}</p>
                </div>
            </div>
        </div>
    </div>
</div> 