# OJJO Estates - Premium Real Estate & Booking Platform

<p align="center">
  <img src="public/assets/img/logos/logo.png" alt="OJJO Estates Logo" width="200">
</p>

<p align="center">
  <a href="#overview">Overview</a> •
  <a href="#features">Features</a> •
  <a href="#technology-stack">Technology Stack</a> •
  <a href="#installation">Installation</a> •
  <a href="#usage">Usage</a> •
  <a href="#screenshots">Screenshots</a> •
  <a href="#roadmap">Roadmap</a> •
  <a href="#license">License</a>
</p>

## Overview

OJJO Estates is a comprehensive real estate and hospitality platform connecting clients with premium properties and accommodations across East Africa. The platform serves as a one-stop solution for buying, selling, and renting properties, as well as booking hotels, resorts, and villas.

Founded by Ojjo Property Masters Ltd and powered by SmogCoders, OJJO Estates has grown into a leading name in East Africa for real estate and booking services, combining local expertise with global standards.

## Vision

To revolutionize the travel and real estate experience by seamlessly connecting users to premium accommodations and properties across East Africa and beyond. Our vision is to empower travelers with innovative tools, trusted services, and unparalleled accessibility, fostering memorable journeys and confident investments.

## Mission

Our mission is to connect clients with exceptional real estate opportunities and world-class accommodations, ensuring a seamless experience that delivers value, trust, and satisfaction.

## Features

### For Property Seekers
- **Advanced Property Search**: Filter by location, type, price, amenities, and more
- **Detailed Property Listings**: High-quality images, comprehensive descriptions, and virtual tours
- **Favorite Properties**: Save and compare properties of interest
- **Property Alerts**: Get notified when new properties match your criteria
- **Schedule Tours**: Book property viewings directly through the platform

### For Property Owners
- **Listing Management**: Add, edit, and manage property listings
- **Analytics Dashboard**: Track views, inquiries, and engagement
- **Client Communication**: Built-in messaging system for efficient communication
- **Booking Calendar**: Manage property availability and appointments

### For Travelers
- **Accommodation Booking**: Hotels, resorts, villas, and more
- **Secure Payments**: Multiple payment options with enhanced security
- **Reviews & Ratings**: Authentic feedback from verified guests
- **Travel Resources**: Local guides, tips, and recommendations

## Technology Stack

- **Backend**: Laravel 10, PHP 8.1
- **Frontend**: Blade, Bootstrap, jQuery
- **Database**: MySQL
- **File Storage**: Laravel Storage with public disk
- **Authentication**: Laravel Breeze with roles and permissions
- **Admin Panel**: Filament PHP

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

### Steps

1. Clone the repository
```bash
git clone https://github.com/yourusername/ojjoestates.git
cd ojjoestates
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install && npm run dev
```

4. Create and configure .env file
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ojjoestates
DB_USERNAME=root
DB_PASSWORD=
```

6. Run database migrations and seed
```bash
php artisan migrate --seed
```

7. Link storage for file uploads
```bash
php artisan storage:link
```

8. Start the development server
```bash
php artisan serve
```

## Usage

### For Administrators
1. Navigate to `/admin/login`
2. Use the default credentials:
   - Email: admin@example.com
   - Password: password
3. Explore the admin dashboard to manage properties, bookings, users, and settings

### For Users
1. Register a new account or login with existing credentials
2. Browse properties and accommodations
3. Save favorites, schedule tours, and make bookings
4. Manage your profile and view your history

## Roadmap

- **Q3 2023**: Mobile application development
- **Q4 2023**: Integration with payment gateways for all East African countries
- **Q1 2024**: AI-powered property recommendations
- **Q2 2024**: Augmented reality virtual tours
- **Q3 2024**: Expansion to additional African regions

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgements

- Ojjo Property Masters Ltd for their vision and support
- SmogCoders for technical development and implementation
- All our users and partners who continue to trust us

---

<p align="center">
  Headquartered along Lubigi-Naluma Road in Nansana, near Bliss Hotel and Avance International University
</p>

<p align="center">
  © 2025 Ojjo Property Masters Limited. All rights reserved.
</p>
