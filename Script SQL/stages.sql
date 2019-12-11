-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : stpolsis45.mysql.db
-- Généré le :  mer. 11 déc. 2019 à 13:32
-- Version du serveur :  5.6.42-log
-- Version de PHP :  7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stpolsis45`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `idclasse` int(11) NOT NULL,
  `libelle_classe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`idclasse`, `libelle_classe`) VALUES
(1, 'SIO1'),
(2, 'SIO2'),
(3, 'ADMIN'),
(4, 'ANCIEN');

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

CREATE TABLE `concerner` (
  `SIRET` varchar(50) NOT NULL,
  `iddemande` int(11) NOT NULL,
  `idcontact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idcontact` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `SIRET` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`idcontact`, `nom`, `prenom`, `tel`, `mail`, `role`, `service`, `SIRET`) VALUES
(8, 'Mallet', 'Emmanuel', '02 38 78 99 52', 'Emmanuel.MALLET@cnfpt.fr ', 'DSI', 'Informatique', '18001404502245'),
(9, 'JLAIEL', 'Nabil', '0616331265', 'contact@totaleaccessibilite.fr', 'Dirigeant', 'Direction', '82033907500013'),
(10, 'BERTHOU', 'Mégane', '0494615527', 'mberthou@varhabitat.com', 'DRH', 'RH', '47990473200019'),
(11, 'PINTO', 'Philippe', '0623642906', 'cides.sarl@gmail.com', 'Gérant', 'Gérant', '79907443000023'),
(12, 'Ribeiro', 'Carlos', '0238398725', 'sarlribeiro@hotmail.fr', 'Chef Entreprise', 'Peinture et Décoration', '42164873400026'),
(13, 'ROUSSEAU', 'Rose', '0613644297', 'rose.rousseau@sfr.fr', 'Membre', 'Responsable', '83896928500017'),
(14, 'Negrini', 'Sébastien', '0238417979', 'sebastien.negrini@socamaine.fr', 'Responsable du service informatique', 'Informatique', '325 184 596 00014'),
(15, 'Marechal', 'Vanessa', '+33 (0)2 38 46 59 26', 'vanessa.marechal@allcircuits.com', 'Gestionnaire Formation', 'RH', '44177234000028'),
(16, 'Inconnu', '.', '.', '.', '.', '.', '18001404502245'),
(17, 'Diaz', 'Marion', '01 76 47 09 50', 'mdiaz@umanis.com', 'Responsable Ressources Humaines', 'RH', '40325953400028'),
(18, 'Alves', 'Lydie', '02 38 45 07 55', 'lydie.alves@gfi.fr', 'Responsable Ressources Humaines', 'RH', '38536571300457'),
(19, 'Jouin', 'Olivier', '0238427961             ', 'olivier.jouin@recia.fr', 'Directeur', 'Direction', '18450311800020'),
(20, 'Potier', 'Lydie', '0000000000', 'lydie@movida-mail.com', 'Secrétaire', 'Service', '39886810900040'),
(21, 'PAILLOU', 'Jean-François ', 'inconnue', 'jean-francois.paillou@mail.nidec.com', 'Responsable du Bureau d\\\'Etudes Electronique', 'Bureau d\\\'Etudes Electronique', '33856725800011'),
(22, 'Chave', 'Kevin', '0238747082', 'kevin.chave@caudalie.com', 'Administrateur réseaux', 'Informatique', '39836012300051'),
(23, 'Caillon-Jimenez', 'Cécilia', '0238604233', 'cecilia.CAILLON-JIMENEZ@mail.nidec.com', 'RH', 'RH', '33856725800011');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `SIRET` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `code_NAF` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `cpville` varchar(50) NOT NULL,
  `nb_demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`SIRET`, `nom`, `code_NAF`, `tel`, `Mail`, `cpville`, `nb_demande`) VALUES
('18001404502245', 'CNFPT (CENTRE NATIONAL DE LA FONCTION PUBLIQUE TER', '73', '0238789494', 'Emmanuel.MALLET@cnfpt.fr ', '45234', 3),
('18450311800020', 'GIP Recia', '74', '02 38 42 79 60', 'contact@recia.fr', '45232', 1),
('325 184 596 00014', 'OLIVET DISTRIBUTION', '43', '0238417979', 'drh.olivet@socamaine.fr', '45232', 1),
('33856725800011', 'Leroy Somer', '26', 'inconnue', 'jean-francois.paillou@mail.nidec.com', '45284', 2),
('38536571300457', 'Gfi Informatique', '55', '01 44 04 50 00', 'cedric.menindes@gfi.fr', '45234', 1),
('39836012300051', 'Caudalie', '19', '0238747082', 'kevin.chave@caudalie.com', '45154', 1),
('39886810900040', 'Movida Production', '52', '0238772266', 'contact@movida-prod.com', '45234', 1),
('40325953400028', 'Umanis', '55', '01 76 47 09 50', 'info@umanis.com', '45234', 1),
('42164873400026', 'SARL RIBEIRO', '72', '02 38 39 87 25', 'sarlribeiro@hotmail.fr', '45095', 1),
('44177234000028', 'MSL CIRCUITS', '25', '02 38 46 35 00', 'contact.commercial@mslcircuits.com', '45203', 1),
('47990473200019', 'VAR HABITAT', '68', '0494615500', 'drh@varhabitat.com', '83144', 1),
('549 501 203 00083', 'DEGREANE', '01', '04 98 16 31 63', 'inconnue', '83049', 1),
('79907443000023', 'CIDES', '32', '0623642906', 'cides.sarl@gmail.com', '31216', 1),
('80752653800010', 'CODI ONE', '53', '08 90 10 93 74 ', 'direction@codi-one.fr', '45234', 1),
('82033907500013', 'Totale Accessibilité', '40', '0616331265', 'contact@totaleaccessibilite.fr', '45290', 1),
('83896928500017', 'M.A.M MA PETITE ENFANCE', '84', '06 13 64 42 97', 'mapetiteenfance@aol.fr', '45146', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `idetat` int(11) NOT NULL,
  `libelle_etat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`idetat`, `libelle_etat`) VALUES
