{gc:extends file="main"/}
<form method="post" action="">
	<input type="hidden" name="form-enigma"/>
	<input type="hidden" name="enigma.category" value="{$category->id}"/>
	<label for="enigma.title">Titre</label>
	<input type="text" id="enigma.title" name="enigma.title" value="{$request->title}"/><br />
	<label for="enigma.logo">Logo</label>
	<input type="text" id="enigma.logo" name="enigma.logo" value="{$request->logo}"/><br />
	<label for="enigma.answer">Réponse</label>
	<input type="text" id="enigma.points" name="enigma.answer" value="{$request->points}"/><br />
    <label for="enigma.points">Nombre de points</label>
    <input type="text" id="enigma.answer" name="enigma.points" value="{$request->answer}"/><br />
    <label for="enigma.child">Enigme suivante</label>
    <select id="enigma.child" name="enigma.child">
        <option value="">Aucune</option>
        {gc:foreach var="$enigmas" as="$enigm"}
            <option value="{$enigm->id}" {gc:if condition="$request->child != null && $request->child->id == $enigm->id"} selected="selected" {/gc:if}>{$enigm->title}</option>
        {/gc:foreach}
    </select><br />
	<textarea id="enigma.description" name="enigma.description" placeholder="Description">{$request->description}</textarea><br/>
	<input type="submit" value="Enregistrer"/>
</form>