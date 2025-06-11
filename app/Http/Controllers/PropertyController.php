<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyType;
use App\Models\PropertyAmenity;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index(Request $request)
    {
        $query = Property::where('status', 'approved')->where('is_active', true);

        // Filter by property type (listing type)
        if ($request->has('property_type') && $request->property_type) {
            $query->where('property_type', $request->property_type);
        }

        // Filter by property category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('property_category_id', $request->category_id);
        }
        
        // Filter by property type (property type model)
        if ($request->has('type_id') && $request->type_id) {
            $query->where('property_type_id', $request->type_id);
        }

        // Filter by rent type
        if ($request->has('rent_type') && $request->rent_type) {
            $query->where('rent_type', $request->rent_type);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by location (city, state, or address)
        if ($request->has('location') && $request->location) {
            $query->where(function($q) use ($request) {
                $q->where('city', 'like', '%' . $request->location . '%')
                  ->orWhere('state', 'like', '%' . $request->location . '%')
                  ->orWhere('address', 'like', '%' . $request->location . '%')
                  ->orWhere('location', 'like', '%' . $request->location . '%');
            });
        }
        
        // Filter by city
        if ($request->has('city') && $request->city) {
            $query->where('city', $request->city);
        }

        // Filter by place (place_id)
        if ($request->has('place_id') && $request->place_id) {
            $query->where('place_id', $request->place_id);
        }

        // Filter by bedrooms
        if ($request->has('bedrooms') && $request->bedrooms) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        // Filter by bathrooms
        if ($request->has('bathrooms') && $request->bathrooms) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        // Filter by amenities
        if ($request->has('amenities') && is_array($request->amenities) && count($request->amenities) > 0) {
            $query->whereHas('amenities', function($q) use ($request) {
                $q->whereIn('property_amenities.id', $request->amenities);
            }, '=', count($request->amenities));
        }
        
        // Filter bookable properties only
        if ($request->has('bookable') && $request->bookable) {
            $query->where('is_bookable', true);
        }

        $properties = $query->with(['user.agentProfile', 'agency', 'category', 'propertyType', 'amenities', 'labels'])->paginate(12);

        // Get categories, types, and amenities for filters
        $categories = PropertyCategory::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $amenities = PropertyAmenity::where('is_active', true)->get();

        // Get recent properties for sidebar
        $recentProperties = $this->getRecentProperties();

        return view('properties.index', compact('properties', 'categories', 'types', 'amenities', 'recentProperties'));
    }

    /**
     * Get recent properties for sidebar display.
     */
    protected function getRecentProperties($limit = 3)
    {
        return Property::where('status', 'approved')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Display the specified property.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        // Redirect to home if property is not active or approved
        if (!$property->is_active || $property->status !== 'approved') {
            return redirect()->route('home')->with('error', 'Property not found or unavailable.');
        }

        // Handle SEO-friendly slugs
        $requestSlug = request()->segment(count(request()->segments()));
        if ($requestSlug !== $property->slug) {
            return redirect()->route('properties.show', $property->slug);
        }

        // Load related data
        $property->load(['user.agentProfile', 'agency', 'category', 'propertyType', 'amenities', 'labels', 'comments.replies']);
        
        // Increment view count
        $property->increment('views');
        
        // Load related properties with the same category or type
        $relatedProperties = Property::where('status', 'approved')
            ->where('is_active', true)
            ->where('id', '!=', $property->id)
            ->where(function($query) use ($property) {
                $query->where('property_category_id', $property->property_category_id)
                      ->orWhere('property_type_id', $property->property_type_id);
            })
            ->with(['amenities', 'labels'])
            ->take(3)
            ->get();
        
        // Check if the property is favorited by the current user
        $isFavorited = false;
        if (Auth::check()) {
            $isFavorited = $this->isFavorited($property);
        }

        return view('properties.show', compact('property', 'relatedProperties', 'isFavorited'));
    }

    /**
     * Add property to favorites.
     */
    public function favorite(Property $property)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to favorite properties.');
        }

        if (!$property->favoritedBy()->where('user_id', Auth::id())->exists()) {
            $property->favoritedBy()->attach(Auth::id());
            return back()->with('success', 'Property has been added to your favorites.');
        }

        return back()->with('info', 'Property is already in your favorites.');
    }

    /**
     * Remove property from favorites.
     */
    public function unfavorite(Property $property)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to manage favorites.');
        }

        $property->favoritedBy()->detach(Auth::id());
        return back()->with('success', 'Property has been removed from your favorites.');
    }

    /**
     * Check if property is favorited by current user.
     */
    protected function isFavorited(Property $property): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return $property->favoritedBy()->where('user_id', Auth::id())->exists();
    }

    /**
     * Display properties filtered by type.
     */
    public function byType($slug)
    {
        $type = PropertyType::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $properties = Property::where('status', 'approved')
            ->where('is_active', true)
            ->where('property_type_id', $type->id)
            ->with(['user.agentProfile', 'agency', 'category', 'propertyType', 'amenities', 'labels'])
            ->paginate(12);
        
        // Get categories, types, and amenities for filters
        $categories = PropertyCategory::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $amenities = PropertyAmenity::where('is_active', true)->get();
        
        // Get recent properties for sidebar
        $recentProperties = $this->getRecentProperties();
        
        return view('properties.index', compact('properties', 'categories', 'types', 'amenities', 'type', 'recentProperties'));
    }
    
    /**
     * Display properties filtered by category.
     */
    public function byCategory($slug)
    {
        $category = PropertyCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $properties = Property::where('status', 'approved')
            ->where('is_active', true)
            ->where('property_category_id', $category->id)
            ->with(['user.agentProfile', 'agency', 'category', 'propertyType', 'amenities', 'labels'])
            ->paginate(12);
        
        // Get categories, types, and amenities for filters
        $categories = PropertyCategory::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $amenities = PropertyAmenity::where('is_active', true)->get();
        
        // Get recent properties for sidebar
        $recentProperties = $this->getRecentProperties();
        
        return view('properties.index', compact('properties', 'categories', 'types', 'amenities', 'category', 'recentProperties'));
    }
    
    /**
     * Display properties filtered by amenity.
     */
    public function byAmenity($slug)
    {
        $amenity = PropertyAmenity::where('id', $slug)->orWhere('name', $slug)->where('is_active', true)->firstOrFail();
        
        $properties = Property::where('status', 'approved')
            ->where('is_active', true)
            ->whereHas('amenities', function($query) use ($amenity) {
                $query->where('property_amenities.id', $amenity->id);
            })
            ->with(['user.agentProfile', 'agency', 'category', 'propertyType', 'amenities', 'labels'])
            ->paginate(12);
        
        // Get categories, types, and amenities for filters
        $categories = PropertyCategory::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $amenities = PropertyAmenity::where('is_active', true)->get();
        
        // Get recent properties for sidebar
        $recentProperties = $this->getRecentProperties();
        
        return view('properties.index', compact('properties', 'categories', 'types', 'amenities', 'amenity', 'recentProperties'));
    }
}
