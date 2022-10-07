import Posts from '../views/Admin/Index.vue'
import Post from '../views/Admin/Post/Item.vue'

export default [
    {
        path: '/',
        name: 'PostsAdmin',
        component: Posts
    },
    {
        path: 'posts/:id',
        name: 'PostAdmin',
        component: Post
    },
];