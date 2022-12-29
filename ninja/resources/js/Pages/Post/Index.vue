<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
	posts: Array,
});
</script>

<template>
	<AppLayout title="Profile">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Posts
			</h2>
		</template>

		<div>
			<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">


			</div>
		</div>
	</AppLayout>
</template>
