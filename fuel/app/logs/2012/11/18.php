<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

Error - 2012-11-18 16:08:12 --> Error - Function name must be a string in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\category.php on line 61
Error - 2012-11-18 16:09:59 --> Error - Function name must be a string in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\category.php on line 62
Error - 2012-11-18 16:13:18 --> Error - SQLSTATE[42S02]: Base table or view not found: 1146 Table 'e_commerce.categories as root' doesn't exist with query: "SELECT `parent`.`name AS parent_name`, `child1`.`name AS child1_name` FROM `categories AS root`" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Error - 2012-11-18 16:15:36 --> Parsing Error - syntax error, unexpected '->' (T_OBJECT_OPERATOR) in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\category.php on line 64
Error - 2012-11-18 16:22:04 --> Error - SQLSTATE[42S02]: Base table or view not found: 1146 Table 'e_commerce.categories as child1' doesn't exist with query: "SELECT `parent`.`name` AS `parent_name`, `child1`.`name` AS `child1_name` FROM `categories` AS `parent` LEFT OUTER JOIN `categories as child1` ON (`child1`.`id` = `parent`.`id`) WHERE `root`.`parent_id` IS null" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Error - 2012-11-18 16:24:29 --> Error - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'root_name' in 'order clause' with query: "SELECT parent.name AS parent_name, child1.name AS child1_name
					  FROM categories AS parent
					  LEFT OUTER JOIN categories AS child1 ON child1.parent_id = parent.id
					  WHERE parent.parent_id IS NULL
					  ORDER BY root_name, down1_name" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Error - 2012-11-18 16:25:19 --> Error - Call to undefined method Fuel\Core\Database_Query::as_array() in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\category.php on line 59
Error - 2012-11-18 16:25:22 --> Error - Call to undefined method Fuel\Core\Database_Query::as_array() in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\category.php on line 59
Error - 2012-11-18 16:25:58 --> Error - Database results are read-only in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\result.php on line 266
Error - 2012-11-18 16:29:29 --> 8 - Undefined offset: 0 in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 8
Error - 2012-11-18 16:30:40 --> 8 - Undefined variable: parent_name in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 9
Error - 2012-11-18 18:01:50 --> 8 - Undefined variable: newArray in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 11
Error - 2012-11-18 18:09:48 --> 8 - Undefined variable: newArray in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 12
Error - 2012-11-18 18:09:52 --> 8 - Undefined variable: newArray in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 12
Error - 2012-11-18 22:12:32 --> Parsing Error - syntax error, unexpected 'foreach' (T_FOREACH) in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 28
Error - 2012-11-18 22:12:56 --> 8 - Undefined variable: toEcho in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 32
Error - 2012-11-18 22:18:48 --> 8 - Undefined variable: name in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 16
Error - 2012-11-18 22:19:44 --> 8 - Array to string conversion in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 13
Error - 2012-11-18 22:20:37 --> 8 - Undefined variable: name in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 14
Error - 2012-11-18 22:30:53 --> 8 - Undefined variable: child1_name in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 9
Error - 2012-11-18 22:30:56 --> 8 - Undefined variable: child1_name in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 9
Error - 2012-11-18 22:32:17 --> 8 - Undefined index: child1_id in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 11
Error - 2012-11-18 22:35:06 --> 8 - Array to string conversion in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\sidebar.php on line 24
