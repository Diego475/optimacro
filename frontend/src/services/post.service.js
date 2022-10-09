import postApi from "../api/post.api";

export default {
    list(data) {
        return postApi.list(data).then(res => {
            return res;
        }).catch(err => {
            return err;
        })
    }
};