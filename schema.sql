CREATE DATABASE `easel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `easel`;

CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_points` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `text` blob NOT NULL,
  `choices` json NOT NULL,
  `answer` char(1) NOT NULL DEFAULT 'C',
  `points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `major` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `answers` json NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`,`s_id`,`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_EXAM`(IN MY_NAME VARCHAR(255), IN MY_POINTS INT(11))
BEGIN
	START TRANSACTION;
	IF (SELECT COUNT(*) FROM `easel`.`exam` WHERE `name` = MY_NAME) <= 0 THEN
		INSERT INTO `easel`.`exam`
		(`name`,
		`created`,
		`total_points`)
		VALUES
		(MY_NAME,
		NOW(),
		MY_POINTS);
        COMMIT;
    ELSE
		ROLLBACK;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_QUESTION`(IN MY_EXAM INT(11), IN Q_NUM INT(11), IN MY_TEXT BLOB, IN MY_CHOICES JSON,
IN MY_ANSWER CHAR(1), IN MY_POINTS INT(11))
BEGIN
	START TRANSACTION;
    
    IF (SELECT COUNT(*) FROM `question` WHERE `exam_id` = MY_EXAM AND `id` = Q_NUM) > 0 THEN
		ROLLBACK;
	ELSE
		INSERT INTO `easel`.`question`
		(`id`,
		`exam_id`,
		`text`,
		`choices`,
		`answer`,
		`points`)
		VALUES
		(Q_NUM,
		MY_EXAM,
		MY_TEXT,
		MY_CHOICES,
		MY_ANSWER,
		MY_POINTS);
		COMMIT;
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_STUDENT`(IN MY_ID INT(11), IN MY_NAME VARCHAR(45), IN MY_MAJOR VARCHAR(45), IN MY_EMAIL VARCHAR(255), IN MY_PASSWORD VARCHAR(255))
BEGIN
	START TRANSACTION;
    IF (SELECT COUNT(*) FROM `student` WHERE `student`.`id` = MY_ID) = 0 THEN
		INSERT INTO `easel`.`student`
		(`id`,
		`name`,
		`major`,
		`email`,
		`password`)
		VALUES
		(MY_ID,
		MY_NAME,
		MY_MAJOR,
		MY_EMAIL,
		(SELECT SHA1(MY_PASSWORD)));
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GRADE_STUDENT`(IN MY_SID INT(11), IN MY_EID INT(11), IN MY_ANSWERS JSON, IN MY_SCORE INT(11))
BEGIN
	START TRANSACTION;
    
    IF (SELECT COUNT(*) FROM `results` WHERE `exam_id` = MY_EID AND `s_id` = MY_SID) > 0 THEN
		ROLLBACK;
	ELSE
		INSERT INTO `easel`.`results`
		(`s_id`,
		`exam_id`,
		`answers`,
		`score`)
		VALUES
		(MY_SID,
		MY_EID,
		MY_ANSWERS,
		MY_SCORE);
		COMMIT;
	END IF;
END$$
DELIMITER ;