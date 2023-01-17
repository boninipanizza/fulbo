<script setup>
import {  onMounted } from 'vue';

const props = defineProps({
    message: String,
    type: String,
});

const emit = defineEmits(['closeToast'])

onMounted(() => {
    setTimeout(() => emit('closeToast'),2000)
});

</script>

<template>
    <div class="toast-container">
        <div 
            :class="{ 'bg-green-300 text-green-800': props.type=='success', 'bg-red-300 text-red-800': props.type=='error' }"
            class="text-center text-sm font-bold text-base p-4"
        >
            <span> {{ message }}</span>
        </div>
    </div>
</template>


<style>
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-50px);
  opacity: 0;
}
</style>