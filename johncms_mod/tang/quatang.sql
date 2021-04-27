-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Sam 16 Juin 2012 à 02:45
-- Version du serveur: 5.1.62
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `htrang_trang`
--

-- --------------------------------------------------------

--
-- Structure de la table `quatang`
--

CREATE TABLE IF NOT EXISTS `quatang` (
  `id` int(11) NOT NULL,
  `user_id_nhan` text CHARACTER SET utf8 NOT NULL,
  `user_id_gui` int(11) NOT NULL,
  `baihat` text CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `quatang`
--

INSERT INTO `quatang` (`id`, `user_id_nhan`, `user_id_gui`, `baihat`, `text`) VALUES
(0, 'BOT Quay Số', 1, 'Lovely Dovely', 'Nếu đây là lần đầu tiên bạn đến với diễn đàn hãy Đăng ký để sử dụng hết chức năng của diễn đàn!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
