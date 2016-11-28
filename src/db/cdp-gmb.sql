-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 28 Novembre 2016 à 20:39
-- Version du serveur :  5.5.53-0+deb8u1
-- Version de PHP :  5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `membreprojet`
--

DROP TABLE IF EXISTS `membreprojet`;
CREATE TABLE IF NOT EXISTS `membreprojet` (
`id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idDeveloppeur` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
`id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `dateFin` date NOT NULL,
  `urlGitDev` text CHARACTER SET utf8 NOT NULL,
  `urlGitDemo` text CHARACTER SET utf8 NOT NULL,
  `estPublic` tinyint(1) NOT NULL,
  `idProprietaire` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sprint`
--

DROP TABLE IF EXISTS `sprint`;
CREATE TABLE IF NOT EXISTS `sprint` (
`id` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
`id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `etat` set('enCours','nonFait','test','fait') NOT NULL,
  `idUserStory` int(11) DEFAULT NULL,
  `idDeveloppeur` int(11) NOT NULL,
  `idSprint` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
`id` int(11) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idProjet` int(11) NOT NULL,
  `idUS` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userstory`
--

DROP TABLE IF EXISTS `userstory`;
CREATE TABLE IF NOT EXISTS `userstory` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `chiffrage` int(11) NOT NULL,
  `priorite` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  `numCommit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
`id` int(11) NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `motDePasse` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idDeveloppeur` (`idDeveloppeur`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
 ADD PRIMARY KEY (`id`), ADD KEY `proprietaire` (`idProprietaire`);

--
-- Index pour la table `sprint`
--
ALTER TABLE `sprint`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
 ADD PRIMARY KEY (`id`), ADD KEY `idUserStory` (`idUserStory`), ADD KEY `idDeveloppeur` (`idDeveloppeur`), ADD KEY `idSprint` (`idSprint`);

--
-- Index pour la table `tests`
--
ALTER TABLE `tests`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idUS` (`idUS`);

--
-- Index pour la table `userstory`
--
ALTER TABLE `userstory`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idSprint` (`idSprint`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `sprint`
--
ALTER TABLE `sprint`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `tests`
--
ALTER TABLE `tests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `userstory`
--
ALTER TABLE `userstory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
ADD CONSTRAINT `membreprojet_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
ADD CONSTRAINT `membreprojet_ibfk_2` FOREIGN KEY (`idDeveloppeur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`idProprietaire`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `sprint`
--
ALTER TABLE `sprint`
ADD CONSTRAINT `sprint_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`idDeveloppeur`) REFERENCES `utilisateur` (`id`),
ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`idUserStory`) REFERENCES `userstory` (`id`),
ADD CONSTRAINT `tache_ibfk_3` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`);

--
-- Contraintes pour la table `tests`
--
ALTER TABLE `tests`
ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`idUS`) REFERENCES `userstory` (`id`),
ADD CONSTRAINT `fk_tests_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `userstory`
--
ALTER TABLE `userstory`
ADD CONSTRAINT `userstory_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
ADD CONSTRAINT `userstory_ibfk_2` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
