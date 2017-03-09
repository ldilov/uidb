/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : website

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-09 21:59:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Ядро на компютърни науки');
INSERT INTO `categories` VALUES ('2', 'Практикум');
INSERT INTO `categories` VALUES ('3', 'Основи на компютърни науки');
INSERT INTO `categories` VALUES ('4', 'Математика');
INSERT INTO `categories` VALUES ('5', 'Приложна математика');

-- ----------------------------
-- Table structure for courses
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `teacher_id` int(11) DEFAULT NULL,
  `credits` int(11) NOT NULL,
  `hour` time NOT NULL,
  `auditorium` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL DEFAULT 'ФМИ',
  `program_id` int(11) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT '32',
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `program_id` (`program_id`),
  KEY `courses_ibfk_3` (`category`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('1', 'Алгебра 1', 'Изчуаване на линейна алгебра', '0', '3', '15', '10:21:00', '123', 'ФМИ', '1', 'Понеделник', '1', '32');
INSERT INTO `courses` VALUES ('2', 'Ruby', 'Изучаване основите на програмиране с Ruby и Ruby on RAILS', '1', '3', '25', '11:15:00', '101', 'ФМИ', '1', 'Сряда', '1', '32');
INSERT INTO `courses` VALUES ('3', 'Python', 'Изучаване основи на програмирането с Python', '1', '3', '23', '12:00:00', '121', 'ФМИ', '1', 'Четвъртък', '1', '32');
INSERT INTO `courses` VALUES ('4', 'Програмиране  с Java', 'Изучаване програмиране на Java и многонишково програмиране.', '1', '3', '25', '15:00:00', '121', 'ФМИ', '1', 'Петък', '3', '32');
INSERT INTO `courses` VALUES ('5', 'Изкуствен интелект', 'Изучаване основните принципи на изкуствения интелект', '0', '3', '25', '10:23:11', '122', 'ФМИ', '1', 'Сряда', '1', '32');

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('1', 'Информационни технологии');
INSERT INTO `department` VALUES ('2', 'Изчислимост');
INSERT INTO `department` VALUES ('3', 'Диференциални уравнения');
INSERT INTO `department` VALUES ('4', 'Алгебра');

-- ----------------------------
-- Table structure for exams
-- ----------------------------
DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `hour` time DEFAULT NULL,
  `room` varchar(255) NOT NULL,
  `faculty` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ФМИ',
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `exams_ibfk_4` (`program_id`),
  CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `exams_ibfk_4` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exams
-- ----------------------------
INSERT INTO `exams` VALUES ('1', '1', '3', '2017-02-03', '10:00:00', '123', 'ФМИ', '1');
INSERT INTO `exams` VALUES ('2', '2', '3', '2017-02-03', '10:00:00', '141', 'ФМИ', '1');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `teacher_registration_allowed` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `student_registration_allowed` tinyint(3) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', '1');

-- ----------------------------
-- Table structure for participate
-- ----------------------------
DROP TABLE IF EXISTS `participate`;
CREATE TABLE `participate` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `completed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mark` float(3,2) DEFAULT '0.00',
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `participate_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`fnumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `participate_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of participate
-- ----------------------------
INSERT INTO `participate` VALUES ('5', '1', '1', '3.00');
INSERT INTO `participate` VALUES ('5', '5', '0', '0.00');
INSERT INTO `participate` VALUES ('5', '4', '0', '0.00');
INSERT INTO `participate` VALUES ('5', '3', '0', '0.00');

-- ----------------------------
-- Table structure for programs
-- ----------------------------
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES ('1', 'Kомпютърни науки', 'Задълбочени познания в областта на компютърните науки : математика, програмиране, информатика');
INSERT INTO `programs` VALUES ('2', 'Информатика', 'Основни информатични познания.');

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `fnumber` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL DEFAULT '0',
  `program_id` int(11) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group` tinyint(4) NOT NULL DEFAULT '1',
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT 'Не съобщава',
  `skype` varchar(255) DEFAULT 'Не съобщава',
  `avatar` varchar(255) DEFAULT 'images/avatar.jpg',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fnumber`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `firstName` (`firstName`,`middleName`,`lastName`),
  KEY `program_id` (`program_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('5', '$2y$10$ltkBLLMrZ/0bvDxHSm0ep.9S8elldg3ycO.UJlyKMcdi2dOzefrvO', 'Лазар', 'Валентиновe', 'Дилов', 'ldilov@yahoo.com', 'Бакалавър', '1', '2017-02-03 14:00:17', '4', 'София', '124122321', 'we22334', 'qrqwr', 'images/avatars/14862092271a1c152905f71ceb6f0e85cacfb32a2d.jpg', '0');
INSERT INTO `students` VALUES ('7', '$2y$10$F2Ca7s33ajY0KDwaiAF/JeGIhXaZuuOcZ1EA69Pd43fyFv/9iw7By', 'test', 'test', 'test', 'test@abvv.bg', 'Бакалавър', '1', '2017-02-15 12:24:09', '1', 'sofis', '0886712321', '', '', 'images/avatar.jpg', '0');
INSERT INTO `students` VALUES ('8', '$2y$10$fFwNwnE7vSOgvrNRcOdGzev00pVwh2w4tAftzU26jlEEPFNMiPLuG', 'test', 'qweqw', 'test214', 'qwrqwr@abvv.bg', 'Бакалавър', '1', '2017-02-16 00:24:37', '1', 'asdasf', '0884123111', '', '', 'images/avatar.jpg', '0');
INSERT INTO `students` VALUES ('9', '$2y$10$29g/xzTWtGsjHvaoTsjwwOezs18WmoVk.42X/Mbk5qFJUD08CtLvS', 'Лазар', 'асдасд', 'Дилов', 'qweqwe@atat.bg', 'Бакалавър', '1', '2017-02-16 00:25:48', '1', 'qwrqwr', '0893112323', '', '', 'images/avatar.jpg', '0');
INSERT INTO `students` VALUES ('12', '$2y$10$N/HMkqzOA6/e5rMivH.KAuE0bxkM.MbsD/xNkm20MTkta5WGUR0J6', 'gabriel', 'vesilinov', 'vasilev', 'csco.mario@abv.bg', 'Бакалавър', '2', '2017-02-21 22:28:40', '1', 'yambol', '0897640422', '', '', 'images/avatar.jpg', '0');
INSERT INTO `students` VALUES ('13', '$2y$10$5CApNcr59u1cvemd52U6neWFXRKMPknBJZGPlR56Xgo38d7nLWk6.', 'Georgi', 'Ivanov', 'Chavdarov', 'antonchavdarov@yahoo.com', 'Бакалавър', '1', '2017-02-22 21:45:26', '1', 'Plovdiv', '0887808268', 'Frenskata', 'Chavdarov10', 'images/avatar.jpg', '0');
INSERT INTO `students` VALUES ('14', '$2y$10$HTrMH1d4ak/vNyO/b25Ftu1GkMLqF94Hbbl3VvRRxnf3/BOiJTuG2', 'iuliq', 'shabanova', 'shabanova', 'shabanova.1993@abv.bg', 'Бакалавър', '2', '2017-02-23 22:51:56', '1', 'blagoevgrad', '0896155435', 'nnsshjajjsja', 'fif11', 'images/avatar.jpg', '0');
INSERT INTO `students` VALUES ('15', '$2y$10$1nGkhGHkVuGsQsnAKbWqC.9FgORjh3pGymeLYkrBxvppIJuHT7Og6', 'teststudent', 'test', 'test', 'tsets@abv.bg', 'Бакалавър', '2', '2017-02-25 11:34:19', '1', 'Sofia', '08851231231', '', '', 'images/avatar.jpg', '0');

-- ----------------------------
-- Table structure for sysadmins
-- ----------------------------
DROP TABLE IF EXISTS `sysadmins`;
CREATE TABLE `sysadmins` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sysadmins
-- ----------------------------
INSERT INTO `sysadmins` VALUES ('1', 'admin', '$2y$10$F2Ca7s33ajY0KDwaiAF/JeGIhXaZuuOcZ1EA69Pd43fyFv/9iw7By', 'admin@abvvv.bg');

-- ----------------------------
-- Table structure for teachers
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'images/avatar.jpg',
  `description` text,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `department` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `firstName` (`firstName`,`lastName`),
  KEY `fk_1` (`department`),
  CONSTRAINT `fk_1` FOREIGN KEY (`department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES ('3', '$2y$10$ltkBLLMrZ/0bvDxHSm0ep.9S8elldg3ycO.UJlyKMcdi2dOzefrvO', 'Иван', 'Иванов', 'eastman18@yahoo.com', 'проф.', '2017-02-02 10:57:21', 'q', '08881231233', 'images/avatars/14865390575ae0c1c8a5260bc7b6648f6fbd115c35.jpg', '&lt;p&gt;3424234&lt;/p&gt;\r\n', 'https://www.facebook.com/profile.php?id=100010159622484', null, '1');
