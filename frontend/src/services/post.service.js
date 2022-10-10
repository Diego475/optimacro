import postApi from "../api/post.api";

export default {
    list(data) {
        return postApi.list(data).then(res => {
            return res;
        }).catch(err => {
            return err;
        })
    },
    item(id) {
        return postApi.item(id).then(res => {
            return res;
        }).catch(err => {
            return err;
        })
    },
    delete(id) {
        return postApi.delete(id).then(res => {
            return res;
        }).catch(err => {
            return err;
        })
    },
};