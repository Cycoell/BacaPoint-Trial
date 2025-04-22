
-- Tabel Users
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password) VALUES
('Hanif', 'hanif@example.com', 'hashed_pw1'),
('Zakky', 'zakky@example.com', 'hashed_pw2');

-- Tabel Books
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200),
    author VARCHAR(100),
    category VARCHAR(100),
    description TEXT,
    cover_url VARCHAR(255)
);

INSERT INTO books (title, author, category, description) VALUES
('Atomic Habits', 'James Clear', 'Self-Development', 'Book on habit building.'),
('Laskar Pelangi', 'Andrea Hirata', 'Novel', 'Inspirational novel from Indonesia.');

-- Tabel Library
CREATE TABLE library (
    library_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    status VARCHAR(50),
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

INSERT INTO library (user_id, book_id, status) VALUES
(1, 1, 'reading'),
(2, 2, 'completed');

-- Tabel Points
CREATE TABLE points (
    point_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    source VARCHAR(100),
    amount INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO points (user_id, source, amount) VALUES
(1, 'read_book', 50),
(2, 'challenge_reward', 100);

-- Tabel Transactions
CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    type VARCHAR(50),
    points_used INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

INSERT INTO transactions (user_id, book_id, type, points_used) VALUES
(1, 1, 'redeem', 50),
(2, 2, 'purchase', 100);

-- Tabel Challenges
CREATE TABLE challenges (
    challenge_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    target_books INT,
    reward_points INT,
    deadline DATE
);

INSERT INTO challenges (title, description, target_books, reward_points, deadline) VALUES
('5 Books in a Month', 'Read 5 books in 30 days', 5, 200, '2025-06-01');

-- Tabel UserChallenges
CREATE TABLE user_challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    challenge_id INT,
    books_read INT,
    completed BOOLEAN,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (challenge_id) REFERENCES challenges(challenge_id)
);

INSERT INTO user_challenges (user_id, challenge_id, books_read, completed) VALUES
(1, 1, 3, FALSE),
(2, 1, 5, TRUE);

-- Tabel Reviews
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    rating INT,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

INSERT INTO reviews (user_id, book_id, rating, comment) VALUES
(1, 1, 5, 'Very helpful and inspiring.'),
(2, 2, 4, 'Beautiful story with great message.');

-- Tabel Admins
CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(255)
);

INSERT INTO admins (username, password) VALUES
('admin', 'adminpw');
