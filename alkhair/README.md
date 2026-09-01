
# 🌟 AL-KHAIR — Transparent Charity Donation Platform

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Blade](https://img.shields.io/badge/Blade-Laravel-F55247?style=for-the-badge)
![MVC](https://img.shields.io/badge/Architecture-MVC-success?style=for-the-badge)
![SOLID](https://img.shields.io/badge/SOLID-Principles-blueviolet?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

</p>

---

# 📖 About The Project

<img width="2952" height="1520" alt="127 0 0 1_8000_ (4)" src="https://github.com/user-attachments/assets/b2fe8f08-accd-4f20-b77c-a861deb8fb4a" />

**AL-KHAIR** is a full-stack charity management platform developed with **Laravel 11** to provide a transparent and secure donation ecosystem connecting donors with local Moroccan charities.

The platform focuses on **transparency**, **traceability**, and **trust** by allowing every donation to be tracked throughout its complete lifecycle—from donation creation to the final impact report published by the association.

Unlike traditional donation systems, AL-KHAIR provides a complete workflow for managing associations, charitable projects, donations, payment validation, PDF reports, and real-time notifications through an intuitive role-based dashboard.

The application was designed following modern software engineering practices including **MVC Architecture**, **SOLID Principles**, **Role-Based Access Control (RBAC)**, secure authentication, and scalable database design.

---

# 🚀 Key Features

## 👤 Donor Dashboard

- Secure Registration & Login
- Email Verification
- Password Recovery
- Edit Profile
- Online Donations
- Manual Donations
- Anonymous Donations
- Donation History
- Project Progress Tracking
- Download Donation Receipt (PDF)
- Email Notifications
- Impact Counter
- Real-Time Donation Status

---

## 🏢 Association Dashboard

- KYC Verification
- Association Profile Management
- Logo & Media Upload
- Project Creation
- Project Management
- Donation Tracking
- Donation Confirmation
- Collection Statistics
- Impact Report Publishing
- PDF Impact Report Generation
- Email Notifications

---

## 🛠 Administrator Dashboard

- Association Approval
- KYC Validation
- Manual Donation Validation
- Platform Moderation
- User Management
- Global Statistics
- Project Monitoring
- Donation Monitoring
- Content Management
- Dashboard Analytics

---

# 💡 Donation Lifecycle

Every donation follows a complete traceable workflow:

```
Pending
      │
      ▼
Validated
      │
      ▼
Processing
      │
      ▼
Received
      │
      ▼
Impact Published
```

Each stage is stored securely inside the database, providing complete transparency for donors, associations, and administrators.

---

# 🎯 Core Functionalities

### Donation Management

- Online Payment (Stripe Simulation)
- Manual Payment with Receipt Upload
- Donation Comments
- Anonymous Donations
- Donation Validation
- PDF Receipts
- Donation History

### Association Management

- Association Registration
- Administrative Approval
- KYC Verification
- Media Upload
- Project Management
- Collection Reports

### Project Management

- Financial Goal Tracking
- Progress Bar
- Expiration Management
- Deadline Extension
- Automatic Project Status
- Impact Report Generation

### Search System

- Search by Project Name
- Search by Category
- Search by City
- Sort by Urgency
- Sort by Nearby Projects

### Notification System

- Email Notifications
- In-App Notifications
- Donation Status Updates
- Project Updates
- Impact Report Notifications

---



# 🛠 Technology Stack

## Backend

- Laravel 11
- PHP 8.x
- MVC Architecture
- Eloquent ORM
- RESTful Routing
- Laravel Breeze
- RBAC (Role-Based Access Control)
- Form Request Validation
- Laravel Middleware
- Mailtrap
- DomPDF
- Stripe (Payment Simulation)

---

## Frontend

- HTML5
- Tailwind CSS
- JavaScript (ES6)
- Blade Template Engine
- Fetch API
- Leaflet.js
- Responsive Design

---

## Database

- MySQL
- Database Migrations
- Eloquent Relationships
- Foreign Keys
- Data Integrity
- Query Optimization

---

## Development Tools

- Git
- GitHub
- Composer
- NPM
- Trello
- Figma
- VS Code

---

# 🏗 Architecture

The application follows a scalable **Laravel MVC Architecture**, ensuring a clean separation between business logic, presentation, and data management.

```
                 Client
                    │
                    ▼
            Laravel Routes
                    │
                    ▼
              Controllers
                    │
     ┌──────────────┼──────────────┐
     ▼              ▼              ▼
 Validation      Services      Notifications
     │              │              │
     ▼              ▼              ▼
             Eloquent Models
                    │
                    ▼
                 MySQL
```

The project follows several software engineering principles:

- MVC Architecture
- SOLID Principles
- Separation of Concerns
- Clean Code Practices
- RESTful Design
- Reusable Components
- Secure Authentication
- Role-Based Authorization

---

# 🔐 Security Features

Security was considered throughout the development process.

### Authentication

- Laravel Breeze Authentication
- Secure Login & Registration
- Email Verification
- Forgot Password
- Password Reset
- Session Protection

### Authorization

- Role-Based Access Control (RBAC)
- Admin Authorization
- Association Authorization
- Donor Authorization
- Route Protection
- Middleware Authorization

### Data Protection

- Password Hashing (Bcrypt)
- CSRF Protection
- XSS Protection
- SQL Injection Protection
- File Validation
- Secure File Upload
- Input Sanitization

### Media Management

- Association Logos
- User Profile Pictures
- KYC Documents
- Donation Receipts
- Impact Report Images

---

# 📂 Main Modules

## Authentication Module

- Register
- Login
- Email Verification
- Password Reset
- Profile Management

---

## Donation Module

- Online Donations
- Manual Donations
- Donation Tracking
- Anonymous Donations
- Donation Receipts (PDF)

---

## Association Module

- Registration
- KYC Verification
- Dashboard
- Project Management
- Impact Reports

---

## Project Module

- Create Projects
- Financial Goals
- Progress Tracking
- Expiration Management
- Deadline Extension

---

## Administration Module

- User Management
- Association Approval
- Donation Validation
- Platform Statistics
- Content Moderation

---

# 📊 Database Highlights

The platform relies on a relational database designed using Laravel Eloquent ORM.

Main entities include:

- Users
- Associations
- Projects
- Donations
- Categories
- Notifications
- Impact Reports

Relationships include:

- One-to-Many
- Many-to-Many
- Foreign Key Constraints
- Cascading Deletes
- Data Integrity Rules

---

# 📸 Screenshots

## Home Page

 
 

<img width="1763" height="7257" alt="Capture d’écran_1-9-2026_1728_127 0 0 1" src="https://github.com/user-attachments/assets/992f2551-edb4-4e87-b31d-821cc48b0d4e" />

 

---
## Login 
 
 <img width="2572" height="1784" alt="127 0 0 1_8000_login" src="https://github.com/user-attachments/assets/0f400636-6ded-4ad8-91ac-f3a817cf9b34" />
 

---
## Register 
 
 <img width="2952" height="1520" alt="127 0 0 1_8000_register (1)" src="https://github.com/user-attachments/assets/90b8ef72-abc5-40ae-8f40-45408ce71124" />
<img width="2952" height="1520" alt="127 0 0 1_8000_register (2)" src="https://github.com/user-attachments/assets/4a9a89a2-8c16-4e63-beb5-5d62eea1d923" />

 

---
## Donor Dashboard
 
 <img width="1763" height="4616" alt="Capture d’écran_1-9-2026_154939_127 0 0 1" src="https://github.com/user-attachments/assets/696356e4-3796-4ee7-8e2f-2c8f5c91d391" />
 
---
 
## Association Dashboard
 
<img width="3122" height="3954" alt="127 0 0 1_8000_association_dashboard" src="https://github.com/user-attachments/assets/9a68cdca-a600-4bc9-ba65-b08e8a7720f7" />
<img width="3122" height="1678" alt="127 0 0 1_8000_association_projects_expired" src="https://github.com/user-attachments/assets/4cd70446-41e4-4db5-99f9-d367596a37f2" />

 
---

## Administrator Dashboard
 
<img width="3122" height="3738" alt="127 0 0 1_8000_admin_dashboard" src="https://github.com/user-attachments/assets/4fa7b512-8a3f-4bdb-bd82-293f0ffe62b0" />
<img width="3122" height="2028" alt="127 0 0 1_8000_admin_categories" src="https://github.com/user-attachments/assets/390b42dd-64bc-449a-9c85-1a731fb526bb" />
<img width="3136" height="2520" alt="127 0 0 1_8000_admin_users" src="https://github.com/user-attachments/assets/84203e8e-9c23-402d-9694-52baf1d68caa" />

 

---

## Project Details
 
<img width="1763" height="7257" alt="Capture d’écran_1-9-2026_1728_127 0 0 1" src="https://github.com/user-attachments/assets/ee4e19f7-e4b8-4275-a44e-67d85cb15e83" />
<img width="1763" height="3543" alt="Capture d’écran_1-9-2026_164225_127 0 0 1" src="https://github.com/user-attachments/assets/d828f0d9-d90d-4f1e-9349-58e691d79f92" />

<img width="3122" height="4736" alt="127 0 0 1_8000_projects_14" src="https://github.com/user-attachments/assets/193db992-0dc1-4a83-b720-0a46c6cc3c7b" />

 

---

## Donation Workflow
 
1er methode paimment en ligne avec strip :

 <img width="3122" height="2584" alt="127 0 0 1_8000_projects_59_donate" src="https://github.com/user-attachments/assets/da5a6159-5edd-49bc-98a5-5ef8c0e906f1" />

 <img width="3122" height="1850" alt="checkout stripe com_c_pay_cs_test_a1k0hjc9lQt018Kp3JnrhNH8yXa6hF4QG0Dbea0kzZtEppFEeKGbkFjIMs (1)" src="https://github.com/user-attachments/assets/9a1fe738-f276-477f-9a39-c660a4e887aa" />

<img width="3122" height="1678" alt="127 0 0 1_8000_donations_90_confirmation" src="https://github.com/user-attachments/assets/dfcca5fc-2bbf-468f-b08c-a089debb3121" />

2eme methode paimment avec viremment:
<img width="3122" height="1678" alt="127 0 0 1_8000_donations_91_confirmation" src="https://github.com/user-attachments/assets/3a51342b-8ee2-41c7-a2a8-7074015072ce" />
<img width="3122" height="3318" alt="127 0 0 1_8000_projects_59_donate (1)" src="https://github.com/user-attachments/assets/6507261e-f106-4af4-8ae5-1b2b6335178c" />
 
---

## Impact Report
 
<img width="3122" height="2826" alt="127 0 0 1_8000_association_profile" src="https://github.com/user-attachments/assets/15c5f07b-5d1a-44c4-b2c4-701f975d8026" />
<img width="1763" height="3144" alt="Capture d’écran_1-9-2026_165858_127 0 0 1" src="https://github.com/user-attachments/assets/cd09fc40-7dca-4f27-89a3-0b5aba91dba4" />
 <img width="1763" height="3897" alt="Capture d’écran_1-9-2026_171448_127 0 0 1" src="https://github.com/user-attachments/assets/96287a41-0f91-436f-a921-881419e25217" />

 

---

## User Profile

 
<img width="3122" height="2826" alt="127 0 0 1_8000_association_profile" src="https://github.com/user-attachments/assets/de3effc0-2564-4dff-82b7-8255c16a9d2e" />
 



# 🚀 Getting Started

## Prerequisites

Before running the project locally, make sure you have installed:

- PHP 8.x
- Composer
- Node.js & NPM
- MySQL
- Git

---

# ⚙️ Installation

Clone the repository

```bash
git clone https://github.com/your-username/AL-KHAIR.git
```

Navigate to the project

```bash
cd AL-KHAIR
```

Install PHP dependencies

```bash
composer install
```

Install JavaScript dependencies

```bash
npm install
```

Create the environment file

```bash
cp .env.example .env
```

Generate the application key

```bash
php artisan key:generate
```

Configure your database inside `.env`

```env
DB_DATABASE=alkhair
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations

```bash
php artisan migrate
```

Seed the database (optional)

```bash
php artisan db:seed
```

Create the storage link

```bash
php artisan storage:link
```

Build frontend assets

```bash
npm run build
```

Start the development server

```bash
php artisan serve
```

---

# 📁 Project Structure

```
AL-KHAIR
│
├── app/
│   ├── Http/
│   ├── Models/
│   ├── Notifications/
│   ├── Services/
│   ├── Policies/
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
│
├── public/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│
├── storage/
│
├── tests/
│
└── README.md
```

---

# ✨ Project Highlights

This project demonstrates practical experience with:

- Laravel 11 Development
- PHP 8
- MVC Architecture
- SOLID Principles
- Authentication & Authorization
- Role-Based Access Control (RBAC)
- Eloquent ORM
- MySQL Database Design
- Responsive UI Development
- Tailwind CSS
- JavaScript
- RESTful Routing
- File Upload Management
- PDF Generation with DomPDF
- Email Testing using Mailtrap
- Stripe Payment Simulation
- Laravel Middleware
- Secure Authentication
- Form Validation
- Dashboard Development
- CRUD Operations
- Git Version Control
- Agile Project Management (Trello)

---

# 🔮 Future Improvements

Future versions of the platform may include:

- Mobile Application
- Real Payment Gateway Integration
- Multi-language Support
- Real-Time Notifications
- Donation Analytics Dashboard
- AI-Based Fraud Detection
- Advanced Reporting
- API for Third-Party Integrations
- Progressive Web App (PWA)
- Dark Mode

---

# 💼 Skills Demonstrated

- Full-Stack Web Development
- Backend Development
- Frontend Development
- Database Design
- Software Architecture
- Object-Oriented Programming (OOP)
- Secure Authentication
- Authorization Management
- Business Logic Implementation
- Payment Workflow
- File Management
- PDF Report Generation
- Email Services
- Responsive Design
- Clean Code
- Problem Solving

---

# 📷 Demo

> Replace these links with your own.

**GitHub Repository**

```
https://github.com/your-username/AL-KHAIR
```

**Live Demo**

```
Coming Soon
```

---
 
## 👨‍💻 Author

**Khadija Abirat**

Full-Stack Web Developer passionate about building secure, scalable, and user-focused web applications with Laravel.

📍 Morocco

💼 Open to Full-Time, Internship, and Remote Opportunities

🌐 GitHub: https://github.com/khadijaabirat

💼 LinkedIn: https://linkedin.com/abirat-khadija

### Core Technologies

- Laravel 11
- PHP 8
- MySQL
- JavaScript
- Tailwind CSS
- HTML5
- Git & GitHub

### Currently Exploring

- Artificial Intelligence
- Data Science
- Machine Learning
- Python
- MLOps

---

# 📄 License

This project was developed for educational purposes as part of the **YouCode Full-Stack Web Development Program**.

---

# ⭐ Support

If you found this project interesting, consider giving it a ⭐ on GitHub.

Your support is greatly appreciated!

---

<p align="center">

Developed with ❤️ using Laravel 11 & Tailwind CSS

</p>
