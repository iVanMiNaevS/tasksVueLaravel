<script setup>
import { RouterLink, RouterView, useRoute } from "vue-router";
import Navigation from "./components/Navigation.vue";

</script>

<template>
	<div class="d-flex h-100">
		<Navigation v-if="!$route.meta.hideNavigation" />
		<RouterView />
	</div>
</template>

<style scoped></style>
