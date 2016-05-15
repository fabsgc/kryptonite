{gc:extends file="main"/}
<h1 class="standalone-title">Nouvel élève</h1>
<div class="home-start">
	{gc:include file="user/home-include"/}
</div>
<div class="home-content">
    <form method="post" action="{{url:kryptonite.student.create}}">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" value="{$username}"/><br />
        <label for="username">Email</label>
        <input type="email" name="email" value="{$email}"/><br />
        <input type="submit" name="form-student" value="Créer" />
    </form>
</div>