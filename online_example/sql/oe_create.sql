DROP DATABASE IF EXISTS oe;
CREATE DATABASE IF NOT EXISTS oe CHARACTER SET utf8 COLLATE utf8_general_ci;
USE oe;

CREATE TABLE IF NOT EXISTS majoys(
	majoyID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	yyyy INT NOT NULL,
	majoyName VARCHAR(50) NOT NULL,
	schooling TINYINT NOT NULL DEFAULT 3,
	UNIQUE KEY (yyyy,majoyName),
	PRIMARY KEY (majoyID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS teachers(
	userID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	userName VARCHAR(50) NOT NULL UNIQUE,
	pwd VARCHAR(50) NOT NULL,
	fullName VARCHAR(50) NOT NULL UNIQUE,
	checked TINYINT NOT NULL DEFAULT 0,
	isAdmin TINYINT NOT NULL DEFAULT 0,
	PRIMARY KEY (userID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS classes(
	classID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	majoyID INT UNSIGNED NOT NULL,
	classNo TINYINT NOT NULL,
	UNIQUE KEY (majoyID,classNo),
	PRIMARY KEY (classID),
	FOREIGN KEY (majoyID) REFERENCES majoys (majoyID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS students(
	userID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	classID INT UNSIGNED NOT NULL,
	userName VARCHAR(50) NOT NULL UNIQUE,
	pwd VARCHAR(50) NOT NULL,
	studentNo VARCHAR(20) UNIQUE,
	fullName VARCHAR(50) NOT NULL,
	checked TINYINT NOT NULL DEFAULT 0,
	PRIMARY KEY (userID),
	FOREIGN KEY (classID) REFERENCES classes (classID)	
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;

CREATE TABLE IF NOT EXISTS online_users(
	userName VARCHAR(50) NOT NULL UNIQUE
)
;

CREATE TABLE IF NOT EXISTS courses(
	courseID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	courseName VARCHAR(50) NOT NULL UNIQUE,
	head INT UNSIGNED NOT NULL,
	PRIMARY KEY (courseID),
	FOREIGN KEY (head) REFERENCES teachers (userID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS questions(
	qID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	courseID INT UNSIGNED NOT NULL,
	qType VARCHAR(50) NOT NULL, -- 单选题 多选题 判断题 客观题
	question VARCHAR(3000),
	answer VARCHAR(1000) NOT NULL,
	cmt VARCHAR(1000),
	PRIMARY KEY (qID),
	FOREIGN KEY (courseID) REFERENCES courses (courseID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS courseSettings(
	courseSettingID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	majoyID INT UNSIGNED NOT NULL,
	term TINYINT NOT NULL,
	courseID INT UNSIGNED NOT NULL,
	UNIQUE KEY (majoyID,term,courseID),
	PRIMARY KEY (courseSettingID),
	FOREIGN KEY (majoyID) REFERENCES majoys (majoyID),
	FOREIGN KEY (courseID) REFERENCES courses(courseID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS exams(
	examID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	courseSettingID INT UNSIGNED NOT NULL,
	examType VARCHAR(10) NOT NULL,
	fullScore TINYINT NOT NULL DEFAULT 100,
	examState VARCHAR(10) NOT NULL DEFAULT '待组卷', -- 待组卷 已组卷 考试中 待阅卷 已阅卷
	testbuilder INT UNSIGNED NOT NULL,-- 制卷人
	timeOfEnd VARCHAR(50),
	howLong INT UNSIGNED NOT NULL,
	UNIQUE KEY (courseSettingID,examType),
	PRIMARY KEY (examID),
	FOREIGN KEY (courseSettingID) REFERENCES courseSettings (courseSettingID),
	FOREIGN KEY (testbuilder) REFERENCES teachers(userID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS paper(
	examID INT UNSIGNED NOT NULL,
	qID INT UNSIGNED NOT NULL,
	fenshu TINYINT NOT NULL,
	PRIMARY KEY (examID,qID),
	FOREIGN KEY (examID) REFERENCES exams (examID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;
CREATE TABLE IF NOT EXISTS answerSheet(
	userID INT UNSIGNED NOT NULL,
	examID INT UNSIGNED NOT NULL,
	qID INT UNSIGNED NOT NULL,
	answer1 VARCHAR(1000),
	fenshu1 TINYINT NOT NULL DEFAULT 0,
	checked TINYINT NOT NULL DEFAULT 0,
	PRIMARY KEY (userID,examID,qID),
	FOREIGN KEY (userID) REFERENCES students (userID)
)	ENGINE=innodb CHARACTER SET=utf8 COLLATE=utf8_general_ci
;

CREATE OR
REPLACE VIEW oe.v_classes AS
SELECT t1.classID,t1.classNo,t1.majoyID,t2.yyyy,t2.majoyName
FROM classes AS t1,majoys AS t2
WHERE t1.majoyID=t2.majoyID
ORDER BY t2.yyyy DESC,t1.classNo;

CREATE OR
REPLACE VIEW oe.v_students AS
SELECT t1.userID,t2.classID,t3.majoyID,t3.yyyy,t3.majoyName,t2.classNo,t1.fullName,t1.userName,t1.pwd,t1.checked
FROM students AS t1,classes AS t2,majoys AS t3
WHERE t1.classID=t2.classID AND t2.majoyID=t3.majoyID
ORDER BY t3.yyyy DESC, CONVERT(t3.majoyName USING gbk) COLLATE gbk_chinese_ci ASC;

CREATE OR
REPLACE VIEW oe.v_courses AS
SELECT t1.courseID,t1.courseName,t2.fullName
FROM courses AS t1,teachers AS t2
WHERE t1.head=t2.userID
ORDER BY CONVERT(t1.courseName USING gbk) COLLATE gbk_chinese_ci ASC;

CREATE OR
REPLACE VIEW oe.v_questions AS
SELECT t1.qID,t1.courseID,t1.qType,t1.question,t1.answer,t1.cmt,t2.courseName
FROM questions AS t1,courses AS t2
WHERE t1.courseID=t2.courseID;

CREATE OR
REPLACE VIEW oe.v_courseSettings AS
SELECT t1.courseSettingID,t2.yyyy,t2.majoyName,t1.term,t3.courseName,t1.majoyID,t1.courseID
FROM coursesettings AS t1,majoys AS t2,courses AS t3
WHERE t1.majoyID=t2.majoyID AND t1.courseID=t3.courseID
ORDER BY t2.yyyy, CONVERT(t2.majoyName USING gbk) COLLATE gbk_chinese_ci ASC, CONVERT(t3.courseName USING gbk) COLLATE gbk_chinese_ci ASC;

CREATE OR
REPLACE VIEW oe.v_exams AS
SELECT t1.examID,t2.majoyID,t2.yyyy,t2.majoyName,t3.term,t4.courseID,t4.courseName,t1.examType,t1.fullScore,t1.timeOfEnd,t1.howLong,t1.examState,t1.testbuilder,t5.fullName,t1.courseSettingID
FROM exams AS t1,majoys AS t2,coursesettings AS t3,courses AS t4,teachers AS t5
WHERE t1.courseSettingID=t3.courseSettingID AND t2.majoyID=t3.majoyID AND t3.courseID=t4.courseID AND t1.testbuilder=t5.userID
ORDER BY t2.yyyy DESC, CONVERT(t2.majoyName USING gbk) COLLATE gbk_chinese_ci ASC, CONVERT(t4.courseName USING gbk) COLLATE gbk_chinese_ci ASC;


CREATE OR
REPLACE VIEW oe.v_paper AS
SELECT t1.examID,t1.qID,t2.qType,t2.question,t2.answer,t1.fenshu
FROM	paper AS t1,questions AS t2
WHERE t1.qID=t2.qID
ORDER BY t2.qType;

CREATE OR
REPLACE VIEW oe.v_answersheet AS
SELECT t1.userID,t1.examID,t1.qID,t1.answer1,t1.fenshu1,t3.question,t3.qType,t3.answer,t2.fenshu,t1.checked
FROM	answersheet AS t1,paper AS t2,questions AS t3
WHERE t1.examID=t2.examID AND t1.qID=t2.qID AND t2.qID=t3.qID;

CREATE OR
REPLACE VIEW oe.v_scores AS
SELECT t1.userID,t1.examID, SUM(t1.fenshu1) as score,t2.fullName,t3.classNo
FROM	answersheet AS t1,students AS t2,classes AS t3
WHERE t1.userID=t2.userID AND t2.classID=t3.classID
GROUP BY t1.userID,t1.examID;
