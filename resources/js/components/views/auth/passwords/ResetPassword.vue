<template>
	<div class="container">
		<h3 class="text-center my-4">Reset Your Password</h3>
		<form v-on:submit.prevent="resetPassword">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" v-bind:class="{'is-invalid': errors.email.length}" id="email" placeholder="Enter email" v-model="user.email" class="form-control">
				<div class="invalid-feedback" v-for="email in errors.email">{{email}}</div>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" v-bind:class="{'is-invalid': errors.password.length}" id="password" placeholder="Enter password" v-model="user.password" class="form-control">
				<div class="invalid-feedback" v-for="password in errors.password">{{password}}</div>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password_confirmation" placeholder="Enter password" v-model="user.password_confirmation" class="form-control">
			</div>
			<button class="btn btn-outline-success">Reset Password</button>
		</form>
	</div>
</template>

<script>
	export default{
		created(){
			this.user.token = this.$route.params.token;
		},
		data(){
			return {
				user:{
					token: '',
					email: '',
					password: '',
					password_confirmation: ''
				},
				errors:{
					email: [],
					password: []
				},
				isLoading: false
			}
		},
		methods:{
			resetPassword(){
				this.isLoading = true
				axios
					.post('/api/password/reset',{
						token: this.user.token,
						email: this.user.email,
						password: this.user.password,
						password_confirmation: this.user.password_confirmation
					})
					.then(res => {
						this.isLoading = false
						if(res.status == 200){
							this.$router.push({name: 'login'})
							this.flashSuccess('Password reset successful!')
						}
					})
					.catch(err => {
						console.error(err.response.data)
						if(err.response.status == 422){
							let errors = err.response.data.errors;
							this.errors.email = errors.email || []
							this.errors.password = errors.password || []
						}
					})
			}
		}
	}
</script>