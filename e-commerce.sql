-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_role_idx` (`role_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `mydb`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `quantity` INT NOT NULL,
  `amount` DECIMAL(6,2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `offered_by` INT NOT NULL,
  PRIMARY KEY (`id`, `offered_by`),
  INDEX `fk_product_users1_idx` (`offered_by` ASC) VISIBLE,
  CONSTRAINT `fk_product_users1`
    FOREIGN KEY (`offered_by`)
    REFERENCES `mydb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_goods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_goods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NULL,
  `collect_delivery` VARCHAR(45) NOT NULL,
  `destination` VARCHAR(255) NULL,
  `status` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `user_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `amount` DECIMAL(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_goods_user1_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_user_goods_product1_idx` (`product_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_goods_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_goods_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `mydb`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`payment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `method` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `user_goods_id` INT NOT NULL,
  PRIMARY KEY (`id`, `user_goods_id`),
  INDEX `fk_payment_user_goods1_idx` (`user_goods_id` ASC) VISIBLE,
  CONSTRAINT `fk_payment_user_goods1`
    FOREIGN KEY (`user_goods_id`)
    REFERENCES `mydb`.`user_goods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`review` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(1000) NOT NULL,
  `rating` INT NOT NULL,
  `created_at` DATETIME NULL,
  `user_goods_id` INT NOT NULL,
  PRIMARY KEY (`id`, `user_goods_id`),
  INDEX `fk_review_user_goods1_idx` (`user_goods_id` ASC) VISIBLE,
  CONSTRAINT `fk_review_user_goods1`
    FOREIGN KEY (`user_goods_id`)
    REFERENCES `mydb`.`user_goods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
