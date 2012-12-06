<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

Error - 2012-12-06 14:40:58 --> 8 - Undefined variable: order in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\products.php on line 226
Error - 2012-12-06 14:48:09 --> 8 - Undefined index: unit_price in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\products.php on line 205
Error - 2012-12-06 15:11:46 --> Error - SQLSTATE[42S22]: Column not found: 1054 Unknown column 't0.desc' in 'order clause' with query: "SELECT `t0`.`id` AS `t0_c0`, `t0`.`user_id` AS `t0_c1`, `t0`.`created_at` AS `t0_c2`, `t0`.`updated_at` AS `t0_c3`, `t0`.`total` AS `t0_c4` FROM `orders` AS `t0` ORDER BY `t0`.`created_at` ASC, `t0`.`desc` ASC" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Error - 2012-12-06 15:12:05 --> 8 - Undefined variable: orders in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\admin\orders\index.php on line 13
