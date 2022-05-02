// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
// import router from '@/router/index.js'
import router from './router';
import App from './App'

window.not_found = function(){
  router.replace("/404");
}

window.not_found_unless = function(condition){
  if (! condition){
    not_found();
  }
}

window.clone = function(obj){
  return JSON.parse(JSON.stringify(obj));
}

var vm = new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
