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
    `matricule_utilisateur` varchar(150) NOT NULL,
    `identifiant_utilisateur` varchar(150) NOT NULL,
    `nom_groupe_utilisateur` varchar(150) NOT NULL,
    `nom_utilisateur` varchar(150) NOT NULL,
    `prenom_utilisateur` varchar(150) NOT NULL,
    `grade_utilisateur` varchar(150) NOT NULL,
    `fonction_utilisateur` varchar(150) NOT NULL,
    `mot_de_passe_utilisateur` varchar(150) NOT NULL,
    `date_entree_utilisateur` date DEFAULT (curdate()),
    `privilege_utilisateur` smallint(1) DEFAULT 0,
    `date_sortie_utilisateur` date DEFAULT NULL,
    `email_utilisateur` varchar(150) DEFAULT NULL,
    `bip_utilisateur` varchar(150) DEFAULT NULL,
    `telephone_utilisateur` varchar(150) DEFAULT NULL,
    UNIQUE (email_utilisateur, bip_utilisateur, telephone_utilisateur, identifiant_utilisateur),
    CHECK(privilege_utilisateur >= 0 AND privilege_utilisateur <= 1),
    PRIMARY KEY (`matricule_utilisateur`),
    KEY `fk_nom_groupe_utilisateur` (`nom_groupe_utilisateur`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
    `nom_groupe` varchar(150) NOT NULL,
    UNIQUE (nom_groupe),
    PRIMARY KEY (`nom_groupe`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `groupe`
--

ALTER TABLE `utilisateur`
    ADD CONSTRAINT `fk_nom_groupe_utilisateur` FOREIGN KEY (`nom_groupe_utilisateur`) REFERENCES `groupe` (`nom_groupe`);

COMMIT;
