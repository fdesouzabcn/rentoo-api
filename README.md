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
- REST API design
- TDD with Pest
- OAuth2 authentication
- Spanish legal compliance (LAU, IRPA, energy certificates)
- Professional Git workflow with GitFlow

---

## Features

### Property Owner Management
- Complete CRUD operations via REST API endpoints
- DNI/NIE/TIE validation with Spanish regex patterns
- Contact and address information management
- Role-based access: admins manage all owners, users manage only their own profile

### Property Management
- Complete CRUD operations for rental properties
- Automatic owner assignment from authenticated user
- Cadastral reference validation (20-character alphanumeric format)
- Energy certificate tracking (A–G rating) and habitability certificate tracking
- Financial fields: IBI, community fees, garbage fees, last rent amount
- Soft deletes: properties with active contracts cannot be deleted

### Contract Management
- Complete CRUD operations for rental contracts
- Dual tenant support (Tenant 1 required, Tenant 2 optional)
- DNI/NIE validation for all tenants
- Three contract statuses: `draft`, `active`, `finalized`
- Financial fields: monthly rent, legal deposit, additional deposit
- IRPA zone classification (tensioned / non-tensioned areas)
- Soft deletes with full audit trail retained in database

### Financial Summary
- Per-property financial breakdown for each owner
- Calculates monthly income, annual income, and deposits held
- Identifies contracts expiring within 90 days
- Distinguishes active income from historical (finalized) contract data
- Draft contracts excluded — only real income is reported

---

## Application Flow

The typical sequence of API calls for a property owner:

1. **Register** → `POST /api/v1/register` → receive OAuth2 access token
2. **Add properties** → `POST /api/v1/properties` → property assigned to authenticated owner
3. **Create a contract** → `POST /api/v1/contracts` with `status: draft`
4. **Activate the contract** when tenancy begins → `PUT /api/v1/contracts/{uuid}` with `status: active`
5. **Monitor portfolio** → `GET /api/v1/users/{uuid}/financial-summary`
6. **Finalize the contract** when tenancy ends → `PUT /api/v1/contracts/{uuid}` with `status: finalized`

Admins can perform all of the above for any user in the system.

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

The database name is set by `DB_DATABASE` in your `.env` file. You must create this database manually before running migrations — Laravel migrations only create tables inside an existing database, they do not create the database itself.

Using MySQL Workbench or the XAMPP shell:
```sql
CREATE DATABASE rentoo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Run database migrations
```bash
php artisan migrate
```

### 4b. Configure the testing environment
Create a `.env.testing` file in the project root (alongside `.env`):
```bash
touch .env.testing   # or create the file manually in VS Code
```

Add the following content:
```env
APP_NAME=RentooAPI
APP_ENV=testing
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=:memory:

