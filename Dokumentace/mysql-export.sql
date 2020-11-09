CREATE TABLE `post`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `post_author` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `date` DATETIME NOT NULL,
    `published` TINYINT(1) NOT NULL
);
ALTER TABLE
    `post` ADD PRIMARY KEY `post_id_primary`(`id`);
CREATE TABLE `user`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `user` ADD PRIMARY KEY `user_id_primary`(`id`);
ALTER TABLE
    `user` ADD UNIQUE `user_username_unique`(`username`);
ALTER TABLE
    `user` ADD UNIQUE `user_email_unique`(`email`);
CREATE TABLE `category`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` INT NOT NULL,
    `slug` INT NOT NULL
);
ALTER TABLE
    `category` ADD PRIMARY KEY `category_id_primary`(`id`);
CREATE TABLE `tag`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `tag` ADD PRIMARY KEY `tag_id_primary`(`id`);
CREATE TABLE `comment`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `parent_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `content` TEXT NOT NULL,
    `user_id` INT NOT NULL
);
ALTER TABLE
    `comment` ADD PRIMARY KEY `comment_id_primary`(`id`);
CREATE TABLE `post_tag`(
    `post_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tag_id` INT NOT NULL
);
CREATE TABLE `post_category`(
    `post_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` INT NOT NULL
);
ALTER TABLE
    `post_tag` ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY(`post_id`) REFERENCES `post`(`id`);
ALTER TABLE
    `post` ADD CONSTRAINT `post_post_author_foreign` FOREIGN KEY(`post_author`) REFERENCES `user`(`id`);
ALTER TABLE
    `post_category` ADD CONSTRAINT `post_category_category_id_foreign` FOREIGN KEY(`category_id`) REFERENCES `category`(`id`);
ALTER TABLE
    `post_tag` ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY(`tag_id`) REFERENCES `tag`(`id`);
ALTER TABLE
    `comment` ADD CONSTRAINT `comment_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `user`(`id`);
ALTER TABLE
    `comment` ADD CONSTRAINT `comment_parent_id_foreign` FOREIGN KEY(`parent_id`) REFERENCES `comment`(`id`);
ALTER TABLE
    `post_category` ADD CONSTRAINT `post_category_post_id_foreign` FOREIGN KEY(`post_id`) REFERENCES `post`(`id`);