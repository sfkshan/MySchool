CREATE TABLE `tblStudentDetails` (
 `StudentD_lngId` double NOT NULL AUTO_INCREMENT,
 `StudentD_strName` varchar(200) NOT NULL,
 `StudentD_strFatherName` text NOT NULL,
 `StudentD_strAddres` text NOT NULL,
 `StudentD_strPrevSchool` text NOT NULL,
 `StudentD_strMotherName` text NOT NULL,
 PRIMARY KEY (`StudentD_lngId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1