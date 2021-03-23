<template>
	<div>
		<div class="container">
			<h3 class="text-center mt-4">Register</h3>
			<form v-on:submit.prevent="register">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" id="name" v-bind:class="{'is-invalid': errors.name.length}" placeholder="Enter Name" class="form-control" v-model="user.name">
					<div class="invalid-feedback" v-for="name in errors.name">{{name}}</div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" id="email" v-bind:class="{'is-invalid': errors.email.length}" placeholder="Enter Email" class="form-control" v-model="user.email">
					<div class="invalid-feedback" v-for="email in errors.email">{{email}}</div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" v-bind:class="{'is-invalid': errors.password.length}" placeholder="Enter Password" class="form-control" v-model="user.password">
					<div class="invalid-feedback" v-for="password in errors.password">{{password}}</div>
				</div>
				<button type="submit" class="btn btn-outline-primary">Register</button>
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
					name: '',
					email: '',
					password: ''
				},
				errors: {
					name: [],
					email: [],
					password: []
				}
			}
		},
		methods: {
			register(){
				axios
					.post('/api/register',{
						name: this.user.name,
						email: this.user.email,
						password: this.user.password
					})
					.then(res => {
						console.log(res)
						store.dispatch('AUTH_LOGIN',res.data)
						this.$router.push({name: 'user.index'})
						this.flashSuccess('Registration Successful!')
					})
					.catch(err => {
						console.log(err.response)
						if(err.response.status == 422){
							let errors = err.response.data.errors
							this.errors.name = errors.name || []
							this.errors.email = errors.email || []
							this.errors.password = errors.password || []
						}
					})
			}
		}
	}
</script>