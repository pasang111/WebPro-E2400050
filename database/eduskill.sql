CREATE DATABASE IF NOT EXISTS eduskill;
USE eduskill;

CREATE TABLE IF NOT EXISTS admin (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS students (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    phone      VARCHAR(20),
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS providers (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    org_name    VARCHAR(150) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    phone       VARCHAR(20),
    address     VARCHAR(200),
    description TEXT,
    password    VARCHAR(255) NOT NULL,
    status      ENUM('pending','approved','rejected') DEFAULT 'pending',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS courses (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    provider_id  INT NOT NULL,
    title        VARCHAR(200) NOT NULL,
    category     VARCHAR(100) NOT NULL,
    duration     VARCHAR(50) NOT NULL,
    description  TEXT,
    price        DECIMAL(10,2) DEFAULT 0.00,
    max_students INT DEFAULT 30,
    status       ENUM('pending','approved','rejected') DEFAULT 'pending',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (provider_id) REFERENCES providers(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS enrollments (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    student_id  INT NOT NULL,
    course_id   INT NOT NULL,
    notes       TEXT,
    status      ENUM('pending','approved','rejected') DEFAULT 'pending',
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id)  REFERENCES courses(id)  ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (student_id, course_id)
);


INSERT INTO admin (name, email, password) VALUES
('Admin Officer', 'admin@eduskill.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO providers (org_name, email, phone, address, description, password, status) VALUES
('Tech Academy Malaysia', 'tech@academy.my',  '03-1234 5678', 'Kuala Lumpur',  'Leading tech training provider in Malaysia.',          '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved'),
('DataSkill Institute',   'info@dataskill.my','03-2345 6789', 'Petaling Jaya', 'Specialising in data science and analytics courses.',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'approved'),
('Creative Hub KL',       'hi@creativehub.my','03-3456 7890', 'Bangsar',       'Design and creative skills training centre.',          '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pending');

INSERT INTO students (name, email, phone, password) VALUES
('Ahmad Faris',  'ahmad@gmail.com', '011-1234 5678', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Nurul Aina',   'nurul@gmail.com', '011-2345 6789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Ravi Kumar',   'ravi@gmail.com',  '011-3456 7890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Test Student', 'student@eduskill.com', '011-0000 0000', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample courses
INSERT INTO courses (provider_id, title, category, duration, description, price, status) VALUES
(1, 'Full Stack Web Development', 'Programming', '8 Weeks', 'Learn HTML, CSS, JavaScript, PHP and MySQL from scratch.',    800.00, 'approved'),
(2, 'Data Science & Analytics',   'Data Science', '6 Weeks', 'Master data analysis and visualization with Python.',        600.00, 'approved'),
(1, 'PHP for Beginners',          'Programming', '4 Weeks', 'Introduction to PHP programming for absolute beginners.',    400.00, 'approved'),
(3, 'UI/UX Design Fundamentals',  'Design',       '4 Weeks', 'Learn user interface and experience design principles.',     500.00, 'pending');

-- Sample enrollments
INSERT INTO enrollments (student_id, course_id, status) VALUES
(1, 1, 'approved'),
(2, 2, 'pending'),
(3, 3, 'approved'),
(4, 1, 'pending');

USE eduskill;

CREATE TABLE IF NOT EXISTS ratings (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    student_id  INT NOT NULL,
    course_id   INT NOT NULL,
    rating      TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    review      TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id)  REFERENCES courses(id)  ON DELETE CASCADE,
    UNIQUE KEY unique_rating (student_id, course_id)
);

-- Sample ratings for existing courses
INSERT IGNORE INTO ratings (student_id, course_id, rating, review) VALUES
(1, 1, 5, 'Excellent course! Very practical and well structured.'),
(2, 2, 5, 'Best data science course I have taken. Highly recommended.'),
(3, 1, 4, 'Great content but could use more exercises.'),
(4, 2, 5, 'Loved every module. The instructor explains clearly.');


