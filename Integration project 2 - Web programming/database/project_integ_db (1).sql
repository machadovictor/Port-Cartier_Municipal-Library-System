-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 10:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_integ_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_name` varchar(20) NOT NULL COMMENT 'Categories'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_name`) VALUES
('Blu-ray'),
('CD'),
('Comic'),
('DVD'),
('Novel'),
('Other'),
('Video Game');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(6) NOT NULL COMMENT 'Document ID',
  `title` varchar(20) NOT NULL COMMENT 'Title',
  `author` varchar(20) NOT NULL COMMENT 'Author',
  `year` int(4) NOT NULL COMMENT 'Year',
  `category_name` varchar(15) NOT NULL COMMENT 'Category',
  `doc_type_name` varchar(15) NOT NULL COMMENT 'Type',
  `genre_name` varchar(15) NOT NULL COMMENT 'Genre',
  `descrip` tinytext NOT NULL COMMENT 'Description',
  `ISBN` varchar(14) NOT NULL COMMENT 'International Standard Book Number',
  `doc_status` enum('Available','Borrowed','Requested','Borrowed/Requested') NOT NULL COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `title`, `author`, `year`, `category_name`, `doc_type_name`, `genre_name`, `descrip`, `ISBN`, `doc_status`) VALUES
(1, '1984', 'George Orwell	', 1949, 'Novel', 'Adult', 'Drama', 'Government controls citizens', '978-0451524935', 'Available'),
(2, 'Batman: Hush	', 'Jeph Loeb	', 2002, 'Comic', 'Adult', 'Drama', 'Batman fights against villain', '978-1401203337', 'Available'),
(3, 'The Last of Us', 'Naughty Dog', 2013, 'Video Game', 'Adult', 'Drama', 'Survival in apocalypse', 'N/A', 'Available'),
(4, 'The Shawshank Redemp', 'Stephen King', 1994, 'DVD', 'Adult', 'Drama', 'Prisoner finds friendship', 'N/A', 'Available'),
(5, 'The Dark Knight', 'Christopher Nolan', 2008, 'Blu-ray', 'Adult', 'Drama', 'Batman confronts Joker', 'N/A', 'Available'),
(6, 'Thriller', 'Michael Jackson', 1982, 'CD', 'Teen', 'Other', 'Famous album by Michael Jackson', 'N/A', 'Available'),
(7, 'Harry Potter', 'J.K. Rowling', 1997, 'Novel', 'Children', 'Other', 'Young boy discovers he\'s a wizard', '978-0439708180', 'Available'),
(8, 'Spider-Man', 'Phil Lord', 2018, 'Comic', 'Children', 'Other', 'Spider-Man in parallel universes', '978-1302907260', 'Available'),
(9, 'Super Mario Bros', 'Nintendo', 1985, 'Video Game', 'Children', 'Other', 'Mario saves Princess Peach', 'N/A', 'Available'),
(10, 'Frozen', 'Disney', 2013, 'DVD', 'Children', 'Other', 'Sisters try to defrost kingdom', 'N/A', 'Available'),
(11, 'Toy Story', 'Pixar', 1995, 'Blu-ray', 'Children', 'Other', 'Toys come to life', 'N/A', 'Available'),
(12, 'Motown Hits', 'Various Artists', 1960, 'CD', 'Adult', 'Other', 'Collection of Motown songs', 'N/A', 'Available'),
(13, 'The Great Gatsby', 'F. Scott Fitzgerald	', 1925, 'Novel', 'Adult', 'Drama', 'Wealthy man has unrequited love', '978-0743273565', 'Available'),
(14, 'Watchmen', 'Alan Moore', 1986, 'Comic', 'Adult', 'Other', 'Superheroes fight against conspiracy', '978-0930289234', 'Available'),
(15, 'Red Dead Redemption', 'Rockstar Games', 2010, 'Video Game', 'Adult', 'Other', 'Outlaw tries to redeem himself', 'N/A', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`type_name`) VALUES
('Adult'),
('Children'),
('Teen');

-- --------------------------------------------------------

--
-- Table structure for table `genre_name`
--

