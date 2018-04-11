-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2018 at 01:31 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authorId` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authorId`, `firstName`, `lastName`, `age`, `gender`) VALUES
(1, 'Joanne', 'Rowling', 52, 'F'),
(2, 'Stephen', 'King', 70, 'M'),
(3, 'Yuval Noah ', 'Harari', 42, 'M'),
(4, 'Ernest', 'Cline', 46, 'M'),
(5, 'Daniel', 'Way', 43, 'M'),
(6, 'Christopher', 'Priest', 56, 'M'),
(7, 'Scott', 'Lobdell ', 47, 'M'),
(8, 'Greg', 'Pak', 49, 'M'),
(9, 'Brian Michael', 'Bendis', 50, 'M'),
(10, 'Richard', 'Prum', 57, 'M'),
(11, 'Jeff', 'Kinney', 47, 'M'),
(12, 'Dav', 'Pilkey ', 52, 'M'),
(13, 'Robert ', 'Stine ', 74, 'M'),
(15, 'Isaac', 'Asimov', 72, 'M'),
(16, 'William', 'Gibson', 70, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookId` int(11) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `bookPublisher` varchar(25) NOT NULL,
  `publishYear` int(11) NOT NULL,
  `bookImage` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `genreId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookId`, `bookName`, `bookPublisher`, `publishYear`, `bookImage`, `price`, `genreId`, `authorId`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 'Scholastic Press', 1997, 'https://images-na.ssl-images-amazon.com/images/I/51HSkTKlauL._SX346_BO1,204,203,200_.jpg', 23.47, 1, 1),
(2, 'Harry Potter And The Chamber Of Secrets', 'Scholastic Press', 2000, 'https://images-na.ssl-images-amazon.com/images/I/51jNORv6nQL._SX340_BO1,204,203,200_.jpg', 11.72, 1, 1),
(3, 'Harry Potter and the Prisoner of Azkaban', 'Scholastic Press', 2013, 'https://images-na.ssl-images-amazon.com/images/I/51BXPzy1rpL._SX322_BO1,204,203,200_.jpg', 16.29, 1, 1),
(4, 'Harry Potter And The Goblet Of Fire', 'Scholastic Press', 2002, 'https://images-na.ssl-images-amazon.com/images/I/51OORp1XD1L._SX421_BO1,204,203,200_.jpg', 22.51, 1, 1),
(5, 'Harry Potter and the Order of the Phoenix', 'Scholastic Press', 2013, 'https://images-na.ssl-images-amazon.com/images/I/51CL-4CeiSL._SX325_BO1,204,203,200_.jpg', 16.29, 1, 1),
(6, 'Harry Potter and the Half-Blood Prince', 'Scholastic Press', 2013, 'https://images-na.ssl-images-amazon.com/images/I/512duVU966L._SX322_BO1,204,203,200_.jpg', 17.39, 1, 1),
(7, 'Harry Potter and the Deathly Hallows', 'Scholastic Press', 2009, 'https://images-na.ssl-images-amazon.com/images/I/5128ATd9dSL._SX418_BO1,204,203,200_.jpg', 20.01, 1, 1),
(8, 'It', 'Scribner', 2016, 'https://images-na.ssl-images-amazon.com/images/I/51xPIEYPWWL._SX326_BO1,204,203,200_.jpg', 19.77, 2, 2),
(9, 'The Shining', 'Anchor', 2012, 'https://images-na.ssl-images-amazon.com/images/I/516uvS8NqwL._SX294_BO1,204,203,200_.jpg', 27.51, 2, 2),
(10, 'The Stand', 'Anchor', 2011, 'https://images-na.ssl-images-amazon.com/images/I/51toR2ujDUL._SX304_BO1,204,203,200_.jpg', 28.04, 3, 2),
(11, 'Homo Deus: A Brief History of Tomorrow', 'Harper', 2017, 'https://images-na.ssl-images-amazon.com/images/I/414JWlgTXGL.jpg', 19.85, 4, 3),
(12, 'Ready Player One', 'Broadway Boos', 2011, 'https://images-na.ssl-images-amazon.com/images/I/51hD3F53GXL.jpg', 10.65, 3, 4),
(13, 'Deadpool Vol. 1: Secret Invasion', 'Marvel', 2009, 'https://images-na.ssl-images-amazon.com/images/I/51Iy98JcD-L.jpg', 17.69, 5, 5),
(14, 'Black Panther: The Complete Collection', 'Marvel', 2015, 'https://images-na.ssl-images-amazon.com/images/I/51qfg-Bf33L.jpg', 25.98, 5, 6),
(15, 'X-Men: Legionquest', 'Marvel', 2018, 'https://images-na.ssl-images-amazon.com/images/I/514epSBioyL.jpg', 75.25, 5, 7),
(16, 'Hulk: World War Hulk', 'Marvel', 2008, 'https://images-na.ssl-images-amazon.com/images/I/61sAlEjmbVL.jpg', 30.01, 5, 8),
(17, 'Guardians of the Galaxy, Vol. 1: Cosmic Avengers', 'Marvel', 2013, 'https://images-na.ssl-images-amazon.com/images/I/51dfrgFcvzL.jpg', 27.66, 5, 9),
(18, 'The Evolution of Beauty', 'Doubleday', 2017, 'https://images-na.ssl-images-amazon.com/images/I/41XJhvMwVUL._SX327_BO1,204,203,200_.jpg', 19.26, 6, 10),
(19, 'Diary of a Wimpy Kid', 'Amulet Books', 2012, 'https://images-na.ssl-images-amazon.com/images/I/51wa5CeM0dL.jpg', 9.59, 7, 11),
(20, 'Diary of a Wimpy Kid Rodrick Rules', 'Amulet Books', 2008, 'https://images-na.ssl-images-amazon.com/images/I/51DER1phkML._SX340_BO1,204,203,200_.jpg', 10.04, 7, 11),
(21, 'Diary of a Wimpy Kid: The Last Straw ', 'Amulet Books', 2009, 'https://images-na.ssl-images-amazon.com/images/I/51A5tjyD%2B9L._SX334_BO1,204,203,200_.jpg', 9.32, 7, 11),
(22, 'Diary of a Wimpy Kid: Dog Days', 'Amulet Books', 2009, 'https://images-na.ssl-images-amazon.com/images/I/51C9zeyCMCL._SX340_BO1,204,203,200_.jpg', 9.59, 7, 11),
(23, 'Diary of a Wimpy Kid: The Ugly Truth', 'Amulet Books', 2011, 'https://images-na.ssl-images-amazon.com/images/I/51Yzz%2BvaXSL._SX331_BO1,204,203,200_.jpg', 19.94, 7, 11),
(24, 'Diary of a Wimpy Kid: Cabin Fever ', 'Amulet Books', 2011, 'https://images-na.ssl-images-amazon.com/images/I/41dPK8m8wgL._SX270_BO1,204,203,200_.jpg', 9.53, 7, 11),
(25, 'Diary of a Wimpy Kid: The Third Wheel', 'Harry N. Abrams', 2012, 'https://images-na.ssl-images-amazon.com/images/I/51nApVju%2B7L._SX339_BO1,204,203,200_.jpg', 7.79, 7, 11),
(26, 'Diary of a Wimpy Kid: Hard Luck', 'Amulet Books', 2013, 'https://images-na.ssl-images-amazon.com/images/I/51WVlYqD1RL._SX339_BO1,204,203,200_.jpg', 9.39, 7, 11),
(27, 'Diary of a Wimpy Kid: The Long Haul', 'Amulet Books', 2014, 'https://images-na.ssl-images-amazon.com/images/I/510%2BtbZHhfL._SX339_BO1,204,203,200_.jpg', 9.59, 7, 11),
(28, 'Diary of a Wimpy Kid: Old School', 'Amulet Books', 2015, 'https://images-na.ssl-images-amazon.com/images/I/61tAHh6Sc5L.jpg', 7.79, 7, 11),
(29, 'Diary of a Wimpy Kid: Double Down ', 'Amulet Books', 2016, 'https://images-na.ssl-images-amazon.com/images/I/518byyOLMcL._SX344_BO1,204,203,200_.jpg', 8.98, 7, 11),
(30, 'Diary of a Wimpy Kid: The Getaway', 'Harry N. Abrams', 2017, 'https://images-na.ssl-images-amazon.com/images/I/515bCkpiEsL._SX345_BO1,204,203,200_.jpg', 9.91, 7, 11),
(31, 'The Adventures of Captain Underpants', 'Scholastic Press', 1997, 'https://images-na.ssl-images-amazon.com/images/I/61fM9j2P8KL._SX337_BO1,204,203,200_.jpg', 10.65, 7, 12),
(32, 'Captain Underpants and the Attack of the Talking Toilets', 'Scholastic Press', 1999, 'https://images-na.ssl-images-amazon.com/images/I/61TvdGmmUfL._SX341_BO1,204,203,200_.jpg', 7.11, 7, 12),
(33, 'Captain Underpants and the Perilous Plot of Professor Poopypants', 'Scholastic Press', 1999, 'https://images-na.ssl-images-amazon.com/images/I/61FuZq7Ao7L._SY344_BO1,204,203,200_QL70_.jpg', 9.08, 7, 12),
(34, 'Goosebumps: Welcome To Dead House', 'Scholastic Press', 1992, 'https://vignette.wikia.nocookie.net/goosebumps/images/8/88/Welcome_to_Dead_House_%28Cover%29.jpg/revision/latest?cb=20161223191421', 5.02, 2, 13),
(35, 'Goosebumps: Stay Out of the Basement', 'Scholastic Press', 1992, 'https://vignette.wikia.nocookie.net/goosebumps/images/0/0c/Stay_Out_of_the_Basement_%28Cover%29.jpg/revision/latest/scale-to-width-down/210?cb=20160705013444', 3.99, 2, 13),
(36, 'Goosebumps: Monster Blood', 'Scholastic Press', 1992, 'https://vignette.wikia.nocookie.net/goosebumps/images/f/fa/Monster_Blood_%28Cover%29.jpg/revision/latest/scale-to-width-down/210?cb=20160813014537', 6.29, 2, 13),
(37, 'Goosebumps: Night of the Living Dummy', 'Scholastic Press', 1993, 'https://vignette.wikia.nocookie.net/goosebumps/images/b/b0/Night_of_the_Living_Dummy_%28Cover%29.jpg/revision/latest/scale-to-width-down/210?cb=20160705010047', 4.97, 2, 13),
(38, 'Goosebumps: Welcome to Camp Nightmare', 'Scholastic Press', 1993, 'https://vignette.wikia.nocookie.net/goosebumps/images/6/65/Welcome_to_Camp_Nightmare_%28Cover%29.jpg/revision/latest/scale-to-width-down/210?cb=20170511014832', 4.89, 2, 13),
(39, 'I, Robot', 'Spectra', 2008, 'https://media.npr.org/assets/bakertaylor/covers/i/i-robot/9780553382563_custom-d5271e904c05142235155dd8823b6108e63ec8a9-s200-c85.jpg', 10.22, 3, 15),
(40, 'Neuromancer', 'Ace', 1984, 'https://media.npr.org/assets/bakertaylor/covers/n/neuromancer/9780441012039_custom-7e989312eec9a96b102522a65f03bdcb8d30df72-s200-c85.jpg', 7.95, 3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genreId` int(11) NOT NULL,
  `genreName` varchar(25) NOT NULL,
  `genreDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genreId`, `genreName`, `genreDescription`) VALUES
(1, 'Fantasy Fiction', 'Fantasy is a genre of fiction set in a fictional universe, often, but not always, without any locations, events, or people referencing the real world.'),
(2, 'Horror', 'Horror is a genre that aims to create a sense of fear, panic, alarm, and dread for the audience.'),
(3, 'Science Fiction', 'fiction based on imagined future scientific or technological advances and major social or environmental changes, frequently portraying space or time travel and life on other planets.'),
(4, 'History', 'History genre describes past events, particularly in human affairs.'),
(5, 'Comics & Graphic Novels', 'a novel in comic-strip format.'),
(6, 'Health and Fitness', 'This genre is based off the state of health and well-being, more specifically, the ability to perform aspects of sports, occupations and daily activities.'),
(7, 'Children\'s Book', 'Children\'s books that provide a \"visual experience\" - telling a story with pictures.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
