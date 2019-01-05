<template>
	<div class="card my-4">
		<div class="card-body">
			<h3 class="card-title text-center">{{todo.name}}</h3>
			<p class="card-text">{{todo.description}}</p>
			<div class="d-flex justify-content-center" v-if="authenticated">
				<router-link :to="{name: 'todos.edit',params: {id: todo.id}}" class="btn btn-outline-warning">UPDATE</router-link>
				<button class="btn btn-outline-danger ml-2" @click="deleteTodo">DELETE</button>
			</div>
		</div>
	</div>
</template>

<script>
	import store from '../../../store/Index'
	import { mapGetters } from 'vuex'
	export default {
		created: function() {
			this.getTodo()
		},
		computed:{
			authenticated(){
				return store.getters.isAuthenticated
			}
		},
		data() {
			return {
				todo: {
					id: 0,
					name: '',
					description: ''
				}
			}
		},
		methods: {
			getTodo(){
				const id = this.$route.params.id;
				axios
					.get(`/api/todos/${id}`)
					.then(res => {
						// console.log(res.data)
						const todo = res.data.todo
						this.todo.name = todo.name
						this.todo.description = todo.description
						this.todo.id = todo.id
					})
					.catch(err => console.error(err))
			},
			deleteTodo(){
				axios
					.delete(`/api/todos/${this.todo.id}`)
					.then(res => {
						if(res.status == 200){
							this.flashSuccess(res.data.msg)
							this.$router.push('/todos')
						}
						
					})
					.catch(err => console.log(err))
			}
		}
	}
</script>