/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : shiawa_gestion

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-01-24 15:23:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adherents
-- ----------------------------
DROP TABLE IF EXISTS `adherents`;
CREATE TABLE `adherents` (
  `A_ID` int(11) NOT NULL AUTO_INCREMENT,
  `A_NOM` varchar(250) DEFAULT NULL,
  `A_PRENOM` varchar(250) DEFAULT NULL,
  `A_DATENAISS` datetime DEFAULT NULL,
  `A_ADR1` varchar(255) DEFAULT NULL,
  `A_CP` varchar(250) DEFAULT NULL,
  `A_VILLE` varchar(255) DEFAULT NULL,
  `A_SEXE` int(11) DEFAULT NULL,
  `A_TELEPHONE` varchar(25) DEFAULT NULL,
  `A_MAIL` varchar(250) DEFAULT NULL,
  `A_DATE_FIN_EXERCICE` datetime DEFAULT NULL,
  `A_VALIDE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`A_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of adherents
-- ----------------------------
INSERT INTO `adherents` VALUES ('1', 'MOULET', 'Fabien', '1995-08-09 00:00:00', '51 chemin des vignes', '81710', 'Saïx', '0', '0659514663', 'mouletfabien@gmail.com', null, '1');

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `C_ID` int(11) NOT NULL AUTO_INCREMENT,
  `C_NOM` varchar(250) DEFAULT NULL,
  `C_PRENOM` varchar(250) DEFAULT NULL,
  `C_DATENAISS` datetime DEFAULT NULL,
  `C_ADR1` varchar(255) DEFAULT NULL,
  `C_CP` varchar(250) DEFAULT NULL,
  `C_VILLE` varchar(255) DEFAULT NULL,
  `C_SEXE` int(11) DEFAULT NULL,
  `C_TELEPHONE` varchar(25) DEFAULT NULL,
  `C_MAIL` varchar(250) DEFAULT NULL,
  `C_ISTUTOR` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`C_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES ('1', 'MOULET', 'Béatrice', '1963-05-26 00:00:00', '51 chemin des vignes', '81710', 'Saix', '1', null, null, '1');

-- ----------------------------
-- Table structure for cotisations
-- ----------------------------
DROP TABLE IF EXISTS `cotisations`;
CREATE TABLE `cotisations` (
  `CT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CT_MONTANT` float DEFAULT NULL,
  `CT_TYPEREGLEMENT` varchar(250) DEFAULT NULL,
  `CT_DATEENCAISSEMENT` datetime DEFAULT NULL,
  PRIMARY KEY (`CT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cotisations
-- ----------------------------
INSERT INTO `cotisations` VALUES ('1', '20', 'VIREMENT', '2017-12-01 15:08:37');

-- ----------------------------
-- Table structure for documents_adherents
-- ----------------------------
DROP TABLE IF EXISTS `documents_adherents`;
CREATE TABLE `documents_adherents` (
  `DA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DA_TYPEDOC` varchar(250) DEFAULT NULL,
  `DA_DOCAJOUR` tinyint(1) DEFAULT NULL,
  `R_DATERETOUR` datetime DEFAULT NULL,
  `A_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`DA_ID`),
  KEY `FK_DOCUMENTS_ADHERENTS_A_ID` (`A_ID`),
  CONSTRAINT `FK_DOCUMENTS_ADHERENTS_A_ID` FOREIGN KEY (`A_ID`) REFERENCES `adherents` (`A_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of documents_adherents
-- ----------------------------
INSERT INTO `documents_adherents` VALUES ('1', 'Fiche Renseignement', '1', '2015-11-11 00:00:00', '1');
INSERT INTO `documents_adherents` VALUES ('2', 'Fiche DAI', '1', '2015-11-11 00:00:00', '1');

-- ----------------------------
-- Table structure for evenements
-- ----------------------------
DROP TABLE IF EXISTS `evenements`;
CREATE TABLE `evenements` (
  `E_ID` int(11) NOT NULL AUTO_INCREMENT,
  `E_NOM` varchar(250) DEFAULT NULL,
  `E_LIEU` varchar(250) DEFAULT NULL,
  `E_MESSAGE` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`E_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of evenements
-- ----------------------------

-- ----------------------------
-- Table structure for inventaire
-- ----------------------------
DROP TABLE IF EXISTS `inventaire`;
CREATE TABLE `inventaire` (
  `INV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `INV_REF` varchar(250) DEFAULT NULL,
  `INV_NOM` varchar(250) DEFAULT NULL,
  `INV_QTE` int(11) DEFAULT NULL,
  `INV_COMMENTAIRE` text,
  PRIMARY KEY (`INV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inventaire
-- ----------------------------

-- ----------------------------
-- Table structure for periode_essais
-- ----------------------------
DROP TABLE IF EXISTS `periode_essais`;
CREATE TABLE `periode_essais` (
  `PE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PE_MESSAGE` varchar(600) DEFAULT NULL,
  `PE_DATE_DEBUT` datetime DEFAULT NULL,
  `PE_DATE_FIN` datetime DEFAULT NULL,
  `A_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PE_ID`),
  KEY `FK_PERIODE_ESSAIS_A_ID` (`A_ID`),
  CONSTRAINT `FK_PERIODE_ESSAIS_A_ID` FOREIGN KEY (`A_ID`) REFERENCES `adherents` (`A_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of periode_essais
-- ----------------------------
INSERT INTO `periode_essais` VALUES ('1', 'Première periode d\'essai', '2015-11-01 00:00:00', '2016-12-01 00:00:00', '1');

-- ----------------------------
-- Table structure for rel_cotiser
-- ----------------------------
DROP TABLE IF EXISTS `rel_cotiser`;
CREATE TABLE `rel_cotiser` (
  `CT_DATEPAIEMENT` datetime DEFAULT NULL,
  `CT_ID` int(11) NOT NULL,
  `A_ID` int(11) NOT NULL,
  PRIMARY KEY (`CT_ID`,`A_ID`),
  KEY `FK_REL_COTISER_A_ID` (`A_ID`),
  CONSTRAINT `FK_REL_COTISER_A_ID` FOREIGN KEY (`A_ID`) REFERENCES `adherents` (`A_ID`),
  CONSTRAINT `FK_REL_COTISER_CT_ID` FOREIGN KEY (`CT_ID`) REFERENCES `cotisations` (`CT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_cotiser
-- ----------------------------
INSERT INTO `rel_cotiser` VALUES ('2017-11-11 15:10:29', '1', '1');

-- ----------------------------
-- Table structure for rel_participer_event
-- ----------------------------
DROP TABLE IF EXISTS `rel_participer_event`;
CREATE TABLE `rel_participer_event` (
  `P_DATE` datetime DEFAULT NULL,
  `A_ID` int(11) NOT NULL,
  `E_ID` int(11) NOT NULL,
  PRIMARY KEY (`A_ID`,`E_ID`),
  KEY `FK_rel_participer_event_E_ID` (`E_ID`),
  CONSTRAINT `FK_rel_participer_event_A_ID` FOREIGN KEY (`A_ID`) REFERENCES `adherents` (`A_ID`),
  CONSTRAINT `FK_rel_participer_event_E_ID` FOREIGN KEY (`E_ID`) REFERENCES `evenements` (`E_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_participer_event
-- ----------------------------

-- ----------------------------
-- Table structure for rel_rattacher_contact
-- ----------------------------
DROP TABLE IF EXISTS `rel_rattacher_contact`;
CREATE TABLE `rel_rattacher_contact` (
  `C_ID` int(11) NOT NULL,
  `A_ID` int(11) NOT NULL,
  PRIMARY KEY (`C_ID`,`A_ID`),
  KEY `FK_rel_rattacher_contact_A_ID` (`A_ID`),
  CONSTRAINT `FK_rel_rattacher_contact_A_ID` FOREIGN KEY (`A_ID`) REFERENCES `adherents` (`A_ID`),
  CONSTRAINT `FK_rel_rattacher_contact_C_ID` FOREIGN KEY (`C_ID`) REFERENCES `contacts` (`C_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_rattacher_contact
-- ----------------------------
INSERT INTO `rel_rattacher_contact` VALUES ('1', '1');

-- ----------------------------
-- Table structure for rel_utiliser_objet
-- ----------------------------
DROP TABLE IF EXISTS `rel_utiliser_objet`;
CREATE TABLE `rel_utiliser_objet` (
  `INV_ID` int(11) NOT NULL,
  `E_ID` int(11) NOT NULL,
  PRIMARY KEY (`INV_ID`,`E_ID`),
  KEY `FK_rel_utiliser_objet_E_ID` (`E_ID`),
  CONSTRAINT `FK_rel_utiliser_objet_E_ID` FOREIGN KEY (`E_ID`) REFERENCES `evenements` (`E_ID`),
  CONSTRAINT `FK_rel_utiliser_objet_INV_ID` FOREIGN KEY (`INV_ID`) REFERENCES `inventaire` (`INV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_utiliser_objet
-- ----------------------------
