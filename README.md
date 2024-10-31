# Apex Motorsport

Apex Motorsport is a digital showroom for showcasing sports cars. This project includes descriptions, high-quality images, technical specifications, and data on various sports cars. Developed over a year, the project aims to create an engaging, data-rich platform for car enthusiasts.

## Table of Contents
1. [Project Structure](#project-structure)
2. [Setup Instructions](#setup-instructions)
3. [Running the Project](#running-the-project)
4. [Database Structure](#database-structure)
5. [Authentication and Validation](#authentication-and-validation)




## Project Structure

The project's folder structure is organized as follows:

```plaintext
src
├── assets
│   ├── code              # JavaScript functionalities
│   ├── css               # Styling files for web pages
│   ├── database          # SQL file with database for setup
│   ├── favicon           # Favicon assets
│   ├── fonts             # Fonts used on the website
│   ├── images            # Images for web pages, organized by format (webp, png, jpg, mp4)
│   ├── json              # JSON data for blog posts
│   └── logo              # Logo assets
├── config
│   └── request.php       # Database connection setup
├── templates
│   ├── header.php        # Header navigation
│   └── footer.php        # Footer section
├── views                 # Visible web pages
│   ├── about.php         # About page
│   ├── cars.php          # Cars page
│   ├── confirm.php       # Account confirmation page
│   ├── imprint.php       # Terms and conditions page
│   ├── index.php         # Home page
│   ├── login.php         # Login page
│   ├── signup.php        # Signup (create account) page
│   └── technology.php    # Technology details page
└── validation            # PHP scripts for form validation and user management
    ├── login_valid.php   # Login validation
    ├── signup_valid.php  # Account creation and validation
    └── logout.php        # Session termination
```



## Setup Instructions

1. **Clone the Repository:** Download or clone the project files to your server environment.
   
2. **Server Environment:** Make sure you have a server environment set up (e.g., Apache(recommended) or Nginx) with PHP and MySQL installed.

3. **Database Import:**
   - Navigate to `src/assets/database`.
   - Import the SQL file `Apex_Motorsport.sql` into your MySQL database. This will create a database named `Apex_Motorsport` with a table called `users` to store user information.

4. **Database Connection:**
   - Go to `src/config/request.php`.
   - Update the database credentials to match your server configuration:
     ```php
     <?php
     $servername = "your_server";
     $username = "your_username";
     $password = "your_password";
     $dbname = "Apex_Motorsport";
     ?>
     ```



## Running the Project

1. **Navigate to Project URL:** Once set up, open the project by navigating to its URL on your server.

2. **Account Management Pages:**
   - **Login:** `login.php`
   - **Signup:** `signup.php`
   - Both pages include HTML templates with PHP for form handling. Validation and submission processes are managed in the `validation` folder, ensuring data is sanitized and securely stored.

3. **Testing Database Connection:**
   - Ensure your server can connect to the `Apex_Motorsport` database by visiting the login and signup pages.
   - Errors or connection issues can typically be resolved by verifying the settings in `request.php`.



## Database Structure

The `users` table in the `Apex_Motorsport` database stores user data in multiple columns. This data is collected and validated during the registration process and stored securely after user registration.



## Authentication and Validation

1. **Login Validation:** The `login_valid.php` file in the `validation` folder handles login form validation and manages user session creation.

2. **Signup Validation:** The `signup_valid.php` script manages user account creation by validating and sanitizing user input before storing it in the database.

3. **Logout Process:** The `logout.php` script ends the user session and logs the user out, redirecting them to the home page.

