<template>
    <div class="form">
        <div class="title">Crear factura</div>
        <form @submit.prevent="create()">
            <div class="input-container ic1">
                <label class="placeholder">Nit Vendedor</label>
                <input class="input" type="text" placeholder=" " v-model="nitVendedor" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Nombre Vendedor</label>
                <input class="input" type="text" placeholder=" " v-model="nombreVendedor" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Nit Comprador</label>
                <input class="input" type="text" placeholder=" " v-model="nitComprador" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Nombre Comprador</label>
                <input class="input" type="text" placeholder=" " v-model="nombreComprador" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Precio</label>
                <input class="input" type="text" placeholder=" " v-model="price" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Iva includo</label>
                <input class="input" type="text" placeholder=" " v-model="iva" required/>
            </div>
            <div class="input-container ic2" v-if="idFactura !== false">
                <label class="placeholder">Estado</label>
                <select class="input">
                    <option>EN PROCESO</option>
                </select>
            </div>
            <button type="text" class="submit">Guardar</button>
            <button type="button" class="submit btnCancel" @click="$router.replace({name: 'facturas'})">Atrás</button>
        </form>

        <div class="addProducts" v-if="idFactura !== false">
            <form @submit.prevent="addProduct()">
                <div class="input-container input-container-products ic2">
                    <label for="email" class="placeholder">Producto</label>
                    <select class="input select-products" @change="onChangeProductos($event)">
                        <option v-for="producto in productos" :value="producto.id" v-text="producto.nombre">EN PROCESO</option>
                    </select>
                    <button type="text" class="submit btn-add-products">Agregar</button>
                </div>
            </form>
            <div class="table">
				<div class="table-header">
					<div class="header__item"><a id="name" class="filter__link" href="#">Producto</a></div>
					<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Cantidad</a></div>
					<div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Observaciones</a></div>
				</div>
				<div class="table-content">
					<div class="table-row" v-for="item in productosByFactura">
						<div class="table-data title-producto" v-text="'Producto ' + item.id"></div>
						<div class="table-data">
                            <input class="input inputTable" type="number" placeholder=" " :value="item.cantidad" />
                        </div>
						<div class="table-data">
                            <textarea class="input inputTable textareTable" rows="10" cols="50" :value="item.observaciones"></textarea>
                        </div>
					</div>
				</div>
			</div>
        </div>
    </div>
</template>

<script>
import facturas from '../store/facturas'
import login from '../store/login'

const token = login.getters.getToken;

export default {
	name: 'facturasDetalle',
	data () {
		return {
            nitVendedor: "",
            nombreVendedor: "",
            nitComprador: "",
            nombreComprador: "",
            price: "",
            iva: "",
            producto_id: "",
            cantidad: 0,
            observaciones: "",
		}
	},

    mounted () {
        //GET PRODUCTOS
		facturas.dispatch('getProductos', {token});

        //REINICIA LA PROPIEDAD IDFACTURA
        facturas.commit('setIdFactura', false)
	},

	methods: {
        create: function(){
            facturas.dispatch('createFactura', {
                nitVendedor: this.nitVendedor,
                nombreVendedor: this.nombreVendedor,
                nitComprador: this.nitComprador,
                nombreComprador: this.nombreComprador,
                price: this.price,
                iva: this.iva
            });
        },

        addProduct: function(){
            facturas.dispatch('addProduct', {
                factura_id: this.idFactura,
                producto_id: this.producto_id,
                cantidad: 1,
                observaciones: "",
            });
        },

        onChangeProductos(event) {
            this.producto_id = event.target.value;
        }
	},

    computed: {
        productos() {
            return facturas.getters.getProductos
        },

        idFactura() {
            return facturas.getters.getIdFactura
        },

        productosByFactura() {
            return facturas.getters.getProductoByFactura
        },
    },
}
</script>

<style scoped src="../css/form.css"></style>