<template>
    <div>
        <header v-if="client_routers.includes($route.name)" class="w-full bg-white py-5 shadow mb-8">
            <div class="flex container mx-auto justify-between">
                <ul class="flex gap-x-7">
                    <li :class="$route.name == 'Home' ? 'text-blue-600' : 'text-blue-400'">
                        <router-link :to="{ name: 'Home' }"> {{ $t("home_page") }}</router-link>
                    </li>
                    <li :class="['Posts', 'Post'].includes($route.name) ? 'text-blue-600' : 'text-blue-400'">
                        <router-link :to="{ name: 'Posts' }">{{ $t("catalog_posts")}}</router-link>
                    </li>
                </ul>
            </div>
        </header>
        <header class="w-full bg-white py-5 shadow mb-8" v-else-if="admin_routers.includes($route.name)&&getToken()">
            <div class="flex container items-center mx-auto justify-between">
                <ul class="flex gap-x-7">
                    <li :class="$route.name == 'Home' ? 'text-blue-600' : 'text-blue-400'">
                        <router-link :to="{ name: 'Home' }"> {{ $t("home_page") }}</router-link>
                    </li>
                    <li :class="['Posts', 'Post'].includes($route.name) ? 'text-blue-600' : 'text-blue-400'">
                        <router-link :to="{ name: 'Posts' }">{{ $t("catalog_posts")}}</router-link>
                    </li>
                </ul>
                <div>
                    <button @click="createPost()" class="bg-green-500 px-3 rounded-md py-3 text-white hover:bg-green-600 w-full">{{ $t('add_post') }}</button>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
import postService from '../services/post.service';
export default {
    data() {
        return {
            client_routers: ['Home', 'Posts', 'Post'],
            admin_routers: ['PostsAdmin', 'PostAdmin']
        }
    },
    name: "Navbar",
    methods: {
        getToken() {
            if (localStorage.getItem("token")) 
                return true;

            return false;
        },
        createPost() {
            postService.post()
                .then(res => {
                    this.$router.push({name: 'PostAdmin', params: {id: res.id}});
                }).catch(err => {
                    console.log(err);
                }
            );
        }
    },
};
</script>