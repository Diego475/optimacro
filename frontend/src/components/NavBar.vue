<template>
    <header class="w-full bg-white py-5 shadow mb-8">
        <div class="flex container mx-auto justify-between">
            <ul class="flex gap-x-7">
                <li :class="$route.name=='Home'?'text-blue-600':'text-blue-400'">
                    <router-link :to="{name: 'Home'}">{{ $t('home_page') }}</router-link>
                </li>
                <li :class="$route.name=='Posts'?'text-blue-600':'text-blue-400'">
                    <router-link :to="{name:'Posts'}">{{ $t('catalog_posts') }}</router-link>
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
export default {
    name: "Navbar",
}
</script>