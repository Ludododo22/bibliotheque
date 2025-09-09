-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 sep. 2025 à 11:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `lecteurs`
--

CREATE TABLE `lecteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lecteurs`
--

INSERT INTO `lecteurs` (`id`, `nom`, `prenom`, `email`) VALUES
(1, 'Invité', 'Guest', 'guest-6h6dn27gu0p1ns09mvmhabhtsc@example.com'),
(2, 'Invité', 'Guest', 'guest-s1kiqqoq61ph8aqadlb3sjp0kd@example.com');

-- --------------------------------------------------------

--
-- Structure de la table `liste_lecture`
--

CREATE TABLE `liste_lecture` (
  `id` int(11) NOT NULL,
  `id_livre` int(11) NOT NULL,
  `id_lecteur` int(11) NOT NULL,
  `date_emprunt` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liste_lecture`
--

INSERT INTO `liste_lecture` (`id`, `id_livre`, `id_lecteur`, `date_emprunt`, `date_retour`, `created_at`) VALUES
(6, 6, 2, NULL, NULL, '2025-09-07 07:44:41'),
(8, 7, 1, NULL, NULL, '2025-09-07 08:13:30'),
(9, 6, 1, NULL, NULL, '2025-09-07 08:54:28'),
(10, 1, 1, NULL, NULL, '2025-09-07 09:01:07');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `maison_edition` varchar(100) DEFAULT NULL,
  `nombre_exemplaire` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`, `description`, `image`, `maison_edition`, `nombre_exemplaire`, `created_at`) VALUES
(1, 'L\'Étranger', 'Albert Camus', 'Un roman philosophique sur l\'absurde.', 'livre_1757228343_9864.JPG', 'Gallimard', 5, '2025-09-06 18:34:45'),
(2, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'Conte poétique et philosophique.', 'livre_1757228247_1604.JPG', 'Reynal & Hitchcock', 8, '2025-09-06 18:34:45'),
(3, 'Les Misérables', 'Victor Hugo', 'Épopée sociale et humaniste.', 'livre_1757228220_2215.jpg', 'A. Lacroix', 4, '2025-09-06 18:34:45'),
(5, 'La guerre des mondes', 'H.G Wells', 'Livre historique écrit par l\'écrivain H. G. Wells.', 'livre_1757228148_1772.jpg', 'charp', 4, '2025-09-07 06:55:48'),
(6, 'Comte de Monte-Cristo', 'Alexandre Dumas', 'C\'est l\'un des romans les plus célèbres d\'Alexandre Dumas, publié sous forme de feuilleton au XIXe siècle, et dont une adaptation cinématographique est sortie en 2024 avec Pierre Niney dans le rôle-titre.', 'livre_1757228573_5589.JPG', 'Legrand', 2, '2025-09-07 07:02:53'),
(7, '1984', 'George orwell', 'Roman historique du célébre écrivain romancier George orwell', 'livre_1757228658_4387.JPG', 'Odyssé', 5, '2025-09-07 07:04:18');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `liste_lecture`
--
ALTER TABLE `liste_lecture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_lecteur_livre` (`id_livre`,`id_lecteur`),
  ADD KEY `fk_ll_lecteur` (`id_lecteur`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `liste_lecture`
--
ALTER TABLE `liste_lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `liste_lecture`
--
ALTER TABLE `liste_lecture`
  ADD CONSTRAINT `fk_ll_lecteur` FOREIGN KEY (`id_lecteur`) REFERENCES `lecteurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ll_livre` FOREIGN KEY (`id_livre`) REFERENCES `livres` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
