-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 09:43 AM
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
-- Database: `be25_exam4_kimschlueter_biglibrary`
--
CREATE DATABASE IF NOT EXISTS `be25_exam4_kimschlueter_biglibrary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be25_exam4_kimschlueter_biglibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `medium`
--

CREATE TABLE `medium` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `isbn_code` varchar(20) DEFAULT NULL,
  `short_description` varchar(800) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `author_first_name` varchar(100) DEFAULT NULL,
  `author_last_name` varchar(100) DEFAULT NULL,
  `publisher_name` varchar(100) DEFAULT NULL,
  `publisher_address` varchar(100) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medium`
--

INSERT INTO `medium` (`id`, `title`, `image`, `isbn_code`, `short_description`, `type`, `author_first_name`, `author_last_name`, `publisher_name`, `publisher_address`, `publish_date`, `status`) VALUES
(5, 'The Amateur', 'https://upload.wikimedia.org/wikipedia/en/a/a3/The_Amateur_2025_poster.jpg', '', 'The Amateur is a 2025 American action thriller film directed by James Hawes and written by Ken Nolan and Gary Spinelli. It is based on the 1981 novel by Robert Littell, which was previously adapted into a 1981 Canadian film.', 'DVD', 'James', 'Hawes', '20th Century Studios', 'Fox Studio Lot Building 88, 10201 West Pico Boulevard, Century City, Los Angeles, California , Unite', '2025-04-11', 1),
(6, 'The Matrix', 'https://upload.wikimedia.org/wikipedia/en/9/94/The_Matrix.jpg', '', 'The Matrix is a 1999 science fiction action film written and directed by the Wachowskis.[a] It is the first installment in the Matrix film series, starring Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss, Hugo Weaving, and Joe Pantoliano. It depicts a dystopian future in which humanity is unknowingly trapped inside the Matrix, a simulated reality created by intelligent machines. Believing computer hacker Neo to be &quot;the One&quot; prophesied to defeat them, Morpheus recruits him into a rebellion against the machines.', 'DVD', 'The Wachowskis', '', 'Warner Bros.', '4000 Warner Blvd, Burbank, California, USA', '1999-03-31', 1),
(7, 'Superman', 'https://upload.wikimedia.org/wikipedia/en/3/32/Superman_%282025_film%29_poster.jpg', '', 'Superman is a 2025 American superhero film based on the character from DC Comics. Written and directed by James Gunn, it is the first film in the DC Universe (DCU) produced by DC Studios and the second reboot of the Superman film series. David Corenswet stars as Clark Kent / Superman, alongside Rachel Brosnahan, Nicholas Hoult, Edi Gathegi, Anthony Carrigan, Nathan Fillion, and Isabela Merced. In the film, Superman must prove to the world that he is their protector after billionaire Lex Luthor enacts a plan to turn public opinion against him. ', 'DVD', 'James', 'Gunn', 'Warner Bros.', '4000 Warner Boulevard, Burbank, California , United States', '2025-07-11', 1),
(8, 'Indiana Jones and the Dial of Destiny', 'https://upload.wikimedia.org/wikipedia/en/c/c3/Indiana_Jones_and_the_Dial_of_Destiny_theatrical_poster.jpg', '', 'Indiana Jones and the Dial of Destiny is a 2023 American action-adventure film directed by James Mangold and written by Mangold, David Koepp, Jez and John-Henry Butterworth. It is the fifth and final installment in the Indiana Jones film series. Harrison Ford, John Rhys-Davies, and Karen Allen reprise their roles from the previous films, with Phoebe Waller-Bridge, Antonio Banderas, Toby Jones, Boyd Holbrook, Ethann Isidore, and Mads Mikkelsen joining the cast. Set in 1969, the film follows Jones and his estranged goddaughter, Helena, who are trying to locate a powerful artifact before Dr. Jürgen Voller, a Nazi-turned-NASA scientist, who plans to use it to alter the outcome of World War II. ', 'DVD', 'James', 'Mangold', 'Walt Disney Studios Motion Pictures', '500 South Buena Vista Street, Burbank, California , U.S.', '2023-06-30', 0),
(9, 'Avatar: The Way of Water', 'https://upload.wikimedia.org/wikipedia/en/5/54/Avatar_The_Way_of_Water_poster.jpg', '', 'Set over a decade after the events of the first film, \"Avatar: The Way of Water\" returns to the breathtaking world of Pandora. Jake Sully and Neytiri now lead a family, facing new threats as they flee their forest home for the oceanic clans. Amidst dazzling underwater wonders and rising tensions, they must protect their bond and fight for survival in a world where the balance between nature and humanity teeters once again.', 'DVD', 'James', 'Cameron', '20th Century Studios', 'Fox Studio Lot Building 88, 10201 West Pico Boulevard, Century City, Los Angeles, California , Unite', '2022-12-16', 0),
(10, 'Atmosphere', 'https://upload.wikimedia.org/wikipedia/en/thumb/6/6f/Atmosphere_%28novel%29_cover.tiff/lossy-page1-375px-Atmosphere_%28novel%29_cover.tiff.jpg', '978-0593158715', 'Atmosphere is a 2025 historical fiction romance novel by Taylor Jenkins Reid. The book centers around Joan Goodwin, a fictional astronaut in NASA&#039;s Space Shuttle program in the early 1980s. The novel begins with a crisis: a malfunction aboard a space shuttle leaves most of the astronauts aboard dead or unconscious, with the exception of Vanessa Ford. Joan Goodwin is working as spacecraft communicator (CAPCOM) in the mission control center, and instructs Vanessa that the ship must be landed. The novel then focuses on events taking place in the lead-up to this disaster.', 'Book', 'Taylor Jenkins', 'Reid', 'Ballantine Books', 'Random House Tower, 1745 Broadway, New York City , U.S.', '2025-06-03', 1),
(11, 'Onyx Storm', 'https://upload.wikimedia.org/wikipedia/en/9/9d/Onyx_Storm_cover.jpg', '978-1-64937-715-9', 'Onyx Storm is a romantic fantasy novel written by Rebecca Yarros and published by Red Tower Books. Released on January 21, 2025, it is the third book in the fantasy romance Empyrean series, after Fourth Wing and Iron Flame. The book was listed on bestseller charts by August 2024 due to pre-orders.', 'Book', 'Rebecca', 'Yarros', 'Red Tower Books', '2614 S Timberline Rd, Ste 105, Fort Collins, Colorado 80525, USA', '2025-01-21', 1),
(12, 'Funny Story', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1691777485i/194802722.jpg', '978-0-593-44128-2', 'Funny Story is a 2024 novel by American author Emily Henry. The romance novel follows librarian Daphne and Miles, whose exes are dating each other. Magazine Paste says it \"has lots of heart but too little mischief\".\r\n\r\nFunny Story debuted at number one on The New York Times fiction best-seller list and USA Today best-selling booklist, and, as of July 2024, has sold over 800,000 copies in North America.', 'Book', 'Emily', 'Henry', 'Berkley Books', '200 Madison Avenue, New York, NY 10016, USA', '2024-04-23', 1),
(13, 'From Zero', 'https://www.emp.at/dw/image/v2/BBQV_PRD/on/demandware.static/-/Sites-master-emp/default/dwb2528493/images/5/7/6/9/576918.jpg?sfrm=png', '', 'From Zero is the eighth studio album by American rock band Linkin Park. It was released on November 15, 2024, through Warner Records and Machine Shop, and is Linkin Park\'s first studio album since One More Light (2017). This is also their first album with vocalist Emily Armstrong and drummer Colin Brittain following the death of vocalist Chester Bennington in 2017 and departure of drummer Rob Bourdon. The album\'s title has a double meaning; it is a reference to both the band\'s original name, Xero, and the band\'s new chapter with Armstrong and Brittain. The album marks the band\'s return to the nu metal, alternative metal and rap rock genres while still incorporating some of the experimental sounds from their later records. ', 'CD', 'Linkin Park', '', 'Warner Records', '1633 Broadway, New York City, New York , U.S.', '2024-11-15', 0),
(14, 'Ego Trip', 'https://upload.wikimedia.org/wikipedia/en/7/7d/Papa_Roach_-_Ego_Trip.png', '', 'Ego Trip is the eleventh studio album by American rock band Papa Roach. It was released on April 8, 2022, through New Noize. Six singles have been released from the album: \"Swerve\", \"Kill the Noise\", \"Stand Up\", \"Cut the Line\", \"No Apologies\", and \"Leave a Light On (Talk Away the Dark)\". ', 'CD', 'Papa Roach', '', 'New Noize', 'PO Box 49554, London E17 9WB', '2022-04-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `authority` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `picture`, `first_name`, `last_name`, `date_of_birth`, `authority`) VALUES
(1, 'test', 'f6952d6eef555ddd87aca66e56b91530222d6e318414816f3ba7cf5bf694bf0f', 'testfqweqe21@gmail.com', 'img_687e3483badf8.png', 'Hans', 'Peter', '1994-12-12', 'user'),
(2, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@admin.com', 'img_687f694681b18.jpg', 'Admin', 'istrator', '1990-12-12', 'admin'),
(3, 'user', 'f6952d6eef555ddd87aca66e56b91530222d6e318414816f3ba7cf5bf694bf0f', 'user@user.com', '', 'Thomas', 'Anderson', '1111-01-01', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medium`
--
ALTER TABLE `medium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medium`
--
ALTER TABLE `medium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
