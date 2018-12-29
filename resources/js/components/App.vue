<template>
	<div>
		<Navbar/>
		<flash-message class="flash-msg" transitionName="list"></flash-message>
		<div class="container">
			<router-view/>
		</div>
		<Footer/>
	</div>
</template>

<script>
	import Navbar from './views/includes/Navbar'
	import Footer from './views/includes/Footer'

	export default {
		components: {
			Navbar,
			Footer
		}
	}
</script>

<style>
	.flash-msg{
		z-index: 99;
		position: fixed;
		top: 30px;
		right: 18px;
		min-width:30%;
	}

	/* Transition css for flash messages */
	.list-item {
	  display: inline-block;
	  margin-right: 10px;
	}
	.list-enter-active, .list-leave-active {
	  transition: all 1s;
	}
	.list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
	  opacity: 0;
	  transform: translateY(60px);
	}
</style>