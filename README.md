# Invoice System

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

---

## 📝 About the Project

**Invoice System** is a Laravel-based project that provides a complete invoicing management system with an integrated admin dashboard.
The system is built with role-based access where only the **Admin** has full control over users and permissions.

---

## 🚀 Features

### 🔑 Admin Features

-   Full control of the system.
-   Create, edit, delete users.
-   Assign and manage user permissions.
-   Suspend or activate user accounts at any time.
-   Reset or change any user's password.

### 👤 User Features (with permissions granted by Admin)

-   Create, edit, delete invoices.
-   Archive invoices.
-   Print invoices.
-   Add multiple invoices.
-   Make partial or full payments on invoices.
-   Manage products and categories (add, update, delete).
-   Export invoices to **Excel**.
-   Download invoices as **PDF**.
-   Search invoices and filter by different criteria.
-   Generate and search customer reports.

---

## 🛠 Requirements

-   PHP 8.1 or higher
-   Composer
-   MySQL (or any supported database)
-   Node.js & npm (for frontend assets)

---

## ⚙️ Installation & Setup

1. Clone the repository:

    ```bash
    git clone https://github.com/MohamedIbrahimAbdulghani/invoice-system.git
    cd invoice-system
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install && npm run dev
    ```

3. Configure environment:

    - Copy `.env.example` to `.env`
    - Update database credentials and other environment variables

4. Run migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

    > This will create the necessary tables and seed the admin account.

5. Start the development server:

    ```bash
    php artisan serve
    ```

---

## 🔑 Default Admin Access

-   **Email:** [admin@example.com](mailto:admin@example.com)
-   **Password:** password

(You can change these credentials in the seeder file or via the app once logged in.)

---

## 📊 Future Improvements

-   Advanced reporting dashboards.
-   Notifications & email integration.
-   Multi-language support.

---

## 📄 License

This project is open-source and available under the [MIT license](https://opensource.org/licenses/MIT).
