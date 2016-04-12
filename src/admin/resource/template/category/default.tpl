<gc:extends file="main"/>
<a href="{{url:admin.category.new:$_SESSION['admin']['token']}}" class="button right">Nouvelle catégorie</a>
<table class="table">
	<thead>
		<tr>
			<th class="icon">&nbsp;</th>
			<th>Titre</th>
			<th class="action">Actions</th>
		<tr>
	</thead>
	<tbody>
		<gc:if condition="$categories->count() >0">
			<gc:foreach var="$categories" as="$category">
				<tr>
					<td class="icon"><img src="/{$category->logo}" alt="icône"/></td>
					<td><a href="{{url:admin.category.see:$category->id}}">{$category->title}</a></td>
					<td class="action">
						<a href="{{url:admin.category.edit:$category->id,$_SESSION['admin']['token']}}"><span class="fa fa-pencil">&nbsp;</span></a>
						<a href="{{url:admin.category.delete:$category->id,$_SESSION['admin']['token']}}"><span class="fa fa-times">&nbsp;</span></a>
					</td>
				</tr>
			</gc:foreach>
		<gc:else/>
			<tr>
				<td colspan="3" class="empty">Aucune énigme</td>
			</tr>
		</gc:if>
	<tbody>
</table>