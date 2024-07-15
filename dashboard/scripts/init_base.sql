CREATE DATABASE inaf_prisma;
USE inaf_prisma;
SOURCE /db/dump.sql;
CREATE USER 'prisma'@'%' IDENTIFIED WITH mysql_native_password BY '${MYSQL_PRISMA_PWD}';
GRANT ALL PRIVILEGES ON inaf_prisma.* TO 'prisma'@'%';
FLUSH PRIVILEGES;
UPDATE `core_person` SET `password` = '${MYSQL_ADMIN_PWD}' WHERE `core_person`.`id` = 1
