<script>
export default {
    name: app
}
</script>

<template>
    <div class="flex items-center" id="app">
        <button class="flex gap-2 text-center text-sm px-4 py-2 py-1rounded-md hover:bg-slate-200 rounded-md">
            <font-awesome-icon icon="fa-regular fa-thumbs-down" size="xl" />
            <slot />
        </button>
    </div>
</template>