(4, 'Validé'),
(5, 'En cours'),
(6, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `idetudiant` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `idclasse` int(11) NOT NULL,
  `idpromotion` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `type` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`idetudiant`, `nom`, `prenom`, `idclasse`, `idpromotion`, `email`, `photo`, `mdp`, `type`) VALUES
(1, 'Admin', 'ADMIN', 3, 1, 'ADMIN', 'admin.png', 'Admin45', 0),
(9, 'ANICET', 'Jordan', 2, 3, 'jordan.anicet14@gmail.com', '', 'LRL62F', 1),
(10, 'BEAUDONNEL', 'Killian', 2, 3, 'killian.beaudonnel@gmail.com', '', 'TCREAJ', 1),
(11, 'BEZARD', 'Baptiste', 2, 3, 'bapt.bezard@gmail.com', '', 'GLGM5Z', 1),
(12, 'BLIN', 'R&eacute;mi', 2, 3, 'remiblin@hotmail.fr', '', 'V3ZEUM', 1),
(13, 'BOUCHER', 'Cl&eacute;ment', 2, 3, 'clementboucher41@gmail.com', '', 'M4DX32', 1),
(14, 'COLLE', 'Stephen', 2, 3, 'stephen.colle@outlook.fr', '', '7S8HT2', 1),
(15, 'DANIEL', 'Alban', 1, 3, 'alban.daniel98@gmail.com', '', '4TZM8C', 1),
(16, 'DAVE', 'Valentin', 2, 3, 'valentin0602@outlook.fr', '', 'ZEE4TR', 1),
(17, 'DECHIPRE', 'Killian', 1, 3, 'dekyllian@hotmail.fr', '', 'JLS8FZ', 1),
(18, 'DIALLO', 'Alpha', 2, 3, 'm.diallo155@laposte.net', '', 'KAV5UT', 1),
(19, 'EL GHAIB', 'Mohamed', 1, 3, 'mohamed.elghaib@gmail.com', '', '2M62S4', 1),
(20, 'EL GHOULBZOURI', 'Siham', 2, 3, 'siham450@hotmail.fr', '', 'MX9ZWT', 1),
(21, 'FARGEON', 'C&eacute;lestin', 2, 3, 'celesram@hotmail.fr', '', '1901', 1),
(22, 'GOSSET', 'K&eacute;vin', 2, 3, 'kevin.gosset25@gmail.com', '', 'QJ6LF4', 1),
(23, 'GOURVES', 'Ewann', 1, 3, 'gourves.ewann.pro@laposte.net', '', '79R84K', 1),
(24, 'GREGOIRE', 'Quentin', 2, 3, 'quentingregoire@ag-lec.fr', '', '171000', 1),
(25, 'INGELAERE', 'Maxime', 2, 3, 'max.ingelaere@orange.fr', '', '5QLDCH', 1),
(26, 'JLAIEL', 'Ouc&eacute;ma', 2, 3, '450oucema@gmail.com', '', 'W9XLQ9', 1),
(27, 'KOC', 'Sybel', 1, 3, 'annaise45@live.fr', '', '589ZLV', 1),
(28, 'LACHATRE', 'Valentin', 2, 3, 'valentin.lachatre@gmail.com', '', 'E2ARBK', 1),
(29, 'LAURENT', 'Joachim', 2, 3, 'joachim.laurent36@gmail.com', '', 'KFTCXU', 1),
(30, 'MASSON', 'Thomas', 2, 3, 'mxfaya45470@yahoo.fr', '', 'LL62KT', 1),
(31, 'MORLIERAS', 'Guillaume', 2, 3, 'g.morlieras@gmail.com', '', 'TKGU2G', 1),
(32, 'MYRON', 'L&eacute;a', 2, 3, 'lea.myron.lm@gmail.com', '', 'LME6YX', 1),
(33, 'PARIS', 'Ma&euml;l', 2, 3, 'mael.35@sfr.fr', '', 'FCAJY4', 1),
(34, 'RICHARD', 'Arthur', 2, 3, 'arthur.richard8@orange.fr', '', 'QPHHQ2', 1),
(35, 'ROUSSEAU', 'Tom', 2, 3, 'tomgrousseau@gmail.com', '', 'SF4DLM', 1),
(36, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(37, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(53, 'ZAP', 'ZAP', 2, 3, 'c:/Windows/system.ini', '', 'ZAP', 1),
(54, 'ZAP', 'ZAP', 2, 3, '../../../../../../../../../../../../../../../../Wi', '', 'ZAP', 1),
(55, 'ZAP', 'ZAP', 2, 3, 'c:\\\\Windows\\\\system.ini', '', 'ZAP', 1),
(56, 'ZAP', 'ZAP', 2, 3, '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', '', 'ZAP', 1),
(57, 'ZAP', 'ZAP', 2, 3, '/etc/passwd', '', 'ZAP', 1),
(58, 'ZAP', 'ZAP', 2, 3, '../../../../../../../../../../../../../../../../et', '', 'ZAP', 1),
(59, 'ZAP', 'ZAP', 2, 3, 'c:/', '', 'ZAP', 1),
(60, 'ZAP', 'ZAP', 2, 3, '/', '', 'ZAP', 1),
(61, 'ZAP', 'ZAP', 2, 3, 'c:\\\\', '', 'ZAP', 1),
(62, 'ZAP', 'ZAP', 2, 3, '../../../../../../../../../../../../../../../../', '', 'ZAP', 1),
(63, 'ZAP', 'ZAP', 2, 3, 'WEB-INF/web.xml', '', 'ZAP', 1),
(64, 'ZAP', 'ZAP', 2, 3, 'WEB-INF\\\\web.xml', '', 'ZAP', 1),
(65, 'ZAP', 'ZAP', 2, 3, '/WEB-INF/web.xml', '', 'ZAP', 1),
(66, 'ZAP', 'ZAP', 2, 3, '\\\\WEB-INF\\\\web.xml', '', 'ZAP', 1),
(67, 'ZAP', 'ZAP', 2, 3, 'thishouldnotexistandhopefullyitwillnot', '', 'ZAP', 1),
(68, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:/Windows/system.ini', 1),
(69, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '../../../../../../../../../../../../../../../../Wi', 1),
(70, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:\\\\Windows\\\\system.ini', 1),
(71, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', 1),
(72, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '/etc/passwd', 1),
(73, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '../../../../../../../../../../../../../../../../et', 1),
(74, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:/', 1),
(75, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '/', 1),
(76, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:\\\\', 1),
(77, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '../../../../../../../../../../../../../../../../', 1),
(78, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'WEB-INF/web.xml', 1),
(79, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'WEB-INF\\\\web.xml', 1),
(80, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '/WEB-INF/web.xml', 1),
(81, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '\\\\WEB-INF\\\\web.xml', 1),
(82, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'thishouldnotexistandhopefullyitwillnot', 1),
(83, 'c:/Windows/system.ini', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(84, '../../../../../../../../../../../../../../../../Wi', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(85, 'c:\\\\Windows\\\\system.ini', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(86, '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(87, '/etc/passwd', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(88, '../../../../../../../../../../../../../../../../et', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(89, 'c:/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(90, '/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(91, 'c:\\\\', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(92, '../../../../../../../../../../../../../../../../', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(93, 'WEB-INF/web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(94, 'WEB-INF\\\\web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(95, '/WEB-INF/web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(96, '\\\\WEB-INF\\\\web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(97, 'thishouldnotexistandhopefullyitwillnot', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(98, 'ZAP', 'c:/Windows/system.ini', 2, 3, 'ZAP', '', 'ZAP', 1),
(99, 'ZAP', '../../../../../../../../../../../../../../../../Wi', 2, 3, 'ZAP', '', 'ZAP', 1),
(100, 'ZAP', 'c:\\\\Windows\\\\system.ini', 2, 3, 'ZAP', '', 'ZAP', 1),
(101, 'ZAP', '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', 2, 3, 'ZAP', '', 'ZAP', 1),
(102, 'ZAP', '/etc/passwd', 2, 3, 'ZAP', '', 'ZAP', 1),
(103, 'ZAP', '../../../../../../../../../../../../../../../../et', 2, 3, 'ZAP', '', 'ZAP', 1),
(104, 'ZAP', 'c:/', 2, 3, 'ZAP', '', 'ZAP', 1),
(105, 'ZAP', '/', 2, 3, 'ZAP', '', 'ZAP', 1),
(106, 'ZAP', 'c:\\\\', 2, 3, 'ZAP', '', 'ZAP', 1),
(107, 'ZAP', '../../../../../../../../../../../../../../../../', 2, 3, 'ZAP', '', 'ZAP', 1),
(108, 'ZAP', 'WEB-INF/web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(109, 'ZAP', 'WEB-INF\\\\web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(110, 'ZAP', '/WEB-INF/web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(111, 'ZAP', '\\\\WEB-INF\\\\web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(112, 'ZAP', 'thishouldnotexistandhopefullyitwillnot', 2, 3, 'ZAP', '', 'ZAP', 1),
(128, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(129, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(130, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(131, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(132, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(133, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(134, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(135, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(136, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(137, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(138, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(139, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(140, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(141, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(142, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(143, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(144, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(160, 'ZAP', 'ZAP', 2, 3, 'c:/Windows/system.ini', '', 'ZAP', 1),
(161, 'ZAP', 'ZAP', 2, 3, '../../../../../../../../../../../../../../../../Wi', '', 'ZAP', 1),
(162, 'ZAP', 'ZAP', 2, 3, 'c:\\\\Windows\\\\system.ini', '', 'ZAP', 1),
(163, 'ZAP', 'ZAP', 2, 3, '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', '', 'ZAP', 1),
(164, 'ZAP', 'ZAP', 2, 3, '/etc/passwd', '', 'ZAP', 1),
(165, 'ZAP', 'ZAP', 2, 3, '../../../../../../../../../../../../../../../../et', '', 'ZAP', 1),
(166, 'ZAP', 'ZAP', 2, 3, 'c:/', '', 'ZAP', 1),
(167, 'ZAP', 'ZAP', 2, 3, '/', '', 'ZAP', 1),
(168, 'ZAP', 'ZAP', 2, 3, 'c:\\\\', '', 'ZAP', 1),
(169, 'ZAP', 'ZAP', 2, 3, '../../../../../../../../../../../../../../../../', '', 'ZAP', 1),
(170, 'ZAP', 'ZAP', 2, 3, 'WEB-INF/web.xml', '', 'ZAP', 1),
(171, 'ZAP', 'ZAP', 2, 3, 'WEB-INF\\\\web.xml', '', 'ZAP', 1),
(172, 'ZAP', 'ZAP', 2, 3, '/WEB-INF/web.xml', '', 'ZAP', 1),
(173, 'ZAP', 'ZAP', 2, 3, '\\\\WEB-INF\\\\web.xml', '', 'ZAP', 1),
(174, 'ZAP', 'ZAP', 2, 3, 'thishouldnotexistandhopefullyitwillnot', '', 'ZAP', 1),
(175, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:/Windows/system.ini', 1),
(176, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '../../../../../../../../../../../../../../../../Wi', 1),
(177, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:\\\\Windows\\\\system.ini', 1),
(178, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', 1),
(179, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '/etc/passwd', 1),
(180, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '../../../../../../../../../../../../../../../../et', 1),
(181, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:/', 1),
(182, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '/', 1),
(183, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'c:\\\\', 1),
(184, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '../../../../../../../../../../../../../../../../', 1),
(185, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'WEB-INF/web.xml', 1),
(186, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'WEB-INF\\\\web.xml', 1),
(187, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '/WEB-INF/web.xml', 1),
(188, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', '\\\\WEB-INF\\\\web.xml', 1),
(189, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'thishouldnotexistandhopefullyitwillnot', 1),
(190, 'c:/Windows/system.ini', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(191, '../../../../../../../../../../../../../../../../Wi', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(192, 'c:\\\\Windows\\\\system.ini', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(193, '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(194, '/etc/passwd', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(195, '../../../../../../../../../../../../../../../../et', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(196, 'c:/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(197, '/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(198, 'c:\\\\', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(199, '../../../../../../../../../../../../../../../../', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(200, 'WEB-INF/web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(201, 'WEB-INF\\\\web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(202, '/WEB-INF/web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(203, '\\\\WEB-INF\\\\web.xml', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(204, 'thishouldnotexistandhopefullyitwillnot', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(205, 'ZAP', 'c:/Windows/system.ini', 2, 3, 'ZAP', '', 'ZAP', 1),
(206, 'ZAP', '../../../../../../../../../../../../../../../../Wi', 2, 3, 'ZAP', '', 'ZAP', 1),
(207, 'ZAP', 'c:\\\\Windows\\\\system.ini', 2, 3, 'ZAP', '', 'ZAP', 1),
(208, 'ZAP', '..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..', 2, 3, 'ZAP', '', 'ZAP', 1),
(209, 'ZAP', '/etc/passwd', 2, 3, 'ZAP', '', 'ZAP', 1),
(210, 'ZAP', '../../../../../../../../../../../../../../../../et', 2, 3, 'ZAP', '', 'ZAP', 1),
(211, 'ZAP', 'c:/', 2, 3, 'ZAP', '', 'ZAP', 1),
(212, 'ZAP', '/', 2, 3, 'ZAP', '', 'ZAP', 1),
(213, 'ZAP', 'c:\\\\', 2, 3, 'ZAP', '', 'ZAP', 1),
(214, 'ZAP', '../../../../../../../../../../../../../../../../', 2, 3, 'ZAP', '', 'ZAP', 1),
(215, 'ZAP', 'WEB-INF/web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(216, 'ZAP', 'WEB-INF\\\\web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(217, 'ZAP', '/WEB-INF/web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(218, 'ZAP', '\\\\WEB-INF\\\\web.xml', 2, 3, 'ZAP', '', 'ZAP', 1),
(219, 'ZAP', 'thishouldnotexistandhopefullyitwillnot', 2, 3, 'ZAP', '', 'ZAP', 1),
(235, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(236, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(237, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(238, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(239, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(240, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(241, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(242, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(243, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(244, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(245, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(246, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(247, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(248, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(249, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(260, 'ZAP', 'ZAP', 2, 3, 'http://www.google.com/', '', 'ZAP', 1),
(261, 'ZAP', 'ZAP', 2, 3, 'http://www.google.com:80/', '', 'ZAP', 1),
(262, 'ZAP', 'ZAP', 2, 3, 'http://www.google.com', '', 'ZAP', 1),
(263, 'ZAP', 'ZAP', 2, 3, 'http://www.google.com/search?q=OWASP%20ZAP', '', 'ZAP', 1),
(264, 'ZAP', 'ZAP', 2, 3, 'http://www.google.com:80/search?q=OWASP%20ZAP', '', 'ZAP', 1),
(265, 'ZAP', 'ZAP', 2, 3, 'www.google.com/', '', 'ZAP', 1),
(266, 'ZAP', 'ZAP', 2, 3, 'www.google.com:80/', '', 'ZAP', 1),
(267, 'ZAP', 'ZAP', 2, 3, 'www.google.com', '', 'ZAP', 1),
(268, 'ZAP', 'ZAP', 2, 3, 'www.google.com/search?q=OWASP%20ZAP', '', 'ZAP', 1),
(269, 'ZAP', 'ZAP', 2, 3, 'www.google.com:80/search?q=OWASP%20ZAP', '', 'ZAP', 1),
(270, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'http://www.google.com/', 1),
(271, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'http://www.google.com:80/', 1),
(272, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'http://www.google.com', 1),
(273, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'http://www.google.com/search?q=OWASP%20ZAP', 1),
(274, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'http://www.google.com:80/search?q=OWASP%20ZAP', 1),
(275, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'www.google.com/', 1),
(276, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'www.google.com:80/', 1),
(277, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'www.google.com', 1),
(278, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'www.google.com/search?q=OWASP%20ZAP', 1),
(279, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'www.google.com:80/search?q=OWASP%20ZAP', 1),
(280, 'http://www.google.com/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(281, 'http://www.google.com:80/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(282, 'http://www.google.com', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(283, 'http://www.google.com/search?q=OWASP%20ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(284, 'http://www.google.com:80/search?q=OWASP%20ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(285, 'www.google.com/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(286, 'www.google.com:80/', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(287, 'www.google.com', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(288, 'www.google.com/search?q=OWASP%20ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(289, 'www.google.com:80/search?q=OWASP%20ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(290, 'ZAP', 'http://www.google.com/', 2, 3, 'ZAP', '', 'ZAP', 1),
(291, 'ZAP', 'http://www.google.com:80/', 2, 3, 'ZAP', '', 'ZAP', 1),
(292, 'ZAP', 'http://www.google.com', 2, 3, 'ZAP', '', 'ZAP', 1),
(293, 'ZAP', 'http://www.google.com/search?q=OWASP%20ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(294, 'ZAP', 'http://www.google.com:80/search?q=OWASP%20ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(295, 'ZAP', 'www.google.com/', 2, 3, 'ZAP', '', 'ZAP', 1),
(296, 'ZAP', 'www.google.com:80/', 2, 3, 'ZAP', '', 'ZAP', 1),
(297, 'ZAP', 'www.google.com', 2, 3, 'ZAP', '', 'ZAP', 1),
(298, 'ZAP', 'www.google.com/search?q=OWASP%20ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(299, 'ZAP', 'www.google.com:80/search?q=OWASP%20ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(310, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(311, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(312, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(313, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(314, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(315, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(316, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(317, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(318, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1),
(319, 'ZAP', 'ZAP', 2, 3, 'ZAP', '', 'ZAP', 1);

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`LOGID`, `PWD`) VALUES
('Admin', 'f9ba71802a75c6f310a2a1713355ceb0');

--
-- Déchargement des données de la table `naf`
--

INSERT INTO `naf` (`code_NAF`, `libelle_NAF`) VALUES
('01', 'Culture et production animale \r\nchasse et services annexes'),
('02', 'Sylviculture et exploitation \r\nforestière'),
('03', 'Pêche et aquaculture'),
('04', 'Extraction houille et lignite'),
('05', 'Extraction d\'hydrocarbures'),
('06', 'Extraction de minerais\r\nmétalliques'),
('07', 'Autres industries extractives'),
('08', 'Serv soutien aux ind ext'),
('09', 'Industries alimentaires'),
('10', 'Fabrication de boissons'),
('11', 'Fabrication produits à base de tabac'),
('12', 'Fabrication de textile'),
('13', 'Industrie de l\'habillement'),
('14', 'Industrie du cuir et de la chaussure'),
('15', 'Travail du bois et fab. d\'art. en \r\nbois et en liège sauf des \r\nmeubles. Fab. art.\r\nvannerie et sparterie'),
('16', 'Industrie du papier et carton'),
('17', 'Imprimerie et reproduction \r\nd\'enregistrements'),
('18', 'Cokéfaction et raffinage'),
('19', 'Industrie chimique'),
('20', 'Industrie pharmaceutique'),
('21', 'Fab. de pdts en caoutchouc et \r\nen plastique'),
('22', 'Fab. d\'autres produits minéraux \r\nnon métalliques'),
('23', 'Metallurgie'),
('24', 'Fab. de produits métalliques \r\nsauf des machines et des \r\néquipements'),
('25', 'Fab. produits informatiques \r\nélectroniques et optiques'),
('26', 'Fabrication d\'équipements \r\nélectriques'),
('27', 'Fabrication de machines et \r\néquipements n.c.a'),
('28', 'Industrie auto'),
('29', 'Fabrication d\'autres matériels \r\nde transport'),
('30', 'Fabrication de meubles'),
('31', 'Autres industries \r\nmanufacturières'),
('32', 'Réparation et installation de \r\nmachines et d\'équipements'),
('33', 'Production et distribution \r\nd\'électricité, de gaz, de vapeur \r\net d\'air conditionné'),
('34', 'Captage trait. dist. Eau '),
('35', 'Collecte trait. eaux usées'),
('36', 'Collecte traitement élimination \r\ndes déchets récupération'),
('37', 'Dépollut° gestion déchets '),
('38', 'Construction de bâtiments'),
('39', 'Génie civil'),
('40', 'Travaux de construction \r\nspécialisés'),
('41', 'Commerce réparation \r\nd\'automobiles et motocycles'),
('42', 'Commerce de gros\r\nsauf des automobiles et des \r\nmotocycles'),
('43', 'Commerce de détail\r\nsauf des automobiles et des \r\nmotocycles'),
('44', 'Transports terrestres et \r\ntransport par conduites'),
('45', 'Transports par eau'),
('46', 'Transports aériens'),
('47', 'Entreposage et services \r\nauxiliaires des transports'),
('48', 'Activité de poste et courrier'),
('49', 'Hébergement'),
('50', 'Restauration'),
('51', 'Edition'),
('52', 'Production de films vidéo \r\nprogramme télévision \r\nenregistrement sonore et \r\nédition musicale'),
('53', 'Programmation et diffusion'),
('54', 'Télécommunications'),
('55', 'Programmation conseil et \r\nautres act. informatiques'),
('56', 'Services d\'information'),
('57', 'Act. des services financiers hors \r\nassurance et caisse de retraite'),
('58', 'Assurance'),
('59', 'Activités auxiliaires de services \r\nfinanciers et d\'assurance'),
('60', 'Activités immobilières'),
('61', 'Act. juridiques comptables'),
('62', 'Act. des sièges sociaux conseil \r\nde gestion'),
('63', 'Architecture et ingénierie \r\ncontrôle et analyses\r\ntechniques'),
('64', 'Recherche développement \r\nscientifique'),
('65', 'Publicité, études de marché'),
('66', 'Autres act. spécialisées \r\nscientifiques et techniques'),
('67', 'Vétérinaires '),
('68', 'Activité de location et location-\r\nbail'),
('69', 'Activités liées à l\'emploi'),
('70', 'Agences de voyages et activités \r\nconnexes'),
('71', 'Enquêtes et sécurité'),
('72', 'Services relatifs aux bât. \r\naménagement paysager'),
('73', 'Activités administratives et \r\nautres act. de soutien aux \r\nentreprises'),
('74', 'Administration publique et \r\ndéfense\r\nSécurité sociale obligatoire'),
('75', 'Enseignement'),
('76', 'Activités pour la santé humaine'),
('77', 'Hébergement médico-social et \r\nsocial'),
('78', 'Action sociale sans \r\nhébergement'),
('79', 'Activités créatives artistiques et \r\nde spectacle'),
('80', 'Bibliothèques archives musée et \r\nautres activités culturelles'),
('81', 'Activités sportives récréatives et \r\nde loisirs'),
('82', 'Activités des organisations \r\nassociatives'),
('83', 'Réparation d\'ordinateurs et de \r\nbiens personnels et \r\ndomestiques'),
('84', 'Autres services personnels'),
('85', 'Activités des ménages'),
('86', 'Act. ind. des ménages'),
('87', 'Org. extraterritoriaux');

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`idperiode`, `annee`, `date_debut`, `date_fin`) VALUES
(1, 2020, '2020-02-10', '2020-03-27'),
(2, 2020, '2020-05-11', '2020-06-12'),
(3, 2019, '2019-05-13', '2019-06-14');

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `libelle_promotion`) VALUES
(1, 'ADMIN'),
(2, '2018'),
(3, '2019'),
(4, '2020'),
(5, '2021'),
(6, '2022');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`idclasse`);

--
-- Index pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD PRIMARY KEY (`SIRET`,`iddemande`,`idcontact`),
  ADD KEY `Concerner_Demande0_FK` (`iddemande`),
  ADD KEY `Concerner_Contact1_FK` (`idcontact`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idcontact`),
  ADD KEY `Contact_Entreprise_FK` (`SIRET`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`SIRET`),
  ADD KEY `Entreprise_Ville_FK` (`cpville`),
  ADD KEY `Entreprise_NAF_FK` (`code_NAF`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`idetat`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idetudiant`),
  ADD KEY `FK_promotion` (`idpromotion`),
  ADD KEY `FK_classe` (`idclasse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `idclasse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idcontact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `idetat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idetudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD CONSTRAINT `Concerner_Contact1_FK` FOREIGN KEY (`idcontact`) REFERENCES `contact` (`idcontact`),
  ADD CONSTRAINT `Concerner_Demande0_FK` FOREIGN KEY (`iddemande`) REFERENCES `demande` (`iddemande`),
  ADD CONSTRAINT `Concerner_Entreprise_FK` FOREIGN KEY (`SIRET`) REFERENCES `entreprise` (`SIRET`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `Contact_Entreprise_FK` FOREIGN KEY (`SIRET`) REFERENCES `entreprise` (`SIRET`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `Entreprise_NAF_FK` FOREIGN KEY (`code_NAF`) REFERENCES `naf` (`code_NAF`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`),
  ADD CONSTRAINT `FK_promotion` FOREIGN KEY (`idpromotion`) REFERENCES `promotion` (`id_promotion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
