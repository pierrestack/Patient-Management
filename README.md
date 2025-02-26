# Patient Management with Filament 3

## Description

This project is a web application for managing patients (cats, dogs) developed with Laravel and Filament 3. It allows managing animals, their medical information, and appointments through a modern and intuitive administration interface. Each patient is linked to an owner.

## Features

-   **Interactive dashboard** with statistics on animals and appointments.
-   **Patient management (animals)**: add, edit, and delete animal records.
-   **Owner management**: register and track animal owners.
-   **Appointment management** with status tracking.
-   **Secure authentication system**.
-   **Modern user interface** thanks to Filament 3.
-   **Advanced search and filters** to quickly find an animal or an appointment.

## Installation

### Prerequisites

-   PHP ≥ 8.1
-   Composer
-   Node.js & NPM
-   MySQL or PostgreSQL

### Installation Steps

1. **Clone the project**

    ```bash
    git clone https://git.mokolos.com/mokolos/filament3.git
    cd filament3
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Configure the environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Modify the database connection variables in the `.env` file.

4. **Run migrations and seeders**

    ```bash
    php artisan migrate --seed
    ```

5. **Start the server**

    ```bash
    php artisan serve
    ```

    The application will be accessible at `http://127.0.0.1:8000`.

## Usage

-   Access the administration panel: `/admin`
-   Default administrator account:
    -   Email: `admin@example.com`
    -   Password: `password`

## Technologies Used

-   Laravel 11
-   Filament 3
-   Livewire & Alpine.js
-   Tailwind CSS
-   MySQL / PostgreSQL

## Contributing

Contributions are welcome! Please submit a pull request for any improvements or corrections.
