<gc:include file="include/functions"/>
<html>
	<head>
		<title>{$title} - MazeMind</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>{$title} - Kryptonite</title>
		<link rel="icon" type="image/png" href="{{path:IMAGE:app}}icon.png" />
		<gc:asset type="css" files="web/kryptonite/css/default.css,web/app/css/default.css,web/app/file/font-awesome/css/font-awesome.min.css" cache="5"/>
		<script type="text/javascript" src="/{{path:JS:app}}jquery-1.11.2.min.js"></script>
	</head>
	<body>
		<div id="root">
			<header>
				<div class="left">
					<a href="/">
						<h1>
							<i class="fa fa-fire">&nbsp;</i>
							MazeMind
						</h1>
					</a>
				</div>
				<div class="middle">
					<nav>

					</nav>
				</div>
				<div class="right">
					<gc:if condition="empty($_SESSION['kryptonite']['logged'])">
						<a href="{{url:kryptonite.user.login}}" class="user">
							<i class="fa fa-user">&nbsp;</i>
							<span>Connexion</span>
						</a>
						<a href="{{url:kryptonite.user.register}}" class="user">
                            <i class="fa fa-user-plus">&nbsp;</i>
                            <span>Inscription</span>
                        </a>
					<gc:else/>
						 <a href="{{url:kryptonite.user.logout}}" class="user">
							<i class="fa fa-sign-out">&nbsp;</i>
							<span>Déconnexion</span>
						 </a>
					</gc:if>
				</div>
			</header>
			<div id="main">
				<div class="content">
					<gc:if condition="isset($request) && count($request->errors()) > 0">
						<div id="error-message">
							<div class="alert alert-error">
								<gc:foreach var="$request->errors()" as="$errors">
									<div><strong>{$errors['field']}</strong> : {$errors['message']}</div>
								</gc:foreach>
							</div>
						</div>
					</gc:if>
					<gc:if condition="isset($_SESSION['flash']) && $_SESSION['flash'] != ''">
						<div id="flash-message">
							<div class="alert alert-success">
								<div class="close" onclick="closeFlashMessage(this);"><span class="fa fa-times">&nbsp;</span></div>
								{$_SESSION['flash']}
								{{php: $_SESSION['flash'] = ''; }}
							</div>
						</div>
					</gc:if>
					<gc:child/>
				</div>
			</div>
			<div id="sub-main">&nbsp;</div>
			<footer>
				<div class="block about">
					<p>Touts droits réservés</p>
				</div>
				<div class="block info">
					<div class="social">
						<a href=""><span class="fa fa-facebook-square">&nbsp;</span></a>
						<a href=""><span class="fa fa-twitter-square">&nbsp;</span></a>
						<a href=""><span class="fa fa-google-plus-square">&nbsp;</span></a>
					</div>
				</div>
				<div class="clear"></div>
			</footer>
			<script type="text/javascript" src="/{{path:JS}}script.js"></script>
		</div>
	</body>
</html>