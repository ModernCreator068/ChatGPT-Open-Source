CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  role ENUM('admin', 'normal') NOT NULL DEFAULT 'normal',
  subscription ENUM('free', 'premium') NOT NULL DEFAULT 'free'
);


-- Create the table
CREATE TABLE commands (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  prompt VARCHAR(255) NOT NULL,
  writer VARCHAR(50) NOT NULL DEFAULT 'CODERRR'
);


CREATE TABLE submissions (
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  email_address VARCHAR(100) NOT NULL,
  title VARCHAR(100) NOT NULL,
  prompt VARCHAR(255) NOT NULL,
  submission_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_update_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);