<template>
    <div>
        <loading v-if="loading" />
        <div v-else class="container mx-auto grid md:grid-cols-3 gap-y-7 gap-x-6 pb-7">
            <template v-if="posts&&posts.length>0">
                <template v-for="post in posts">
                    <post-item :key="post.id" :post="post" />
                </template>
            </template>
            <div class="text-center font-semibold text-2xl" v-else>
                {{ $t('posts_not_found') }}
            </div>
        </div>
        <div v-if="posts.length>0" class="w-full flex justify-center mb-4 gap-x-4">
            <div v-for="n in last_page" :key="n">
                <div class="p-5 border py-3 rounded-xl border-blue-400 hover:bg-blue-500 hover:text-white cursor-pointer" @click="paginate(n)" :class="{'text-white bg-blue-500':n==filters.page,'text-blue-500 bg-white':n!=filters.page}">
                    {{ n }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '../../components/Loading';
import PostItem from '../../components/Post/Post';
import postService from '../../services/post.service';

export default {
    data() {
        return {
            posts: [],
            loading: true,
            filters: {
                page: 1,
                limit: 10
            },
            last_page: 1,
        }
    },
    mounted() {
        this.query();
        this.getPosts();
    },
    methods: {
        query() {
            !this.$route.query.page ? this.$router.push({name: 'Posts', query: {page: 1}}) : this.filters.page = this.$route.query.page;
        },
        getPosts() {
            postService.list({params: this.filters}).then(res => {
                this.loading = false;
                this.posts = res.data;
                this.last_page = res.last_page;
            }).catch(err => {
                this.loading = false;
                console.log(err);
            });
        },
        paginate(n) {
            this.filters.page = n;
            this.loading = true;
            this.$router.push({name: 'Posts', query: {page: n}});
            this.getPosts();
        },
    },
    components: { PostItem, Loading },
}
</script>