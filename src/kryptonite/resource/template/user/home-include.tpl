<div class="home-progress">
	{{php:
		$percent = $enigmas->count() / $enigmasTotal * 100;
	}}
	<div id="progress">
		<div id="progress-bar" style="width:{$percent}%;">
			{$percent}%
		</div>
	</div>
</div>
<div class="home-continue">
	<a href="{{url:kryptonite.enigma.enigma:$user->enigma->id,slugify($user->enigma->title)}}">Continuer !</a>
</div>
<div class="home-tabs">
	{{php:
		if($_SESSION['kryptonite']['role'] == 'TEACHER'){
			$tabs = '25';
		}
		else{
			$tabs = '33';
		}
	}}

	<a href="{{url:kryptonite.user.default}}" class="tab <gc:if condition="$nameRequest == 'kryptonite.user.default'">activated</gc:if> tab-{$tabs}">En cours</a>
	<a href="{{url:kryptonite.user.home-finished}}" class="tab <gc:if condition="$nameRequest == 'kryptonite.user.home-finished'">activated</gc:if> tab-{$tabs}">Terminées</a>
	<a href="{{url:kryptonite.user.home-successes}}" class="tab <gc:if condition="$nameRequest == 'kryptonite.user.home-successes'">activated</gc:if> tab-{$tabs}">Badges</a>
	<gc:if condition="$tabs == '25'">
		<a href="{{url:kryptonite.user.home-students}}" class="tab <gc:if condition="$nameRequest == 'kryptonite.user.home-students'">activated</gc:if> tab-{$tabs}">Mes élèves</a>
	</gc:if>
</div>