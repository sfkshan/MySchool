CREATE TABLE `tblMenu` (
 `Menu_intId` int(11) NOT NULL AUTO_INCREMENT,
 `Menu_strName` varchar(50) NOT NULL DEFAULT '',
 `Menu_strLink` varchar(100) NOT NULL DEFAULT '#',
 `Menu_intParentId` int(11) NOT NULL DEFAULT '0',
 `Menu_intOrder` int(11) DEFAULT NULL,
 PRIMARY KEY (`Menu_intId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1