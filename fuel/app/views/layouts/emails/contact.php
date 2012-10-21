<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Contact Form</title>
</head>
<body>
	<p>
        New message reveived from the contact form:<br>
        Email Address: <?php echo $email ?><br>
        Name: <?php echo $name ?>
    </p>
    <p>
        <?php echo $message ?>
    </p>
</body>
</html>