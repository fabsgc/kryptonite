{gc:extends file="main"/}
<h1 class="standalone-title">{$title}</h1>
<div class="standalone-form">
    <form method="post" action="{{url:kryptonite.user.register}}">
        <div class="line">
            {gc:call template="displayErrorsForm($form->errors(), 'username')"/}
            <i class="fa fa-user"></i>
            <input type="text" name="username" placeholder="Nom d'utilisateur" value="{$username}"/>
        </div>
        <div class="line">
            {gc:call template="displayErrorsForm($form->errors(), 'email')"/}
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" value="{$email}"/>
        </div>
        <div class="line">
            {gc:call template="displayErrorsForm($form->errors(), 'password')"/}
            <i class="fa fa-lock"></i>
            <input type="password" name="password" placeholder="Mot de passe" value=""/>
        </div>
        <div class="line">
            {gc:call template="displayErrorsForm($form->errors(), 'role')"/}
            <i class="fa fa-child"> </i>
            <select name="role">
                {gc:foreach var="$roles" as="$key => $value"}
                    <option value="{$key}" {gc:if condition="$role == $key"}{/gc:if}> {$value}</option>
                {/gc:foreach}
            </select><br />
        </div>
        <div class="line">
            <input type="submit" name="form-register" value="Inscription" />
        </div>
    </form>
</div>