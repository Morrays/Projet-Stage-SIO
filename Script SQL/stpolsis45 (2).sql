-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 18 déc. 2019 à 13:10
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

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
-- Structure de la table `sta_classe`
--

CREATE TABLE `sta_classe` (
  `idclasse` int(11) NOT NULL,
  `libelle_classe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sta_option` (
  `idoption` int(11) NOT NULL,
  `libelle_option` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sta_classe`
--

INSERT INTO `sta_classe` (`idclasse`, `libelle_classe`) VALUES
(1, 'SIO1'),
(2, 'SIO2'),
(3, 'ADMIN'),
(4, 'ANCIEN');

INSERT INTO `sta_option` (`idoption`, `libelle_option`) VALUES
(1, 'SISR'),
(2, 'SLAM');

-- --------------------------------------------------------

--
-- Structure de la table `sta_concerner`
--

CREATE TABLE `sta_concerner` (
  `SIRET` varchar(50) NOT NULL,
  `iddemande` int(11) NOT NULL,
  `idcontact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sta_contact`
--

CREATE TABLE `sta_contact` (
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
-- Déchargement des données de la table `sta_contact`
--

INSERT INTO `sta_contact` (`idcontact`, `nom`, `prenom`, `tel`, `mail`, `role`, `service`, `SIRET`) VALUES
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
-- Structure de la table `sta_demande`
--

CREATE TABLE `sta_demande` (
  `iddemande` int(11) NOT NULL,
  `date_demande` date NOT NULL,
  `refus` varchar(50) DEFAULT NULL,
  `idetudiant` int(11) NOT NULL,
  `idetat` int(11) NOT NULL,
  `SIRET` varchar(50) NOT NULL,
  `idcontact` int(11) NOT NULL,
  `idperiode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sta_demande`
--

INSERT INTO `sta_demande` (`iddemande`, `date_demande`, `refus`, `idetudiant`, `idetat`, `SIRET`, `idcontact`, `idperiode`) VALUES
(12, '2019-09-04', '', 22, 4, '18001404502245', 8, 1),
(13, '2019-09-04', '', 12, 4, '18001404502245', 8, 3),
(14, '2019-04-30', '', 26, 4, '82033907500013', 9, 3),
(15, '2019-03-11', '', 10, 4, '47990473200019', 10, 1),
(16, '2019-04-05', '', 31, 4, '79907443000023', 11, 3),
(17, '2019-04-19', '', 9, 4, '42164873400026', 12, 3),
(18, '2019-04-01', '', 28, 4, '83896928500017', 13, 3),
(19, '2020-03-24', '', 35, 4, '325 184 596 00014', 14, 3),
(20, '2019-10-13', '', 35, 4, '44177234000028', 15, 1),
(21, '2019-10-18', '', 12, 5, '18001404502245', 8, 1),
(22, '2019-10-18', '', 22, 4, '18001404502245', 8, 1),
(23, '2019-10-18', 'Sans reponse apres mutiple rappelle', 9, 6, '80752653800010', 16, 1),
(24, '2019-10-06', '', 31, 6, '40325953400028', 17, 1),
(25, '2019-10-06', '', 31, 5, '38536571300457', 18, 1),
(26, '2019-10-18', '', 10, 5, '549 501 203 00083', 16, 1),
(27, '2019-09-29', '', 31, 5, '18450311800020', 19, 1),
(28, '2019-09-23', '', 26, 4, '39886810900040', 20, 1),
(29, '2019-10-17', '', 10, 5, '33856725800011', 21, 1),
(30, '2019-10-06', '', 31, 5, '39836012300051', 22, 1),
(31, '2019-11-11', '', 31, 5, '33856725800011', 23, 1);

--
-- Déclencheurs `sta_demande`
--
DELIMITER $$
CREATE TRIGGER `MAJ_nb_demande` AFTER INSERT ON `sta_demande` FOR EACH ROW update entreprise
SET nb_demande = nb_demande+1
WHERE SIRET = new.SIRET
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `MAJ_nb_demande-1` AFTER DELETE ON `sta_demande` FOR EACH ROW update entreprise
SET nb_demande = nb_demande-1
WHERE SIRET = old.SIRET
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `sta_entreprise`
--

CREATE TABLE `sta_entreprise` (
  `SIRET` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `code_NAF` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `cpville` varchar(50) NOT NULL,
  `nb_demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sta_entreprise`
--

INSERT INTO `sta_entreprise` (`SIRET`, `nom`, `code_NAF`, `tel`, `Mail`, `cpville`, `nb_demande`) VALUES
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
-- Structure de la table `sta_etat`
--

CREATE TABLE `sta_etat` (
  `idetat` int(11) NOT NULL,
  `libelle_etat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sta_etat`
--

INSERT INTO `sta_etat` (`idetat`, `libelle_etat`) VALUES
(4, 'Validé'),
(5, 'En cours'),
(6, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `sta_etudiant`
--

CREATE TABLE `sta_etudiant` (
  `idetudiant` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `idclasse` int(11) NOT NULL,
  `idpromotion` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `type` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sta_etudiant`
--

INSERT INTO `sta_etudiant` (`idetudiant`, `nom`, `prenom`, `idclasse`, `idpromotion`, `email`, `photo`, `mdp`, `type`) VALUES
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
(35, 'ROUSSEAU', 'Tom', 2, 3, 'tomgrousseau@gmail.com', '', 'SF4DLM', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sta_naf`
--

CREATE TABLE `sta_naf` (
  `code_NAF` int(11) DEFAULT NULL,
  `libelle_NAF` char(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sta_naf`
--

INSERT INTO `sta_naf` (`code_NAF`, `libelle_NAF`) VALUES
(1, 'Culture et production animale \r\nchasse et services'),
(2, 'Sylviculture et exploitation \r\nforestière'),
(3, 'Pêche et aquaculture'),
(4, 'Extraction houille et lignite'),
(5, 'Extraction d\'hydrocarbures'),
(6, 'Extraction de minerais\r\nmétalliques'),
(7, 'Autres industries extractives'),
(8, 'Serv soutien aux ind ext'),
(9, 'Industries alimentaires'),
(10, 'Fabrication de boissons'),
(11, 'Fabrication produits à base de tabac'),
(12, 'Fabrication de textile'),
(13, 'Industrie de l\'habillement'),
(14, 'Industrie du cuir et de la chaussure'),
(15, 'Travail du bois et fab. d\'art. en \r\nbois et en liè'),
(16, 'Industrie du papier et carton'),
(17, 'Imprimerie et reproduction \r\nd\'enregistrements'),
(18, 'Cokéfaction et raffinage'),
(19, 'Industrie chimique'),
(20, 'Industrie pharmaceutique'),
(21, 'Fab. de pdts en caoutchouc et \r\nen plastique'),
(22, 'Fab. d\'autres produits minéraux \r\nnon métalliques'),
(23, 'Metallurgie'),
(24, 'Fab. de produits métalliques \r\nsauf des machines e'),
(25, 'Fab. produits informatiques \r\nélectroniques et opt'),
(26, 'Fabrication d\'équipements \r\nélectriques'),
(27, 'Fabrication de machines et \r\néquipements n.c.a'),
(28, 'Industrie auto'),
(29, 'Fabrication d\'autres matériels \r\nde transport'),
(30, 'Fabrication de meubles'),
(31, 'Autres industries \r\nmanufacturières'),
(32, 'Réparation et installation de \r\nmachines et d\'équi'),
(33, 'Production et distribution \r\nd\'électricité, de gaz'),
(34, 'Captage trait. dist. Eau'),
(35, 'Collecte trait. eaux usées'),
(36, 'Collecte traitement élimination \r\ndes déchets récu'),
(37, 'Dépollut° gestion déchets'),
(38, 'Construction de bâtiments'),
(39, 'Génie civil'),
(40, 'Travaux de construction \r\nspécialisés'),
(41, 'Commerce réparation \r\nd\'automobiles et motocycles'),
(42, 'Commerce de gros\r\nsauf des automobiles et des \r\nmo'),
(43, 'Commerce de détail\r\nsauf des automobiles et des \r\n'),
(44, 'Transports terrestres et \r\ntransport par conduites'),
(45, 'Transports par eau'),
(46, 'Transports aériens'),
(47, 'Entreposage et services \r\nauxiliaires des transpor'),
(48, 'Activité de poste et courrier'),
(49, 'Hébergement'),
(50, 'Restauration'),
(51, 'Edition'),
(52, 'Production de films vidéo \r\nprogramme télévision \r'),
(53, 'Programmation et diffusion'),
(54, 'Télécommunications'),
(55, 'Programmation conseil et \r\nautres act. informatiqu'),
(56, 'Services d\'information'),
(57, 'Act. des services financiers hors \r\nassurance et c'),
(58, 'Assurance'),
(59, 'Activités auxiliaires de services \r\nfinanciers et'),
(60, 'Activités immobilières'),
(61, 'Act. juridiques comptables'),
(62, 'Act. des sièges sociaux conseil \r\nde gestion'),
(63, 'Architecture et ingénierie \r\ncontrôle et analyses\r'),
(64, 'Recherche développement \r\nscientifique'),
(65, 'Publicité, études de marché'),
(66, 'Autres act. spécialisées \r\nscientifiques et techni'),
(67, 'Vétérinaires'),
(68, 'Activité de location et location-\r\nbail'),
(69, 'Activités liées à l\'emploi'),
(70, 'Agences de voyages et activités \r\nconnexes'),
(71, 'Enquêtes et sécurité'),
(72, 'Services relatifs aux bât. \r\naménagement paysager'),
(73, 'Activités administratives et \r\nautres act. de sout'),
(74, 'Administration publique et \r\ndéfense\r\nSécurité soc'),
(75, 'Enseignement'),
(76, 'Activités pour la santé humaine'),
(77, 'Hébergement médico-social et \r\nsocial'),
(78, 'Action sociale sans \r\nhébergement'),
(79, 'Activités créatives artistiques et \r\nde spectacle'),
(80, 'Bibliothèques archives musée et \r\nautres activités'),
(81, 'Activités sportives récréatives et \r\nde loisirs'),
(82, 'Activités des organisations \r\nassociatives'),
(83, 'Réparation d\'ordinateurs et de \r\nbiens personnels'),
(84, 'Autres services personnels'),
(85, 'Activités des ménages'),
(86, 'Act. ind. des ménages'),
(87, 'Org. extraterritoriaux');

-- --------------------------------------------------------

--
-- Structure de la table `sta_periode`
--

CREATE TABLE `sta_periode` (
  `idperiode` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sta_periode`
--

INSERT INTO `sta_periode` (`idperiode`, `annee`, `date_debut`, `date_fin`) VALUES
(1, 2020, '2020-02-10', '2020-03-27'),
(2, 2020, '2020-05-11', '2020-06-12'),
(3, 2019, '2019-05-13', '2019-06-14');

-- --------------------------------------------------------

--
-- Structure de la table `sta_promotion`
--

CREATE TABLE `sta_promotion` (
  `id_promotion` int(11) DEFAULT NULL,
  `libelle_promotion` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sta_promotion`
--

INSERT INTO `sta_promotion` (`id_promotion`, `libelle_promotion`) VALUES
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
-- Index pour la table `sta_classe`
--
ALTER TABLE `sta_classe`
  ADD PRIMARY KEY (`idclasse`);

--
-- Index pour la table `sta_concerner`
--
ALTER TABLE `sta_concerner`
  ADD PRIMARY KEY (`SIRET`,`iddemande`,`idcontact`),
  ADD KEY `Concerner_Demande0_FK` (`iddemande`),
  ADD KEY `Concerner_Contact1_FK` (`idcontact`);

--
-- Index pour la table `sta_contact`
--
ALTER TABLE `sta_contact`
  ADD PRIMARY KEY (`idcontact`),
  ADD KEY `Contact_Entreprise_FK` (`SIRET`);

--
-- Index pour la table `sta_demande`
--
ALTER TABLE `sta_demande`
  ADD PRIMARY KEY (`iddemande`),
  ADD KEY `Demande_Etudiant_FK` (`idetudiant`),
  ADD KEY `Demande_Etat0_FK` (`idetat`),
  ADD KEY `Demande_Periode1_FK` (`idperiode`),
  ADD KEY `Demande_Entreprise_FK` (`SIRET`),
  ADD KEY `Demande_Contact_FK` (`idcontact`);

--
-- Index pour la table `sta_entreprise`
--
ALTER TABLE `sta_entreprise`
  ADD PRIMARY KEY (`SIRET`),
  ADD KEY `Entreprise_Ville_FK` (`cpville`),
  ADD KEY `Entreprise_NAF_FK` (`code_NAF`);

--
-- Index pour la table `sta_etat`
--
ALTER TABLE `sta_etat`
  ADD PRIMARY KEY (`idetat`);

--
-- Index pour la table `sta_etudiant`
--
ALTER TABLE `sta_etudiant`
  ADD PRIMARY KEY (`idetudiant`),
  ADD KEY `FK_promotion` (`idpromotion`),
  ADD KEY `FK_classe` (`idclasse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sta_classe`
--
ALTER TABLE `sta_classe`
  MODIFY `idclasse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sta_contact`
--
ALTER TABLE `sta_contact`
  MODIFY `idcontact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `sta_demande`
--
ALTER TABLE `sta_demande`
  MODIFY `iddemande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `sta_etat`
--
ALTER TABLE `sta_etat`
  MODIFY `idetat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sta_etudiant`
--
ALTER TABLE `sta_etudiant`
  MODIFY `idetudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
