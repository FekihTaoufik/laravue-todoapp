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
				<ul class="navbar-nav ml-auto">
					<li class="nav-item" v-if="!authenticated">
						<router-link :to="{name: 'login' }" class="nav-link">Login</router-link>
					</li>
					<li class="nav-item" v-if="!authenticated">
						<router-link :to="{name: 'register' }" class="nav-link">Register</router-link>
					</li>
					<li class="nav-item dropdown" v-if="authenticated">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dashboard</a>
				        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				        	<router-link :to="{name: 'user.index'}" class="dropdown-item">Dashboard</router-link>
				          	<div class="dropdown-divider"></div>
				          	<a href="#" v-on:click.prevent="logout" class="dropdown-item">Logout</a>
				        </div>
				    </li>
				</ul>
			</div>
		</div>
	</nav>
</template>

<script>
	import store from '../../../store/Index'
	import { mapGetters } from 'vuex'
	export default {
		created: function() {
			console.log(store.state.token)
		},
		computed:{
			authenticated(){
				return store.getters.isAuthenticated
			}
		},
		methods: {
			logout(){
				axios
					.post('/api/logout',{
						token: store.state.token
					})
					.then(res => {
						console.log(res)
						store.dispatch('AUTH_LOGOUT')
						this.$router.push({name: 'home'})
						this.flashSuccess('You are logged out!')
					})
					.catch(err => {
						console.log(err.response)
					})
			}
		}
	}
</script>