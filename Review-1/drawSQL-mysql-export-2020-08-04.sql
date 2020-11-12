CREATE TABLE `Register - Form`(
    `email` VARCHAR(255) NOT NULL,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `signUpDate` DATE NOT NULL,
    `isSubscribed` TINYINT(1) NOT NULL
);
ALTER TABLE
    `Register - Form` ADD PRIMARY KEY `register _ form_email_primary`(`email`);
CREATE TABLE `Feedback & Recommendation  : Form`(
    `email` VARCHAR(255) NOT NULL,
    `feedback` TEXT NOT NULL,
    `remark` VARCHAR(255) NOT NULL
);
CREATE TABLE `categories`(
    `id` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `categories` ADD PRIMARY KEY `categories_id_primary`(`id`);
CREATE TABLE `entities`(
    `id` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `thumbnail` VARCHAR(255) NOT NULL,
    `preview` VARCHAR(255) NOT NULL,
    `categoryID` INT NOT NULL
);
ALTER TABLE
    `entities` ADD PRIMARY KEY `entities_id_primary`(`id`);
CREATE TABLE `videos`(
    `id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `filePath` VARCHAR(255) NOT NULL,
    `uploadDate` DATETIME NOT NULL,
    `releasedDate` DATE NOT NULL,
    `duration` INT NOT NULL,
    `season` INT NOT NULL,
    `episode` INT NOT NULL,
    `entityID` INT NOT NULL
);
ALTER TABLE
    `videos` ADD PRIMARY KEY `videos_id_primary`(`id`);
ALTER TABLE
    `Feedback & Recommendation  : Form` ADD CONSTRAINT `feedback & recommendation  : form_email_foreign` FOREIGN KEY(`email`) REFERENCES `Register - Form`(`email`);
ALTER TABLE
    `entities` ADD CONSTRAINT `entities_categoryid_foreign` FOREIGN KEY(`categoryID`) REFERENCES `categories`(`id`);
ALTER TABLE
    `videos` ADD CONSTRAINT `videos_entityid_foreign` FOREIGN KEY(`entityID`) REFERENCES `entities`(`id`);