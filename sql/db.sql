CREATE TABLE IF NOT EXISTS `mc_soundcloud` (
  `idsc` INT(7) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idcatalog` INT(6) UNSIGNED NOT NULL ,
  `url_media_sc` VARCHAR(125) NOT NULL ,
  PRIMARY KEY (`idsc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `mc_soundcloud_home` (
  `idsc_h` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `name_sc_h` varchar(125) NOT NULL,
  `url_media_sc_h` varchar(125) NOT NULL,
  `order_sc_h` int(7) unsigned NOT NULL,
  PRIMARY KEY (`idsc_h`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;