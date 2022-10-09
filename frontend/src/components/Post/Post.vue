<template>
    <div class="w-full bg-white rounded-lg pt-7 px-5 pb-6">
        <img class="mx-auto" :src="post.miniature">
        <div class="mt-6 text-3xl text-center md:text-left font-medium">
            {{ post.title }}
        </div>
        <div class="mt-4 text-gray-500 text-center text-sm mb-4">
            {{ post.short_description }}
        </div>
        <button class="py-3 w-full rounded-md bg-green-500 text-white hover:bg-green-600">
            {{ $t('go') }}
        </button>
    </div>
</template>

<script>
export default {
    name: "ItemPost",
    props: ["post"]
}
</script>