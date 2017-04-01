-- MySQL Script generated by MySQL Workbench
-- Thu Mar 30 10:54:26 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema Project
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Project
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Project` DEFAULT CHARACTER SET latin1 ;
USE `Project` ;

-- -----------------------------------------------------
-- Table `Project`.`users`
-- -----------------------------------------------------
CREATE TABLE `users` (
  `username` VARCHAR(20) NOT NULL,
  `firstName` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `aboutme` VARCHAR(500) NULL,
  PRIMARY KEY (`username`),
  UNIQUE INDEX `email` (`email` ASC),
  UNIQUE INDEX `userID` (`userID` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Project`.`userimages`
-- -----------------------------------------------------
CREATE TABLE `userImages` (
  `userID` INT(11) NOT NULL,
  `contentType` VARCHAR(255) NOT NULL,
  `image` BLOB NOT NULL,
  PRIMARY KEY (`userID`),
  INDEX `userID` (`userID` ASC),
  CONSTRAINT `userImages_ibfk_1`
    FOREIGN KEY (`userID`)
    REFERENCES `users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Project`.`Userpost`
-- -----------------------------------------------------
CREATE TABLE `userpost` (
  `PostID` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `theme` VARCHAR(100) NOT NULL,
  `post` VARCHAR(500) NOT NULL,
  `headline` VARCHAR(100) NULL,
  PRIMARY KEY (`PostID`, `username`),
  INDEX `fk_userpost_users1_idx` (`username` ASC),
  CONSTRAINT `fk_userpost_users1`
    FOREIGN KEY (`username`)
    REFERENCES `users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Project`.`PostImages`
-- -----------------------------------------------------
CREATE TABLE `postImages` (
  `contentType` VARCHAR(255) NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `image` BLOB NOT NULL,
  `PostID` INT NOT NULL,
  PRIMARY KEY (`username`, `PostID`),
  CONSTRAINT `fk_PostImages_Userpost1`
    FOREIGN KEY (`PostID` , `username`)
    REFERENCES `userpost` (`PostID` , `username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Project`.`Comment`
-- -----------------------------------------------------
CREATE TABLE `comment` (
  `PostID` INT NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `comment` VARCHAR(300) NULL,
  `date` DATETIME NOT NULL,
  INDEX `fk_Comment_Userpost1_idx` (`PostID` ASC, `username` ASC),
  PRIMARY KEY (`PostID`, `date`),
  CONSTRAINT `fk_Comment_Userpost1`
    FOREIGN KEY (`PostID`)
    REFERENCES `userpost` (`PostID`)
    )
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
