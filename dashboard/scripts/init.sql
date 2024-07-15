CREATE DATABASE inaf_prisma;
USE inaf_prisma;
SOURCE /db/dump.sql;
CREATE USER 'prisma'@'%' IDENTIFIED WITH mysql_native_password BY 'efGZ<Hx5id71';
GRANT ALL PRIVILEGES ON inaf_prisma.* TO 'prisma'@'%';
FLUSH PRIVILEGES;
UPDATE `core_person` SET `password` = '$2y$10$P7yiTgvS2/AvfuMFqW7Y8.V9OUKvG8GzXkG4qjVJMMgOsmlxCdItu' WHERE `core_person`.`id` = 1
