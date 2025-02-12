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

├── assets
│   ├── code              # JavaScript functionalities
│   ├── css               # Styling files for web pages
│   ├── sql               # SQL file with database for setup
│   ├── favicon           # Favicon assets
│   ├── fonts             # Fonts used on the website
│   ├── images            # Images for web pages, organized by format  (webp, png, jpg, mp4)
│   ├── uploads
│   ├── json              # JSON data for blog posts
│   └── logo              # Logo assets
├── Controller
├── Model
├── views
   ├── cms_folder # CMS PAges

## Setup Instructions

1. **Clone the Repository:** Download or clone the project files to your server environment.
   
2. **Server Environment:** Make sure you have a server environment set up (e.g., Apache(recommended) or Nginx) with PHP and MySQL installed.

3. **Database Import:**
   - Navigate to `assets/sql`.
   - Import the SQL file `Apex_Motorsport.sql` into your MySQL database. This will create a database named `Apex_Motorsport` with a table called `users` to store user information.

4. **Database Connection:**
   - Go to `Model/Database.php`.
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
   - **Signup:** `register.php`
   - Both pages include HTML templates with PHP for form handling. Validation and submission processes are managed in the `validation` folder, ensuring data is sanitized and securely stored.

3. **Testing Database Connection:**
   - Ensure your server can connect to the `Apex_Motorsport` database by visiting the login and signup pages.
   - Errors or connection issues can typically be resolved by verifying the settings in `Database.php`.

## Database Structure

The `users` table in the `Apex_Motorsport` database stores user data in multiple columns. This data is collected and validated during the registration process and stored securely after user registration.

## Authentication and Validation

1. **Login Validation:** The Validation takes Part into the Form Validator class
3. **Logout Process:** The `logout.php` script ends the user session and logs the user out, redirecting them to the home page.
 
- **File Storage**  
  - After successful validation, the file is moved to the specified target folder.

- **Database Integration**  
  - The file path and the provided alternative text are saved in the **`uploads`** table of the database for future reference.

# Setup CMS

## 1. Sign Up and Grant Admin Role
- After successfully setting up the project, you can sign up (create an account) using the **"Create an Account"** option in the footer.  
- Once you have signed up, open the database table called `users` and set the value of the `is_admin` column to `1` for your user account. This will grant you admin privileges.

## 2. Login and Access the CMS Dashboard
- Log in to authenticate yourself after becoming an admin.  
- Once logged in, a new page called **CMS Dashboard** will appear in the navigation.  
- The CMS Dashboard includes its own navigation with pages dedicated to content management.

## 3. Content Management Features
From the CMS Dashboard, you can:
- **Manage Cars**:  
  - Add, delete, edit records, and upload images for each car model.  
- **Manage Manufacturers**:  
  - Add new manufacturers or delete existing ones.  
- **Grant Admin Rights**:  
  - Assign admin privileges to other users by modifying their roles.

- **You would find more information on the dashboard page**:

