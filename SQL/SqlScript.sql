create database ChatBox;
use ChatBox;
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    sender_id INT(11) NOT NULL,
    receiver_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);
INSERT INTO users (username, email, password) 
VALUES
('john_doe', 'john@example.com', 'hashed_password_123'),
('jane_smith', 'jane@example.com', 'hashed_password_456'),
('michael_brown', 'michael@example.com', 'hashed_password_789');
INSERT INTO messages (sender_id, receiver_id, message, image) 
VALUES
(1, 2, 'Hey Jane, how are you?', NULL),
(2, 1, 'I am good, thanks for asking!', NULL),
(3, 2, 'Hey Jane, I sent you the report.', 'report_image.png');

