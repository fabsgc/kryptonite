{gc:extends file="main"/}
<form method="post" action="">
	<input type="hidden" name="request-put"/>
	<input type="hidden" name="form-enigma"/>
	<input type="hidden" name="enigma.id" value="{$request->id}"/>
	<input type="hidden" name="enigma.category" value="{$request->category->id}"/>
	<label for="enigma.title">Titre</label>
	<input type="text" id="enigma.title" name="enigma.title" value="{$request->title}"/><br />
	<label for="enigma.logo">Logo</label>
	<input type="text" id="enigma.logo" name="enigma.logo" value="{$request->logo}"/><br />
	<label for="enigma.answer">Réponse</label>
	<input type="text" id="enigma.points" name="enigma.points" value="{$request->points}"/><br />
    <label for="enigma.points">Nombre de points</label>
    <input type="text" id="enigma.answer" name="enigma.answer" value="{$request->answer}"/><br />
    <label for="enigma.child">Enigme suivante</label>
    <select id="enigma.child" name="enigma.child">
        <option value="">Aucune</option>
        {gc:foreach var="$enigmas" as="$enigm"}
            <option value="{$enigm->id}" {gc:if condition="$request->child != null && $request->child->id == $enigm->id"} selected="selected" {/gc:if}>{$enigm->title}</option>
        {/gc:foreach}
    </select><br />
    <label for="enigma.first">Première</label>
    <select id="enigma.first" name="enigma.first">
        <option value="0">Non</option>
        <option value="1" {gc:if condition="$request->first == 1"} selected="selected" {/gc:if}>Oui</option>
    </select><br />
	<textarea id="enigma.description" name="enigma.description" placeholder="Description">{$request->description}</textarea><br/>
	<input type="submit" value="Enregistrer"/>
</form>