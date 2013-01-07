-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Dezember 2012 um 13:56
-- Server Version: 5.1.66
-- PHP-Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: 'swa2'
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle 'shoppingcart'
--

CREATE TABLE shoppingcart (
  orderid int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  quantity tinyint(4) NOT NULL,
  price float NOT NULL,
  PRIMARY KEY (orderid,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
