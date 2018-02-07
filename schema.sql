CREATE TABLE dishes (
	  id INT AUTO_INCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE dishes_ingredients (
	  dish_id INT NOT NULL,
    ingredient_id INT NOT NULL,
    INDEX IDX_837A1997148EB0CB (dish_id),
    INDEX IDX_837A1997933FE08C (ingredient_id),
    PRIMARY KEY(dish_id, ingredient_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE ingredients (
	  id INT AUTO_INCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE ingredients_allergens (
	  ingredient_id INT NOT NULL,
    allergen_id INT NOT NULL,
    INDEX IDX_6886B58E933FE08C (ingredient_id),
    INDEX IDX_6886B58E6E775A4A (allergen_id),
    PRIMARY KEY(ingredient_id, allergen_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE ingredients_allergens (
	  ingredient_id INT NOT NULL,
    allergen_id INT NOT NULL,
    INDEX IDX_6886B58E933FE08C (ingredient_id),
    INDEX IDX_6886B58E6E775A4A (allergen_id),
    PRIMARY KEY(ingredient_id, allergen_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE allergens (
	  id INT AUTO_INCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

CREATE TABLE log_modified_dishes (
	  id INT AUTO_INCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    user_id INT NOT NULL,
    deleted_ingredients VARCHAR(255) NOT NULL,
    added_ingredients VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

ALTER TABLE dishes_ingredients ADD CONSTRAINT FK_837A1997148EB0CB FOREIGN KEY (dish_id) REFERENCES dishes (id);
ALTER TABLE dishes_ingredients ADD CONSTRAINT FK_837A1997933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id);
ALTER TABLE ingredients_allergens ADD CONSTRAINT FK_6886B58E933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id);
ALTER TABLE ingredients_allergens ADD CONSTRAINT FK_6886B58E6E775A4A FOREIGN KEY (allergen_id) REFERENCES allergens (id);