<template>
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

			<div class="login-form">
				<form @submit.prevent="login()">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" class="label">Email</label>
							<input type="text" class="input" required v-model="email">
						</div>
						<div class="group">
							<label for="pass" class="label">Contraseña</label>
							<input type="password" class="input" data-type="password" required v-model="password">
						</div>
						<div class="group">
							<input type="submit" class="button" value="Login">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<a href="#forgot">Forgot Password?</a>
						</div>
					</div>
				</form>

				<div class="sign-up-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<input type="text" class="input">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign Up">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1"><a href="#">Already Member?</a></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import login from '../store/login'

export default {
	name: 'login',
	data () {
		return {
			email: '',
			password: '',
		}
	},

	methods: {
		//GET AND SET TOKEN API BY LOGIN
		async login() {
			let response = await login.dispatch('createToken', {email: this.email, password: this.password});

			if (response){
				localStorage.setItem('token', response.token);

				this.$router.push({name: 'facturas'});
			} else {
				localStorage.setItem('token', false);
			}
		},
	}
}
</script>

<style scoped src="../css/login.css"></style>
