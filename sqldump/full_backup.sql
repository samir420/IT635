-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: client
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Position to start replication or point-in-time recovery from
--

-- CHANGE MASTER TO MASTER_LOG_FILE='mysql-bin.000006', MASTER_LOG_POS=154;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(30) NOT NULL,
  `companyType` varchar(15) NOT NULL,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (2,'5PSolutions','Private'),(3,'Acxiom','Public'),(4,'Adobe Digital Government','Public'),(5,'Altova','Private'),(6,'Amazon Web Services','Public'),(7,'Analytica','Private'),(8,'Apextech LLC','Private'),(9,'Appallicious','Private'),(16,'Priyanka Inc','Saloon');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companyaddress`
--

DROP TABLE IF EXISTS `companyaddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companyaddress` (
  `addressID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `city` varchar(15) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `country` varchar(15) NOT NULL,
  PRIMARY KEY (`addressID`),
  KEY `fk_addressID` (`companyID`),
  CONSTRAINT `fk_addressID` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companyaddress`
--

LOCK TABLES `companyaddress` WRITE;
/*!40000 ALTER TABLE `companyaddress` DISABLE KEYS */;
INSERT INTO `companyaddress` VALUES (2,2,'Fairfax',22003,'VA','us'),(3,3,'Little Rock',72201,'AR','us'),(4,4,'San Jose',95510,'CA','us'),(5,5,'Beverly',1915,'MA','us'),(6,6,'Seattle',98109,'WA','us'),(7,7,'Washington DC',20005,'DC','us'),(8,8,'Arlington',22201,'VA','us'),(9,9,'San Francisco',94104,'CA','us');
/*!40000 ALTER TABLE `companyaddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companydetails`
--

DROP TABLE IF EXISTS `companydetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companydetails` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `businessType` varchar(25) DEFAULT NULL,
  `description` text,
  `url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`detailID`),
  KEY `fk_detailID` (`companyID`),
  CONSTRAINT `fk_detailID` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companydetails`
--

LOCK TABLES `companydetails` WRITE;
/*!40000 ALTER TABLE `companydetails` DISABLE KEYS */;
INSERT INTO `companydetails` VALUES (2,2,'Data','At 5PSolutions, we wish to make all basic information of different categories easily available to via tablets or phones.','www.5psolutions.com'),(3,3,'Data','Acxiom is an enterprise data, analytics and software as a service company. For more than 40 years, Acxiom has harnessed the powerful potential of data to strengthen connections between people, businesses and their partners.','http://acxiom.com'),(4,4,'Data','Adobe Digital Government is part of Adobe Systems, a global digital marketing and digital media solutions company. Adobes tools and services allow customers to create digital content, deploy it across media and devices, measure and optimize it over time. Adobe Digital Government delivers solutions that help government agencies make, manage, mobilize, and measure the information and experiences needed to achieve their missions. Adobe Digital Government provides solutions for content creation and management, more secure business workflows, easy-to-develop forms, robust analytics, or intuitive collaboration and eLearning.','http://www.adobe.com/solutions/government.html'),(5,5,'Data','At Altova, our mission is to deliver standards-based, platform-independent software development tools that empower our customers to create, access, edit and transform information resources. Altova is the creator of XMLSpyÂ® and other award-winning XML, SQL, and UML tools.','http://www.altova.com'),(6,6,'Technology','Amazon Web Services offers a broad set of global compute, storage, database, analytics, application, and deployment services that help organizations move faster, lower IT costs, and scale applications. These services are trusted by the largest enterprises and the hottest start-ups to power a wide variety of workloads including: web and mobile applications, data processing and warehousing, storage, archive, and many others.','http://aws.amazon.com'),(7,7,'Technology','Analytica is a leading-edge consulting and IT firm that provides solutions to managing, analyzing, leveraging and protecting information.  The company supports prominent US Public Sector (Federal, State, and Local agencies) and commercial organizations with innovative, value driven solutions supporting national security, law enforcement, health care, and financial services.','http://www.analytica.net/'),(8,8,'Technology','Apextech LLCs mission is to provide clients with effective tools and methods to measure their performance. As your provider of choice, Apextech addresses, analyzes, and evaluates current business processes and systems in order to effectively modify or augment our clientâ€™s capabilities. Our solutions are forward-thinking, flexible and scalable.','apextechllc.com'),(9,9,'Technology','Appallicious (http://www.appallicious.com) is an open data visualization company that creates open data products for government agencies using our proprietary platform. Current products include: Disaster Assessment and Assistance Dashboard (DAAD), Code Enforcement Dashboard (CEAD), Apartment Facts, SF Rec & Park App, Neighborhood Score. The civic start-up has also developed the SkippittTM platform, which enables governments and businesses to generate revenue by leveraging your existing customer base and extending it via mobile. Appallicious is based in San Francisco, CA and is a Silicon Valley Innovation Summit A0250 to Watch Winner.','appallicious.com');
/*!40000 ALTER TABLE `companydetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`contactID`),
  KEY `fk_contactID` (`companyID`),
  CONSTRAINT `fk_contactID` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (2,2,'Tyree',' 659-860-2084','twilbourn@5psolutions.com'),(3,3,'Carmen',' 288-884-6806','cfierros@acxiom.com'),(4,4,'Herman',' 225-205-9658','hlindner@adobe.com'),(5,5,'Tracey',' 764-128-8270','tbough@altova.com'),(6,6,'Palmer',' 483-306-5585','plamere@amazon.com'),(7,7,'Cody',' 130-981-1452','cwidman@analytica.net'),(8,8,'Santo',' 368-640-6103','sbillings@apextechllc.com'),(9,9,'Hubert',' 448-260-6180','hbraxton@appallicious.com'),(10,7,'Jack','3456763837','jack@analytica.com');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(15) NOT NULL,
  `UserType` varchar(10) NOT NULL,
  `PasswordSalt` varchar(50) NOT NULL,
  `HashedPass` char(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'user','user','ryJ@33gDx1hukilXbQuLw#OybBN4gecsBq@Rs9o0?2d%8GG6E5','f6b0c530cef068ed31576e4d2268baeae98f606542ec896a36a9ed1d517e5ea8cb5e2394172e947b4469a3c05c24c5d1234c9c7af8b818ece2c0eff31c654345'),(2,'admin','admin','Xdd*4vGWHJ7p6dwDCJ6b5O7?hRai?T@!!Q1hU$#kMSC$oLGr?D','f55624fea1ffe86e98f838a636757fe5b529ed2251f76be9ecbb1f14c3c27e98dd3fe163ecacf55fd0e397a94d89a961bb9a457e7e028890983acb13e63a8997');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `noteID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `note` text,
  PRIMARY KEY (`noteID`),
  KEY `fk_noteID` (`companyID`),
  CONSTRAINT `fk_noteID` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (1,16,'This is a nice Company.');
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `serviceID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `serviceType` varchar(50) NOT NULL,
  PRIMARY KEY (`serviceID`),
  KEY `fk_serviceID` (`companyID`),
  CONSTRAINT `fk_serviceID` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (2,2,'Workforce Augmentation and Training'),(3,3,'Identity Resolution'),(4,4,'Digital Government Solutions'),(5,5,'XML, Data Integration and Mobile App Development'),(6,6,'Clould Computing Services'),(7,7,'Government Consulting and IT solutions'),(8,8,'Resource Management Services'),(9,9,'Data Visualization');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(15) NOT NULL,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user','Jack','Smith'),(2,'admin','John','Brown');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-09  5:17:52
