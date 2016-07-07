<!DOCTYPE html>
<html style="opacity:0;">
	<head>
		<meta charset="utf-8" />
		<title>{$title} - MazeMind</title>
		<link rel="icon" type="image/png" href="/{{path:IMAGE:app}}icon.png" />
		{gc:asset type="css" files="web/admin/css/default.css,web/app/css/default.css,web/app/file/font-awesome/css/font-awesome.min.css" cache="5"/}
		<script type="text/javascript" src="/web/app/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="/web/admin/js/default.js"></script>
	</head>
	<body id="body">
		<header class="default">
			<div id="header-left">
				<img src="/{{path:IMAGE:app}}logo.png"/>
			</div>
			<div id="header-right">
				<div class="right-account">
					<div id="logout" class="account-logout">
						<i class="fa fa-sign-out"></i>
					</div>
					<div class="account-profile">
						<div class="profile-username">
							{$_SESSION['admin']['username']}
						</div>
						<div class="profile-avatar">
							<img src="/{{path:IMAGE:app}}/avatar/default.png"/>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"/>
		</header>
		<div id="side-menu">
			<ul>
			    {{php: use System\Request\Request }}
				<li {gc:if condition="Request::instance()->controller == 'index'"} class="active" {/gc:if}>
					<a href="{{url:admin.index.default}}">
						<i class="fa fa-home"></i>
						<span class="title">Accueil</span>
					</a>
				</li>
				<li {gc:if condition="Request::instance()->controller == 'manager'"} class="active" {/gc:if}>
					<a href="{{url:admin.manager.default}}">
						<i class="fa fa-user-times"></i>
						<span class="title">Managers</span>
					</a>
				</li>
				<li {gc:if condition="Request::instance()->controller == 'user'"} class="active" {/gc:if}>
					<a href="{{url:admin.user.default}}">
						<i class="fa fa-users"></i>
						<span class="title">Utilisateurs</span>
					</a>
				</li>
				<li {gc:if condition="Request::instance()->controller == 'enigma' || Request::instance()->controller == 'Category'"} class="active" {/gc:if}>
                    <a href="{{url:admin.category.default}}">
                        <i class="fa fa-university"></i>
                        <span class="title">Enigmes</span>
                    </a>
                </li>
				<li {gc:if condition="Request::instance()->controller == 'success'"} class="active" {/gc:if}>
					<a href="{{url:admin.success.default}}">
						<i class="fa fa-gamepad"></i>
						<span class="title">Badges</span>
					</a>
				</li>
                <li {gc:if condition="Request::instance()->controller == 'payment'"} class="active" {/gc:if}>
                    <a href="{{url:admin.payment.default}}">
                        <i class="fa fa-credit-card"></i>
                        <span class="title">Paiements</span>
                    </a>
                </li>
                <li {gc:if condition="Request::instance()->controller == 'upload'"} class="active" {/gc:if}>
                    <a href="{{url:admin.upload.default}}">
                        <i class="fa fa-cloud"></i>
                        <span class="title">Upload</span>
                    </a>
                </li>
			</ul>
		</div>
		<div id="main">
		    {gc:if condition="Request::instance()->controller == 'index'"}
		        <h2>{$title}</h2>
		    {/gc:if}
            <div id="fil-ariane">
                <ul>
                    <?php
                        if(empty($filAriane))
                        {
                            $filAriane = array('Accueil');
                        }
                        else
                        {
                            $filAriane = array_merge(['Accueil'], $filAriane);
                        }
                    ?>
                    {gc:foreach var="$filAriane" as="$key => $value"}
                        <li>
                            {$value}
                        </li>
                        {gc:if condition="count($filAriane) > 1 && $key < count($filAriane)-1"}
                            <span class="fa fa-chevron-right">&#160;</span>
                        {/gc:if}
                    {/gc:foreach}
                </ul>
            </div>
            {gc:if condition="isset($request) && count($request->errors()) > 0"}
            	<div class="alert alert-error">
            	    {gc:foreach var="$request->errors()" as="$errors"}
                		<div><strong>{$errors['field']}</strong> : {$errors['message']}</div>
                	{/gc:foreach}
            	</div>
            {/gc:if}
            {gc:if condition="isset($_SESSION['flash']) && $_SESSION['flash'] != ''"}
            	<div class="alert alert-success">
            		<div class="close" onclick="closeFlashMessage(this);"><span class="fa fa-times">&nbsp;</span> </div>
            		{$_SESSION['flash']}
            		{{php: $_SESSION['flash'] = ''; }}
            	</div>
            {/gc:if}
            {gc:child/}
        </div>
        <footer>

        </footer>
	</body>
</html>