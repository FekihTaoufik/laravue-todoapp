<template>	
	<div>
		<h3 class="text-center my-4">Create a new Todo</h3>
		<form v-on:submit.prevent="createTodo">
			<div class="form-group">
				<label for="name">Todo Name</label>
				<input type="text" class="form-control" v-bind:class="{'is-invalid': errors.name.length}" v-model="todo.name" id="name" placeholder="Enter Todo Name">
				<div class="invalid-feedback" v-for="(error) in errors.name">{{error}}</div>
			</div>
			<div class="form-group">
				<label for="description">Todo Description</label>
				<textarea class="form-control" id="description" v-bind:class="{'is-invalid': errors.description.length}" v-model="todo.description" placeholder="Enter Description"></textarea>
				<div class="invalid-feedback" v-for="(error) in errors.description">{{error}}</div>
			</div>
			<button type="submit" class="btn btn-outline-primary">Create Todo</button>
		</form>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				todo: {
					name: '',
					description: ''
				},

				//validation errors
				errors: {
					name: [],
					description: []
				},

				msg: ''
			}
		},
		methods: {
			createTodo(){
				axios
					.post('/api/todos',{
						name: this.todo.name,
						description: this.todo.description
					})
					.then(res => {
						// console.log(res)
						if(res.status == 201){
							this.flashSuccess(res.data.msg)
							this.$router.push('/todos')
						}
					})
					.catch(err => {
						console.log(err.response)
						if(err.response.status == 422){
							const errors = err.response.data.errors
							this.errors.name = errors.name || []
							this.errors.description = errors.description || []
						}
					})
			}
		}
	}
</script>