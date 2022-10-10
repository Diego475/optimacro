<template>
    <div>
        <div v-if="delete_post" class="fixed bottom-0 right-0">
            <div class="px-4 py-2 rounded text-white bg-green-500 mb-6 mr-3">
                {{ $t('post_success_delete') }}
            </div>
        </div>
        <div v-if="!getToken()" class="w-screen h-screen bg-green-500">
            <div v-if="error" class="absolute bottom-0 right-0">
                <div class="px-4 py-2 text-white bg-red-500 mb-6 mr-3">
                    {{ $t('error_user_not_found') }}
                </div>
            </div> 
            <div class="flex items-center justify-center h-screen">
                <div class="container grid grid-cols-12">
                    <div class="col-span-4 col-start-5">
                        <div class="bg-white px-8 py-2 rounded-md pb-6">
                            <div class="text-3xl text-center pt-2 font-semibold">
                                {{ $t('auth') }}
                            </div>
                            <div class="mb-4">
                                <div class="w-full mt-5">
                                    <input v-model="form.email" :placeholder="$t('login')" :class="errors.email ? 'bg-red-100' : ''" class="w-full focus:outline-none bg-gray-100 rounded-lg py-2 px-4">
                                </div>
                                <div class="w-full mt-3">
                                    <input type="password" v-model="form.password" :placeholder="$t('password')" :class="errors.password ? 'bg-red-100' : ''" class="w-full focus:outline-none bg-gray-100 rounded-lg py-2 px-4">
                                </div>
                            </div>
                            <button @click="auth()" :disabled="disable" :class="disable ?'bg-green-700' : 'bg-green-500 hover:bg-green-600'" class="py-3 w-full rounded-md text-white">
                                {{ $t('go') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <loading v-if="loading" />
            <div v-else class="container mx-auto grid md:grid-cols-3 gap-y-7 gap-x-6 pb-7">
                <div v-for="post in posts" :key="post.id">
                    <post-item @removeItem="removeItem(post)" :post="post" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '../../components/Loading';
import PostItem from '../../components/Post/Post';
import authService from '../../services/auth.service';
import postService from '../../services/post.service';

export default {
    data() {
        return {
            errors: [],
            form: {},
            err_msg: '',
            error: false,
            posts: [],
            disable: false,
            loading: false,
            delete_post: false,
        }
    },
    components: { PostItem, Loading },
    mounted() {
        if (this.getToken()) {
            this.loading = true;
            this.getPosts();
        }
    },
    methods: {
        auth() {
            this.errors = {};
            this.error = false;
            this.disable = true;
            authService.login(this.form).then(res => {
                    if (res&&res.response&&res.response.data&&res.response.data.errors)
                        this.errors = res.response.data.errors;

                    else if (res&&res.response&&res.response.data&&res.response.data.msg == "user_not_found") {
                        this.error = true;
                        this.err_msg = this.$t('error_user_not_found');
                        setTimeout(() => this.error = false, 1500)
                    }

                    else if (res&&res.response&&res.response.data&&res.response.data.msg == "invalid_password") {
                        this.errors = {};
                        this.errors.password = true;
                    }

                    else if (res.token) {
                        localStorage.setItem('token', res.token);
                        this.$router.go(0);
                    }

                    this.disable = false;

                }).catch(err => {
                    console.log(err);
                    this.disable = false;
                }
            );
        },
        getToken() {
            if (localStorage.getItem('token'))
                return true;
            return false;
        },
        getPosts() {
            postService.list()
                .then(res => {
                    this.loading = false;
                    this.posts = res;
                })
                .catch(err => {
                    console.log(err);
            });
        },
        removeItem(post) {
            this.delete_post = true;
            this.posts = this.posts.filter(item => post.id !== item.id);
            setTimeout(() => {this.delete_post = false;}, 1500);
        },
    }
}
</script>