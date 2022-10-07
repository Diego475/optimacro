import Home from '../views/Home.vue'
import Posts from '../views/Post/Index.vue'
import Post from '../views/Post/Item.vue'
import AdminProvider from '../providers/AdminProvider.vue'
import admin from './admin'

export default [
    {
        path: '',
        name: 'Home',
        component: Home,
    },
    {
        path: '/posts',
        name: 'Posts',
        component: Posts
    },
    {
        path: '/posts/:id',
        name: 'Post',
        component: Post
    },
    {
        path: '/admin',
        component: AdminProvider,
        children: admin
    }
];