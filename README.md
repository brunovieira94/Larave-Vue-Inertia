# Million User Dashboard Project

A user management system built with Laravel, Inertia and Vue.js.

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- Node.js 16+ and npm
- MySQL 5.7+
- Git

## 🚀 Quick Start

### Clone the repository
```bash
git clone https://github.com/brunovieira94/Larave-Vue-Inertia.git
cd Larave-Vue-Inertia
```

### Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Environment Setup
```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Configure Database
1. Create a new MySQL database
2. Update `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ninacare
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Run Migrations and Seeders
```bash
# Run migrations and seed the database with sample data
php artisan migrate:fresh --seed

### Start Development Servers
```bash
# Start Laravel server
php artisan serve

# Start Vite development server
npm run dev
```

The application will be available at `http://localhost:8000`

## 🛠️ Development

### Project Structure

```
Larave-Vue-Inertia/
├── app/
│   ├── Contracts/       # Interfaces
│   ├── Services/        # Business logic
│   ├── Queries/        # Complex database queries
│   └── Http/           # Controllers, Requests, Resources
└── resources/
    ├── js/
    │   ├── Components/ # Reusable Vue components
    │   ├── Pages/     # Vue pages
    │   └── Layouts/   # Vue layouts
    └── views/         # Blade templates

```

## 🔧 Configuration

### Cache
Configure cache TTL in `config/cache-ttl.php`:
```php
return [
    'ttl' => [
        'countries' => 3600, // 1 hour
        'cities' => 3600,    // 1 hour
    ],
];
```

## 📄 License

This project is licensed under the MIT License

## 👥 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request
