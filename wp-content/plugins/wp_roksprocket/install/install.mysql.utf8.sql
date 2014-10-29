CREATE TABLE IF NOT EXISTS `#__roksprocket_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(45) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `provider_id` varchar(45) NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `params` text,
  PRIMARY KEY (`id`),
  KEY `idx_module` (`widget_id`),
  KEY `idx_module_order` (`widget_id`,`order`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__roksprocket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `params` text,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
