CREATE DATABASE IF NOT EXISTS flexfood_reservation;
USE flexfood_reservation;

DROP TABLE IF EXISTS reservations;

CREATE TABLE reservations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    guests INT UNSIGNED NOT NULL,
    table_area VARCHAR(50) NOT NULL,
    special_request TEXT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO reservations
(customer_name, phone, booking_date, booking_time, guests, table_area, special_request, status)
VALUES
('Sena Kendali', '081234567890', CURDATE(), '19:00:00', 4, 'Window Seat', 'Anniversary dinner, quiet table if possible.', 'pending'),
('Nadia Putri', '081299998888', DATE_ADD(CURDATE(), INTERVAL 1 DAY), '18:30:00', 2, 'Outdoor Garden', 'Prefer garden view.', 'confirmed'),
('Raka Pratama', '082211112222', DATE_ADD(CURDATE(), INTERVAL 2 DAY), '20:00:00', 6, 'Center Hall', 'Birthday dinner.', 'cancelled');
