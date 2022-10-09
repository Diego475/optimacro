<template>
    <div>
        <loading v-if="loading" />
        <template v-else>
            <div v-if="posts&&posts.length>0" class="container mx-auto grid md:grid-cols-3 gap-y-7 gap-x-6 pb-7">
                <template v-for="post in posts">
                    <item-post :post="post" :key="post.id" />
                </template>
            </div>
            <div v-else class="text-center font-semibold text-2xl">
                {{ $t('posts_not_found') }}
            </div>
        </template>
    </div>
</template>

<script>
import NavBar from '../components/NavBar';
import ItemPost from '../components/Post/Post';
import Loading from "../components/Loading";

import postService from '../services/post.service';

export default {
    data() {
        return {
            loading: true,
            posts: [],
            filters: {
                limit: 6,
                date: 'desc'
            },
        }
    },
    components: { NavBar, ItemPost, Loading},
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            postService.list({params: this.filters})
                .then(res => {
                    this.loading = false;
                    this.posts = res;
                })
                .catch(err => {
                    console.log(err);
                }
            );
        },
    },
}
</script>
