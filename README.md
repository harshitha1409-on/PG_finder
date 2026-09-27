# VizagPG Finder

## 📌 Project Overview

**VizagPG Finder** is a student accommodation website developed as an internship-level web development project.

The main purpose of this project is to help students and working professionals find suitable **PG (Paying Guest) accommodation** in different cities.

The website currently contains PG listings for:

- Vizag (Visakhapatnam)
- Hyderabad
- Mumbai
- Delhi
- Bengaluru

Users can search for properties, apply filters, view property details, create an account, log in, and save interesting properties to their shortlist.

---

## 🎯 Project Objective

The objective of this project is to build a simple and responsive accommodation-finding platform where users can:

1. Search PG accommodations by city.
2. Filter properties according to budget and gender.
3. View detailed information about a PG.
4. Check available amenities and ratings.
5. Create an account and log in.
6. Save/shortlist properties for later.
7. View saved properties from their profile.

This project was created to demonstrate practical knowledge of **frontend development, backend development, database management, APIs, AJAX, and basic React integration**.

---

## 🛠️ Technologies Used

### Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- AJAX
- React (small component integration)

### Backend

- PHP
- PHP PDO
- PHP Sessions
- REST-style JSON API endpoints

### Database

- MySQL
- SQL

### Development Environment

- XAMPP
- Apache
- MySQL
- VS Code / any code editor

---

## ✨ Main Features

### 1. Home Page

The home page contains:

- Website navigation
- City search
- Major city section
- City-specific icons
- Introduction to the project
- Links to PG listings

### 2. City-Based PG Search

Users can select a city and view available properties.

Supported cities:

| City | Display Name |
|---|---|
| Visakhapatnam | Vizag |
| Hyderabad | Hyderabad |
| Mumbai | Mumbai |
| Delhi | Delhi |
| Bengaluru | Bengaluru |

### 3. Property Filtering

Properties can be filtered without refreshing the page.

Available filters include:

- Gender
  - Boys
  - Girls
  - Co-living
- Budget ranges
- City
- Sorting options

Sorting options include:

- Recommended
- Price: Low to High
- Price: High to Low
- Rating

### 4. Property Details

Each property has a separate details page.

The details can include:

- Property name
- City
- Area
- Price
- Gender/category
- Rating
- Description
- Images
- Amenities

### 5. User Authentication

Users can:

- Sign up
- Log in
- Log out

Passwords are stored using PHP password hashing rather than plain text.

### 6. Shortlist / Interested Properties

Logged-in users can save properties that they are interested in.

The saved properties are stored in the MySQL database and can be viewed from the profile page.

### 7. User Profile

The profile page displays:

- User information
- Email
- Phone number
- Saved/shortlisted properties

### 8. Responsive Design

Bootstrap and custom CSS are used to make the website usable on:

- Desktop
- Laptop
- Tablet
- Mobile

### 9. AJAX

AJAX is used so that several actions can happen without completely refreshing the webpage.

For example:

- Loading properties
- Login/signup requests
- Filtering properties
- Saving/unsaving properties
- Loading profile information

### 10. React Integration

A small React component is included in the project to demonstrate React integration alongside the existing JavaScript frontend.

---

## 📂 Project Structure

```text
VizagPG-Finder-Project/
│
├── index.php
├── listings.php
├── property.php
├── profile.php
├── setup.php
├── config.php
├── brief-document.txt
│
├── api/
│   ├── auth.php
│   ├── interest.php
│   ├── profile.php
│   ├── properties.php
│   ├── property.php
│   └── session.php
│
├── assets/
│   ├── style.css
│   ├── app.js
│   ├── home.js
│   ├── listings.js
│   ├── detail.js
│   ├── profile.js
│   ├── react-component.jsx
│   │
│   └── cities/
│       ├── vizag.svg
│       ├── hyderabad.svg
│       ├── mumbai.svg
│       ├── delhi.svg
│       └── bengaluru.svg
│
└── sql/
    └── vizag_pg_finder.sql
```

---

## 🗄️ Database Structure

The project uses a MySQL database named:

```text
vizag_pg_finder
```

The main tables are:

### `users`

Stores registered user information.

Main fields:

- id
- name
- email
- password
- phone
- created_at

### `properties`

Stores PG/property information.

Main fields:

- id
- name
- city
- area
- price
- gender
- rating
- description
- image_url
- created_at

### `amenities`

Stores available amenities such as:

- Wi-Fi
- AC
- Food
- Laundry
- Power Backup
- Parking
- CCTV
- Housekeeping

### `property_amenities`

Connects properties with their amenities.

This is a many-to-many relationship between `properties` and `amenities`.

### `property_images`

Stores additional property images used for the property gallery.

### `interested_users`

Stores the properties saved by users.

This table connects:

```text
User → Property
```

---

## 🔄 How the Project Works

The basic flow of the website is:

```text
User
  ↓
Frontend
(HTML + CSS + JavaScript + Bootstrap)
  ↓
AJAX Request
  ↓
PHP API
  ↓
MySQL Database
  ↓
PHP returns JSON
  ↓
JavaScript updates the webpage
```

For example, when a user searches for PGs:

