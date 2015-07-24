-- Structure de la table `sondage_table` 
CREATE TABLE IF NOT EXISTS `sondage_table` (
  `sond_id` int(11) NOT NULL AUTO_INCREMENT, 
  `sond_theme` varchar(25) NOT NULL,
  `sond_resume` text NOT NULL,
  `sond_dateD` date NOT NULL,
  `sond_dateF` date NOT NULL, 
  PRIMARY KEY (`sond_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Structure de la table `sondage_question` 
CREATE TABLE IF NOT EXISTS `sondage_question` (
  `sondQ_id` int(11) NOT NULL AUTO_INCREMENT,
  `sondQ_sondage_id` INT NOT NULL,
  `sondQ_question` text NOT NULL, 
  `sondQ_options` text NOT NULL,
  PRIMARY KEY (`sondQ_id`),
  CONSTRAINT `question_vers_sondage_fk` FOREIGN KEY (`sondQ_sondage_id`) REFERENCES sondage_table(sond_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Structure de la table `sondage_resultat` 
CREATE TABLE IF NOT EXISTS `sondage_resultat` (
  `sondR_id` int(11) NOT NULL AUTO_INCREMENT,
  `sondR_question_id` int(11) NOT NULL,
  `sondR_reponse` text NOT NULL,
  `sondR_nb` int(11) NOT NULL,
  PRIMARY KEY (`sondR_id`),
  CONSTRAINT `resultat_vers_question_fk` FOREIGN KEY (`sondR_question_id`) REFERENCES sondage_question(sondQ_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;
