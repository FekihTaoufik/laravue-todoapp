import VueRouter from 'vue-router'
import Home from '../views/home/Index'

const routes = [
	{
		name: 'home',
		path: '/',
		component: Home
	}
];


export default new VueRouter({
	mode: 'history',
	routes: routes
});