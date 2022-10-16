
CREATE TABLE `post` (
  `id` int NOT NULL,
  `id_utilisateur`int,
  `name_user` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `utilisateur` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`);


ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `post`
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);
COMMIT;
