SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `service_desk_db` ;
CREATE SCHEMA IF NOT EXISTS `service_desk_db` DEFAULT CHARACTER SET utf8 ;
USE `service_desk_db` ;

-- -----------------------------------------------------
-- Table `service_desk_db`.`odjel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service_desk_db`.`odjel` ;

CREATE  TABLE IF NOT EXISTS `service_desk_db`.`odjel` (
  `idOdjel` INT(11) NOT NULL AUTO_INCREMENT ,
  `naziv` VARCHAR(45) NOT NULL ,
  `lokacija` VARCHAR(45) NOT NULL ,
  `adresa` VARCHAR(45) NOT NULL ,
  `telefon` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idOdjel`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `service_desk_db`.`korisnik`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service_desk_db`.`korisnik` ;

CREATE  TABLE IF NOT EXISTS `service_desk_db`.`korisnik` (
  `idKorisnik` INT(11) NOT NULL AUTO_INCREMENT ,
  `imePrezime` VARCHAR(45) NOT NULL ,
  `korisnickoIme` VARCHAR(45) NOT NULL ,
  `lozinka` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `telefon` VARCHAR(45) NOT NULL ,
  `privilegija` ENUM('Administrator', 'User', 'EventManager', 'IncidetManager', 'RequestManager', 'SupplierManager', 'SuperManager' ) NOT NULL ,
  `odjel_idOdjel` INT(11) NOT NULL ,
  PRIMARY KEY (`idKorisnik`) ,
  INDEX `fk_korisnik_odjel1_idx` (`odjel_idOdjel` ASC) ,
  CONSTRAINT `fk_korisnik_odjel1`
    FOREIGN KEY (`odjel_idOdjel` )
    REFERENCES `service_desk_db`.`odjel` (`idOdjel` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `service_desk_db`.`dogadjaj`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service_desk_db`.`dogadjaj` ;

CREATE  TABLE IF NOT EXISTS `service_desk_db`.`dogadjaj` (
  `idDogadjaj` INT(11) NOT NULL ,
  `datumVrijemePrijave` DATETIME NOT NULL ,
  `naslov` VARCHAR(45) NOT NULL ,
  `kategorija` VARCHAR(45) NOT NULL ,
  `podkategorija` VARCHAR(45) NOT NULL ,
  `konfiguracijskaStavka` VARCHAR(45) NOT NULL ,
  `opis` VARCHAR(500) NOT NULL ,
  `status` ENUM('novi','filtriran') NOT NULL ,
  `uticaj` INT(11) NULL DEFAULT NULL ,
  `hitnost` INT(11) NULL DEFAULT NULL ,
  `prioritet` INT(11) NULL DEFAULT NULL ,
  `vrsta` ENUM('incident','zahtjev') NULL DEFAULT NULL ,
  `korisnik_idKorisnik` INT(11) NOT NULL ,
  PRIMARY KEY (`idDogadjaj`) ,
  INDEX `fk_dogadjaj_korisnik_idx` (`korisnik_idKorisnik` ASC) ,
  CONSTRAINT `fk_dogadjaj_korisnik`
    FOREIGN KEY (`korisnik_idKorisnik` )
    REFERENCES `service_desk_db`.`korisnik` (`idKorisnik` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `service_desk_db`.`incident`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service_desk_db`.`incident` ;

CREATE  TABLE IF NOT EXISTS `service_desk_db`.`incident` (
  `idIncident` INT(11) NOT NULL AUTO_INCREMENT ,
  `datumVrijemePrijave` DATETIME NOT NULL ,
  `naslov` VARCHAR(45) NOT NULL ,
  `kategorija` VARCHAR(45) NOT NULL ,
  `podkategorija` VARCHAR(45) NOT NULL ,
  `konfiguracijskaStavka` VARCHAR(45) NOT NULL ,
  `opis` VARCHAR(500) NOT NULL ,
  `status` ENUM('novi','naCekanju','aktivan','rijesen','zatvoren') NOT NULL ,
  `tipPrijave` ENUM('sistem','telefon','email','licno') NOT NULL ,
  `povratnaInfoPreko` VARCHAR(45) NOT NULL ,
  `dodijeljenaGrupa` VARCHAR(45) NOT NULL ,
  `komentar` VARCHAR(45) NULL DEFAULT NULL ,
  `uticaj` INT(11) NULL DEFAULT NULL ,
  `hitnost` INT(11) NULL DEFAULT NULL ,
  `prioritet` INT(11) NULL DEFAULT NULL ,
  `radneBiljeske` VARCHAR(500) NULL DEFAULT NULL ,
  `datumRjesavanja` DATETIME NULL DEFAULT NULL ,
  `korisnik` VARCHAR(45) NULL DEFAULT NULL ,
  `dogadjaj_idDogadjaj` INT(11) NULL ,
  PRIMARY KEY (`idIncident`) ,
  INDEX `fk_incident_dogadjaj1_idx` (`dogadjaj_idDogadjaj` ASC) ,
  CONSTRAINT `fk_incident_dogadjaj1`
    FOREIGN KEY (`dogadjaj_idDogadjaj` )
    REFERENCES `service_desk_db`.`dogadjaj` (`idDogadjaj` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `service_desk_db`.`zahtjev`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service_desk_db`.`zahtjev` ;

CREATE  TABLE IF NOT EXISTS `service_desk_db`.`zahtjev` (
  `idZahtjev` INT(11) NOT NULL ,
  `dogadjaj_idDogadjaj` INT(11) NULL ,
  PRIMARY KEY (`idZahtjev`) ,
  INDEX `fk_zahtjev_dogadjaj1_idx` (`dogadjaj_idDogadjaj` ASC) ,
  CONSTRAINT `fk_zahtjev_dogadjaj1`
    FOREIGN KEY (`dogadjaj_idDogadjaj` )
    REFERENCES `service_desk_db`.`dogadjaj` (`idDogadjaj` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `service_desk_db` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
