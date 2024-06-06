-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 12:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courses`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddArticle` (IN `p_user_id` INT, IN `p_category_id` INT, IN `p_title` VARCHAR(255), IN `p_content` TEXT)   BEGIN
    INSERT INTO articles (user_id, category_id, title, content)
    VALUES (p_user_id, p_category_id, p_title, p_content);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddComment` (IN `p_user_id` INT, IN `p_article_id` INT, IN `p_comment_text` TEXT)   BEGIN
    INSERT INTO comments (user_id, article_id, comment_text)
    VALUES (p_user_id, p_article_id, p_comment_text);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddCourse` (IN `p_category_id` INT, IN `p_course_name` VARCHAR(100), IN `p_description` TEXT, IN `p_price` DECIMAL(10,2))   BEGIN
    INSERT INTO courses (category_id, course_name, description, price)
    VALUES (p_category_id, p_course_name, p_description, p_price);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddCourseReview` (IN `p_student_id` INT, IN `p_course_id` INT, IN `p_rating` INT, IN `p_review_text` TEXT)   BEGIN
    INSERT INTO course_reviews (student_id, course_id, rating, review_text)
    VALUES (p_student_id, p_course_id, p_rating, p_review_text);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddEvent` (IN `p_user_id` INT, IN `p_event_name` VARCHAR(255), IN `p_event_description` TEXT, IN `p_event_date` DATE)   BEGIN
    INSERT INTO events (user_id, event_name, event_description, event_date)
    VALUES (p_user_id, p_event_name, p_event_description, p_event_date);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddUser` (IN `p_username` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255), IN `p_permission` ENUM('1','2','3'))   BEGIN
    INSERT INTO users (username, email, password, permission)
    VALUES (p_username, p_email, p_password, p_permission);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteArticle` (IN `article_id` INT)   BEGIN
    DECLARE thumbnail_path VARCHAR(255);

    -- Get the thumbnail path
    SELECT thumbnail INTO thumbnail_path
    FROM articles
    WHERE id = article_id;

    -- Delete the article
    DELETE FROM articles
    WHERE id = article_id;

    -- If the thumbnail exists, delete it
    IF thumbnail_path IS NOT NULL THEN
        SET @thumbnailPath = thumbnail_path;
        IF EXISTS (SELECT 1 FROM information_schema.tables WHERE table_name = 'articles' AND table_schema = DATABASE()) THEN
            SET @query = CONCAT('DELETE FROM ', @thumbnailPath);
            PREPARE stmt FROM @query;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;
        END IF;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EnrollStudent` (IN `p_student_id` INT, IN `p_course_id` INT)   BEGIN
    INSERT INTO enrollments (student_id, course_id)
    VALUES (p_student_id, p_course_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetArticles` ()   BEGIN
    SELECT articles.*, categories.category_name, users.username 
    FROM articles 
    LEFT JOIN categories ON articles.category_id = categories.id 
    LEFT JOIN users ON articles.user_id = users.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCourseDetails` (IN `p_course_id` INT)   BEGIN
    SELECT c.id, c.course_name, c.description, c.price, cat.category_name
    FROM courses c
    INNER JOIN categories cat ON c.category_id = cat.id
    WHERE c.id = p_course_id;

    SELECT cr.rating, cr.review_text, cr.review_date, s.student_name
    FROM course_reviews cr
    INNER JOIN students s ON cr.student_id = s.id
    WHERE cr.course_id = p_course_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserProfile` (IN `p_user_id` INT)   BEGIN
    SELECT u.id, u.username, u.email, u.permission, p.bio, p.profile_picture
    FROM users u
    LEFT JOIN profiles p ON u.id = p.user_id
    WHERE u.id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LikeArticle` (IN `p_user_id` INT, IN `p_article_id` INT)   BEGIN
    INSERT INTO likes (user_id, article_id)
    VALUES (p_user_id, p_article_id);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `published_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `category_id`, `title`, `thumbnail`, `content`, `published_date`) VALUES
