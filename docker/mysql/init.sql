CREATE DATABASE IF NOT EXISTS `wandersnap_api`;
USE `wandersnap_api`;
GRANT ALL PRIVILEGES ON `wandersnap_api`.* TO 'root'@'%';

CREATE DATABASE IF NOT EXISTS `wandersnap_api_testing`;
USE `wandersnap_api_testing`;
GRANT ALL PRIVILEGES ON `wandersnap_api_testing`.* TO 'root'@'%';
