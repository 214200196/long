SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `pcbooks` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pcbooks` ;

-- -----------------------------------------------------
-- Table `pcbooks`.`book_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pcbooks`.`book_user` (
  `id` INT UNSIGNED NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NOT NULL DEFAULT '' ,
  `passworld` VARCHAR(45) NOT NULL DEFAULT '' ,
  `name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `add_time` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `user_face` VARCHAR(60) NOT NULL DEFAULT '' ,
  `user_work` VARCHAR(30) NOT NULL DEFAULT '' ,
  `user_experience` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `user_abstract` VARCHAR(150) NOT NULL DEFAULT '' ,
  `client_id` VARCHAR(45) NOT NULL DEFAULT '' ,
  `today_visitor` TINYINT(5) NOT NULL DEFAULT 0 ,
  `count_visitor` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `pcbooks`.`book_books_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pcbooks`.`book_books_category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `category_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `category_sort` TINYINT(5) UNSIGNED NOT NULL DEFAULT 0 ,
  `pid` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `category_name` (`category_name` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `pcbooks`.`book_books_list`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pcbooks`.`book_books_list` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `books_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `books_counts` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `add_time` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `books_face` VARCHAR(60) NOT NULL DEFAULT '' ,
  `uid` INT UNSIGNED NOT NULL ,
  `category_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `uid` (`uid` ASC) ,
  UNIQUE INDEX `books_name` (`books_name` ASC) ,
  INDEX `category_id` (`category_id` ASC) ,
  CONSTRAINT `fk_book_books_list_book_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `pcbooks`.`book_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_book_books_list_book_books_category1`
    FOREIGN KEY (`category_id` )
    REFERENCES `pcbooks`.`book_books_category` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `pcbooks`.`book_books_content`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pcbooks`.`book_books_content` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `acticle_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `key_word` VARCHAR(255) NOT NULL DEFAULT '' ,
  `acticle_content` LONGTEXT NOT NULL ,
  `add_time` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `books_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `books_id` (`books_id` ASC) ,
  CONSTRAINT `fk_book_books_content_book_books_list1`
    FOREIGN KEY (`books_id` )
    REFERENCES `pcbooks`.`book_books_list` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `pcbooks`.`book_content_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pcbooks`.`book_content_category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `content_category_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `pid` TINYINT(5) UNSIGNED NOT NULL DEFAULT 0 ,
  `content_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `content_id` (`content_id` ASC) ,
  CONSTRAINT `fk_book_content_category_book_books_content1`
    FOREIGN KEY (`content_id` )
    REFERENCES `pcbooks`.`book_books_content` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `pcbooks`.`book_follow`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pcbooks`.`book_follow` (
  `uid` INT UNSIGNED NOT NULL ,
  `books_id` INT UNSIGNED NOT NULL ,
  INDEX `uid` (`uid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
