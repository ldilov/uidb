/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : website

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-02-10 17:00:28
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
INSERT INTO `participate` VALUES ('5', '4', '0', null);
INSERT INTO `participate` VALUES ('5', '2', '1', '3.00');

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
  PRIMARY KEY (`fnumber`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `firstName` (`firstName`,`middleName`,`lastName`),
  KEY `program_id` (`program_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6028 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('5', '062ed1a8fe4d762eab76205037e1d8f8', 'Лазар', 'Валентинов', 'Дилов', 'ldilov@yahoo.com', 'Бакалавър', '1', '2017-02-03 14:00:17', '1', 'София', '0885215350', '', 'qrqwr', 'images/avatars/14862092271a1c152905f71ceb6f0e85cacfb32a2d.jpg');

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
  `description` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `department` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `firstName` (`firstName`,`lastName`),
  KEY `fk_1` (`department`),
  CONSTRAINT `fk_1` FOREIGN KEY (`department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3452 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES ('3', '062ed1a8fe4d762eab76205037e1d8f8', 'Иван', 'Иванов', 'eastman18@yahoo.com', 'проф.', '2017-02-02 10:57:21', 'София', '0888123123', 'images/avatars/14865390575ae0c1c8a5260bc7b6648f6fbd115c35.jpg', '<p>Някаква примерна информация. Преподавател по някакъв предмет в университета.</p>\r\n\r\n<p><strong>История:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Завършва през 1990г. ФМИ , спец. Информатика</strong></li>\r\n	<li>Прави още нещо после.</li>\r\n	<li>Става преподава', null, null, '1');
