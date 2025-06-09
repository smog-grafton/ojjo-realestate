# OjjoEstates - Real Estate Platform

A comprehensive real estate platform built with Laravel, offering property listings, agent profiles, user dashboards, and property management tools.

![OjjoEstates](https://via.placeholder.com/800x400?text=OjjoEstates+Real+Estate+Platform)

## Features

- **Property Listings**: Browse, search, and filter properties by various criteria
- **User Accounts**: Registration, login, and personalized dashboards
- **Agent Profiles**: Detailed profiles for real estate agents
- **Property Management**: Submit, edit, and manage property listings
- **Favorites**: Save and manage favorite properties
- **Contact System**: Built-in messaging system for inquiries
- **Admin Panel**: Complete administration interface using Filament
- **Responsive Design**: Mobile-friendly interface for all devices

## Technologies Used

- **Laravel 10**: PHP framework for the backend
- **MySQL**: Database management
- **Filament**: Admin panel and CRUD operations
- **Bootstrap**: Frontend framework for responsive design
- **JavaScript/jQuery**: Frontend interactions
- **Blade Templates**: Laravel templating engine

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and NPM
- MySQL

### Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/ojjoestates.git
   cd ojjoestates
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file and configure your database:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

7. Visit http://localhost:8000 in your browser

## Usage

### User Types

- **Guests**: Can browse properties and send contact messages
- **Registered Users**: Can save favorites and submit inquiries
- **Agents**: Can list properties and manage their listings
- **Administrators**: Full access to the admin panel and all features

### Key Pages

- **Home**: Featured properties and search
- **Properties**: Browse all available properties
- **About Us**: Information about the company
- **Contact Us**: Contact form and information
- **Dashboard**: User-specific dashboard with property management

## Admin Access

Access the admin panel at `/admin` with admin credentials:

- Email: admin@example.com
- Password: password

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Credits

Developed by [SmogCoders](https://github.com/smogcoders) / Mulinda Akiibu

Contact: +256702093354

## License

This project is licensed under the MIT License - see the LICENSE file for details.
