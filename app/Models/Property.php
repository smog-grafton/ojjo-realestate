<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Property extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'status',
        'bedrooms',
        'bathrooms',
        'area',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'images',
        'features',
        'is_featured',
        'is_active',
        'user_id',
        'agency_id',
        'property_type',
        'area_sqft',
        'zip_code',
        'views',
        'rent_type',
        'location',
        'image',
        'property_category_id',
        'property_type_id',
        'is_bookable',
        'year_built',
        'garage_spaces',
        'parking_spaces',
        'lot_size',
        'sold_date',
        'place_id',
    ];

    protected $casts = [
        'price' => 'float',
        'area' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'images' => 'array',
        'image' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_bookable' => 'boolean',
        'sold_date' => 'date',
        'rating' => 'float',
    ];

    /**
     * Get the user who submitted this property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the agency this property belongs to.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * Get the category of this property.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }

    /**
     * Get the type of this property.
     */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    /**
     * Get the amenities of this property.
     */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(PropertyAmenity::class, 'property_amenity', 'property_id', 'property_amenity_id')
            ->withTimestamps();
    }

    /**
     * Get the labels associated with this property.
     */
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(PropertyLabel::class, 'property_property_label')
                    ->withTimestamps();
    }

    /**
     * Get the bookings of this property.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get users who have favorited this property.
     */
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorite_properties')
                    ->withTimestamps();
    }

    /**
     * Get the tour requests for this property.
     */
    public function tourRequests(): HasMany
    {
        return $this->hasMany(PropertyTourRequest::class);
    }

    /**
     * Get the info requests for this property.
     */
    public function infoRequests(): HasMany
    {
        return $this->hasMany(PropertyInfoRequest::class);
    }

    /**
     * Get all the contact messages for the property.
     */
    public function contactMessages()
    {
        return $this->hasMany(PropertyContactMessage::class);
    }

    /**
     * Get the comments for this property.
     */
    public function comments()
    {
        return $this->hasMany(PropertyComment::class)->whereNull('parent_id')->latest();
    }

    /**
     * Get all comments for this property, including replies.
     */
    public function allComments()
    {
        return $this->hasMany(PropertyComment::class);
    }

    /**
     * Get all the reviews for the property.
     */
    public function reviews()
    {
        return $this->hasMany(PropertyReview::class)->approved()->latest();
    }

    /**
     * Get all the reviews for the property including pending ones.
     */
    public function allReviews()
    {
        return $this->hasMany(PropertyReview::class);
    }

    /**
     * Get the property's average rating.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get the property's rounded rating for display.
     */
    public function getRoundedRatingAttribute()
    {
        return ceil($this->average_rating);
    }

    /**
     * Get the place this property belongs to.
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
