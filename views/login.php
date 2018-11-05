<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Conta Azul</title>
	<link href="<?php echo BASE_URL; ?>/assets/css/login.css" rel="stylesheet"/>
</head>
<body>

	<div id="login">
	    <form method="POST">

	        <span class="fontawesome-user"></span>
	        <input type="email" id="email" name="email" placeholder="Email">
	       
	        <span class="fontawesome-lock"></span>
	        <input type="password" id="password" name="password" placeholder="Senha">
	        
	        <input type="submit" value="Entrar"><br>

	        <?php if (!empty($error) ): ?>
	        	<div class="wrning"><?php echo $error; ?></div>
	    	<?php endif; ?>
		</form>
	</div>

</body>
</html>