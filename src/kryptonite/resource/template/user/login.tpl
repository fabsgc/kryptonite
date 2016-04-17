<gc:extends file="main"/>
<h1 class="standalone-title">{$title}</h1>
<div class="standalone-form">
    <form method="post" action="{{url:kryptonite.user.login}}">
        <div class="line">
            <gc:call template="displayErrorsForm($form->errors(), 'username')"/>
            <i class="fa fa-user"></i>
            <input type="text" name="username" placeholder="Nom d'utilisateur" value="{$username}"/>
        </div>
        <div class="line">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" placeholder="Mot de passe" value=""/>
        </div>
        <div class="line">
            <input type="submit" name="form-login" value="Connexion" />
        </div>
    </form>
</div>