<h3>Bonjour {$user->username}</h3>
<p>
    {gc:if condition="$password != '*****'"}
	    Ton professeur {$user->parent->username} vient de t'inscrire sur MazeMind.com avec les identifiants suivants :
	{gc:else/}
        Ton professeur {$user->parent->username} a modifié ton compte sur MazeMind.com. Voici tes nouveaux identifiants :
	{/gc:if}
	<ul>
		<li>Nom d'utilisateur : {$user->username}</li>
		<li>Mot de passe : {$password}</li>
	</ul>
</p>
<p>Pour finaliser ton inscription, clique sur le lien suivant : <a href="{{url[absolute]:kryptonite.user.activate:$user->token}}">activer mon compte</a><p>
<br />
<p>L'équipe de MazeMind</p>