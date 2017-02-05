CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `students` (
  `fnumber` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `degree` tinyint(1) NOT NULL DEFAULT 0,
  `program_id` int(11),
  `join_date`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fnumber`),
  UNIQUE(firstName, middleName, lastName),
  FOREIGN KEY (program_id) REFERENCES programs(id) 
	ON DELETE SET NULL 
	ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `title` varchar(255),
  `join_date`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(firstName, lastName),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `teacher_id` int(11),
  `credits` int(11) NOT NULL,
  `hour` TIME NOT NULL,
  `auditorium` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL DEFAULT '???',
  `program_id` int(11),
  PRIMARY KEY (`id`),
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) 
	ON DELETE SET NULL 
	ON UPDATE CASCADE,
  FOREIGN KEY (program_id) REFERENCES programs(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `participate` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `completed` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  `mark` FLOAT(3,2) default 0,
  FOREIGN KEY (student_id) REFERENCES students(fnumber) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_created`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11),
  `teacher_id` int(11),
  `date`  TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;