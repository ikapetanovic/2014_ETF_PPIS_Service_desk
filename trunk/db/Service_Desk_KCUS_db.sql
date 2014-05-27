SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `service_desk_kcus_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `service_desk_kcus_db` ;

-- -----------------------------------------------------
-- Table `service_desk_kcus_db`.`korisnicki_racun`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_desk_kcus_db`.`korisnicki_racun` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `broj_telefona` VARCHAR(45) NOT NULL,
  `email_adresa` VARCHAR(45) NOT NULL,
  `odjel` VARCHAR(45) NOT NULL,
  `korisnicko_ime` VARCHAR(45) NOT NULL,
  `korisnicka_sifra` VARCHAR(45) NOT NULL,
  `korisnicka_grupa` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `service_desk_kcus_db`.`dogadaj`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_desk_kcus_db`.`dogadaj` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `datum` VARCHAR(45) NOT NULL,
  `naziv` VARCHAR(45) NOT NULL,
  `kategorija` VARCHAR(45) NOT NULL,
  `podkategorija` VARCHAR(45) NOT NULL,
  `prioritet` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(250) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `id_korisnickog_racuna` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK1_idx` (`id_korisnickog_racuna` ASC),
  CONSTRAINT `FK1`
    FOREIGN KEY (`id_korisnickog_racuna`)
    REFERENCES `service_desk_kcus_db`.`korisnicki_racun` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `service_desk_kcus_db`.`zahtjev`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_desk_kcus_db`.`zahtjev` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `datum_prijavljivanja` VARCHAR(45) NOT NULL,
  `naziv` VARCHAR(45) NOT NULL,
  `kategorija` VARCHAR(45) NOT NULL,
  `podkategorija` VARCHAR(45) NOT NULL,
  `prioritet` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(250) NOT NULL,
  `komentar` VARCHAR(250) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `datum_rjesavanja` VARCHAR(45) NOT NULL,
  `id_dogadaja` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK2_idx` (`id_dogadaja` ASC),
  CONSTRAINT `FK2`
    FOREIGN KEY (`id_dogadaja`)
    REFERENCES `service_desk_kcus_db`.`dogadaj` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `service_desk_kcus_db`.`incident`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_desk_kcus_db`.`incident` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `datum_prijavljivanja` VARCHAR(45) NOT NULL,
  `naziv` VARCHAR(45) NOT NULL,
  `kategorija` VARCHAR(45) NOT NULL,
  `podkategorija` VARCHAR(45) NOT NULL,
  `prioritet` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(250) NOT NULL,
  `komentar` VARCHAR(250) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `stanje` VARCHAR(45) NOT NULL,
  `datum_rjesavanja` VARCHAR(45) NOT NULL,
  `id_dogadaja` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK3_idx` (`id_dogadaja` ASC),
  CONSTRAINT `FK3`
    FOREIGN KEY (`id_dogadaja`)
    REFERENCES `service_desk_kcus_db`.`dogadaj` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
