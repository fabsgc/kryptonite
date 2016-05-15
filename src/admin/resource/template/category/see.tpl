{gc:extends file="main"/}
<a href="{{url:admin.enigma.new:$category->id,$_SESSION['admin']['token']}}" class="button right">Nouvelle énigme</a>
<table class="table">
	<thead>
		<tr>
			<th class="icon">&nbsp;</th>
			<th>Titre</th>
			<th class="action">Actions</th>
		<tr>
	</thead>
	<tbody>
		{gc:if condition="$category->enigmas->count() > 0"}
			{gc:foreach var="$category->enigmas" as="$enigma"}
				<tr>
					<td class="icon"><img src="/{$enigma->logo}" alt="icône"/></td>
					<td>{$enigma->title}</td>
					<td class="action">
						<a href="{{url:admin.enigma.edit:$enigma->id,$_SESSION['admin']['token']}}"><span class="fa fa-pencil">&nbsp;</span></a>
						<a href="{{url:admin.enigma.delete:$enigma->id,$_SESSION['admin']['token']}}"><span class="fa fa-times">&nbsp;</span></a>
					</td>
				</tr>
			{/gc:foreach}
		{gc:else/}
			<tr>
				<td colspan="3" class="empty">Aucune énigme</td>
			</tr>
		{/gc:if}
	<tbody>
</table>