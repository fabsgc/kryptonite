{gc:include file="include/functions"/}
<html>
	<head>
		<title>{$title} - MazeMind</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>{$title} - Kryptonite</title>
		<link rel="icon" type="image/png" href="/{{path:IMAGE:app}}icon.png" />
		{gc:asset type="css" files="web/app/css/default.css,web/kryptonite/css/default.css,web/app/file/font-awesome/css/font-awesome.min.css" cache="5"/}
		<script type="text/javascript" src="/{{path:JS:app}}jquery-1.11.2.min.js"></script>
	</head>
	<body>
		<div id="root">
			<header>
				<div class="left">
					<a href="/">
					    <img src="/{{path:IMAGE:app}}logo.png"/>
						<h1>
							azeMind
						</h1>
					</a>
				</div>
				<div class="middle">
					<nav>

					</nav>
				</div>
				<div class="right">
					{gc:if condition="empty($_SESSION['kryptonite']['logged'])"}
						<a href="{{url:kryptonite.user.login}}" class="user">
							<i class="fa fa-user">&nbsp;</i>
							<span>Connexion</span>
						</a>
						<a href="{{url:kryptonite.user.register}}" class="user">
                            <i class="fa fa-user-plus">&nbsp;</i>
                            <span>Inscription</span>
                        </a>
					{gc:else/}
						<a href="{{url:kryptonite.user.logout}}" class="user">
							<i class="fa fa-sign-out">&nbsp;</i>
							<span>Déconnexion</span>
						</a>
						<a href="{{url:kryptonite.user.account}}" class="user">
							<i class="fa fa-cog">&nbsp;</i>
							<span>Réglages</span>
						</a>
						<a href="{{url:kryptonite.category.browse}}" class="user">
							<i class="fa fa-th-list">&nbsp;</i>
							<span>Parcourir</span>
						</a>
					{/gc:if}
				</div>
			</header>

			{{php:
				$namesRequest = [
					'kryptonite.user.default',
					'kryptonite.user.home-finished',
					'kryptonite.user.home-successes',
					'kryptonite.user.home-students',
					'kryptonite.user.home',
					'kryptonite.student.create',
					'kryptonite.student.createSave',
					'kryptonite.student.update',
					'kryptonite.student.updateSave',
					'kryptonite.user.suscribe',
					'kryptonite.user.suscribeSave',
					'kryptonite.user.suscribeStudent',
					'kryptonite.user.suscribeStudentSave'
				];

				$nameRequest = \System\Request\Request::instance()->name;
			}}

			<div id="main" {gc:if condition="in_array($nameRequest,$namesRequest)"}class="main-home"{/gc:if}>
				<div class="content">
					{gc:if condition="isset($request) && count($request->errors()) > 0"}
                        <div class="alert alert-error">
                            {gc:foreach var="$request->errors()" as="$errors"}
                                <div><strong>{$errors['field']}</strong> : {$errors['message']}</div>
                            {/gc:foreach}
                        </div>
                    {/gc:if}
					{gc:if condition="isset($_SESSION['flash']) && $_SESSION['flash'] != ''"}
						<div id="flash-message">
							<div class="alert alert-success">
								<div class="close" onclick="closeFlashMessage(this);"><span class="fa fa-times">&nbsp;</span></div>
								{$_SESSION['flash']}
								{{php: $_SESSION['flash'] = ''; }}
							</div>
						</div>
					{/gc:if}
					{gc:child/}
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