import authApi from "../api/auth.api";

export default {
    login(data) {
        return authApi.login(data).then(res => {
            return res;
        }).catch(err => {
            return err;
        });
    },
}