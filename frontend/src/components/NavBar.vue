<template>
    <header class="w-full bg-white py-5 shadow mb-8">
        <div class="flex container mx-auto justify-between">
            <ul>
                <li :class="$route.name == 'Home' ? 'text-blue-600' : 'text-blue-500'">
                    <router-link :to="{naem: 'Home'}">{{ $t('home_page') }}</router-link>
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
export default {
    name: "Navbar"
}
</script>