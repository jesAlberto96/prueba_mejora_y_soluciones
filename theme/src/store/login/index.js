import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: false
    },

    getters: {
        getToken: (state) => state.token
    },

    mutations: {
        setToken(state, token){
            state.token = token;
        },
    },

    actions: {
        async createToken(context, { email, password }){
            try{
                let response = await axios.post(`http://127.0.0.1:8000/api/login`,
                    {
                        email,
                        password,
                        device: 'windows'
                    }
                );

                return response.data['data'];
            } catch (error){
                return false;
            }
        },
    }
})