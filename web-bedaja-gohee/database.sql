DROP TABLE IF EXISTS `tbl_product_inv`;
CREATE TABLE `tbl_product_inv` (
  `rec_id` int(8) NOT NULL default '0',
  `prod_id` int(8) NOT NULL default '0',
  `prod_qty` int(8) NOT NULL default '0',
  KEY  (`prod_id`),
  KEY (`rec_id`)
) ENGINE=MYISAM;