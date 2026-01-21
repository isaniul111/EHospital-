```markdown
# EHospital

A Hospital Appointment Booking System built with PHP and MySQL.  
This project allows patients to book appointments online, while doctors and admins manage appointments and user information.

---

## 📌 Project Overview

EHospital is a web application designed for appointment scheduling in a medical environment.  
It features role-based access for admin, doctor, and patient.  
Patients can register and schedule their appointments with doctors, and doctors can view appointments assigned to them.

---

## 🧩 Features

### 🔹 Admin
- Add new doctors  
- Edit & delete doctor profiles  
- Schedule doctor sessions  
- View patient details  
- View all appointment bookings  

### 🔹 Doctor
- View personal appointments  
- See patients’ details  
- Manage schedule  
- Edit account settings  

### 🔹 Patient
- Register account  
- Log in to system  
- Make online appointments  
- View booking history  
- Edit or delete account  

---

## 🛠️ Technologies Used

This project is built using:

| Technology | Purpose |
|------------|---------|
| PHP | Server-side scripting |
| MySQL | Database |
| HTML | Structure & markup |
| CSS | Styling |
| JavaScript | UI interactivity |

---

## 📁 Project Structure

```

EHospital-/
├── admin/
├── css/
├── doctor/
├── img/
├── patient/
├── connection.php
├── index.html
├── login.php
├── logout.php
├── signup.php
├── SQL_Database_edoc.sql
├── Dockerfile
├── docker-compose.yml
├── README.md
└── SECURITY.md

````

---

## 🛠️ Setup and Installation

Follow the steps below to run the project locally:

### 1️⃣ Install XAMPP / WAMP / LAMP

Make sure you have:
- Apache
- PHP
- MySQL

installed and running.

---

### 2️⃣ Clone the repository

```bash
git clone https://github.com/isaniul111/EHospital-.git
````

---

### 3️⃣ Move project to local server

Copy the project folder into your web server directory:

```
htdocs/ (for XAMPP)
www/ (for WAMP)
```

---

### 4️⃣ Create Database

Open **phpMyAdmin** in your browser:

👉 [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

* Create a new database named `edoc`
* Go to **Import**
* Upload: `SQL_Database_edoc.sql`

---

### 5️⃣ Update connection

Open `connection.php` and make sure database credentials match your setup:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edoc";
```

---

### 6️⃣ Start Server

Start Apache & MySQL via XAMPP/WAMP.

---

### 7️⃣ Run the App

Open in browser:

👉 [http://localhost/EHospital-/](http://localhost/EHospital-/)

---

## 🗃️ Screenshots

*(Add screenshots of your dashboards/screens here if you want to showcase)*

---

## 🧪 Credentials (if applicable)

| Role    | Email                                                 | Password  |
| ------- | ----------------------------------------------------- | --------- |
| Admin   | [admin@yourdomain.com](mailto:admin@yourdomain.com)   | adminpass |
| Doctor  | [doctor@yourdomain.com](mailto:doctor@yourdomain.com) | docpass   |
| Patient | [user@yourdomain.com](mailto:user@yourdomain.com)     | userpass  |

*(Optional: Add your actual demo credentials here)*

---

## 🌐 Deployment

To deploy this project online:

* Upload to shared hosting with PHP & MySQL support
* Import database using phpMyAdmin or similar
* Configure database connection in `connection.php`

---

## 📬 Contact

Developer: **Saniul**
Email: [support@yourshopbd.com](mailto:support@yourshopbd.com)

---

## 📝 License

This project is open-source and free to use under the MIT License.

```

---

