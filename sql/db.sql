CREATE TABLE IF NOT EXISTS `mc_soundcloud` (
  `idsc` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `idcatalog` int(6) unsigned NOT NULL,
  `url_media_sc` varchar(125) NOT NULL,
  `duration` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`idsc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `mc_soundcloud_home` (
  `idsc_h` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `name_sc_h` varchar(125) NOT NULL,
  `url_media_sc_h` varchar(125) NOT NULL,
  `order_sc_h` int(7) unsigned NOT NULL,
  PRIMARY KEY (`idsc_h`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;