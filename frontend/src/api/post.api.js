import client from ".";

export default {
    list(data) {
        return client.get('/posts', data).then(res => {
            return res.data;
        }).catch(err => {
            return err;
        });
    },
    item(id) {
        return client.get(`/posts/${id}`).then(res => {
            return res.data;
        }).catch(err => {
            return err;
        });
    },
}