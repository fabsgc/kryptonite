<gc:extends file="main"/>
<form method="post" action="">
	<input type="hidden" name="form-enigma"/>
	<input type="hidden" name="enigma.category.id" value="{$category->id}"/>
	<label for="enigma.title">Titre</label>
	<input type="text" id="enigma.title" name="enigma.title" value="{$request->title}"/><br />
	<label for="enigma.logo">Logo</label>
	<input type="text" id="enigma.logo" name="enigma.logo" value="{$request->logo}"/><br />
	<label for="enigma.answer">Réponse</label>
    <input type="text" id="enigma.answer" name="enigma.answer" value="{$request->answer}"/><br />
	<textarea id="enigma.description" name="enigma.description" placeholder="Description">{$request->description}</textarea><br/>
	<input type="submit" value="Enregistrer"/>
</form>