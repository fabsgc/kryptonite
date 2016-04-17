<gc:include file="include/functions" />
<html>
	<head>
		<title>{$title} - MazeMind</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>{$title} - Kryptonite</title>
		<link rel="icon" type="image/png" href="{{path:IMAGE:app}}icon.png" />
		<gc:asset type="css" files="web/kryptonite/css/default.css,web/app/css/default.css,web/app/file/font-awesome/css/font-awesome.min.css" cache="5"/>
		<script type="text/javascript" src="/web/app/js/jquery-1.11.2.min.js"></script>
	</head>
	<body>
		<div id="root">
			<header>
				<div class="left">
					<a href="/">
						<h1>
							<i class="fa fa-fire"></i>
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
							<i class="fa fa-user"></i>
							<span>Connexion</span>
						</a>
						<a href="{{url:kryptonite.user.register}}" class="user">
                            <i class="fa fa-user-plus"></i>
                            <span>Inscription</span>
                        </a>
					<gc:else/>
						 <a href="{{url:kryptonite.user.logout}}" class="user">
							<i class="fa fa-sign-out"></i>
							<span>Déconnexion</span>
						 </a>
					</gc:if>
				</div>
			</header>
		</div>
	</body>
	<div id="main">
	    <gc:if condition="isset($request) && count($request->errors()) > 0">
            <div class="alert alert-error">
                <gc:foreach var="$request->errors()" as="$errors">
                    <div><strong>{$errors['field']}</strong> : {$errors['message']}</div>
                </gc:foreach>
            </div>
        </gc:if>
        <gc:if condition="isset($_SESSION['flash']) && $_SESSION['flash'] != ''">
            <div class="alert alert-success">
                <div class="close" onclick="closeFlashMessage(this);"><span class="fa fa-times">&nbsp;</span> </div>
                {$_SESSION['flash']}
                {{php: $_SESSION['flash'] = ''; }}
            </div>
        </gc:if>
		<gc:child/>
	</div>
	<footer>
		<div class="block about">
			<p>Touts droits réservés</p>
		</div>
		<div class="block info">
			<div class="social">
				<a href=""><span class="fa fa-facebook-square"></span></a>
				<a href=""><span class="fa fa-twitter-square"></span></a>
				<a href=""><span class="fa fa-google-plus-square"></span></a>
			</div>
		</div>
		<div class="clear"></div>
	</footer>
	<script type="text/javascript" src="/web/kryptonite/js/script.js"></script>
</html>