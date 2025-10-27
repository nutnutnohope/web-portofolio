-- Create database
CREATE DATABASE IF NOT EXISTS portfolio;
USE portfolio;

-- Create projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    demo_link VARCHAR(255),
    github_link VARCHAR(255),
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create skills table
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    icon VARCHAR(100),
    proficiency INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create messages table
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample projects
INSERT INTO projects (title, description, demo_link, github_link) VALUES
('Portfolio Website', 'A modern portfolio website built with PHP and JavaScript', 'https://demo.example.com/portfolio', 'https://github.com/yourusername/portfolio'),
('E-commerce Platform', 'Full-stack e-commerce solution with shopping cart', 'https://demo.example.com/shop', 'https://github.com/yourusername/ecommerce'),
('Task Manager', 'A simple but powerful task management application', 'https://demo.example.com/tasks', 'https://github.com/yourusername/tasks');

-- Insert sample skills
INSERT INTO skills (name, icon, proficiency) VALUES
('HTML5', 'fab fa-html5', 90),
('CSS3', 'fab fa-css3-alt', 85),
('JavaScript', 'fab fa-js', 80),
('React', 'fab fa-react', 75),
('Node.js', 'fab fa-node-js', 70),
('PHP', 'fab fa-php', 85),
('MySQL', 'fas fa-database', 80),
('Git', 'fab fa-git-alt', 75);