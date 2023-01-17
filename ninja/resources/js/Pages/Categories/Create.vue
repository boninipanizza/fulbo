<script setup>
import { useForm, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const nameInput = ref(null);
const slugInput = ref(null);

const form = useForm({
	name: '',
	slug: '',
});

const fillSlug = (e) => {
	form.slug=form.name.replaceAll(' ', '-').replace(/[^a-zA-Z0-9 ]/g, "-")
}

const submit = () => {
	form.post(route('categories.store'), {
		errorBag: 'createCategory',
		preserveScroll: true,
		onSuccess: () => form.reset(),
		onError: () => {
			if (form.errors.name) {
				form.reset('nameInput');
				nameInput.value.focus();
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
				New Category
			</h2>
		</template>
		<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 gap-7 grid grid-cols-3">
			<div class="col-span-2">
				<form class="grid gap-7" @submit.prevent="submit">
					<div class="form-group">
						<InputLabel for="name" value="Name" />
						<TextInput
							id="name"
							ref="nameInput"
							v-model="form.name"
							type="text"
							class="mt-1 block w-full"
							v-on:keyup="fillSlug"
						/>
						<InputError :message="form.errors.name" class="mt-2" />
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
						<Link :href="route('categories.index')">
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
