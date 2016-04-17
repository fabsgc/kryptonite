<gc:extends file="main"/>
<a href="{{url:admin.manager.new:$_SESSION['admin']['token']}}" class="button right">Nouveau manager</a>
<table class="table">
	<thead>
		<tr>
			<th>Nom d'utilisateur</th>
			<th>Email</th>
			<th class="action">Actions</th>
		<tr>
	</thead>
	<tbody>
		<gc:if condition="$managers->count() >0">
			<gc:foreach var="$managers" as="$manager">
				<tr>
					<td>{$manager->username}</td>
					<td>{$manager->email}</td>
					<td class="action">
						<a href="{{url:admin.user.edit:$manager->id,$_SESSION['admin']['token']}}"><span class="fa fa-pencil">&nbsp;</span></a>
						<a href="{{url:admin.user.delete:$manager->id,$_SESSION['admin']['token']}}"><span class="fa fa-times">&nbsp;</span></a>
					</td>
				</tr>
			</gc:foreach>
		<gc:else/>
			<tr>
				<td colspan="3" class="empty">Aucun manager</td>
			</tr>
		</gc:if>
	<tbody>
</table>