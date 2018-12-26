<template>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container">
			<router-link :to="{name: 'home'}" class="navbar-brand">TodoApp</router-link>
			<button class="navbar-toggler" data-target="#menu" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</nav>
</template>