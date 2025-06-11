@php use Illuminate\Support\Facades\Storage; @endphp
@php use Illuminate\Support\Str; @endphp

<!-- Most popular places start -->
<div class="most-popular-places content-area-23 bg-white">
    <div class="container">
        <!-- Main title section -->
        <div class="main-title">
            <h1>Most Popular Places</h1>
            <p>Discover the most sought-after locations for your next property investment.</p>
        </div>
        
        <!-- Popular places grid container -->
        <div class="container">
            <div class="row">
                @if($popularPlaces->count() > 0)
                    <!-- Left column: First two popular places -->
                    <div class="col-lg-4 col-md-12 col-pad wow fadeInLeft delay-04s">
                        <div class="row">
                            @if(isset($popularPlaces[0]))
                                <!-- First place -->
                                <div class="col-lg-12 col-md-6 col-sm-12 cp-2">
                                    <div class="most-popular-box-1">
                                        <div class="thumb-photo">
                                            <img src="{{ Storage::url($popularPlaces[0]->image) }}" alt="{{ $popularPlaces[0]->name }}" class="img-fluid">
                                            <div class="content"></div>
                                            <div class="inner">
                                                <div class="info">
                                                    <h3><a href="{{ route('properties.index', ['city' => $popularPlaces[0]->name]) }}">{{ $popularPlaces[0]->name }}</a></h3>
                                                    <p>{{ $popularPlaces[0]->properties_count }} {{ Str::plural('Property', $popularPlaces[0]->properties_count) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if(isset($popularPlaces[1]))
                                <!-- Second place -->
                                <div class="col-lg-12 col-md-6 col-sm-12 cp-2">
                                    <div class="most-popular-box-1">
                                        <div class="thumb-photo">
                                            <img src="{{ Storage::url($popularPlaces[1]->image) }}" alt="{{ $popularPlaces[1]->name }}" class="img-fluid">
                                            <div class="content"></div>
                                            <div class="inner">
                                                <div class="info">
                                                    <h3><a href="{{ route('properties.index', ['city' => $popularPlaces[1]->name]) }}">{{ $popularPlaces[1]->name }}</a></h3>
                                                    <p>{{ $popularPlaces[1]->properties_count }} {{ Str::plural('Property', $popularPlaces[1]->properties_count) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Center column: Featured place (tall) -->
                    <div class="col-lg-4 col-md-12 col-sm-12 col-pad cp-3 wow fadeInUp delay-04s d-none-992">
                        @if(isset($popularPlaces[2]))
                            <div class="most-popular-box-1 mpb-2">
                                <div class="thumb-photo">
                                    <img src="{{ Storage::url($popularPlaces[2]->image) }}" alt="{{ $popularPlaces[2]->name }}" class="img-fluid">
                                    <div class="content"></div>
                                    <div class="inner">
                                        <div class="info">
                                            <h3><a href="{{ route('properties.index', ['city' => $popularPlaces[2]->name]) }}">{{ $popularPlaces[2]->name }}</a></h3>
                                            <p>{{ $popularPlaces[2]->properties_count }} {{ Str::plural('Property', $popularPlaces[2]->properties_count) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Right column: Last two popular places -->
                    <div class="col-lg-4 col-md-12 col-pad wow fadeInRight delay-04s">
                        <div class="row">
                            @if(isset($popularPlaces[3]))
                                <!-- Fourth place -->
                                <div class="col-lg-12 col-md-6 col-sm-12 cp-2">
                                    <div class="most-popular-box-1">
                                        <div class="thumb-photo">
                                            <img src="{{ Storage::url($popularPlaces[3]->image) }}" alt="{{ $popularPlaces[3]->name }}" class="img-fluid">
                                            <div class="content"></div>
                                            <div class="inner">
                                                <div class="info">
                                                    <h3><a href="{{ route('properties.index', ['city' => $popularPlaces[3]->name]) }}">{{ $popularPlaces[3]->name }}</a></h3>
                                                    <p>{{ $popularPlaces[3]->properties_count }} {{ Str::plural('Property', $popularPlaces[3]->properties_count) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if(isset($popularPlaces[4]))
                                <!-- Fifth place -->
                                <div class="col-lg-12 col-md-6 col-sm-12 cp-2">
                                    <div class="most-popular-box-1">
                                        <div class="thumb-photo">
                                            <img src="{{ Storage::url($popularPlaces[4]->image) }}" alt="{{ $popularPlaces[4]->name }}" class="img-fluid">
                                            <div class="content"></div>
                                            <div class="inner">
                                                <div class="info">
                                                    <h3><a href="{{ route('properties.index', ['city' => $popularPlaces[4]->name]) }}">{{ $popularPlaces[4]->name }}</a></h3>
                                                    <p>{{ $popularPlaces[4]->properties_count }} {{ Str::plural('Property', $popularPlaces[4]->properties_count) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-12 text-center">
                        <p>No popular places found. Please add some places in the admin panel.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Most popular places end --> 