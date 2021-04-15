--
--	Table groupe
--

INSERT INTO `groupe` (`id_groupe`, `nom`)
VALUES (1, 'Informatique'),
       (2, 'Urgence');

--
--	Table utilisateur
--

INSERT INTO `utilisateur` (`id_utilisateur`, `id_groupe`, `nom`, `prenom`, `email`, `mot_de_passe`, `privileges`)
VALUES ('543cab7a811ed2eda0922055106ec967c2e07e6b223e1c9c2a990f6bddf0a370', 1, 'bc88ec3b0cfecf309d1e8622bda39fac90bcb321e26527b0111a396f005fbf5b', 'ef01ca0cb93b9d94f642337818aaf5ce2319c6df6dedf19d6ac329030e5a3fa3', '002d4d923b3725f227a7613cd7c8396b5cb115e42c73b06aae3ff0b0fd2eb61a', '5471d39e681ffc00128c11b573f4a3356ceba766956bb928d562d2c7c0c2db6a', 2);

--
--	Table compte
--

INSERT INTO `compte` (`id_compte`, `id_groupe`, `id_utilisateur`, `titre`, `identifiant_compte`, `mot_de_passe_compte`, `url`, `notes`)
VALUES (1, 1, '543cab7a811ed2eda0922055106ec967c2e07e6b223e1c9c2a990f6bddf0a370', '50d8970e55c185da7f8dede3c2f3a6bc93a68fbacea30fcc1f7b48cd553d2244', '88cd2108b5347d973cf39cdf9053d7dd42704876d8c9a9bd8e2d168259d3ddf7', '88cd2108b5347d973cf39cdf9053d7dd42704876d8c9a9bd8e2d168259d3ddf7', '02f09a766cdb5df4a4b91e9952fb052106c6f817f8ae790e17e7bc562306107a', '8d4559ae8b8ea3ed40851d4dc3a812994adb533b3ebe5f9fc2dfc4c2b9d561bb');