import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

var token = localStorage.getItem('token');

export default new Vuex.Store({
    state: {
        idFactura: false,
        factura: false,
        facturas: [],
        productos: [],
        productosByFactura: []
    },

    getters: {
        getFacturas: (state) => state.facturas,
        getFactura: (state) => state.factura,
        getProductos: (state) => state.productos,
        getIdFactura: (state) => state.idFactura,
        getProductoByFactura: (state) => state.productosByFactura,
    },

    mutations: {
        setFactura(state, factura){
            state.factura = factura;
        },
        setFacturas(state, facturas){
            state.facturas = facturas;
        },
        setProductos(state, productos){
            state.productos = productos;
        },
        setIdFactura(state, idFactura){
            state.idFactura = idFactura;
        },
        setProductosByFactura(state, productosByFactura){
            state.productosByFactura = productosByFactura;
        },
    },

    actions: {
        //GET ALL FACTURAS
        getFacturas(context){
            axios.get('http://127.0.0.1:8000/api/v1/facturas', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            }
            ).then(function (response) {
                context.commit('setFacturas', response.data['data'])
            }).catch(function (error) {
                context.commit('setFacturas', [])
            });
        },

        //GET FACTURAS POR ID
        async getFacturasById(context, { id }){
            try{
                let response = await axios.get(`http://127.0.0.1:8000/api/v1/facturas/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                return response.data['data'];
            } catch (error){
                return false;
            }
        },

        //GET DETALLE DE LA FACTURA POR ID
        getFacturaDetalles(context){
            axios.get(`http://127.0.0.1:8000/api/v1/productoByFactura/${context.getters.getIdFactura}`, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            }
            ).then(function (response) {
                context.commit('setProductosByFactura', response.data['data'])
            }).catch(function (error) {
                context.commit('setProductosByFactura', [])
            });
        },

        //GET PRODUCTO AGREGADOS A LA FACTURA
        getProductos(context){
            axios.get('http://127.0.0.1:8000/api/v1/productos', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            }
            ).then(function (response) {
                context.commit('setProductos', response.data['data'])
            }).catch(function (error) {
                context.commit('setProductos', [])
            });
        },

        createFactura(context, {
            nitVendedor,
            nombreVendedor,
            nitComprador,
            nombreComprador,
            price,
            iva,
            estado}
        ){
            axios.post('http://127.0.0.1:8000/api/v1/facturas', {
                nitVendedor,
                nombreVendedor,
                nitComprador,
                nombreComprador,
                price,
                iva,
                estado
            },{
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(function (response) {
                context.commit('setFactura', response.data['data'])
                context.commit('setIdFactura', response.data['data'].id)
                context.dispatch('getFacturas', {token});
            })
            .catch(function (error) {
                context.commit('setFactura', false)
            });
        },

        updateFactura(context, {
            id,
            nitVendedor,
            nombreVendedor,
            nitComprador,
            nombreComprador,
            price,
            iva,
            estado}
        ){
            axios.put(`http://127.0.0.1:8000/api/v1/facturas/${id}`, {
                nitVendedor,
                nombreVendedor,
                nitComprador,
                nombreComprador,
                price,
                iva,
                estado
            },{
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(function (response) {
                context.commit('setFactura', response.data['data'])
                context.commit('setIdFactura', response.data['data'].id)
            })
            .catch(function (error) {
                context.commit('setFactura', false)
            });
        },

        addProduct(context, {factura_id, producto_id, cantidad, observaciones}){
            axios.post('http://127.0.0.1:8000/api/v1/facturasDetalle', {
                factura_id,
                producto_id,
                cantidad,
                observaciones,
            },{
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(function (response) {
                let id = response.data['data'].id;
                context.dispatch('getFacturaDetalles', {
                    id,
                });
            })
            .catch(function (error) {
                console.log(error)
            });
        }
    }
})