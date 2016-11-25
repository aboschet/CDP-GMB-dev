-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 24 Novembre 2016 à 21:47
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
-- Structure de la table `userstory`
--

CREATE TABLE IF NOT EXISTS `userstory` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `chiffrage` int(11) NOT NULL,
  `priorite` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  `numCommit` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userstory`
--

INSERT INTO `userstory` (`id`, `nom`, `description`, `etat`, `chiffrage`, `priorite`, `idProjet`, `idSprint`, `numCommit`) VALUES
(1, 'US 1', 'test', 0, 3, 4, 2, NULL, 0),
(3, 'US 2', 'Test 2', 0, 3, 4, 2, NULL, 0),
(4, 'us 1', ' En temps que ... je souhaite ... afin de ...', 1, 3, 5, 1, 5, 0),
(5, 'us 2', ' En temps que ... je souhaite ... afin de ...', 0, 4, 3, 1, NULL, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `userstory`
--
ALTER TABLE `userstory`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idSprint` (`idSprint`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `userstory`
--
ALTER TABLE `userstory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `userstory`
--
ALTER TABLE `userstory`
ADD CONSTRAINT `userstory_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
ADD CONSTRAINT `userstory_ibfk_2` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
