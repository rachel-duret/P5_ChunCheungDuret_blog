-- MySQL Script generated by MySQL Workbench
-- Fri Jun 24 14:17:19 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 ;
USE `blog` ;

-- -----------------------------------------------------
-- Table `blog`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 64
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `users_id` INT(11) NOT NULL,
  `role` VARCHAR(45) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `profession` VARCHAR(255) NOT NULL,
  `skill` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_admin_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_admin_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `blog`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`posts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(500) NULL DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(500) NULL DEFAULT NULL,
  `content` LONGTEXT NULL DEFAULT NULL,
  `author` VARCHAR(100) NULL DEFAULT NULL,
  `date` TIMESTAMP NULL DEFAULT NULL,
  `admin_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_admin1_idx` (`admin_id` ASC) ,
  CONSTRAINT `fk_posts_admin1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `blog`.`admin` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `comment` TINYTEXT NOT NULL,
  `date` DATE NOT NULL,
  `validation` INT(1) NOT NULL DEFAULT '0',
  `users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `post_id_idx` (`post_id` ASC) ,
  INDEX `fk_comments_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `post_id`
    FOREIGN KEY (`post_id`)
    REFERENCES `blog`.`posts` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `blog`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
