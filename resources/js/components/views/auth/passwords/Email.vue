<template>
	<div>
		<div class="container">
			<h3 class="text-center mt-4">Login</h3>
			<form v-on:submit.prevent="sendResetEmail">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" id="email" v-bind:class="{'is-invalid': errors.email.length}" v-model="email" placeholder="Enter Email" class="form-control">
					<div class="invalid-feedback" v-for="email in errors.email">{{email}}</div>
				</div>
				<button type="submit" class="btn btn-outline-primary" v-bind:disabled="isLoading">
					<span class="spinner-border spinner-border-sm" role="status" v-if="isLoading" aria-hidden="true"></span>
					<span v-if="!isLoading">Send Password Reset Email</span>
					<span v-if="isLoading">Sending Email...</span>
				</button>
			</form>
		</div>
	</div>
</template>

<script>
	import Loader from '../../includes/Loader'
	export default{
		components:{
			Loader
		},
		data(){
			return {
				email: '',
				errors: {
					email: []
				},
				isLoading: false
			}
		},
		methods: {
			sendResetEmail(){
				this.isLoading = true
				axios
					.post('/api/password/email',{
						email: this.email
					})
					.then(res => {
						console.log(res)
						this.isLoading = false
						if(res.status == 200){
							this.email = ''
							this.flashSuccess('We have sent you reset email!')
						}
					})
					.catch(err => {
						console.error(err)
						this.isLoading = false
						if(err.response.status == 422){
							let errors = err.response.data.errors	
							this.errors.email = errors.email || []
						}
						if(err.response.status == 400){
							this.flashError(err.response.data.status)
						}
						if(err.response.status == 500){
							console.log(err.response.data)
							this.flashError('Error! please try again.')
						}
					})
			}
		}
	}
</script>