import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		//get token from localStorage else set it to null
		token: localStorage.getItem('token') || null
	},
	getters: {
		isAuthenticated: state =>  !!state.token
	},
	mutations: {
		LOGIN_SUCCESS(state,token){
			state.token = token
		},
		LOGOUT_SUCCESS(state){
			state.token = null
		}
	},
	actions: {
		AUTH_LOGIN({commit,state},token){
			commit('LOGIN_SUCCESS',token)
			localStorage.setItem('token',token);
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
		},
		AUTH_LOGOUT({commit}){
			commit('LOGOUT_SUCCESS')
			localStorage.removeItem('token')
			delete axios.defaults.headers.common['Authorization']
		}
	}
})