CACHE_STORE=array
QUEUE_CONNECTION=sync
SESSION_DRIVER=array
```
Key points:
- `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` tell Pest to use an in-memory SQLite database — XAMPP does not need to be running for tests
- `APP_KEY` can be left empty for testing
- `CACHE_STORE`, `QUEUE_CONNECTION`, and `SESSION_DRIVER` prevent tests from touching Redis, real queues, or file-based sessions

### 5. Seed roles, permissions, and sample data
```bash
php artisan db:seed
```

This runs four seeders in order:

| Seeder | What it creates |
|--------|-----------------|
| `RolesAndPermissionsSeeder` | `Admin` and `User` roles |
| `UserSeeder` | 3 fixed test accounts (see below) |
| `SampleDataSeeder` | Sample properties and contracts for the owner accounts |

**Test accounts created:**

| Email | Password | Role |
|-------|----------|------|
| `admin@rentoo.com` | `password` | Admin |
| `owner1@rentoo.com` | `password` | User |
| `owner2@rentoo.com` | `password` | User |

**Sample data created:**
- `owner1` — 2 properties: one with an active contract (6 months in), one with a finalized contract (ended yesterday)
- `owner2` — 1 property with an active contract expiring within 45 days (demonstrates the `expiring: true` flag in the financial summary endpoint)

The seeder is safe to re-run — `UserSeeder` uses `updateOrCreate` and `SampleDataSeeder` checks `properties()->count()` before inserting, so no duplicate data is created.

### 6. Install Passport keys
```bash
php artisan passport:install
```

This generates the RSA encryption keys and creates the required OAuth clients in the database in a single step. It creates:
- Two files in `storage/`: `oauth-private.key` and `oauth-public.key` — the key pair Passport uses to sign and verify Bearer tokens. Without these, Passport cannot issue or validate any token.
- One row in the `oauth_clients` table — the "personal access client" that your application uses when calling `$user->createToken()`. Passport requires this client record to exist before it can issue tokens.

### 7. Start the development server
```bash
php artisan serve
```

---

## API Documentation

Interactive documentation is available at `/docs` when the server is running:
```bash
php artisan serve
# Visit: http://127.0.0.1:8000/docs
```

The docs are generated by Scribe from PHPDoc annotations in the controller files. To regenerate after making changes to any controller:
```bash
php artisan scribe:generate
```

---

## API Endpoints

Base URL: `http://127.0.0.1:8000/api/v1`

Full interactive documentation available at: `http://127.0.0.1:8000/docs`

### Authentication
| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/v1/register` | Register a new owner account | No |
| POST | `/api/v1/login` | Login and receive access token | No |
| POST | `/api/v1/logout` | Revoke current access token | Yes |

### Users *(aka "Owners")*
| Method | Endpoint | Description | Access |
|--------|----------|-------------|--------|
| GET | `/api/v1/users` | List all users | Admin only |
| GET | `/api/v1/users/{uuid}` | Show user details | Admin (any) / User (own) |
| DELETE | `/api/v1/users/{uuid}` | Soft delete user | Admin (any) / User (own) |

> <sup>*A user cannot be deleted if it has existing properties. Delete the properties first.*</sup>

### Properties
| Method | Endpoint | Description | Access |
|--------|----------|-------------|--------|
| POST | `/api/v1/properties` | Create a new property | Admin / User |
| GET | `/api/v1/properties` | List properties | Admin (all) / User (own) |
| GET | `/api/v1/properties/{uuid}` | Show property details | Admin (any) / User (own) |
| PUT | `/api/v1/properties/{uuid}` | Full update of a property | Admin (any) / User (own) |
| DELETE | `/api/v1/properties/{uuid}` | Soft delete a property | Admin (any) / User (own) |

> <sup>*A property cannot be deleted if it has existing contracts. Delete the contracts first.*</sup>

### Contracts
| Method | Endpoint | Description | Access |
|--------|----------|-------------|--------|
| POST | `/api/v1/contracts` | Create a new contract | Admin / User (own property only) |
| GET | `/api/v1/contracts` | List contracts | Admin (all) / User (own properties) |
| GET | `/api/v1/contracts/{uuid}` | Show contract details | Admin (any) / User (own property) |
| PUT | `/api/v1/contracts/{uuid}` | Full update of a contract | Admin (any) / User (own property) |
| DELETE | `/api/v1/contracts/{uuid}` | Soft delete a contract | Admin (any) / User (own property) |

> <sup>*Contract ownership is nested: a user can only access contracts that belong to properties they own.*</sup>

### Business Logic
| Method | Endpoint | Description | Access |
|--------|----------|-------------|--------|
| GET | `/api/v1/users/{uuid}/financial-summary` | Owner financial summary | Admin (any) / User (own) |

> <sup>*Only active and finalized contracts are included — draft contracts are excluded because they represent future intent rather than real income.*</sup>

---

## Authorization Summary

| Role | Users | Properties | Contracts |
|------|-------|------------|-----------|
| **Admin** | Full access to all records | Full access to all records | Full access to all records |
| **User** | Own profile only | Own properties only | Own properties' contracts only |

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
curl -X POST http://127.0.0.1:8000/api/v1/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Admin Rentoo",
    "dni": "12345678A",
    "email": "admin@example.com",
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
curl -X POST http://127.0.0.1:8000/api/v1/login \
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
curl -X POST http://127.0.0.1:8000/api/v1/logout \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1Qi..." \
  -H "Accept: application/json"
```

