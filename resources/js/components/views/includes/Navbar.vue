<template>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container">
			<router-link :to="{name: 'home'}" class="navbar-brand">TodoApp</router-link>
			<button class="navbar-toggler" data-target="#menu" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="menu">
				<ul class="navbar-nav">
					<li class="nav-item">
						<router-link :to="{name: 'todos.index'}" class="nav-link">Todos</router-link>
					</li>
					<li class="nav-item">
						<router-link :to="{name: 'todos.create'}" class="nav-link">New Todo</router-link>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>