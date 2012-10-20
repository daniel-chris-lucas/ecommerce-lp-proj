<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Activate Your Account</title>
</head>
<body>
	<p>
        <?php echo "{$first_name} {$last_name}" ?>,<br>
        Thank you for registering on our site. Your account is almost ready to use; all you need to do to get started is click on the link
        below or copy the link and paste it in your browser:
    </p>
    <p>
        <a href="<?php echo $act_link ?>"><?php echo $act_link ?></a>
    </p>
</body>
</html>