{gc:extends file="main"/}
<form method="post" action="">
	<input type="hidden" name="form-category"/>
	<input type="hidden" name="request-put"/>
	<input type="hidden" name="category.id" value="{$request->id}"/>
	<label for="category.title">Titre</label>
	<input type="text" id="category.title" name="category.title" value="{$request->title}"/><br />
	<label for="category.logo">Logo</label>
	<input type="text" id="category.logo" name="category.logo" value="{$request->logo}"/><br />
	<textarea id="category.description" name="category.description" placeholder="Description">{$request->description}</textarea><br/>
	<input type="submit" value="Enregistrer"/>
</form>