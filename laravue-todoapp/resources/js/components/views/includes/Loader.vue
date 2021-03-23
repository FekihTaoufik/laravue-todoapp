<template>
	<div class="d-flex justify-content-center my-5" v-if="isLoading">
	  	<div class="spinner-border text-secondary" role="status" aria-hidden="true"></div>
	</div>
</template>

<script>
	export default {
		props: {
			isLoading: Boolean
		}
	}
</script>