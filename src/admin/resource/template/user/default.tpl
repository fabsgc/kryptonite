<gc:extends file="main"/>
<a href="{{url:admin.user.new:$_SESSION['admin']['token']}}" class="button right">Nouvel utilisateur</a>
<table class="table">
	<thead>
		<tr>
			<th class="icon">&nbsp;</th>
			<th>Nom d'utilisateur</th>
			<th>Email</th>
			<th class="action">Actions</th>
		<tr>
	</thead>
	<tbody>
		<gc:if condition="$users->count() >0">
			<gc:foreach var="$users" as="$user">
				<tr>
					<td class="icon"><img src="/{$user->avatar}" alt="icône"/></td>
					<td>{$user->username}</td>
					<td>{$user->email}</td>
					<td class="action">
						<a href="{{url:admin.user.edit:$user->id,$_SESSION['admin']['token']}}"><span class="fa fa-pencil">&nbsp;</span></a>
						<a href="{{url:admin.user.delete:$user->id,$_SESSION['admin']['token']}}"><span class="fa fa-times">&nbsp;</span></a>
					</td>
				</tr>
			</gc:foreach>
		<gc:else/>
			<tr>
				<td colspan="3" class="empty">Aucun utilisateur</td>
			</tr>
		</gc:if>
	<tbody>
</table>