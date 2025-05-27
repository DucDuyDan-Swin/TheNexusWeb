-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 04:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexusweb_db`
--
CREATE DATABASE nexusweb_db;
-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_ref` varchar(50) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `suburb` varchar(40) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `postcode` varchar(4) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `skill1` varchar(50) DEFAULT NULL,
  `skill2` varchar(50) DEFAULT NULL,
  `skill3` varchar(50) DEFAULT NULL,
  `skill4` varchar(50) DEFAULT NULL,
  `skill5` varchar(50) DEFAULT NULL,
  `skill6` varchar(50) DEFAULT NULL,
  `skill7` varchar(50) DEFAULT NULL,
  `skill8` varchar(50) DEFAULT NULL,
  `skill9` varchar(50) DEFAULT NULL,
  `skill10` varchar(50) DEFAULT NULL,
  `cv_filename` varchar(225) DEFAULT NULL,
  `other_skills` text DEFAULT NULL,
  `status` varchar(10) DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `job_ref`, `first_name`, `last_name`, `dob`, `gender`, `address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5`, `skill6`, `skill7`, `skill8`, `skill9`, `skill10`, `cv_filename`, `other_skills`, `status`) VALUES
(24, 'FSD01', 'abc', 'olpkjh', '1212-12-12', 'Male', 'rtstgesdrt', 'rtwsdfgsd', 'VIC', '2342', 'daffdsgsdfgsdfg@gmail.com', '987654321', 'HTML', '', '', '', '', '', '', '', '', '', 'cv_20250524_125624_6831a5d8d4036.pdf', '123', 'Current'),
(25, 'DTA02', 'def', 'poiuy', '1212-12-12', 'Female', 'rtstgesdrt', 'rtwsdfgsd', 'VIC', '2342', 'daffdsgsdfgsdfg@gmail.com', '987654321', 'CSS', '', '', '', '', '', '', '', '', '', 'cv_20250524_125643_6831a5eb31e3d.pdf', '321', 'New'),
(26, 'FSD01', 'dat', 'nghien', '2004-02-04', 'OtherG', 'thuong ly', 'hong bang', 'SA', '1111', 'datngunhatquadat@mail.com', '0987653425', 'OtherS', '', '', '', '', '', '', '', '', '', '', '', 'New'),
(27, 'FSD01', 'tran', 'nghien', '2004-05-06', 'Male', 'thuong ly', 'hong bang', 'SA', '2222', 'datngunhatquadat@mail.com', '0987653425', 'OtherS', '', '', '', '', '', '', '', '', '', '', '', 'New'),
(28, 'DTA02', 'tran', 'nghien', '2004-05-06', 'Female', 'thuong ly', 'hong bang', 'SA', '2222', 'datngunhatquadat@mail.com', '0987653425', 'OtherS', '', '', '', '', '', '', '', '', '', '', 'concac', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `reports_to` varchar(100) DEFAULT NULL,
  `key_responsibilities` text DEFAULT NULL,
  `required_qualifications` text DEFAULT NULL,
  `essential` text DEFAULT NULL,
  `preferable` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `reference`, `salary`, `reports_to`, `key_responsibilities`, `required_qualifications`, `essential`, `preferable`) VALUES
(1, 'Full Stack Developer', 'FSD01', '$80,000 - $120,000 per year', 'Lead Software Engineer', '<ul><li>Develop and maintain web applications using modern frameworks.</li><li>Design and implement RESTful APIs.</li><li>Collaborate with UI/UX designers to create intuitive user interfaces.</li><li>Optimize applications for performance and scalability.</li></ul>', '<ol><li>Proficiency in JavaScript, HTML, CSS, and a backend language (e.g., Node.js, Python).</li><li>3+ years of experience in full-stack development.</li><li>Strong understanding of database systems (SQL/NoSQL).</li></ol>', '<ul><li>HTML/CSS: Basics of web structure and styling.</li><li>JavaScript: Core language for web development.</li><li>Frameworks/Libraries: React, Angular, or Vue.js.</li><li>Server-Side Languages: Node.js, Python, Ruby, Java, or PHP.</li><li>Databases: SQL (MySQL, PostgreSQL) and NoSQL (MongoDB).</li><li>APIs: RESTful services and GraphQL.</li><li>Git: Essential for collaboration and version tracking.</li><li>CI/CD: Tools like Jenkins, Travis CI.</li><li>Containerization: Docker and Kubernetes.</li><li>Problem-Solving: Ability to troubleshoot and debug.</li><li>Communication: Clear communication with team members and stakeholders.</li></ul>', '<ul><li>Experience with cloud platforms like AWS or Azure.</li><li>Knowledge of DevOps practices and CI/CD pipelines.</li></ul>'),
(2, 'Data Analyst', 'DTA02', '$70,000 - $100,000 per year', 'Lead Data Scientist', '<ul><li>Analyze large datasets to identify trends and insights.</li><li>Develop and maintain dashboards and reports for stakeholders.</li><li>Collaborate with teams to define data requirements and solutions.</li><li>Ensure data accuracy and integrity through validation processes.</li></ul>', '<ol><li>Proficiency in data analysis tools such as Python, R, or SQL.</li><li>Experience with data visualization tools like Tableau or Power BI.</li><li>Strong analytical and problem-solving skills.</li></ol>', '<ul><li>Excel: Advanced functions and data analysis tools.</li><li>SQL: Querying databases to extract and manipulate data.</li><li>Python or R: For data analysis.</li><li>Data Visualization Tools: Tableau, Power BI, Matplotlib/Seaborn.</li><li>Statistical Analysis: Understanding of statistical tests and data distributions.</li><li>Mathematical Concepts: Linear algebra, calculus, and probability.</li><li>ETL Processes: Extract, Transform, Load processes.</li><li>Critical Thinking: Ability to interpret data and draw meaningful conclusions.</li><li>Communication: Presenting data insights clearly to non-technical stakeholders.</li></ul>', '<ul><li>Experience with machine learning models and techniques.</li><li>Knowledge of cloud platforms like AWS or Azure for data processing.</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_attempts` int(11) DEFAULT 0,
  `last_attempt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `username`, `password`, `login_attempts`, `last_attempt`, `role`) VALUES
(1, 'Duy', '$2y$10$/WdBZTW3ofQ3WFUZJSZuF.M7/C7Uvl2bK4aSt3HF4bF1/gpqJ9hvK', 0, '2025-05-24 12:39:26', 'admin'),
(2, 'Dan', '$2y$10$6YM3KVgG8EhfXikorgZcJePnQXJJ.sJWuqwW.W3ROwwtt74HBB2nm', 0, '2025-05-24 12:39:33', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
