<!DOCTYPE html>
<html style="opacity:0;">
	<head>
		<meta charset="utf-8" />
		<title>{$title} - MazeMind</title>
		<link rel="icon" type="image/png" href="web/app/image/icon.png" />
		<gc:asset type="css" files="web/admin/css/login.css,web/app/file/font-awesome/css/font-awesome.min.css" cache="5"/>
		<script type="text/javascript" src="/web/app/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="/web/admin/js/login.js"></script>
	</head>
	<body id="body">
		<div id="main-login">
			<header class="login">
				<div id="logo">
					<i class="fa fa-fire"></i> MazeMind
				</div>
			</header>
			<div id="login" class="stack twisted">
				<div class="content">
					<div id="login-top">{$title}</div>
					<div id="login-content">
						<input type="hidden" name="form-login"/>
						<input type="text" name="username" id="username" placeholder="Nom d'utilisateur"/>
						<input type="password" name="password" id="password" placeholder="Mot de passe"/>
						<input type="button" id="send" value="Se connecter"/>
						<div id="error"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>