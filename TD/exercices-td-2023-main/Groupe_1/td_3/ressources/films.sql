

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `films`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` int(5) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `annee_sortie` int(11) DEFAULT NULL,
  `realisateur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `genre`, `annee_sortie`, `realisateur`) VALUES
(1, 'Le Seigneur des Anneaux: La Communauté de l\'Anneau', 'Fantasy', 2001, 'Peter Jackson'),
(2, 'Forrest Gump', 'Drame', 1994, 'Robert Zemeckis'),
(3, 'Inception', 'Science-fiction', 2010, 'Christopher Nolan'),
(4, 'Pulp Fiction', 'Crime', 1994, 'Quentin Tarantino'),
(5, 'Gladiator', 'Action', 2000, 'Ridley Scott'),
(6, 'Le Parrain', 'Crime', 1972, 'Francis Ford Coppola'),
(7, 'Matrix', 'Science-fiction', 1999, 'Lana Wachowski'),
(8, 'La La Land', 'Musical', 2016, 'Damien Chazelle'),
(9, 'Jurassic Park', 'Science-fiction', 1993, 'Steven Spielberg'),
(10, 'Blade Runner', 'Science-fiction', 1982, 'Ridley Scott'),
(11, 'Le Roi Lion', 'Animation', 1994, 'Roger Allers'),
(12, 'Star Wars: Épisode IV - Un nouvel espoir', 'Science-fiction', 1977, 'George Lucas'),
(13, 'Avatar', 'Science-fiction', 2009, 'James Cameron'),
(14, 'Les Dents de la Mer', 'Thriller', 1975, 'Steven Spielberg'),
(15, 'Le Silence des Agneaux', 'Crime', 1991, 'Jonathan Demme'),
(16, 'Titanic', 'Drame', 1997, 'James Cameron'),
(17, 'Les Évadés', 'Drame', 1994, 'Frank Darabont'),
(18, 'E.T. l\'extra-terrestre', 'Science-fiction', 1982, 'Steven Spielberg'),
(19, 'Les Affranchis', 'Crime', 1990, 'Martin Scorsese'),
(20, 'Le Cinquième Élément', 'Science-fiction', 1997, 'Luc Besson'),
(21, 'Les Indestructibles', 'Animation', 2004, 'Brad Bird'),
(22, 'Rocky', 'Drame', 1976, 'John G. Avildsen'),
(23, 'Les Infiltrés', 'Crime', 2006, 'Martin Scorsese'),
(24, 'Les Oiseaux', 'Horreur', 1963, 'Alfred Hitchcock'),
(25, 'Retour vers le futur', 'Science-fiction', 1985, 'Robert Zemeckis'),
(26, 'La La Land', 'Musical', 2016, 'Damien Chazelle');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
