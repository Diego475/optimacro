<template>
    <div>
        <div v-if="loading" class="flex justify-center">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div v-else-if="posts&&posts.length>0" class="container mx-auto grid md:grid-cols-3 gap-y-7 gap-x-6 pb-7">
            <template v-for="post in posts">
                <item-post :post="post" :key="post.id" />
            </template>
        </div>
    </div>
</template>

<script>
import NavBar from '../components/NavBar';
import ItemPost from '../components/Post/Post';

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
    components: { NavBar, ItemPost},
    mounted() {
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
}
</script>

<style>
    .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid #fff;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: rgb(0, 0, 0) transparent transparent transparent;
    }
    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }
    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }
    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }
    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
    }
}
</style>
