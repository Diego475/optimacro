import axios from 'axios';

const client = axios.create({
    baseURL: process.env.VUE_APP_API || 'http://localhost:8000/api/',
});

export default client;
