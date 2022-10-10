<template>
    <div class="w-full bg-white rounded-lg pt-7 px-5 pb-6">
        <img class="mx-auto" :src="post.miniature">
        <div class="mt-6 text-3xl text-center md:text-left font-medium">
            {{ post.title }}
        </div>
        <div class="mt-4 text-gray-500 text-center text-sm mb-4">
            {{ post.short_description }}
        </div>
        <template v-if="!admin_routers.includes($route.name)">
            <button @click="$router.push({name: 'Post', params: {id: post.id}})" class="py-3 w-full rounded-md bg-green-500 text-white hover:bg-green-600">
                {{ $t('go') }}
            </button>
        </template>
        <template v-else>
            <div class="flex gap-x-7 text-white mt-4">
                <button class="bg-blue-500 rounded-md py-3 hover:bg-blue-600 w-full">{{ $t('edit') }}</button>
                <button class="bg-red-500 rounded-md py-3 hover:bg-red-600 w-full">{{ $t('delete') }}</button>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "ItemPost",
    props: ["post"],
    data() {
        return {
            admin_routers: ['PostsAdmin', 'PostAdmin']
        }
    }
}
</script>