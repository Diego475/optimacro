import client from ".";

export default {
    login(data) {
        return client.post('login', data)
            .then(res => {
                return res.data;
            })
            .catch(err => {
                return err;
            }
        );
    }
}