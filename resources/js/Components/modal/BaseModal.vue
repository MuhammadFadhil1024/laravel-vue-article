<script setup>
defineEmits(['close-modal'])
defineProps({
    modalActive: {
        type: Boolean,
        default: false
    },
})

// console.log(props.modalActive);

</script>

<template>
    <div v-show="modalActive" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30">
        <div v-if="modalActive"
            class="bg-white p-4 self-start mt-8 w-full max-w-screen-sm rounded-md shadow-lg overflow-y-auto max-h-screen">
            <div class="flex justify-between items-center">
                <div class="font-semibold text-xl text-center w-11/12">
                    All Comments
                </div>
                <div class="text-right">
                    <button @click="$emit('close-modal')">
                        <font-awesome-icon icon="fa-regular fa-circle-xmark" size="lg" />
                    </button>
                </div>
            </div>
            <div class="border-b border-gray-300 mt-4"></div>
            <div class="mt-4">
                <slot />
            </div>
        </div>
    </div>
</template>
  
  
  