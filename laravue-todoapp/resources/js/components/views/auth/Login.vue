<template>
	<div>
		<div class="container">
			<h3 class="text-center mt-4">Login</h3>
			<form v-on:submit.prevent="login">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" id="email" v-bind:class="{'is-invalid': errors.email.length}" v-model="user.email" placeholder="Enter Email" class="form-control">
					<div class="invalid-feedback" v-for="email in errors.email">{{email}}</div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" v-bind:class="{'is-invalid': errors.password.length}" v-model="user.password" placeholder="Enter password" class="form-control">
					<div class="invalid-feedback" v-for="password in errors.password">{{password}}</div>
				</div>
				<button type="submit" class="btn btn-outline-primary">Login</button>
				<router-link class="btn btn-outline-success" :to="{name: 'password.email'}">Forgot Password</router-link>
			</form>
		</div>
	</div>
</template>

<script>
	import store from '../../../store/Index'
	
	export default {
		data(){
			return {
				user: {
					email: '',
					password: ''
				},
				errors: {
					email: [],
					password: []
				}
			}
		},
		methods: {
			login(){
				axios
					.post('/api/login',{
						email: this.user.email,
						password: this.user.password
					})
					.then(res => {
						store.dispatch('AUTH_LOGIN',res.data)
						this.$router.push({name: 'user.index'})
						this.flashSuccess('You are logged in!')
						
					})
					.catch(err => {
						console.log(err.response)
						if(err.response.status == 422){
							let errors = err.response.data.errors
							this.errors.email = errors.email || []
							this.errors.password = errors.password || []
						}
						if(err.response.status == 400){
							this.error('Invalid Credentials!','error')
						}
					})
			}
		}
	}
</script>