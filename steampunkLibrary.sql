-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 17 mai 2021 à 08:45
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `steampunkLibrary`
--

-- --------------------------------------------------------

--
-- Structure de la table `booksCatalogue`
--

CREATE TABLE `booksCatalogue` (
  `id` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `booksCatalogue`
--

INSERT INTO `booksCatalogue` (`id`, `isbn`) VALUES
(1, '9782354083182'),
(2, '9782354083229'),
(3, '9782354083250'),
(4, '9782371021365'),
(5, '9782371021358'),
(6, '9782371021341'),
(7, '9782820509635'),
(8, '9782820519689'),
(9, '9782366293579'),
(10, '9782820524669');

-- --------------------------------------------------------

--
-- Structure de la table `forumSubjects`
--

CREATE TABLE `forumSubjects` (
  `id` int(11) NOT NULL,
  `loginSubscriber` varchar(255) NOT NULL,
  `subject` text CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forumSubjects`
--

INSERT INTO `forumSubjects` (`id`, `loginSubscriber`, `subject`, `title`, `content`, `date`) VALUES
(1, 'Philippe', 'bibliotheque', 'Les voix d\'Anubis', '<p>Excellent livre. Une aventure qui va crescendo.</p>', '2021-04-12'),
(3, 'Quidam', 'bazar', 'Nouveau sujet de bazar', '<p>Test de bazar</p>', '2021-04-13'),
(4, 'Quidam', 'bazar', 'Un autre essai', '<p>Test de redirection</p>', '2021-04-13'),
(5, 'Quidam', 'bazar', 'Oups', '<p>Petit bins</p>', '2021-04-13');

-- --------------------------------------------------------

--
-- Structure de la table `likeDislike`
--

CREATE TABLE `likeDislike` (
  `id` int(11) NOT NULL,
  `subscriberId` int(11) NOT NULL,
  `opinionId` int(11) NOT NULL,
  `agree` int(11) NOT NULL,
  `disagree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likeDislike`
--

INSERT INTO `likeDislike` (`id`, `subscriberId`, `opinionId`, `agree`, `disagree`) VALUES
(39, 2, 1, 2, 0),
(51, 3, 3, 0, 3),
(66, 5, 1, 5, 0),
(73, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `opinions`
--

CREATE TABLE `opinions` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `forumId` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `dateOfComment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `opinions`
--

INSERT INTO `opinions` (`id`, `login`, `forumId`, `comment`, `dateOfComment`) VALUES
(1, 'Explorateur', 1, '<p>Enti&egrave;rement d\'accord. Ce livre nous transporte dans l\'espace et dans le temps.</p>', '2021-04-12'),
(2, 'Truc', 1, '<p>Je n\'ai pas aim&eacute; ce livre. Il est lent &agrave; d&eacute;marrer. Il faut attendre le milieu de livre pour enfin avoir de l\'action.</p>', '2021-04-12'),
(3, 'Machin', 1, '<p>Je suis d\'accord sur le fait que le livre est lent &agrave; d&eacute;marrer, cependant je pense que c\'est un bon livre. A conseiller.</p>', '2021-04-12'),
(4, 'Quidam', 1, '<p>Ajout de commentaires pour tester la pagination</p>', '2021-04-13'),
(5, 'Quidam', 1, '<p>Un autre test avec modification de l\'url</p>', '2021-04-13'),
(6, 'Quidam', 1, '<p>Url ok, enfin je pense. Maintenant test pour pagination</p>', '2021-04-13'),
(7, 'Philippe', 5, '<p>Test pour deleteOpinion sans la page</p>', '2021-04-15');

-- --------------------------------------------------------

--
-- Structure de la table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `record` date NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `subscribers`
--

INSERT INTO `subscribers` (`id`, `login`, `password`, `email`, `record`, `role`) VALUES
(1, 'Philippe', '$2y$10$A/KkT4WjS80kjgQnE/bNUeYl346yTZyTg85aHMIZv1gfXXGoqF/mW', 'philippe@mail.fr', '2021-04-08', 'admin'),
(2, 'Explorateur', '$2y$10$z7om5qPMZQikHPOyrYsdk.j334rSKQB7CEchRvN7smeNTrQzlxAm.', 'explorateur@mail.com', '2021-04-10', 'moderator'),
(3, 'Nemo', '$2y$10$SnEtJjNaFh8Rnk48yt8m9OG/V955zuD6LlcXmQFSp.dLU8EqEMGF2', 'nemo@mail.com', '2021-04-19', 'moderator');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `booksCatalogue`
--
ALTER TABLE `booksCatalogue`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forumSubjects`
--
ALTER TABLE `forumSubjects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likeDislike`
--
ALTER TABLE `likeDislike`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `opinions`
--
ALTER TABLE `opinions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `booksCatalogue`
--
ALTER TABLE `booksCatalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `forumSubjects`
--
ALTER TABLE `forumSubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `likeDislike`
--
ALTER TABLE `likeDislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `opinions`
--
ALTER TABLE `opinions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
