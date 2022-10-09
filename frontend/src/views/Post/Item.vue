<template>
    <div>
        <loading v-if="loading" />
        <div v-else class="w-full">
            <template v-if="post&&post.id">
                <img :src="post.cover" class="w-full h-screen -mt-9">
                <div class="container mx-auto mt-8">
                    <div class="grid grid-cols-12 mb-8">
                        <div class="md:col-span-4 col-span-12 flex justify-center">
                            <div>
                                <img :src="post.miniature" alt="">
                            </div>
                        </div>
                        <div class="md:col-span-8 col-span-12 justify-center">
                            <h1 class="text-3xl font-semibold text-center md:text-left mb-4 mt-2">{{ post.title }}</h1>
                            <div class="mt-4">
                                {{ post.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <div v-else class="text-center font-semibold text-2xl">
                {{ $t('post_not_found') }}
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '../../components/Loading';
import postService from '../../services/post.service';

export default {
  components: { Loading },
    data() {
        return {
            loading: true,
            post: {}
        }
    },
    mounted() {
        this.getPost();
    },
    methods: {
        getPost() {
            postService.item(this.$route.params.id).then(res => {
                console.log(res);
                this.loading = false;
                this.post = res;
            })
            .catch(err => {
                console.log(err);
            });
        }
    }
}
</script>