create database if not exists AgendaLalo;
use AgendaLalo;

CREATE TABLE IF NOT EXISTS `contactos`(
	idCont int auto_increment,
    nombre varchar(50) not null,
    direccion varchar(50),
    telefono varchar(11) not null,
    email varchar(70),
    cp varchar(10),
    edad int not null,
    gustos varchar(250),
    
    primary key(idCont)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `startdate` varchar(48) NOT NULL,
  `enddate` varchar(48) NOT NULL,
  `allDay` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




