# 🏠 Rentoo REST API

A production-ready REST API for Rentoo, a comprehensive rental property management system for the Spanish market.

The project enables property owners to manage their rental properties and contracts, with full compliance to Spanish legal requirements including LAU (Ley de Arrendamientos Urbanos) and Catalunya-specific regulations.

Built with Laravel 12, Laravel Passport (OAuth2), Spatie Laravel Permission, and documented with Scribe.

---

## Project Description

**Rentoo** allows property owners to register, manage their rental properties, and create legally compliant rental contracts with complete tenant information.

The system tracks:
- Property owners with DNI/NIE/TIE validation
- Rental properties with cadastral references and energy certificates
- Rental contracts with dual tenant support and IRPA compliance

The project has been developed as an **academic project** for the Barcelona Activa Fullstack PHP bootcamp, with emphasis on:
- MVC architecture
- Database relational design
- Spanish legal compliance (LAU, IRPA, energy certificates)
- Professional Git workflow with GitFlow

---

## Features
- to be considered

### Property Owner Management
- to be considered

### Property Management
- to be considered

### Contract Management
- to be considered

---

## Application Flow
- to be considered

---

## Tech Stack

- **Framework:** Laravel 12
- **PHP:** 8.5+
- **Database:** MariaDB 10.4 (via XAMPP)
- **Authentication:** Laravel Passport (OAuth2 Bearer Tokens)
- **Authorization:** Spatie Laravel Permission (Admin + User roles)
- **Testing:** Pest v4 (TDD)
- **Documentation:** Scribe v5 (auto-generated at `/docs`)

---

## Prerequisites

- PHP 8.5+
- Composer 2.8+
- MariaDB 10.4+ (XAMPP recommended for local development)
- Node.js 22+ / NPM 10+
- Postman (for manual API testing)

---

## Local Development Setup

### 1. Clone the repository
```bash
git clone https://github.com/YOUR_USERNAME/rentoo-api.git
cd rentoo-api
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rentoo
DB_USERNAME=root
DB_PASSWORD=
```

> **Note:** This API connects to the existing `rentoo` MariaDB database from the companion MVC project. The database must exist and contain the `owners`, `properties`, and `contracts` tables before running the API.

### 4. Run database migrations
```bash
php artisan migrate
```

### 5. Seed roles, permissions, and test users
```bash
php artisan db:seed
```

This creates:
- Roles: `Admin`, `User`(named as 'Owner')
- Test users: `admin@rentoo.com`, `owner1@rentoo.com`, `owner2@rentoo.com`
- Default password for all seeded users: `password`

### 6. Install Passport keys
```bash
php artisan passport:keys
php artisan passport:client --personal --name="Rentoo Personal Access Client"
```

### 7. Start the development server
```bash
php artisan serve
```

API available at: `http://localhost:8000/api/v1`

---

## Authentication Flow

This API uses **OAuth2 Bearer Token** authentication via Laravel Passport.
```
1. Register or Login  →  Receive access token
2. Include token in all protected requests  →  Authorization: Bearer {token}
3. Logout  →  Token is revoked
```

### Step-by-step example

**Register a new user:**
```bash
curl -X POST http://localhost:8000/api/v1/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Joan Puigdmon",
    "dni": "12345678A",
    "email": "joan@example.com",
    "phone": "600111222",
    "address": "Carrer de Balmes, 10",
    "city": "Barcelona",
    "postal_code": "08007",
    "province": "Barcelona",
    "password": "password",
    "password_confirmation": "password"
  }'
```

**Login with existing user:**
```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email": "admin@rentoo.com", "password": "password"}'
```

Response includes your access token:
```json
{
  "data": {"id": "uuid", "name": "Admin Rentoo", "email": "admin@rentoo.com"},
  "token": "eyJ0eXAiOiJKV1Qi..."
}
```

**Use the token in subsequent requests:**
```bash
curl -X POST http://localhost:8000/api/v1/logout \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1Qi..."
  -H "Accept: application/json"
```

---

## Testing with Postman

1. Download [Postman](https://postman.com) and create a free account
2. Create a new environment called `Rentoo - Local` with these variables:

| Variable | Value |
|----------|-------|
| `base_url`     | `http://localhost:8000/api/v1` |
| `access_token` | *(leave empty — auto-populated on login)* |
| `admin_token`  | *(populate via Login with admin@rentoo.com)* |
| `owner1_token` | *(populate via Login with owner1@rentoo.com)* |
| `owner2_token` | *(populate via Login with owner2@rentoo.com)* |
| `admin_uuid`   | *(populate from Login response id field)* |
| `owner1_uuid`  | *(populate from Login response id field)* |
| `owner2_uuid`  | *(populate from Login response id field)* |

3. Set collection-level Authorization: `Bearer Token` → `{{admin_token}}`

> **Important:** Always include `Accept: application/json` header in all requests, otherwise Laravel returns HTML instead of JSON for error responses.

---

## Running Tests
```bash
# Run full test suite
./vendor/bin/pest

# Run specific test file
./vendor/bin/pest tests/Feature/Auth/AuthTest.php
./vendor/bin/pest tests/Feature/User/UserTest.php
./vendor/bin/pest tests/Feature/User/PropertyTest.php
./vendor/bin/pest tests/Feature/User/ContractTest.php
```

Tests use an **SQLite in-memory database** (configured in `.env.testing`) — no impact on the real MariaDB data.

---

## API Documentation

Full interactive documentation available at `/docs` once the server is running:
```bash
php artisan scribe:generate   # Regenerate docs
php artisan serve
# Visit: http://localhost:8000/docs
```

---

## API Endpoints (18 Total)

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/v1/register` | Register new user | Public |
| POST | `/api/v1/login` | Login, receive token | Public |
| POST | `/api/v1/logout` | Revoke token | Required |
| GET | `/api/v1/users` | List all users (Admin only) | Required |
| GET | `/api/v1/users/{uuid}` | Show user profile | Required |
| DELETE | `/api/v1/users/{uuid}` | Soft delete user | Required |
| *(More endpoints added as built — see `/docs` for full list)* | | | |

---

## Project Structure
```
TO BE CREATED

```

---

## Git Workflow

This project uses GitFlow:
- `main` — production-ready releases
- `develop` — integration branch
- `feature/*` — individual feature development

---

## Database Design

Entities: **Owners** (users) → **Properties** → **Contracts**

The database follows a **relational design** with three main entities:

- **owners** → Property owners (UUID primary key)
  - Personal information (name, surnames)
  - DNI/NIE with Spanish validation
  - Contact information (phone, email)
  
- **properties** → Rental properties (UUID primary key)
  - Address details (street, number, floor, door, postal code, city, province)
  - Cadastral reference (20 characters)
  - Energy certificate (A-G rating)
  - Built area and room count
  - IRPA zone classification
  - Belongs to one owner (foreign key with cascade delete protection)
  
- **contracts** → Rental contracts (UUID primary key)
  - Belongs to one property (foreign key with cascade delete protection)
  - Dual tenant information (Tenant 1 & Tenant 2)
  - Contract dates (start and end)
  - Financial information (monthly rent, deposit)
  - Status enum (DRAFT or FINALIZED)


## Author

**Flavio de Souza**  
Repository: [https://github.com/fdesouzabcn/rentoo-api](https://github.com/fdesouzabcn/rentoo-api)

## Acknowledgments

- Barcelona Activa Fullstack PHP Bootcamp  (2025/2026)
