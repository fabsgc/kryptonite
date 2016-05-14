<gc:extends file="main"/>
<h1 class="standalone-title">Mon compte</h1>
<div class="home-start">
<gc:include file="user/home-include"/>
</div>
<div class="home-content">
	<a href="{{url:kryptonite.student.create}}" class="button right">Nouve élève</a>
	<div class="clear"> </div>
	<gc:if condition="$students->count() > 0">
		<gc:foreach var="$students" as ="$key => $student">
			<div class="enigma">
				<div class="logo">
					<img src="/{$student->avatar}"/>
				</div>
				<div class="description">
					<span>{$student->username}</span>
					<div class="go">
						<a href="{{url:kryptonite.student.delete:$student->id}}">
							<span class="fa fa-times"></span>
						</a>
					</div>
					<div class="go">
						<a href="{{url:kryptonite.student.update:$student->id}}">
							<span class="fa fa-pencil"></span>
						</a>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</gc:foreach>
	<gc:else/>
		<h2 class="empty">Aucun élève</h2>
	</gc:if>
	<div class="clear"> </div>
</div>