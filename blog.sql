-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 01:30 PM
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `post` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post`, `owner`) VALUES
(3, 'testujemy testujemy', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  `post` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `alt` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `route`, `post`, `owner`, `cover`, `alt`) VALUES
(1, './images/test.png', 1, 1, 1, 'Ryba patrząca w duszę'),
(52, './images/dawid1702543883.jpg', 18, 2, 1, 'zap4.jpg'),
(53, './images/dawid1703154591.jpeg', 19, 2, 1, 'import.jpeg'),
(54, './images/tester1703155085.jpg', 20, 1, 1, 'zap1.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `contents` varchar(2047) NOT NULL,
  `date` varchar(63) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `contents`, `date`, `owner`) VALUES
(1, 'test post', 'ejfshdkghdurghdurghd luejfshdkg hdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurgh durghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurg hdurghdluejfs \n \n hdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkg \n hdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdu rghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurg hdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdluejfshdkg hdurghdurghdluejfshdkghdurghdurghdluejfshdkghdur ghdurghdluejfshdkghdurghdurghdluejfshdkghdurghdurghdlu', '2023-11-13 10:06:27', 1),
(18, 'hihi', 'hehe', '2023-12-14 09:51:23', 2),
(19, 'nowy', 'dkfheykwiudijaskh.gklisjdkhgfdsjlhgdskljcsbvdnkdghreklsdghj', '2023-12-21 11:29:51', 2),
(20, 'djewyfduiajslckfdlis;ujchdfivojdlkcd.flhgijf;kj.dhlj', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem voluptate et illum repudiandae facilis mollitia porro. Sit nesciunt ipsam distinctio. Tempora blanditiis perferendis saepe asperiores voluptas ducimus.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut accusantium dignissimos autem volu', '2023-12-21 11:38:05', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(1, 'tester', '$2y$10$37tXxxwlSjYcf//SHXvaHO3mbjQ71GfCOfwGbgLCI1cJ4.2VRnEem', 1),
(2, 'dawid', '$2y$10$tDmdJP6pYMe2lupbflwn1.Bs8bcyOpUsBm5KlvKxcoO9ob04e5CNe', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commentPost` (`post`),
  ADD KEY `fk_commentOwner` (`owner`);

--
-- Indeksy dla tabeli `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagePost` (`post`),
  ADD KEY `fk_imageOwner` (`owner`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_owner` (`owner`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_commentOwner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commentPost` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_imageOwner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_imagePost` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