(1, 1, 1, 'JS 103', 'lily-banse--YHSwy6uqvk-unsplash.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto commodi rem perspiciatis. Quae suscipit, accusamus facilis optio neque soluta vitae repellendus voluptate error ut rerum dolores ea doloremque ipsum pariatur quidem, itaque iure mollitia sed accusantium obcaecati odit nulla? Ab dolorem aliquam tempora dolore! Totam odit, nihil aliquid officia, laudantium suscipit non ullam excepturi reprehenderit, similique commodi aliquam temporibus at animi ducimus quae ad distinctio voluptas asperiores tempora placeat! Nostrum pariatur maiores quae voluptatibus, maxime et dolorum nemo quo impedit voluptatum facilis dolores nihil alias laborum rem? Facere modi repellat ipsa eaque, et ex delectus dolores aliquid doloribus, magni rem quod nobis velit sapiente aspernatur placeat quasi itaque id vero. Quam perspiciatis tempora necessitatibus in tenetur quos sit aspernatur ratione!', '2024-06-04'),
(2, 1, 1, 'Java 102', 'anna-tukhfatullina-food-photographer-stylist-Mzy-OjtCI70-unsplash.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto commodi rem perspiciatis. Quae suscipit, accusamus facilis optio neque soluta vitae repellendus voluptate error ut rerum dolores ea doloremque ipsum pariatur quidem, itaque iure mollitia sed accusantium obcaecati odit nulla? Ab dolorem aliquam tempora dolore! Totam odit, nihil aliquid officia, laudantium suscipit non ullam excepturi reprehenderit, similique commodi aliquam temporibus at animi ducimus quae ad distinctio voluptas asperiores tempora placeat! Nostrum pariatur maiores quae voluptatibus, maxime et dolorum nemo quo impedit voluptatum facilis dolores nihil alias laborum rem? Facere modi repellat ipsa eaque, et ex delectus dolores aliquid doloribus, magni rem quod nobis velit sapiente aspernatur placeat quasi itaque id vero. Quam perspiciatis tempora necessitatibus in tenetur quos sit aspernatur ratione!', '2024-06-03'),
(6, 1, 1, 'Go Lang 101', 'eiliv-aceron-ZuIDLSz3XLg-unsplash.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto commodi rem perspiciatis. Quae suscipit, accusamus facilis optio neque soluta vitae repellendus voluptate error ut rerum dolores ea doloremque ipsum pariatur quidem, itaque iure mollitia sed accusantium obcaecati odit nulla? Ab dolorem aliquam tempora dolore! Totam odit, nihil aliquid officia, laudantium suscipit non ullam excepturi reprehenderit, similique commodi aliquam temporibus at animi ducimus quae ad distinctio voluptas asperiores tempora placeat! Nostrum pariatur maiores quae voluptatibus, maxime et dolorum nemo quo impedit voluptatum facilis dolores nihil alias laborum rem? Facere modi repellat ipsa eaque, et ex delectus dolores aliquid doloribus, magni rem quod nobis velit sapiente aspernatur placeat quasi itaque id vero. Quam perspiciatis tempora necessitatibus in tenetur quos sit aspernatur ratione!', '2024-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assignment_title` varchar(100) NOT NULL,
  `assignment_description` text DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `course_id`, `user_id`, `assignment_title`, `assignment_description`, `created_at`) VALUES
