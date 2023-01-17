<script setup>
import { useForm, Link, usePage } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const titleInput = ref(null);
const contentInput = ref(null);
const slugInput = ref(null);
const categories = ref({})

const form = useForm({
	title: '',
	content: '',
	slug: '',
	user: usePage().props.value.user.id,
});

const fillSlug = (e) => {
	form.slug=form.title.replaceAll(' ', '-').replace(/[^a-zA-Z0-9 ]/g, "-")
}
const submit = () => {
	form.post(route('posts.store'), {
		errorBag: 'createPost',
		preserveScroll: true,
		onSuccess: () => form.reset(),
		onError: () => {
			if (form.errors.title) {
				form.reset('titleInput');
				titleInput.value.focus();
			}
			if (form.errors.content) {
				form.reset('contentInput');
				contentInput.value.focus();
			}
			if (form.errors.slug) {
				form.reset('slugInput');
				slugInput.value.focus();
			}
		},
	});
};

</script>

<template>
	<AppLayout title="Profile">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				New Post
			</h2>
		</template>
		<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 gap-7 grid grid-cols-3">
			<div class="col-span-2">
				<form class="grid gap-7" @submit.prevent="submit">
					<div class="form-group">
						<InputLabel for="title" value="Title" />
						<TextInput
							id="title"
							ref="titleInput"
							v-model="form.title"
							type="text"
							class="mt-1 block w-full"
							v-on:keyup="fillSlug"
						/>
						<InputError :message="form.errors.title" class="mt-2" />
					</div>

					<div class="form-group">
						<InputLabel for="content" value="Content" />
						<TextInput
							id="content"
							ref="contentInput"
							v-model="form.content"
							type="text"
							class="mt-1 block w-full"
						/>
						<InputError :message="form.errors.content" class="mt-2" />
					</div>

					<div class="form-group">
						<InputLabel for="slug" value="Slug" />
						<TextInput
							id="slug"
							ref="slugInput"
							v-model="form.slug"
							type="text"
							class="mt-1 block w-full"
						/>
						<InputError :message="form.errors.slug" class="mt-2" />
					</div>
					<div class="px-4 py-5 sm:p-6 text-right sm:rounded-lg">
						<Link :href="route('posts.index')">
							<SecondaryButton class="mr-3">
								Cancel
							</SecondaryButton>
						</Link>
						<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
							Save
						</PrimaryButton>
					</div>
				</form>
			</div>
			<div class="bg-black rounded-lg text-white text-center">
				<h2>Options</h2>
			</div>
		</div>
	</AppLayout>
</template>
