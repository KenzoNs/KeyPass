--
--	Table groupe
--

INSERT INTO `groupe` (`id_groupe`, `nom`)
VALUES (1, 'Informatique'),
       (2, 'Urgence');

--
--	Table user
--

INSERT INTO `utilisateur` (`id_utilisateur`, `id_groupe`, `nom`, `prenom`, `email`, `mot_de_passe`, `privileges`)
VALUES ('Jg0LclGP', 1, 'AzYwWWc=', 'BgYQZls=', 'JgYQZlvSDmpURz0WRXUewRZGTzM=', 'OQYNaAXOUys=', 2);

--
--	Table compte
--

INSERT INTO `compte` (`id_compte`, `id_groupe`, `id_utilisateur`, `titre`, `identifiant_compte`, `mot_de_passe_compte`, `url`, `notes`)
VALUES (1, 1, 'Jg0LclGP', 'CwIdeVaTD3Q=', 'OQYNaA==', 'OQYNaA==', 'KwIdeVaTD3QUQSE7', 'IAYNb1WbBQ==');