```text
User selects city
        ↓
JavaScript sends request
        ↓
api/properties.php
        ↓
PHP queries MySQL
        ↓
Database returns properties
        ↓
PHP sends JSON response
        ↓
JavaScript displays property cards
```

---

# 💻 How to Run the Project Locally

## Step 1: Install XAMPP

Install XAMPP on your computer.

XAMPP provides:

- Apache
- MySQL
- PHP
- phpMyAdmin

Start:

```text
Apache
MySQL
```

from the XAMPP Control Panel.

---

## Step 2: Copy the Project

Copy the project folder into the XAMPP `htdocs` folder.

Example:

```text
C:\xampp\htdocs\VizagPG-Finder-Project
```

---

## Step 3: Create the Database

Open:

```text
http://localhost/phpmyadmin
```

Create/import the database using:

```text
sql/vizag_pg_finder.sql
```

The SQL file creates the required database and tables.

---

## Step 4: Check Database Configuration

Open:

```text
config.php
```

The default local XAMPP configuration is:

```php
$host = "localhost";
$db   = "vizag_pg_finder";
$user = "root";
$pass = "";
```

If your MySQL username or password is different, update these values.

---

## Step 5: Run the Setup File

Open:

```text
http://localhost/VizagPG-Finder-Project/setup.php
```

The setup page adds/updates demonstration properties for the supported cities.

After successful setup, open:

```text
http://localhost/VizagPG-Finder-Project/
```

---

# 🌐 Important URLs

When running locally:

### Home

```text
http://localhost/VizagPG-Finder-Project/
```

### Listings

```text
http://localhost/VizagPG-Finder-Project/listings.php
```

### Profile

```text
http://localhost/VizagPG-Finder-Project/profile.php
```

### Database Setup

```text
http://localhost/VizagPG-Finder-Project/setup.php
```

---

# 🔐 Security Features Used

Some basic security practices have been implemented:

- PHP PDO is used for database communication.
- Prepared statements are used for database queries.
- Passwords are stored using `password_hash()`.
- Password verification uses `password_verify()`.
- PHP sessions are used for login management.
- User input is validated in important authentication operations.

### Example

Instead of storing a password directly, PHP uses:

```php
password_hash($password, PASSWORD_DEFAULT)
```

This provides a safer way to store user passwords.

---

# 🧪 Testing Performed

The following basic functions can be tested:

### Home Page

- Open website
- Select different cities
- Search for a city

### Listings

- Open different city listings
- Apply gender filter
- Apply budget filter
- Change sorting
- Open a property

### Authentication

- Create a new account
- Try logging in
- Try logging out
- Try invalid login details

### Shortlist

- Log in
- Open a property
- Save the property
- Remove it from shortlist
- Check the profile page

### Responsive Design

Test the website using:

- Desktop browser
- Mobile browser/developer tools
- Different screen sizes

---

# ⚠️ Current Project Limitations

This is an internship/student-level project, so there are some limitations.

- Property information is demonstration/sample data.
- There is no real property-owner/admin dashboard.
- There is no online payment system.
- There is no real-time property availability system.
- Images are currently loaded using image URLs.
- There is no advanced location/map integration.
- Email verification and password reset are not implemented.
- Production-level security and deployment configuration would require additional work.

---

# 🚀 Possible Future Improvements

The project can be improved by adding:

1. Admin dashboard
2. Property owner login
3. Add/edit/delete property functionality
4. Google Maps integration
5. Property location on maps
6. Contact property owner feature
7. WhatsApp/contact integration
8. Advanced search
9. More detailed filters
10. Image upload system
11. User reviews and comments
12. Email verification
13. Forgot password functionality
14. Online booking
15. Payment gateway
16. Property availability status
17. Cloud image storage
18. Better production security
19. Analytics dashboard
20. Mobile application

---

# 📚 What I Learned From This Project

Through this project, I gained practical experience in:

- Creating webpages using HTML
- Designing responsive layouts using CSS and Bootstrap
- Writing JavaScript for frontend interaction
- Using AJAX for asynchronous requests
- Creating PHP backend APIs
- Connecting PHP with MySQL
- Writing SQL queries
- Designing relational database tables
- Using PHP sessions
- Implementing basic user authentication
- Using prepared statements
- Integrating a small React component
- Organizing a web project into frontend, backend, and database sections
- Testing a website locally using XAMPP

---

# 👨‍💻 Project Type

**Internship / Student Web Development Project**

### Project Name

**VizagPG Finder**

### Domain

**Student Accommodation / PG Finder**

### Development Type

**Full-Stack Web Development**

### Main Technologies

```text
HTML
CSS
Bootstrap
JavaScript
AJAX
PHP
MySQL
React
```

---

## 📄 Project Brief

The original project requirements are available in:

```text
brief-document.txt
```

The database setup is available in:

```text
sql/vizag_pg_finder.sql
```

---

## 🙏 Conclusion

VizagPG Finder is a practical full-stack web development project created to provide a simple platform for finding PG accommodations.

The project combines frontend technologies, PHP backend APIs, MySQL database management, AJAX communication, and basic React integration into one application.

It can also be extended in the future into a complete accommodation marketplace with property owners, bookings, payments, maps, reviews, and an admin panel.
