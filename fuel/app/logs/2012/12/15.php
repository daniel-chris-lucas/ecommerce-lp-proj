<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

Error - 2012-12-15 00:52:11 --> 8 - Undefined variable: title in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\layouts\template.php on line 9
Error - 2012-12-15 01:24:21 --> 8 - Undefined variable: results in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\products\search.php on line 17
Error - 2012-12-15 02:06:12 --> 2 - Invalid argument supplied for foreach() in L:\Local Server\sites\sandbox\projet-web\fuel\app\views\products\search.php on line 27
Error - 2012-12-15 04:58:42 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'slug' cannot be null with query: "INSERT INTO `products` (`name`, `description`, `slug`, `category_id`, `price`, `created_at`, `updated_at`) VALUES ('Stylish Jacket', 'Nunc non fermentum nunc. Sed ut ante eget leo tempor consequat sit amet eu orci. Donec dignissim dolor eget', null, '17', '122', 1355547522, 1355547522)" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Error - 2012-12-15 05:52:10 --> 8 - Use of undefined constant OT - assumed 'OT' in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\admin\products.php on line 67
Error - 2012-12-15 05:52:37 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'folder' cannot be null with query: "INSERT INTO `images` (`name`, `alt`, `product_id`, `folder`) VALUES ('Clothes, Shoes & Watches\\1802e9ad6f12e3f2de7656d33d5757f9.png', 'Stylish Jacket', '5', null)" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Error - 2012-12-15 05:56:36 --> Error - Image file  does not exist. in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\image\driver.php on line 149
Error - 2012-12-15 05:58:44 --> Error - Image file  does not exist. in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\image\driver.php on line 149
Error - 2012-12-15 05:59:20 --> 2 - getimagesize(assets/uploads/c6e5c13ff06f595d1baf49ed9a51dfb8.png): failed to open stream: No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\admin\products.php on line 94
Error - 2012-12-15 05:59:47 --> 2 - getimagesize(assets/uploads/8beea3905a1e0d3a2d28c29eb61a892e.png): failed to open stream: No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\admin\products.php on line 94
Error - 2012-12-15 06:00:59 --> 2 - getimagesize(assets/uploads/9392ba69c295fee5fd9bcb1712534284.png): failed to open stream: No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\admin\products.php on line 94
Error - 2012-12-15 06:02:04 --> 2 - getimagesize(assets/uploads/9d63b0ecc189253b15b226325eade45b.png): failed to open stream: No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\admin\products.php on line 94
Error - 2012-12-15 06:02:13 --> 2 - getimagesize(assets/uploads/04458e0a19994758286c189537592765.png): failed to open stream: No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\controller\admin\products.php on line 94
Error - 2012-12-15 06:06:56 --> 8 - Undefined offset: 1 in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 18
Error - 2012-12-15 06:23:18 --> 8 - Undefined offset: 1 in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 18
Error - 2012-12-15 06:26:08 --> 8 - Undefined variable: folder in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 21
Error - 2012-12-15 06:26:40 --> 2 - unlink(assets/uploads/b5870d6f2a25b65f4b8f4237a4f0b4e1.png): No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 23
Error - 2012-12-15 06:27:26 --> 2 - unlink(assets/uploads/b5870d6f2a25b65f4b8f4237a4f0b4e1.png): No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 23
Error - 2012-12-15 06:28:19 --> 2 - unlink(assets/uploads/Clothes, Shoes &amp; Watches\b5870d6f2a25b65f4b8f4237a4f0b4e1-thumbnail.png): No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 24
Error - 2012-12-15 06:30:19 --> 2 - unlink(assets/uploads/Biography\3dcd6613adef8a09c29ca3553314c92e-thumbnail.png): No such file or directory in L:\Local Server\sites\sandbox\projet-web\fuel\app\classes\model\image.php on line 24
Error - 2012-12-15 06:39:14 --> 1000 - SQLSTATE[01000]: Warning: 1265 Data truncated for column 'price' at row 1 with query: "INSERT INTO `products` (`name`, `description`, `slug`, `category_id`, `price`, `created_at`, `updated_at`) VALUES ('Brown Winter Shoes', 'Nunc non fermentum nunc. Sed ut ante eget leo tempor consequat sit amet eu orci. Donec dignissim dolor eget', 'brown-winter-shoes', '17', '', 1355553554, 1355553554)" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
