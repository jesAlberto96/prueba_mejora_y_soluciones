<template>
	<div class="container">
		<div>
			<button type="button" class="button btnCrear" @click="$router.replace({name: 'facturas.create'})">Nueva factura</button>
		</div>
		<div class="container-facturas">
			<div class="table">
				<div class="table-header">
					<div class="header__item"><a id="name" class="filter__link" href="#"># Factura</a></div>
					<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Nit vendedor</a></div>
					<div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Nombre Vendedor</a></div>
					<div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">Nit comrpador</a></div>
					<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Nombre comprador</a></div>
					<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Acciones</a></div>
				</div>

				<div class="table-content">
					<div class="table-row" v-for="(item, index) in facturas">
						<div class="table-data" v-text="item.id"></div>
						<div class="table-data" v-text="item.nitVendedor"></div>
						<div class="table-data" v-text="item.nombreVendedor"></div>
						<div class="table-data" v-text="item.nitComprador"></div>
						<div class="table-data" v-text="item.nombreComprador"></div>
						<div class="table-data">
							<button type="button" class="button btnEditar" @click="$router.push({name: 'facturas.edit', params: {id: item.id}})">Editar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="form">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>

<script>
import facturas from '../store/facturas'
import login from '../store/login'

const token = login.getters.getToken;

export default {
	name: 'facturas',

	mounted () {
		facturas.dispatch('getFacturas', {token});
	},

	methods: {
		showEdit: (id) => {
			this.$router.push({name: 'facturas.edit', params: {id: id}});
		}
	},

	computed: {
        facturas() {
            return facturas.getters.getFacturas
        },
    },
}
</script>

<style scoped src="../css/facturasList.css"></style>