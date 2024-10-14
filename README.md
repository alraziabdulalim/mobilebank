# MobileBank

MobileBank is a demo application that simulates how an online banking app works. It provides basic features to demonstrate customer and admin functionalities in a banking environment.

## Prerequisites

Before running the application, ensure the following:

1. **PHP Environment:** You need to have PHP installed on your system to run this application.
2. **PHP Path Setup (Windows):** Make sure the PHP installation folder is added to your system's environment variables.

## How to Run the Application

Follow these steps to start the app:

1. Open a terminal (such as PowerShell) and run the following command to start the application:

    ```bash
    php run.php
    ```

2. In another terminal window, run the following command to set up the database:

    ```bash
    php create_db.php
    ```

## Accessing the Application

- **Home Page:** [http://localhost:9001](http://localhost:9001)
- **Customer Login:** [http://localhost:9001/login](http://localhost:9001/login)
- **Admin Login:** [http://localhost:9001/admin/login](http://localhost:9001/admin/login)

### Admin Credentials

- **Email:** `admin@example.com`
- **Password:** `adminpassword`
