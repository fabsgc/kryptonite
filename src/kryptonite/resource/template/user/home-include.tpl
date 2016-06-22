{{php:
    $user = \Orm\Entity\User::find()
        ->vars('id', $_SESSION['kryptonite']['id'])
        ->where('User.id = :id')->fetch()->first();

    $enigmas = \Orm\Entity\EnigmaUser::find()
        ->vars('id', $_SESSION['kryptonite']['id'])
        ->where('EnigmaUser.user = :id')->fetch();

    $enigmasTotal = \Orm\Entity\Enigma::count()->fetch();
}}
<div class="home-progress">
	{{php:
		$percent = round(($enigmas->count()) / ($enigmasTotal + 13) * 100, 1);
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
			$tabs = '20';
		}
		else{
			$tabs = '25';
		}

		$arrayStudents = [
		    'kryptonite.user.home-students',
		    'kryptonite.student.create',
		    'kryptonite.student.createSave',
		    'kryptonite.student.update',
		    'kryptonite.student.updateSave',
		];

		$arraySuscribes = [
		     'kryptonite.user.suscribe',
		     'kryptonite.user.suscribeSave'
		];
	}}
	<a href="{{url:kryptonite.user.default}}" class="tab {gc:if condition="$nameRequest == 'kryptonite.user.default'"}activated{/gc:if} tab-{$tabs}"}>En cours</a>
	<a href="{{url:kryptonite.user.home-finished}}" class="tab {gc:if condition="$nameRequest == 'kryptonite.user.home-finished'"}activated{/gc:if} tab-{$tabs}"}>Terminées</a>
	<a href="{{url:kryptonite.user.home-successes}}" class="tab {gc:if condition="$nameRequest == 'kryptonite.user.home-successes'"}activated{/gc:if} tab-{$tabs}"}>Badges</a>
	{gc:if condition="$tabs == '20'"}
		<a href="{{url:kryptonite.user.home-students}}" class="tab {gc:if condition="in_array($nameRequest, $arrayStudents)"}activated{/gc:if} tab-{$tabs}"}>Mes élèves</a>
	{/gc:if}
	<a href="{{url:kryptonite.user.suscribe}}" class="tab {gc:if condition="in_array($nameRequest, $arraySuscribes)"}activated{/gc:if} tab-{$tabs}"}>Abonnement</a>
</div>