(2, 5, 16, 'zxc', 'zxc', '2024-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Javascript'),
(2, 'Python'),
(4, 'Typescript');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `category_id`, `course_name`, `thumbnail`, `description`, `price`) VALUES
(2, 2, 'AI', 'praktikum-pbo 5.png', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus, aspernatur. Laborum similique obcaecati ex reiciendis illo velit iure! Quas vitae, perspiciatis voluptatem, eius nisi dolor iure deserunt iste illo a commodi quam. Maxime, iste reprehenderit. Iusto vero corporis quasi eius architecto ut ipsam illo autem perspiciatis laboriosam quibusdam iste omnis mollitia, sed fugit cupiditate. Non ea, nulla officia doloremque ipsum iusto sunt ducimus mollitia distinctio! Necessitatibus consequatur, laborum iste placeat nulla deserunt consequuntur incidunt deleniti iusto facere veritatis accusamus ratione. Totam nisi perspiciatis culpa repellendus eius dolores error, reiciendis facilis voluptas alias provident aliquid natus ullam nulla necessitatibus sapiente quasi consequatur optio. Iure sapiente amet corporis explicabo, distinctio, quod recusandae saepe itaque atque perferendis, omnis ipsa praesentium aperiam fugit aspernatur.', 2000000.00),
(4, 2, 'Machine Learning', 'praktikum-pbo 7.png', 'lorem', 2000000.00),
(5, 4, 'React', 'praktikum-pbo 4.png', 'lorem', 750000.00),
(6, 1, 'Vue', 'praktikum-pbo 6.png', 'lorem', 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `course_materials`
--

CREATE TABLE `course_materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `material_title` varchar(100) NOT NULL,
  `material_description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_materials`
--

INSERT INTO `course_materials` (`id`, `course_id`, `material_title`, `material_description`, `user_id`) VALUES
(1, 2, 'RAG', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto ipsa obcaecati quae ab eum accusantium ullam soluta omnis, eaque deserunt cupiditate exercitationem distinctio! Non assumenda sed cum aspernatur ut architecto asperiores nobis dolorem! Omnis, qui in atque ipsa nihil consequuntur quas nostrum veritatis assumenda autem illo odit, dicta maiores doloribus. Dignissimos omnis, mollitia magni veniam ducimus ullam possimus labore neque. Incidunt quam deserunt, laboriosam dolore provident voluptatem quibusdam ab quia. Illum, nam tenetur reprehenderit dolorum ut ipsum perferendis et doloribus, vero labore magnam officiis aliquid nisi explicabo. Earum et nemo neque quisquam tempora quis eveniet quia deleniti delectus ex. Nulla nihil officia quam! Dignissimos ad enim est dolores fugit eaque, rerum corrupti nobis porro ipsam recusandae rem sint odit magni.', 1),
(2, 5, 'ShadCN UI', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto ipsa obcaecati quae ab eum accusantium ullam soluta omnis, eaque deserunt cupiditate exercitationem distinctio! Non assumenda sed cum aspernatur ut architecto asperiores nobis dolorem! Omnis, qui in atque ipsa nihil consequuntur quas nostrum veritatis assumenda autem illo odit, dicta maiores doloribus. Dignissimos omnis, mollitia magni veniam ducimus ullam possimus labore neque. Incidunt quam deserunt, laboriosam dolore provident voluptatem quibusdam ab quia. Illum, nam tenetur reprehenderit dolorum ut ipsum perferendis et doloribus, vero labore magnam officiis aliquid nisi explicabo. Earum et nemo neque quisquam tempora quis eveniet quia deleniti delectus ex. Nulla nihil officia quam! Dignissimos ad enim est dolores fugit eaque, rerum corrupti nobis porro ipsam recusandae rem sint odit magni.', 16),
(3, 5, 'Pendahuluan', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto ipsa obcaecati quae ab eum accusantium ullam soluta omnis, eaque deserunt cupiditate exercitationem distinctio! Non assumenda sed cum aspernatur ut architecto asperiores nobis dolorem! Omnis, qui in atque ipsa nihil consequuntur quas nostrum veritatis assumenda autem illo odit, dicta maiores doloribus. Dignissimos omnis, mollitia magni veniam ducimus ullam possimus labore neque. Incidunt quam deserunt, laboriosam dolore provident voluptatem quibusdam ab quia. Illum, nam tenetur reprehenderit dolorum ut ipsum perferendis et doloribus, vero labore magnam officiis aliquid nisi explicabo. Earum et nemo neque quisquam tempora quis eveniet quia deleniti delectus ex. Nulla nihil officia quam! Dignissimos ad enim est dolores fugit eaque, rerum corrupti nobis porro ipsam recusandae rem sint odit magni.', 16);

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL,
  `review_date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`id`, `course_id`, `rating`, `review_text`, `review_date`, `user_id`) VALUES
(3, 2, 5, 'bagus', '2024-06-06', 15);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_link` varchar(255) NOT NULL,
  `org_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_name`, `event_description`, `event_date`, `event_link`, `org_id`) VALUES
(2, 16, 'AI Integration Web', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab provident sapiente, architecto illo eveniet, assumenda neque totam quisquam eum vel sunt iusto, excepturi ratione? Unde maiores accusantium, aliquam quas quam illum quibusdam ipsum molestiae quos saepe libero! Eligendi assumenda voluptatum suscipit. Alias ullam perspiciatis mollitia est sapiente autem, molestiae beatae non hic cum totam illo consectetur nostrum, repellat similique delectus quam praesentium nobis aliquam neque? Atque sunt rem voluptatum tenetur recusandae iste quae corporis? Atque, possimus distinctio magni aspernatur similique, numquam corrupti excepturi vero minima alias odio corporis. Eaque esse in vero deleniti nulla natus quas neque ex explicabo assumenda sint enim soluta quod, necessitatibus laboriosam veniam, distinctio ducimus atque facilis? Dignissimos nulla repellat provident saepe consectetur accusamus iusto perspiciatis!', '2024-06-05', 'https://youtube.com/ibm/', 3),
(5, 16, 'MLOPS Integration Web', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab provident sapiente, architecto illo eveniet, assumenda neque totam quisquam eum vel sunt iusto, excepturi ratione? Unde maiores accusantium, aliquam quas quam illum quibusdam ipsum molestiae quos saepe libero! Eligendi assumenda voluptatum suscipit. Alias ullam perspiciatis mollitia est sapiente autem, molestiae beatae non hic cum totam illo consectetur nostrum, repellat similique delectus quam praesentium nobis aliquam neque? Atque sunt rem voluptatum tenetur recusandae iste quae corporis? Atque, possimus distinctio magni aspernatur similique, numquam corrupti excepturi vero minima alias odio corporis. Eaque esse in vero deleniti nulla natus quas neque ex explicabo assumenda sint enim soluta quod, necessitatibus laboriosam veniam, distinctio ducimus atque facilis? Dignissimos nulla repellat provident saepe consectetur accusamus iusto perspiciatis!', '2024-06-05', 'https://youtube.com/microsoft/', 4);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` decimal(5,2) NOT NULL,
  `grade_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `instructor_name`, `email`, `phone_number`, `user_id`) VALUES
(5, 'Padika Prasaja', 'padikapras@gmail.com', '+621982763122', 16);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `like_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `description`, `link`) VALUES
(3, 'IBM', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae neque corporis sint voluptatem, nesciunt reprehenderit sit maiores ratione ex? Iste, provident numquam ea error, voluptates quas vitae nemo veritatis consequuntur dolorem accusantium natus repellat obcaecati blanditiis sunt delectus recusandae. Labore, eos. Repellat, et soluta. Voluptas libero eum possimus distinctio neque? Repellendus excepturi ex dicta quis pariatur quas explicabo at praesentium cumque quaerat beatae earum vel aut in id sunt ullam similique consectetur eligendi, quo deleniti placeat architecto, eaque quam. Adipisci quaerat incidunt expedita vel ab deleniti impedit blanditiis animi necessitatibus dicta dolor ad totam obcaecati laboriosam odio ipsam, amet pariatur porro minima tenetur quod quos sint ducimus! Soluta, assumenda. Vel magni accusantium tempore soluta iure, veritatis libero obcaecati eius ex?', 'https://ibm.com'),
(4, 'Microsoft', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab provident sapiente, architecto illo eveniet, assumenda neque totam quisquam eum vel sunt iusto, excepturi ratione? Unde maiores accusantium, aliquam quas quam illum quibusdam ipsum molestiae quos saepe libero! Eligendi assumenda voluptatum suscipit. Alias ullam perspiciatis mollitia est sapiente autem, molestiae beatae non hic cum totam illo consectetur nostrum, repellat similique delectus quam praesentium nobis aliquam neque? Atque sunt rem voluptatum tenetur recusandae iste quae corporis? Atque, possimus distinctio magni aspernatur similique, numquam corrupti excepturi vero minima alias odio corporis. Eaque esse in vero deleniti nulla natus quas neque ex explicabo assumenda sint enim soluta quod, necessitatibus laboriosam veniam, distinctio ducimus atque facilis? Dignissimos nulla repellat provident saepe consectetur accusamus iusto perspiciatis!', 'https://microsoft.com'),
(5, 'Open AI', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab provident sapiente, architecto illo eveniet, assumenda neque totam quisquam eum vel sunt iusto, excepturi ratione? Unde maiores accusantium, aliquam quas quam illum quibusdam ipsum molestiae quos saepe libero! Eligendi assumenda voluptatum suscipit. Alias ullam perspiciatis mollitia est sapiente autem, molestiae beatae non hic cum totam illo consectetur nostrum, repellat similique delectus quam praesentium nobis aliquam neque? Atque sunt rem voluptatum tenetur recusandae iste quae corporis? Atque, possimus distinctio magni aspernatur similique, numquam corrupti excepturi vero minima alias odio corporis. Eaque esse in vero deleniti nulla natus quas neque ex explicabo assumenda sint enim soluta quod, necessitatibus laboriosam veniam, distinctio ducimus atque facilis? Dignissimos nulla repellat provident saepe consectetur accusamus iusto perspiciatis!', 'https://open-ai.com');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `email`, `phone_number`, `user_id`) VALUES
(8, 'Muhammad Rizki Malik Aziz', 'rimali22@gmail.com', '+628777123123', 15);

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `id` int(11) NOT NULL,
  `course_assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submission_status` enum('submitted','graded') DEFAULT 'submitted',
  `grade_id` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `file_submission` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permission`) VALUES
(1, 'admin', '$2y$10$cmvaC8pYJhrPbyG8WCoEWu3YrfwOL4SYiETwX1f.vhFy3HKj2tbTe', '1'),
(15, 'asd', '$2y$10$wRiGJ3eqwnGb1I9HiSdvXePDFTUveEyTM1kJYkwIp6/WVwKb2FU8K', '3'),
(16, 'zxc', '$2y$10$Ig22CQfZspfdoEJHLR9qsu3gQiWx4h1NP2KTi6eJBhihEaJrRFlRi', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `fk_user_course_material_id` (`user_id`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `fk_user_review_id` (`user_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_org_id` (`org_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_instructors_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `course_assignment_id` (`course_assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_assignments`
--
ALTER TABLE `student_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD CONSTRAINT `course_materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_course_material_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_review_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_org_id` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `fk_user_instructors_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD CONSTRAINT `student_assignments_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_assignments_ibfk_2` FOREIGN KEY (`course_assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_assignments_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
