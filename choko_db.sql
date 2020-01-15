-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 15 Janvier 2020 à 12:33
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `choko_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Jeu'),
(2, 'Divers');

-- --------------------------------------------------------

--
-- Structure de la table `t_discussion`
--

CREATE TABLE `t_discussion` (
  `idDiscussion` int(11) NOT NULL,
  `disName` varchar(150) NOT NULL,
  `fkCategory` int(11) NOT NULL,
  `disActive` tinyint(1) NOT NULL DEFAULT '1',
  `disPrioritized` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_discussion`
--

INSERT INTO `t_discussion` (`idDiscussion`, `disName`, `fkCategory`, `disActive`, `disPrioritized`) VALUES
(1, 'Minecraft', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_discussiontag`
--

CREATE TABLE `t_discussiontag` (
  `fkDiscussion` int(11) NOT NULL,
  `fkTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_discussiontag`
--

INSERT INTO `t_discussiontag` (`fkDiscussion`, `fkTag`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_gender`
--

CREATE TABLE `t_gender` (
  `idGender` int(11) NOT NULL,
  `genName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_gender`
--

INSERT INTO `t_gender` (`idGender`, `genName`) VALUES
(1, 'Homme'),
(2, 'Femme'),
(3, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `t_grade`
--

CREATE TABLE `t_grade` (
  `idGrade` int(11) NOT NULL,
  `graName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_grade`
--

INSERT INTO `t_grade` (`idGrade`, `graName`) VALUES
(1, 'Chokolaaat');

-- --------------------------------------------------------

--
-- Structure de la table `t_like`
--

CREATE TABLE `t_like` (
  `idUser` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_like`
--

INSERT INTO `t_like` (`idUser`, `idMessage`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_message`
--

CREATE TABLE `t_message` (
  `idMessage` int(11) NOT NULL,
  `mesText` text NOT NULL,
  `mesDate` datetime NOT NULL,
  `fkDiscussion` int(11) NOT NULL,
  `fkUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_message`
--

INSERT INTO `t_message` (`idMessage`, `mesText`, `mesDate`, `fkDiscussion`, `fkUser`) VALUES
(1, 'Bonjour je veux pas etre seul', '2019-11-09 09:53:30', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_right`
--

CREATE TABLE `t_right` (
  `idRight` int(11) NOT NULL,
  `rigName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_right`
--

INSERT INTO `t_right` (`idRight`, `rigName`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `t_tag`
--

CREATE TABLE `t_tag` (
  `idTag` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_tag`
--

INSERT INTO `t_tag` (`idTag`, `tagName`) VALUES
(1, 'Jeux vidéos'),
(2, 'Coopération');

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `usePseudo` varchar(50) NOT NULL,
  `useEmail` varchar(50) NOT NULL,
  `usePassword` varchar(100) NOT NULL,
  `useBirthDate` date NOT NULL,
  `useSignUpDate` date NOT NULL,
  `useBio` text NOT NULL,
  `useProfilePicture` varchar(100) NOT NULL,
  `useSignature` varchar(150) NOT NULL,
  `fkGender` int(11) NOT NULL,
  `fkGrade` int(11) NOT NULL,
  `fkRight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `usePseudo`, `useEmail`, `usePassword`, `useBirthDate`, `useSignUpDate`, `useBio`, `useProfilePicture`, `useSignature`, `fkGender`, `fkGrade`, `fkRight`) VALUES
(1, 'Bakbat', 'aviolat.baptiste@gmail.com', '$2y$10$FtXQL5v4NEC/8ajxv9EjCeXo7ZWySePX34iBgQD8zyhFvySYeN15.', '2000-09-26', '2019-11-09', 'Moi c\'est Baptiste, the sniiiiper', 'chokolaaat/resources/images/timestamp.jpg', 'Membre de la team Panda', 1, 1, 1),
(2, 'Qosox', 'matheo0204@hotmail.ch', '$2y$10$FtXQL5v4NEC/8ajxv9EjCeXo7ZWySePX34iBgQD8zyhFvySYeN15.', '2001-04-02', '2019-11-09', 'xxxxxxx', 'chokolaaat/resources/images/timestamp.jpg', 'Membre de Chokolaaat', 1, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `t_discussion`
--
ALTER TABLE `t_discussion`
  ADD PRIMARY KEY (`idDiscussion`),
  ADD KEY `t_discussion_t_category_FK` (`fkCategory`);

--
-- Index pour la table `t_discussiontag`
--
ALTER TABLE `t_discussiontag`
  ADD PRIMARY KEY (`fkDiscussion`,`fkTag`),
  ADD KEY `fkTag` (`fkTag`);

--
-- Index pour la table `t_gender`
--
ALTER TABLE `t_gender`
  ADD PRIMARY KEY (`idGender`);

--
-- Index pour la table `t_grade`
--
ALTER TABLE `t_grade`
  ADD PRIMARY KEY (`idGrade`);

--
-- Index pour la table `t_like`
--
ALTER TABLE `t_like`
  ADD PRIMARY KEY (`idUser`,`idMessage`),
  ADD KEY `t_like_t_message0_FK` (`idMessage`);

--
-- Index pour la table `t_message`
--
ALTER TABLE `t_message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `t_message_t_discussion_FK` (`fkDiscussion`),
  ADD KEY `t_message_t_user0_FK` (`fkUser`);

--
-- Index pour la table `t_right`
--
ALTER TABLE `t_right`
  ADD PRIMARY KEY (`idRight`);

--
-- Index pour la table `t_tag`
--
ALTER TABLE `t_tag`
  ADD PRIMARY KEY (`idTag`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `t_user_t_gender_FK` (`fkGender`),
  ADD KEY `t_user_t_grade0_FK` (`fkGrade`),
  ADD KEY `t_user_t_right1_FK` (`fkRight`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_discussion`
--
ALTER TABLE `t_discussion`
  MODIFY `idDiscussion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_gender`
--
ALTER TABLE `t_gender`
  MODIFY `idGender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_grade`
--
ALTER TABLE `t_grade`
  MODIFY `idGrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_message`
--
ALTER TABLE `t_message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_right`
--
ALTER TABLE `t_right`
  MODIFY `idRight` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_tag`
--
ALTER TABLE `t_tag`
  MODIFY `idTag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_discussion`
--
ALTER TABLE `t_discussion`
  ADD CONSTRAINT `t_discussion_t_category_FK` FOREIGN KEY (`fkCategory`) REFERENCES `t_category` (`idCategory`);

--
-- Contraintes pour la table `t_discussiontag`
--
ALTER TABLE `t_discussiontag`
  ADD CONSTRAINT `t_discussiontag_ibfk_1` FOREIGN KEY (`fkTag`) REFERENCES `t_tag` (`idTag`),
  ADD CONSTRAINT `t_discussiontag_ibfk_2` FOREIGN KEY (`fkDiscussion`) REFERENCES `t_discussion` (`idDiscussion`);

--
-- Contraintes pour la table `t_like`
--
ALTER TABLE `t_like`
  ADD CONSTRAINT `t_like_t_message0_FK` FOREIGN KEY (`idMessage`) REFERENCES `t_message` (`idMessage`),
  ADD CONSTRAINT `t_like_t_user_FK` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`);

--
-- Contraintes pour la table `t_message`
--
ALTER TABLE `t_message`
  ADD CONSTRAINT `t_message_t_discussion_FK` FOREIGN KEY (`fkDiscussion`) REFERENCES `t_discussion` (`idDiscussion`),
  ADD CONSTRAINT `t_message_t_user0_FK` FOREIGN KEY (`fkUser`) REFERENCES `t_user` (`idUser`);

--
-- Contraintes pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_t_gender_FK` FOREIGN KEY (`fkGender`) REFERENCES `t_gender` (`idGender`),
  ADD CONSTRAINT `t_user_t_grade0_FK` FOREIGN KEY (`fkGrade`) REFERENCES `t_grade` (`idGrade`),
  ADD CONSTRAINT `t_user_t_right1_FK` FOREIGN KEY (`fkRight`) REFERENCES `t_right` (`idRight`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
