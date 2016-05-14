<gc:extends file="main"/>
<h1 class="standalone-title">Mon compte</h1>
<div class="home-start">
	<gc:include file="user/home-include"/>
</div>
<div class="home-content">
	{{php: $i = 0;}}
	<gc:foreach var="$enigmas" as ="$key => $enigma">
		<gc:if condition="$enigma->finished == 1">
			{{php: $i++;}}
			<div class="enigma">
				<div class="logo">
					<img src="/{$enigma->enigma->logo}"/>
				</div>
				<div class="description">
					<span>{$enigma->enigma->title}</span>
				</div>
				<div class="clear"> </div>
			</div>
		</gc:if>
	</gc:foreach>
	<gc:if condition="$i == 0">
		<h2 class="empty">Aucune énigme</h2>
	</gc:if>
</div>