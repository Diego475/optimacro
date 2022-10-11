<template>
    <div>
        <div class="container mx-auto">
            <div v-if="success_save_post" class="fixed bottom-0 right-0">
                <div class="px-4 py-2 rounded text-white bg-green-500 mb-6 mr-3">
                    {{ $t('post_success_save') }}
                </div>
            </div>
            <div class="grid grid-cols-8 gap-x-7">
                <div class="col-span-4">
                    <div class="mb-4">
                        <label class="text-xl pb-3" for="">{{ $t('title_post') }}</label>
                        <input v-model="form.title" :class="errors.title ? 'bg-red-100' : ''" :placeholder="$t('title_post')" class="w-full py-2 mt-3 rounded-md border focus:outline-none px-3">
                    </div>
                    <div class="mb-2">
                        <label class="text-xl pb-3" for="">{{ $t('short_description_post') }}</label>
                    </div>
                    <textarea v-model="form.short_description" :class="errors.short_description ? 'bg-red-100' : ''" :placeholder="$t('text_post_card')" class="w-full py-2 mt-3 rounded-md border focus:outline-none px-3" rows="7"></textarea>
                    <div class="mb-2 mt-4">
                        <label class="text-xl pb-3" for="">{{ $t('post') }}</label>
                    </div>
                    <textarea v-model="form.description" :class="errors.description ? 'bg-red-100' : ''" :placeholder="$t('text_post')" class="w-full py-2 mt-3 rounded-md border focus:outline-none px-3" rows="7"></textarea>
                    <div class="mt-4 mb-4">
                        <button @click="updatePost()" :class="disabled ?'bg-green-700' : 'bg-green-500 hover:bg-green-600'" class="w-full py-3 rounded text-white">
                            {{ $t('save') }}
                        </button>
                    </div>
                </div>
                <div class="col-span-4 mt-10">
                    <div>
                        <div class="justify-center h-52 border cursor-pointer items-center flex py-12 rounded-md bg-white">
                            <div>
                                <img src="@/assets/upload.svg" width="55">
                            </div>
                        </div>
                        <div class="text-center cursor-default select-none text-gray-400 mt-1 text-xs">
                            {{ $t('upload_cover_post') }}
                        </div>
                    </div>
                    <div>
                        <div class="flex mt-8 px-7 py-4 bg-white cursor-pointer rounded-md border justify-between">
                            <div class="select-none text-gray-400 text-sm">
                                {{ $t('upload_miniature') }}
                            </div>
                            <div>
                                <img src="@/assets/upload.svg" width="16">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import postService from '../../../services/post.service'
export default {
    data() {
        return {
            disabled: false,
            form: {},
            errors: [],
            success_save_post: false,
        }
    },
    mounted() {
        this.getPost();
    },
    methods: {
        getPost() {
            postService.item(this.$route.params.id)
                .then(res => {
                    if (res.id)
                        this.form = res;
                    else if (res&&res.response&&res.response.data&&res.response.data.success==false&&res.response.data.msg=="not_found_post")
                        this.$router.push({name: 'PostsAdmin'});
                })
                .catch(err => {
                    console.log(err)
            });
        },
        updatePost() {
            this.disabled = true;
            this.form.id = parseInt(this.$route.params.id);
            postService.post(this.form)
                .then(res => {
                    this.disabled = false;
                    if (res.success) {
                        this.getPost();
                        this.success_save_post = true;
                        setTimeout(() => this.success_save_post = false, 1500);
                    }
                    else if (res.response.data.errors)
                        this.errors = res.response.data.errors;
                })
                .catch(err => {
                    console.log(err);
                    this.disabled = false;
                }
            );
        },
    }
}
</script>