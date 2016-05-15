{gc:extends file="main"/}
<h1 class="standalone-title">Réglages</h1>
<div class="page">
    <div class="content">
        <form method="post" action="{{url:kryptonite.user.account}}">
            <input type="hidden" name="request-put"/>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" value="{$username}"/><br />
            <label for="username">Email</label>
            <input type="email" name="email" value="{$email}"/><br />
            <label for="password">Mot de passe</label>
            <input type="password" name="password" value=""/><br />
            <input type="submit" name="form-account" value="Mettre à jour" />
        </form>
    </div>
</div>