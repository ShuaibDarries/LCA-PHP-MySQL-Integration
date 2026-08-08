# AfriStaff

## Description
AfriStaff is a lightweight, full-stack HR staff directory web application built for a growing company. It allows administrators to create, view, update, and delete staff records through a clean browser interface. The application connects a PHP backend to a MySQL database and uses prepared statements for secure data handling.

## Tech Stack
| Technology | Description |
|------------|-------------|
| **PHP** | Server-side scripting language used to handle form submissions, database queries, and page rendering. |
| **MySQL** | Relational database used to store and manage all staff records persistently. |
| **XAMPP** | Local development stack providing Apache (web server) and MySQL (database server) in one package. |
| **phpMyAdmin** | Web-based GUI for managing MySQL databases, running SQL scripts, and inspecting tables. |
| **HTML** | Markup language used to structure all web pages (index, add, edit forms). |
| **CSS** | Custom stylesheet providing a responsive, consistent, and readable layout across all pages. |

## Prerequisites
- **XAMPP** installed with Apache and MySQL enabled.
- MySQL must be running on **port 3307**.
- A modern web browser (Chrome, Firefox, Edge, Safari).

## Database Setup
1. Open **XAMPP Control Panel** and start **Apache** and **MySQL**.
2. Open your browser and go to `http://localhost/phpmyadmin`.
3. Click the **SQL** tab (or Import tab).
4. Copy and paste the following SQL, then click **Go**:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS afristaff_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE afristaff_db;

-- Create staff table
CREATE TABLE IF NOT EXISTS staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO staff (first_name, last_name, department, email) VALUES
('Thabo', 'Mokoena', 'Human Resources', 'thabo.mokoena@afristaff.co.za'),
('Lerato', 'Dlamini', 'Finance', 'lerato.dlamini@afristaff.co.za'),
('Sipho', 'Nkosi', 'Information Technology', 'sipho.nkosi@afristaff.co.za'),
('Nomsa', 'Zulu', 'Marketing', 'nomsa.zulu@afristaff.co.za'),
('Kagiso', 'Moloi', 'Operations', 'kagiso.moloi@afristaff.co.za'),
('Amahle', 'Buthelezi', 'Human Resources', 'amahle.buthelezi@afristaff.co.za'),
('Bongani', 'Mahlangu', 'Finance', 'bongani.mahlangu@afristaff.co.za'),
('Zanele', 'Khumalo', 'Information Technology', 'zanele.khumalo@afristaff.co.za'),
('Mandla', 'Sithole', 'Sales', 'mandla.sithole@afristaff.co.za'),
('Refilwe', 'Maseko', 'Marketing', 'refilwe.maseko@afristaff.co.za'),
('Tebogo', 'Pienaar', 'Operations', 'tebogo.pienaar@afristaff.co.za'),
('Dineo', 'Mabena', 'Legal', 'dineo.mabena@afristaff.co.za');
```

Alternatively, you can use the provided `setup.sql` file via phpMyAdmin's **Import** feature.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/LCA-PHP-MySQL-Integration.git
   ```
2. Copy the `week4_ex01_php_mysql_integration/` folder into your XAMPP `htdocs` directory:
   - **Windows**: `C:\xampp\htdocs\`
   - **macOS**: `/Applications/XAMPP/htdocs/`
   - **Linux**: `/opt/lampp/htdocs/`
3. Ensure the folder structure looks like this inside `htdocs`:
   ```
   htdocs/
   └── week4_ex01_php_mysql_integration/
       ├── config/
       │   └── db.php
       ├── index.php
       ├── add.php
       ├── edit.php
       ├── delete.php
       ├── style.css
       ├── setup.sql
       └── README.md
   ```

## How to Run
1. Start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Open your browser and navigate to:
   ```
   http://localhost/week4_ex01_php_mysql_integration/index.php
   ```
3. Use the interface to:
   - **View** all staff records (with search and pagination).
   - **Add** a new staff member via the "Add New Staff" button.
   - **Edit** an existing record by clicking the **Edit** link.
   - **Delete** a record by clicking the **Delete** link (confirmation required).

## Project Structure
```
week4_ex01_php_mysql_integration/
├── config/
│   └── db.php          # Database connection (mysqli_connect on port 3307)
├── index.php           # Displays all staff records with search & pagination
├── add.php             # HTML form + PHP script to insert a new record
├── edit.php            # HTML form pre-populated + PHP script to update a record
├── delete.php          # PHP script to delete a record by ID
├── style.css           # Custom CSS for consistent, responsive styling
├── setup.sql           # SQL script to create database, table, and sample data
└── README.md           # Project documentation
```

## Screenshots
> *Note: Add screenshots of the running application here showing index.php, add.php, and edit.php in action.*

## Author
Shuaib Darries
Life Choices Academy YouthCode Off-Site, Cohort 2
