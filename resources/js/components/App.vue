<template>
	<div>
		<Navbar/>
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