-- TEYZIX CORE Internship Portal Database
CREATE DATABASE IF NOT EXISTS `teyzixcore_portal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `teyzixcore_portal`;

-- Applications
CREATE TABLE IF NOT EXISTS `applications` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(40) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `university` VARCHAR(200) NOT NULL,
  `semester` VARCHAR(40) NOT NULL,
  `domain` VARCHAR(100) NOT NULL,
  `skills` TEXT NOT NULL,
  `cover_letter` TEXT NOT NULL,
  `cv_file` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `subject` VARCHAR(200) NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin (username: admin / password: admin123)
INSERT INTO `admin_users` (`username`, `password`) VALUES
('admin', 'admin123');

-- Sample applications
INSERT INTO `applications` (`full_name`,`email`,`phone`,`city`,`university`,`semester`,`domain`,`skills`,`cover_letter`,`cv_file`) VALUES
('Ali Raza','ali@example.com','+92 300 1234567','Karachi','NED University','5th','Web Development','HTML, CSS, JS, PHP','Excited to join TEYZIX CORE.',NULL),
('Sara Khan','sara@example.com','+92 311 9876543','Lahore','FAST NUCES','6th','AI & Machine Learning','Python, TensorFlow, NumPy','Passionate about ML.',NULL);

-- Sample messages
INSERT INTO `contact_messages` (`name`,`email`,`subject`,`message`) VALUES
('Hamza','hamza@example.com','Internship Query','Do you offer remote internships?');
