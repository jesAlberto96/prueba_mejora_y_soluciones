<template>
    <div class="form">
        <div class="title">Crear factura</div>

        <form @submit.prevent="update()">
            <div class="input-container ic1">
                <label class="placeholder">Nit Vendedor</label>
                <input class="input" type="text" placeholder=" " v-model="factura.nitVendedor" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Nombre Vendedor</label>
                <input class="input" type="text" placeholder=" " v-model="factura.nombreVendedor" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Nit Comprador</label>
                <input class="input" type="text" placeholder=" " v-model="factura.nitComprador" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Nombre Comprador</label>
                <input class="input" type="text" placeholder=" " v-model="factura.nombreComprador" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Precio</label>
                <input class="input" type="text" placeholder=" " v-model="factura.price" required/>
            </div>
            <div class="input-container ic2">
                <label class="placeholder">Iva includo</label>
                <input class="input" type="text" placeholder=" " v-model="factura.iva" required/>
            </div>
            <div class="input-container ic2" >
                <label class="placeholder">Estado</label>
                <select class="input" v-model="factura.estado" @change="onChangeEstado($event)">
                    <option value="P">EN PROCESO</option>
                    <option value="F">FINALIZADA</option>
                </select>
            </div>
            <button type="text" class="submit">Guardar</button>
            <button type="button" class="submit btnCancel" @click="$router.replace({name: 'facturas'})">Atrás</button>
        </form>

        <div class="addProducts">
            <form @submit.prevent="addProduct()">
                <div class="input-container input-container-products ic2">
                    <label for="email" class="placeholder">Productos</label>
                    <select class="input select-products" @change="onChangeProductos($event)">
                        <option selected>Seleccione un producto</option>
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
	props: ['id'],

	data () {
		return {
            factura: [],
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

    async mounted () {
        //SET ID FACTURA SELECCIONADA
        facturas.commit('setIdFactura', this.id)

        //GET PRODUCTOS
		facturas.dispatch('getProductos', {token});

        //GET PRODUCTOS AGREADOS A LA FACTURA
		let response = await facturas.dispatch('getFacturasById', { id: this.id });
        if (response){
            this.factura = response.factura;
            facturas.commit('setProductosByFactura', response.facturaDetalle)
        }
	},

	methods: {
        update: function(){
            facturas.dispatch('updateFactura', {
                id: this.id,
                nitVendedor: this.factura.nitVendedor,
                nombreVendedor: this.factura.nombreVendedor,
                nitComprador: this.factura.nitComprador,
                nombreComprador: this.factura.nombreComprador,
                price: this.factura.price,
                iva: this.factura.iva,
                estado: this.factura.estado
            });
        },

        addProduct: function(){
            facturas.dispatch('addProduct', {
                factura_id: this.id,
                producto_id: this.producto_id,
                cantidad: 1,
                observaciones: "",
            });
        },

        onChangeEstado(event) {
            this.factura.estado = event.target.value;
        },

        onChangeProductos(event) {
            this.producto_id = event.target.value;
        },

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