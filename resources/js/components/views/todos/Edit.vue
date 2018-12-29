<template>	
	<div>
		<h3 class="text-center my-4">Update Todo</h3>
		<form v-on:submit.prevent="updateTodo">
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
			<button type="submit" class="btn btn-outline-primary">Update Todo</button>
		</form>
	</div>
</template>

<script>
	export default {
		created: function(){
			const id = this.$route.params.id
			this.getTodo(id)
		},
		data() {
			return {
				todo: {
					id: 0,
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
			getTodo(id){
				axios
					.get(`/api/todos/${id}`)
					.then(res => {
						const todo = res.data.todo
						this.todo.id = todo.id
						this.todo.name = todo.name
						this.todo.description = todo.description
					})
					.catch(err => console.log(err))
			},
			updateTodo(){
				axios
					.put(`/api/todos/${this.todo.id}`,{
						name: this.todo.name,
						description: this.todo.description
					})
					.then(res => {
						// console.log(res)
						if(res.status == 200){
							this.flashSuccess('Todo Updated!')
							this.$router.push(`/todos/${this.todo.id}`)	
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