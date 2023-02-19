-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 fév. 2023 à 17:24
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monassistantepro2`
--

-- --------------------------------------------------------

--
-- Structure de la table `category_file`
--

CREATE TABLE `category_file` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category_file`
--

INSERT INTO `category_file` (`id`, `name`, `type`) VALUES
(1, 'Entreprise', 'Entreprise'),
(2, 'Entreprise2', 'Entreprise'),
(3, 'Employé', 'Employé'),
(4, 'Employé2', 'Employé'),
(5, 'Stagiaire', 'Stagiaire'),
(6, 'Stagiaire2', 'Stagiaire');

-- --------------------------------------------------------

--
-- Structure de la table `compagny`
--

CREATE TABLE `compagny` (
  `id` int(11) NOT NULL,
  `compagny_name` varchar(255) NOT NULL,
  `leader_name` varchar(255) NOT NULL,
  `leader_first_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `additional_address` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `siret_number` varchar(255) NOT NULL,
  `comment` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compagny`
--

INSERT INTO `compagny` (`id`, `compagny_name`, `leader_name`, `leader_first_name`, `address`, `additional_address`, `zip_code`, `city`, `mail`, `phone`, `siret_number`, `comment`) VALUES
(2, 'MacDo', 'SNACK', 'Burger', 'rue des snacks', NULL, '75000', 'Paris', 'macdo@hotmail.fr', '601020304', '8010416767687', NULL),
(3, 'Quick', 'SNACK', 'Giant', 'rue des snacks', NULL, '75000', 'Paris', 'quick@hotmail.fr', '102030102', '8010416767687', NULL),
(4, 'Burger King', 'SNACK', 'Fish', 'rue des snacks', NULL, '75000', 'Paris', 'burgerking@hotmail.fr', '101020305', '8010416767687', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `compagny_file`
--

CREATE TABLE `compagny_file` (
  `id` int(11) NOT NULL,
  `compagny_id` int(11) DEFAULT NULL,
  `category_file_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compagny_file`
--

INSERT INTO `compagny_file` (`id`, `compagny_id`, `category_file_id`, `image_name`, `image_size`, `updated_at`) VALUES
(1, 2, 1, 'compagny-63ee4fc7d1cc7485229965.pdf', 6725, '2023-02-16 16:46:15'),
(2, 3, 2, 'compagny2-63ee520152fc9744228950.pdf', 6725, '2023-02-16 16:55:45'),
(3, 4, 2, 'compagny-63ee524d5e1a3223640998.pdf', 6725, '2023-02-16 16:57:01');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230215110904', '2023-02-15 12:09:16', 1368);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Pole emploi'),
(2, 'Compte personnel'),
(3, 'Compte formation');

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `made_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `user_id`, `name`, `made_by`) VALUES
(1, NULL, 'Cacher le madeBy qui ne doit devenir apparant que lorsqu\'il est complété', 'Olwen'),
(2, NULL, 'Ajouter un bouton réaliser en ajoutant dans l\'index le nom de la personne qui a cliquer dessus', NULL),
(3, NULL, 'Peut être ajouter une date limite type \'A faire avant\', mentionner quand cette tâche est en retard', NULL),
(4, NULL, 'Peut être ajouter un degré d\'urgence ou de priorité, ça peut être un booleén : A faire en priorité ou pas', NULL),
(5, NULL, 'Mettre des barres de recherche', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `is_first_login` tinyint(1) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `additional_address` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `ss_number` varchar(255) NOT NULL,
  `comment` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `status_id`, `email`, `roles`, `password`, `name`, `first_name`, `is_first_login`, `address`, `additional_address`, `zip_code`, `city`, `phone`, `date_of_birth`, `ss_number`, `comment`) VALUES
(2, NULL, 'julien@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$s5jVczy1Z6u4id/ZbnsBBeB63P9SXAj.ZDF38xYCg59k38uRl/Wtm', 'Julien', 'Julien', 1, '13 rue du fou', 'porte 12', '34000', 'Montpellier', '101010101', '2018-01-01', '123456', 'empty_data\r\ntapez : string par défaut :mixed\r\n\r\nCette option détermine la valeur renvoyée par le champ lorsque le placeholder choix est sélectionné. Dans la case à cocher et le type de radio, la valeur de empty_data est remplacée par la valeur renvoyée par le transformateur de données (voir Comment utiliser les transformateurs de données ).'),
(3, NULL, 'bouziane@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$eJ4dR44DtzeZvbYBAM92Quy.HVo4ClHn3ZmvwRLu3oyq/vknf5Z.a', 'Bouziane', 'Bouziane', NULL, '13 rue du fou', 'porte 12', '34000', 'Montpellier', '202020202', '2018-01-01', '123456', 'La façon la plus simple d\'utiliser ce champ est de définir l\' choicesoption pour spécifier les choix sous forme de tableau associatif où les clés sont les étiquettes affichées aux utilisateurs finaux et les valeurs du tableau sont les valeurs internes utilisées dans le champ de formulaire :'),
(4, NULL, 'Olwen@hotmail.fr', '[\"ROLE_ADMIN\"]', '$2y$13$QxcpIS8LsBLQYyLDqTX2kOSS2k8YLh1L3BubeNs2RIIqUqg/BDv8K', 'Olwen', 'Olwen', NULL, '13 rue du fou', 'porte 12', '34000', 'Montpellier', '303030303', '2018-01-01', '123456354654654634', 'Crée un seul bouton radio. Si le bouton radio est sélectionné, le champ sera défini sur la valeur spécifiée. Les boutons radio ne peuvent pas être décochés - la valeur ne change que lorsqu\'un autre bouton radio portant le même nom est coché.'),
(5, NULL, 'julien@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$.y48a.yMUsTTYIfHyz3s5.F7WQoFwp47/ATm9Y3hEm/l36QxpLcvy', 'Stagiaire', 'AFPA', NULL, '13 rue du fou', 'porte 12', '34000', 'Montpellier', '405060701', '2018-01-01', '78555212468768998', 'Crée un seul bouton radio. Si le bouton radio est sélectionné, le champ sera défini sur la valeur spécifiée. Les boutons radio ne peuvent pas être décochés - la valeur ne change que lorsqu\'un autre bouton radio portant le même nom est coché.'),
(6, 1, 'stagiaire2@hotmail.fr', '[]', NULL, 'Stagiaire 2', 'AFPA', NULL, '13 rue du Web', 'porte c', '11000', 'Carcassonne', '602136546', '2019-01-01', '57874167687', 'Commentaire sur ce stagiaire'),
(7, NULL, 'Pierre@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$uuvArTAN2xiYc9yN2FE.8OWshzclHdxIlUStUC0eMVeBgwNe6iVMa', 'Pierre', 'AFPA', 1, '13 rue du fou', 'porte 12', '34000', 'Montpellier', '104070205', '2018-03-01', '1234567', 'test'),
(8, 3, 'stagiaire@hotmail.fr', '[]', NULL, 'Stagiaire', 'AFPA', NULL, '13 rue du Web', 'porte c', '11000', 'Carcassonne', '102030102', '2018-04-01', '578741676871', 'Commentaire du stagiaire'),
(9, 2, 'stagiaire3@hotmail.fr', '[]', NULL, 'Stagiaire 3', 'AFPA', NULL, '13 rue du Web', 'porte c', '11000', 'Carcassonne', '201010203', '2018-01-01', '57874167687', 'stagiaire 3'),
(10, NULL, 'Employe@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$vJoi/cdGBbVkK/vCq8iryOEkbR6Sf6s2UIqSiQu7KaFhnW.owqsh.', 'Employe', 'AFPA', 1, '13 rue du fou', 'porte 12', '34000', 'Montpellier', '201030405', '2018-03-01', '123456', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `user_file`
--

CREATE TABLE `user_file` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_file_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_file`
--

INSERT INTO `user_file` (`id`, `user_id`, `category_file_id`, `image_name`, `image_size`, `updated_at`) VALUES
(1, 2, 3, 'employe-63ecc09c9c853583316212.pdf', 6725, '2023-02-15 12:23:08'),
(2, 2, 3, 'employe2-63ecc09ca10f1007165618.pdf', 6725, '2023-02-15 12:23:08'),
(3, 3, 4, 'employe-63ecc1116f243058620124.pdf', 6725, '2023-02-15 12:25:05'),
(4, 3, 3, 'employe-63ecc11170eef411549524.pdf', 6725, '2023-02-15 12:25:05'),
(5, 4, 3, 'compagny2-63ecc1f792798592124879.pdf', 6725, '2023-02-15 12:28:55'),
(6, 5, 3, 'compagny2-63ecc25eaa67a394612363.pdf', 6725, '2023-02-15 12:30:38'),
(7, 6, 3, 'stagiaire2-63ecd45232bbb765418702.pdf', 6725, '2023-02-15 13:47:14'),
(8, 7, 4, 'employe-63ecf5dff2e0d308480136.pdf', 6725, '2023-02-15 16:10:24'),
(9, 8, 3, 'stagiaire-63ee0cd381900948822834.pdf', 6725, '2023-02-16 12:00:35'),
(10, 9, 5, 'stagiaire-63ee0da39ff13060165528.pdf', 6725, '2023-02-16 12:04:03'),
(11, 10, 3, 'employe-63efa55079a55219479513.pdf', 6725, '2023-02-17 17:03:28');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category_file`
--
ALTER TABLE `category_file`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compagny`
--
ALTER TABLE `compagny`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compagny_file`
--
ALTER TABLE `compagny_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FA88BB2E1224ABE0` (`compagny_id`),
  ADD KEY `IDX_FA88BB2E54133912` (`category_file_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB25A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D93D6496BF700BD` (`status_id`);

--
-- Index pour la table `user_file`
--
ALTER TABLE `user_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F61E7AD9A76ED395` (`user_id`),
  ADD KEY `IDX_F61E7AD954133912` (`category_file_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category_file`
--
ALTER TABLE `category_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `compagny`
--
ALTER TABLE `compagny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `compagny_file`
--
ALTER TABLE `compagny_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user_file`
--
ALTER TABLE `user_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compagny_file`
--
ALTER TABLE `compagny_file`
  ADD CONSTRAINT `FK_FA88BB2E1224ABE0` FOREIGN KEY (`compagny_id`) REFERENCES `compagny` (`id`),
  ADD CONSTRAINT `FK_FA88BB2E54133912` FOREIGN KEY (`category_file_id`) REFERENCES `category_file` (`id`);

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6496BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `user_file`
--
ALTER TABLE `user_file`
  ADD CONSTRAINT `FK_F61E7AD954133912` FOREIGN KEY (`category_file_id`) REFERENCES `category_file` (`id`),
  ADD CONSTRAINT `FK_F61E7AD9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
