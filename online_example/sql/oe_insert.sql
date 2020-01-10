USE oe;

SET NAMES utf8;

INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2015, '计算机', 3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2014, '计算机', 3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2013, '计算机', 3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2015, '机电',	3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2014, '机电',	3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2013, '机电',	3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2015, '旅游',	3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2014, '旅游',	3);
INSERT INTO `majoys` (`yyyy`, `majoyName`, `schooling`) VALUES (2013, '旅游',	3);


insert into teachers (userName,fullName,pwd,isAdmin) values ('402429306','付承群','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429301','许来林','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429302','李海燕','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429303','徐凤英','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429304','鲁和','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429307','彭承强','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429308','王继胜','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429309','周继武','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429310','商海青','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429311','马州','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429312','屈俊芳','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429313','陆元斌','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429314','张建国','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429315','王燕','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429316','黄加文','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429317','王鹏','690914',1);
insert into teachers (userName,fullName,pwd,checked) values ('402429318','袁德','690914',1);


INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (1, 1, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (2, 1, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (3, 2, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (4, 2, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (5, 3, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (6, 3, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (7, 4, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (8, 4, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (9, 5, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (10, 5, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (11, 6, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (12, 6, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (13, 7, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (14, 7, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (15, 8, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (16, 8, 2);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (17, 9, 1);
INSERT INTO `classes` (`classID`, `majoyID`, `classNo`) VALUES (18, 9, 2);


-- 用于班级管理
-- select t1.classID,t1.majoyID,t1.bossID,t2.yyyy,t2.majoyName,t3.fullName
-- from  classes as t1,majoys as t2,teachers as t3
-- where t1.majoyID=t2.majoyID and t1.bossID=t3.userID;

insert into students (classID,userName,pwd,studentNo,fullName) values (1,111101,111101,111101,'111101');
insert into students (classID,userName,pwd,studentNo,fullName) values (1,111102,111102,111102,'111102');
insert into students (classID,userName,pwd,studentNo,fullName) values (2,111103,111103,111103,'111103');
insert into students (classID,userName,pwd,studentNo,fullName) values (2,111104,111104,111104,'111104');
insert into students (classID,userName,pwd,studentNo,fullName) values (3,111105,111105,111105,'111105');
insert into students (classID,userName,pwd,studentNo,fullName) values (3,111106,111106,111106,'111106');
insert into students (classID,userName,pwd,studentNo,fullName) values (4,111107,111107,111107,'111107');
insert into students (classID,userName,pwd,studentNo,fullName) values (4,111108,111108,111108,'111108');
insert into students (classID,userName,pwd,studentNo,fullName) values (5,111109,111109,111109,'111109');
insert into students (classID,userName,pwd,studentNo,fullName) values (5,111110,111110,111110,'111110');
insert into students (classID,userName,pwd,studentNo,fullName) values (6,111111,111111,111111,'111111');
insert into students (classID,userName,pwd,studentNo,fullName) values (6,111112,111112,111112,'111112');
insert into students (classID,userName,pwd,studentNo,fullName) values (7,111113,111113,111113,'111113');
insert into students (classID,userName,pwd,studentNo,fullName) values (7,111114,111114,111114,'111114');
insert into students (classID,userName,pwd,studentNo,fullName) values (8,111115,111115,111115,'111115');
insert into students (classID,userName,pwd,studentNo,fullName) values (8,111116,111116,111116,'111116');
insert into students (classID,userName,pwd,studentNo,fullName) values (9,111117,111117,111117,'111117');
insert into students (classID,userName,pwd,studentNo,fullName) values (9,111118,111118,111118,'111118');
insert into students (classID,userName,pwd,studentNo,fullName) values (10,111119,111119,111119,'111119');
insert into students (classID,userName,pwd,studentNo,fullName) values (10,111120,111120,111120,'111120');
insert into students (classID,userName,pwd,studentNo,fullName) values (11,111121,111121,111121,'111121');
insert into students (classID,userName,pwd,studentNo,fullName) values (11,111122,111122,111122,'111122');
insert into students (classID,userName,pwd,studentNo,fullName) values (12,111123,111123,111123,'111123');
insert into students (classID,userName,pwd,studentNo,fullName) values (12,111125,111125,111125,'111125');
insert into students (classID,userName,pwd,studentNo,fullName) values (13,111126,111126,111126,'111126');
insert into students (classID,userName,pwd,studentNo,fullName) values (13,111127,111127,111127,'111127');
insert into students (classID,userName,pwd,studentNo,fullName) values (14,111128,111128,111128,'111128');
insert into students (classID,userName,pwd,studentNo,fullName) values (14,111129,111129,111129,'111129');
insert into students (classID,userName,pwd,studentNo,fullName) values (15,111130,111130,111130,'111130');
insert into students (classID,userName,pwd,studentNo,fullName) values (15,111131,111131,111131,'111131');
insert into students (classID,userName,pwd,studentNo,fullName) values (16,111132,111132,111132,'111132');
insert into students (classID,userName,pwd,studentNo,fullName) values (16,111133,111133,111133,'111133');
insert into students (classID,userName,pwd,studentNo,fullName) values (17,111134,111134,111134,'111134');
insert into students (classID,userName,pwd,studentNo,fullName) values (17,111135,111135,111135,'111135');
insert into students (classID,userName,pwd,studentNo,fullName) values (18,111136,111136,111136,'111136');
insert into students (classID,userName,pwd,studentNo,fullName) values (18,111137,111137,111137,'111137');

insert into courses (courseName,head) values ('数学',1);
insert into courses (courseName,head) values ('外语',2);
insert into courses (courseName,head) values ('物理',3);
insert into courses (courseName,head) values ('计算机基础',4);
insert into courses (courseName,head) values ('CAD',5);
insert into courses (courseName,head) values ('CD',6);
insert into courses (courseName,head) values ('语文',7);

INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'单选', '<p>微型计算机的发展是以（）的发展为表征的<br/>A．软件<br/>B．主机<br/>C．微处理器<br/>D．控制器</p>', '0010', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'单选', '一台微机的型号中含有 486、586、PII、PIII 等文字，其含义是指（ ）<br/>A．内存储器的容量<br/>B．硬盘的容量<br/>C．显示器的规格<br/>D．CPU的档次', '0001', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'单选', '是内存储器的一部分，CPU 对其只取不存<br/>A．ROM<br/>B．RAM<br/>C．CMOS<br/>D．寄存器', '1000', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'单选', '微机存储器容量的基本单位是（&nbsp; ）<br/>A．数字<br/>B．字母<br/>C．符号<br/>D．字节', '0001', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'单选', '计算机能直接执行的程序是（ ）<br/>A．机器语言程序<br/>B．C语言程序<br/>C．汇编语言程序<br/>D．源程序', '1000', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'单选', '下列存储器中，存储容量最大的是( )<br/>A、软盘<br/>B、硬盘<br/>C、光盘<br/>D、内存', '0100', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'多选', '<p>下列存储器中，不属于高速缓存的是（）<br/>A.EPROM<br/>B.Cache<br/>C.DRAM<br/>D.CD-ROM</p>', '1011', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'多选', '用硬盘Cache的目的不是（）<br/>A.增加硬盘容量<br/>B.提高硬盘读写信息的速度<br/>C.实现动态信息存储<br/>D.实现静态信息存储', '1011', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'多选', '世界上第一台电子数字计算机不是（）年出现的<br/>A.1958&nbsp;&nbsp; B.1946&nbsp;&nbsp; C.1965&nbsp;&nbsp; D.1947', '1011', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'多选', '对于微型计算机来说,(&nbsp; ) 的工作速度基本上决定了计算机的运算速度<br/><p>A.控制器</p><p>B.运算器</p><p>C.CPU</p><p>D.存储器</p>', '0010', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'多选', '<p>CPU主要由运算器和控制器组成</p>', '10', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'判断', '1K存储空间就是1000个字节', '01', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'判断', '磁盘驱动器也是一种输入输出设备', '10', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'判断', '系统软件就是买来的软件，应用软件就是自己编写的软件', '01', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'判断', '现代计算机被称为冯．诺依曼型计算机', '10', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'判断', '我们通常所说的IP地址是指网卡的逻辑地址', '01', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'填空', '<p>存放在（）中的数据不能够被改写，断电以后数据也不会丢失</p>', '只读存储器', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'填空', '计算机在工作的时候会把程序使用率高的数据和指令放在（）里', '二级Cache', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'填空', '显示器稳定工作（基本消除闪烁）的最低刷新频率是（）', '75HZ', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'填空', '电源一般安装在立式机箱的（），把计算机电源放入时不要放反', '顶部', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'填空', '现在主板上的内存插槽一般都有2个以上，如果不能插满，则一般优先插在靠近（）的插槽中', 'CPU', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'填空', '输入设备就是负责把计算机所要处理的问题转换为计算机内部所能接受和识别的（）信息', '二进制', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'问答', '<p>存放在（）中的数据不能够被改写，断电以后数据也不会丢失</p>', '只读存储器', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'问答', '计算机在工作的时候会把程序使用率高的数据和指令放在（）里', '二级Cache', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'问答', '显示器稳定工作（基本消除闪烁）的最低刷新频率是（）', '75HZ', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'问答', '电源一般安装在立式机箱的（），把计算机电源放入时不要放反', '顶部', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'问答', '现在主板上的内存插槽一般都有2个以上，如果不能插满，则一般优先插在靠近（）的插槽中', 'CPU', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (1,'问答', '输入设备就是负责把计算机所要处理的问题转换为计算机内部所能接受和识别的（）信息', '二进制', '太简单不解释');




INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'单选', '<p>微型计算机的发展是以（）的发展为表征的<br/>A．软件<br/>B．主机<br/>C．微处理器<br/>D．控制器</p>', '0010', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'单选', '一台微机的型号中含有 486、586、PII、PIII 等文字，其含义是指（ ）<br/>A．内存储器的容量<br/>B．硬盘的容量<br/>C．显示器的规格<br/>D．CPU的档次', '0001', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'单选', '是内存储器的一部分，CPU 对其只取不存<br/>A．ROM<br/>B．RAM<br/>C．CMOS<br/>D．寄存器', '1000', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'单选', '微机存储器容量的基本单位是（&nbsp; ）<br/>A．数字<br/>B．字母<br/>C．符号<br/>D．字节', '0001', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'单选', '计算机能直接执行的程序是（ ）<br/>A．机器语言程序<br/>B．C语言程序<br/>C．汇编语言程序<br/>D．源程序', '1000', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'单选', '下列存储器中，存储容量最大的是( )<br/>A、软盘<br/>B、硬盘<br/>C、光盘<br/>D、内存', '0100', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'多选', '<p>下列存储器中，不属于高速缓存的是（）<br/>A.EPROM<br/>B.Cache<br/>C.DRAM<br/>D.CD-ROM</p>', '1011', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'多选', '用硬盘Cache的目的不是（）<br/>A.增加硬盘容量<br/>B.提高硬盘读写信息的速度<br/>C.实现动态信息存储<br/>D.实现静态信息存储', '1011', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'多选', '世界上第一台电子数字计算机不是（）年出现的<br/>A.1958&nbsp;&nbsp; B.1946&nbsp;&nbsp; C.1965&nbsp;&nbsp; D.1947', '1011', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'多选', '对于微型计算机来说,(&nbsp; ) 的工作速度基本上决定了计算机的运算速度<br/><p>A.控制器</p><p>B.运算器</p><p>C.CPU</p><p>D.存储器</p>', '0010', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'多选', '<p>CPU主要由运算器和控制器组成</p>', '10', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'判断', '1K存储空间就是1000个字节', '01', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'判断', '磁盘驱动器也是一种输入输出设备', '10', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'判断', '系统软件就是买来的软件，应用软件就是自己编写的软件', '01', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'判断', '现代计算机被称为冯．诺依曼型计算机', '10', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'判断', '我们通常所说的IP地址是指网卡的逻辑地址', '01', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'填空', '<p>存放在（）中的数据不能够被改写，断电以后数据也不会丢失</p>', '只读存储器', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'填空', '计算机在工作的时候会把程序使用率高的数据和指令放在（）里', '二级Cache', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'填空', '显示器稳定工作（基本消除闪烁）的最低刷新频率是（）', '75HZ', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'填空', '电源一般安装在立式机箱的（），把计算机电源放入时不要放反', '顶部', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'填空', '现在主板上的内存插槽一般都有2个以上，如果不能插满，则一般优先插在靠近（）的插槽中', 'CPU', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'填空', '输入设备就是负责把计算机所要处理的问题转换为计算机内部所能接受和识别的（）信息', '二进制', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'问答', '<p>存放在（）中的数据不能够被改写，断电以后数据也不会丢失</p>', '只读存储器', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'问答', '计算机在工作的时候会把程序使用率高的数据和指令放在（）里', '二级Cache', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'问答', '显示器稳定工作（基本消除闪烁）的最低刷新频率是（）', '75HZ', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'问答', '电源一般安装在立式机箱的（），把计算机电源放入时不要放反', '顶部', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'问答', '现在主板上的内存插槽一般都有2个以上，如果不能插满，则一般优先插在靠近（）的插槽中', 'CPU', '太简单不解释');
INSERT INTO `questions` (`courseID`, `qType`, `question`, `answer`, `cmt`) VALUES (7,'问答', '输入设备就是负责把计算机所要处理的问题转换为计算机内部所能接受和识别的（）信息', '二进制', '太简单不解释');
