import VueRouter from 'vue-router'
import Home from '../views/home/Index'
import TodoIndex from '../views/todos/Index'
import TodoShow from '../views/todos/Show'
import TodoEdit from '../views/todos/Edit'
import TodoCreate from '../views/todos/Create'

const routes = [
	{
		name: 'home',
		path: '/',
		component: Home
	},
	{
		name: 'todos.index',
		path: '/todos',
		component: TodoIndex
	},
	{
		name: 'todos.create',
		path: '/todos/create',
		component: TodoCreate
	},
	{
		name: 'todos.edit',
		path: '/todos/:id/edit',
		component: TodoEdit
	},
	{
		name: 'todos.show',
		path: '/todos/:id',
		component: TodoShow
	}
];


export default new VueRouter({
	mode: 'history',
	routes: routes
});