> **Important:** Always include `Accept: application/json` in all requests. Without it, Laravel returns an HTML error page instead of a JSON response for 4xx errors.

### Testing with Postman

1. Download [Postman](https://postman.com) and create a free account
2. Create a new environment called `Rentoo - Local` with these variables:

| Variable | Value |
|----------|-------|
| `base_url`     | `http://127.0.0.1:8000/api/v1` |
| `access_token` | *(leave empty — auto-populated on login)* |
| `admin_token`  | *(populate via Login with admin@rentoo.com)* |
| `owner1_token` | *(populate via Login with owner1@rentoo.com)* |
| `owner2_token` | *(populate via Login with owner2@rentoo.com)* |
| `admin_uuid`   | *(populate from Login response id field)* |
| `owner1_uuid`  | *(populate from Login response id field)* |
| `owner2_uuid`  | *(populate from Login response id field)* |

3. Set collection-level Authorization: `Bearer Token` → `{{admin_token}}`

---

## Running Tests

Tests use Pest with an SQLite in-memory database. XAMPP does not need to be running to execute the test suite.

Run the full suite:
```bash
./vendor/bin/pest
```

Run a specific file:
```bash
./vendor/bin/pest tests/Feature/Auth/AuthTest.php
./vendor/bin/pest tests/Feature/Users/UserTest.php
./vendor/bin/pest tests/Feature/Properties/PropertyTest.php
./vendor/bin/pest tests/Feature/Contracts/ContractTest.php
./vendor/bin/pest tests/Feature/FinancialSummary/FinancialSummaryTest.php
```

Expected: ~85 tests passing across all suites

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
  - Status enum: `draft`, `active`, `finalized`

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── V1/
│   │           ├── AuthController.php
│   │           ├── ContractController.php
│   │           ├── FinancialSummaryController.php
│   │           ├── PropertyController.php
│   │           └── UserController.php
│   └── Resources/
│       ├── ContractResource.php
│       ├── FinancialSummaryResource.php
│       ├── PropertyResource.php
│       └── UserResource.php
├── Models/
│   ├── Contract.php
│   ├── Property.php
│   └── User.php
database/
├── factories/
│   ├── ContractFactory.php
│   ├── PropertyFactory.php
│   └── UserFactory.php
├── migrations/
│   └── *.php
└── seeders/
    ├── DatabaseSeeder.php
    ├── RolesAndPermissionsSeeder.php
    ├── SampleDataSeeder.php
    └── UserSeeder.php
routes/
└── api.php
tests/
└── Feature/
    ├── Auth/
    │   └── AuthTest.php
    ├── Contracts/
    │   └── ContractTest.php
    ├── FinancialSummary/
    │   └── FinancialSummaryTest.php
    ├── Properties/
    │   └── PropertyTest.php
    └── Users/
        └── UserTest.php
```

> **Note:** Verify that your actual test folder names match the paths above. If your test files live under `tests/Feature/` with different subfolder names, update the paths in the "Running Tests" section accordingly.

---

## Git Workflow

This project uses GitFlow:
- `main` — production-ready releases
- `develop` — integration branch
- `feature/*` — individual feature development

---

## Author

**Flavio de Souza**  
Repository: [https://github.com/fdesouzabcn/rentoo-api](https://github.com/fdesouzabcn/rentoo-api)

## Acknowledgments

- Barcelona Activa Fullstack PHP Bootcamp (2025/2026)
