<gc:extends file="main"/>
<h1 class="standalone-title">Mon compte</h1>
<div class="home-start">
<gc:include file="user/home-include"/>
</div>
<div class="home-content">
	<gc:if condition="$successes->count() > 0">
		<gc:foreach var="$successes" as ="$success">
			<div class="success">
				<div class="logo">
					<img src="{$success->success->logo}"/>
				</div>
				<div class="description">{$success->success->title}</div>
			</div>
		</gc:foreach>
	<gc:else/>
		<h2 class="empty">Aucun badge</h2>
	</gc:if>
	<div class="clear"> </div>
</div>