CREATE TABLE `genre_name` (
  `genre_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre_name`
--

INSERT INTO `genre_name` (`genre_name`) VALUES
('Comedy'),
('Documentary'),
('Drama'),
('Horror'),
('Other'),
('Sci-fi');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(10) NOT NULL COMMENT 'Loan ID',
  `user_code` int(6) NOT NULL COMMENT 'User ID',
  `document_id` int(6) NOT NULL COMMENT 'Document ID',
  `loan_date` date NOT NULL COMMENT 'Loan Date',
  `return_date` date NOT NULL COMMENT 'Expected Return Date',
  `loan_status` enum('Late','Valid') NOT NULL COMMENT 'Status',
  `date_updated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans_history`
--

CREATE TABLE `loans_history` (
  `user_code` int(6) DEFAULT NULL COMMENT 'User ID',
  `document_id` int(6) NOT NULL COMMENT 'Document ID',
  `loan_date` date DEFAULT NULL COMMENT 'Loan Date',
  `return_date` date DEFAULT NULL COMMENT 'Return Date',
  `history_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans_history`
--

INSERT INTO `loans_history` (`user_code`, `document_id`, `loan_date`, `return_date`, `history_id`) VALUES
(3, 11, '2023-01-16', NULL, 6),
(NULL, 11, NULL, '2023-01-16', 7);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `user_code` int(6) NOT NULL COMMENT 'User ID',
  `document_id` int(6) NOT NULL COMMENT 'Document ID',
  `request_date` date NOT NULL COMMENT 'Request Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_code` int(6) NOT NULL COMMENT 'User''s Code',
  `full_name` varchar(50) NOT NULL COMMENT 'User''s Name',
  `street_number` int(6) NOT NULL COMMENT 'Street Number',
  `street_name` varchar(50) NOT NULL COMMENT 'Street Name',
  `city` varchar(20) NOT NULL COMMENT 'City',
  `province` text NOT NULL COMMENT 'Province',
  `phone` varchar(10) NOT NULL COMMENT 'Phone Number',
  `email` varchar(50) NOT NULL COMMENT 'E-mail',
  `pwd` varchar(16) NOT NULL COMMENT 'Password',
  `user_type_code` enum('M','E','A') NOT NULL COMMENT 'User Type Code (M = Member; E = Employee; A = Administrator)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_code`, `full_name`, `street_number`, `street_name`, `city`, `province`, `phone`, `email`, `pwd`, `user_type_code`) VALUES
(1, 'Victor Machado', 11001, 'Boulevard Lacordaire', 'Montreal', 'QC', '4384932630', 'machadovictor86@gmail.com', 'Logan0001', 'A'),
(2, 'Employee 1', 5150, 'Boulevard Robert', 'Montreal', 'QC', '5143250480', 'employee1@teste.com', 'Emp0001', 'E'),
(3, 'Member 1', 4777, 'Pierre-de Coubertin Avenue', 'Montreal', 'QC', '5148683000', 'member1@teste.com', 'Mem0001', 'M'),
(21, 'Employee 2', 7999, 'Boulevard des Galeries d\'Anjou', 'Montreal', 'QC', '5143536410', 'employee2@teste.com', 'Emp0002', 'E'),
(27, 'Member 2', 4101, 'Sherbrooke Street E', 'Montreal', 'QC\r\n', '5148684000', 'member2@teste.com', 'Mem0002', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `category_name` (`category_name`),
  ADD KEY `doc_type_name` (`doc_type_name`),
  ADD KEY `genre_name` (`genre_name`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`type_name`);

--
-- Indexes for table `genre_name`
--
ALTER TABLE `genre_name`
  ADD PRIMARY KEY (`genre_name`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `user_code` (`user_code`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `loans_history`
--
ALTER TABLE `loans_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `user_code` (`user_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_code`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Document ID', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Loan ID', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `loans_history`
--
ALTER TABLE `loans_history`
  MODIFY `history_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_code` int(6) NOT NULL AUTO_INCREMENT COMMENT 'User''s Code', AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`category_name`) REFERENCES `categories` (`category_name`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`doc_type_name`) REFERENCES `document_types` (`type_name`),
  ADD CONSTRAINT `documents_ibfk_3` FOREIGN KEY (`genre_name`) REFERENCES `genre_name` (`genre_name`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_code`) REFERENCES `users` (`user_code`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`user_code`) REFERENCES `users` (`user_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
