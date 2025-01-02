# Laravel API Testing Project

A robust Laravel-based API implementation for managing users, authentication, and role-based access control (RBAC).

## Features

- User management system
- Token-based authentication
- Role-based access control
- Searchable and sortable user listings
- Comprehensive test suite

## Prerequisites

- PHP 8.0 or higher
- Composer
- MySQL

## Installation

1. Clone the repository
```bash
git clone https://github.com/your-username/your-repository-name.git
cd your-repository-name
```

2. Install dependencies
```bash
composer install
```

3. Configure environment variables
```bash
cp .env.example .env
```
Then update the `.env` file with your database credentials and other configuration settings.

4. Set up the database
```bash
php artisan migrate
```

5. Generate application key
```bash
php artisan key:generate
```

6. Start the development server
```bash
php artisan serve
```

## API Documentation

### Authentication
All API endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer <your-token>
```

### Available Endpoints

#### Users

| Method | Endpoint      | Description        | Parameters                    |
|--------|--------------|--------------------|-----------------------------|
| POST   | /api/users   | Create new user    | name, email, password      |
| GET    | /api/users   | List all users     | search, sortBy (optional)  |

### Query Parameters

- `search`: Filter users by name or email
- `sortBy`: Sort users by any valid column name

## Testing

Run the test suite:
```bash
php artisan test
```

## Token Generation

You can generate API tokens using Laravel Tinker:

```bash
php artisan tinker
$user = App\Models\User::first();
$token = $user->createToken('API Token')->plainTextToken;
echo $token;
```

## Security

- All endpoints are protected with Laravel Sanctum authentication
- CSRF protection enabled for web routes
- Rate limiting implemented on API endpoints

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Contact Information
For any questions, concerns, or support needs, please contact:
Supun Chathuranga

Email: chathurangarulz@gmail.com
Phone: +46762646237

## Acknowledgments

- Built with [Laravel](https://laravel.com/)
- Authentication powered by [Laravel Sanctum](https://laravel.com/docs/sanctum)
