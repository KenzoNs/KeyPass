SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";

--
-- Base de données : `keypass`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
    `id_utilisateur` varchar(150) NOT NULL,
    `id_groupe` int(11) NOT NULL,
    `nom` varchar(150) NOT NULL,
    `prenom` varchar(150) NOT NULL,
    `email` varchar(150) NOT NULL,
    `mot_de_passe` varchar(150) NOT NULL,
    `privileges` smallint(1) NOT NULL,
    UNIQUE (email),
    CHECK(privileges >= 1 AND privileges <= 2),
    PRIMARY KEY (`id_utilisateur`),
    KEY `fk_id_groupe_utilisateur` (`id_groupe`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
    `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(50) NOT NULL,
    UNIQUE (nom),
    PRIMARY KEY (`id_groupe`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
    `id_compte` int(11) NOT NULL AUTO_INCREMENT,
    `id_groupe` int(11) NOT NULL,
    `id_utilisateur` varchar(150) NOT NULL,
    `titre` varchar(150) NOT NULL,
    `identifiant_compte` varchar(150) NOT NULL,
    `mot_de_passe_compte` varchar(150) NOT NULL,
    `url` varchar(300) NOT NULL,
    `notes` varchar(150),
    PRIMARY KEY (`id_compte`),
    KEY `fk_id_groupe_compte` (`id_groupe`),
    KEY `fk_id_utilisateur_compte` (`id_utilisateur`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `groupe`
--

ALTER TABLE `utilisateur`
    ADD CONSTRAINT `fk_id_groupe_utilisateur` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`);

--
-- Contraintes pour la table `compte`
--

ALTER TABLE `compte`
    ADD CONSTRAINT `fk_id_groupe_compte` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`),
    ADD CONSTRAINT `fk_id_utilisateur_compte` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

COMMIT;
