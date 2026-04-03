CREATE TABLE IF NOT EXISTS `#__vigilara_events` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(50) NOT NULL,
    `data` TEXT NOT NULL,
    `created` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;