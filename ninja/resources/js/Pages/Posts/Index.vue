<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue';
import VueTableLite from 'vue3-table-lite';
import DialogModal from '@/Components/DialogModal.vue';
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';


defineProps({
	posts: Array,
});

const showModal = ref(false)
const selectedPost = ref(0)

const confirmPostDeletion = (posteos) => {
  showModal.value = true
  selectedPost.value = posteos
};

const closeModal = () => {
  showModal.value = false
};

const deletePost = () => {
  Inertia.delete(route('posts.destroy', selectedPost.value), {}, {preserveState: true})
  closeModal()
};

const table = reactive({
  isLoading: false,
  columns: [
    {
      label: "ID",
      field: "id",
      width: "3%",
      sortable: true,
      isKey: true,
    },
    {
      label: "Title",
      field: "title",
      width: "10%",
      sortable: true,
    },{
      label: "Actions",
      field: "actions",
      width: "10%",
    },
  ],
  rows: [],
  totalRecordCount: 0,
  sortable: {
    order: "id",
    sort: "asc",
  },
});

const tableLoadingFinish = (elements) => {
  table.isLoading = false;
  Array.prototype.forEach.call(elements, function (element) {
    if (element.classList.contains("delete")) {
      element.addEventListener("click", function () {
        confirmPostDeletion(element.value);
      });
    }
  });
};

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
				<VueTableLite
          :is-slot-mode="true"
          :is-loading="table.isLoading"
          :columns="table.columns"
          :rows="posts"
          :total="table.totalRecordCount"
          :sortable="table.sortable"
          :messages="table.messages"
          @do-search=""
          @is-finished="tableLoadingFinish"
				>
          <template class="is-row-el" v-slot:actions="data">
            <Link class="bg-gray-600 hover:bg-gray-800 text-white py-1 px-3 mr-3 rounded" :href="route('posts.edit', data.value.id)">Edit</Link>
            <button class="bg-red-600 hover:bg-red-800 text-white py-1 px-3 rounded delete is-rows-el" :value="data.value.id">Delete</button>
          </template>
      </VueTableLite>
    </div>
		</div>
	</AppLayout>

  <!-- Delete Post Confirmation Modal -->
  <DialogModal :show="showModal" @close="closeModal">
                <template #title>
                    Delete Post
                </template>

                <template #content>
                  Are you sure you want to delete this post?
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        @click="deletePost"
                        :onBefore="test"
                    >
                        Delete Post
                    </DangerButton>
                </template>
            </DialogModal>
</template>
