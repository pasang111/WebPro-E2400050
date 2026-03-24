# EduSkill Marketplace System

**BIT210 Web Programming Project**
**Semester 3, 2023**

## Project Overview

EduSkill is an online learning marketplace developed for the Ministry of Human Resources Malaysia. The platform connects learners with certified training providers offering short courses, workshops, and certification programmes — similar to Coursera or Udemy but at a simpler scope.

## Team Members

| Name | Role | Student ID |
|---|---|---|
| Pasang Lama | Team Lead | E2400050 |
| Shreeyash Pandey | Student Module | E2300578 |
| Archana Tharu | Provider Module | E2300555 |

## GitHub Repository

```
https://github.com/pasang111/WebPro-E2400050
```

## Technologies Used

- **Frontend:** HTML5, CSS3, Bootstrap 4, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server:** Apache (XAMPP)
- **Fonts:** Plus Jakarta Sans, Lora (Google Fonts)
- **Icons:** Font Awesome 5

## System Requirements

- XAMPP (Apache + MySQL + PHP)
- Web browser (Chrome recommended)
- PHP 7.4 or higher
- MySQL 5.7 or higher

## Installation & Setup

### Step 1 — Clone the repository
```
git clone https://github.com/pasang111/WebPro-E2400050.git eduskill
```

### Step 2 — Move to htdocs
Move the `eduskill` folder into:
```
C:\xampp\htdocs\
```

### Step 3 — Start XAMPP
Open XAMPP Control Panel and start **Apache** and **MySQL**.

### Step 4 — Import the database
1. Go to `http://localhost:8080/phpmyadmin`
2. Click **New** and create a database named `eduskill`
3. Click **Import** and select `database/eduskill.sql`
4. Click **Go**

### Step 5 — Run the application
Open your browser and go to:
```
http://localhost:8080/eduskill/
```

## User Roles & Login

| Role | Email | Password |
|---|---|---|
| Admin | admin@eduskill.com | (create via phpmyadmin) |
| Student | (register via signup page) | (your password) |
| Provider | (register via signup page) | (your password) |

## Main Features

### Admin (Ministry Officer)
- Login to admin dashboard
- Approve or reject training provider registrations
- View all student enrollment requests
- Approve or reject student enrollments
- View and manage all courses

### Student (Learner)
- Sign up for a free account
- Browse available courses from approved providers
- Enroll in courses (request sent to admin)
- Track enrollment status (Pending / Approved / Rejected)
- View enrollment history

### Training Provider
- Register organisation (pending Ministry approval)
- After approval: add, edit, delete courses
- View students enrolled in their courses

## Folder Structure

```
eduskill/
├── index.php               # Landing page
├── about.php               # About page
├── contact.php             # Contact page
├── auth/
│   ├── login.php           # Login (all 3 roles)
│   ├── signup_student.php  # Student registration
│   ├── signup_provider.php # Provider registration
│   └── logout.php          # Logout
├── admin/
│   ├── dashboard.php       # Admin dashboard
│   ├── approve_providers.php
│   ├── approve_enrollments.php
│   └── manage_courses.php
├── student/
│   ├── dashboard.php       # Student dashboard
│   ├── courses.php         # Browse courses
│   ├── enroll.php          # Enrollment request
│   └── my_courses.php      # Enrollment status
├── provider/
│   ├── dashboard.php       # Provider dashboard
│   ├── add_course.php      # Add new course
│   ├── edit_course.php     # Manage courses
│   ├── delete_course.php   # Delete course
│   └── course_students.php # View enrolled students
├── config/
│   └── database.php        # Database connection
├── database/
│   └── eduskill.sql        # Database schema
├── css/
│   ├── style.css           # Main stylesheet (Pasang)
│   ├── pasang.css          # Dashboard styles (Pasang)
│   ├── shreeyash.css       # Student module (Shreeyash)
│   └── archana.css         # Provider module (Archana)
├── js/
│   ├── script.js           # Main JavaScript (Pasang)
│   ├── shreeyash.js        # Student JS (Shreeyash)
│   └── archana.js          # Provider JS (Archana)
├── includes/
│   ├── navbar.php          # Shared navbar
│   ├── footer.php          # Shared footer
│   └── header.php          # Shared header
└── images/                 # Image assets
```

## Database Structure

| Table | Description |
|---|---|
| `admin` | Ministry officer accounts |
| `students` | Student accounts |
| `providers` | Training provider accounts |
| `courses` | Course listings |
| `enrollments` | Student enrollment records |

## Work Distribution

| Feature | Responsible |
|---|---|
| Project setup, homepage, navbar, footer | Pasang Lama |
| About page, contact page | Pasang Lama |
| Login system (all 3 roles) | Pasang Lama |
| Admin dashboard | Pasang Lama |
| Provider approval system | Pasang Lama |
| Enrollment approval system | Pasang Lama |
| Course management (admin) | Pasang Lama |
| Database schema | Pasang Lama |
| Student signup | Shreeyash Pandey |
| Student dashboard | Shreeyash Pandey |
| Course browsing | Shreeyash Pandey |
| Enrollment request | Shreeyash Pandey |
| My courses / status | Shreeyash Pandey |
| Provider signup | Archana Tharu |
| Provider dashboard | Archana Tharu |
| Add / edit / delete course | Archana Tharu |
| Course students view | Archana Tharu |

## References

- Bootstrap 4 Documentation: https://getbootstrap.com/docs/4.5/
- Font Awesome Icons: https://fontawesome.com/
- PHP Documentation: https://www.php.net/docs.php
- MySQL Documentation: https://dev.mysql.com/doc/
- Google Fonts: https://fonts.google.com/
- The Edge Malaysia (2023). Upskilling and reskilling demand.
