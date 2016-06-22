{gc:extends file="main"/}
<h1 class="standalone-title">{$enigma->title}</h1>
<div class="page">
    <div class="enigme">
		{$enigma->description}
	</div>
	<div class="answer">
	    <form action="" method="post">
            <input type="text" name="answer" placeholder="Votre réponse">
            <input type="submit" placeholder="Valider">
        </form>
    </div>
</div>