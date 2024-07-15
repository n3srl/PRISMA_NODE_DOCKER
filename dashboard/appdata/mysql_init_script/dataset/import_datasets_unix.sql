
LOAD DATA LOCAL INFILE '/var/www/html/mysql_init_script/dataset/pr_core_person.csv' 
INTO TABLE inaf_prisma.pr_core_person 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/var/www/html/mysql_init_script/dataset/pr_region.csv' 
INTO TABLE inaf_prisma.pr_region 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/var/www/html/mysql_init_script/dataset/pr_node.csv' 
INTO TABLE inaf_prisma.pr_node 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;
