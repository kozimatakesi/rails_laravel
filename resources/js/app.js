import './bootstrap';
import Vue from 'vue';
import HeaderComponent from './components/HeaderComponent';
import store from './store';
import router from './router';

require('./bootstrap');

// window.Vue = require('vue');

Vue.component('header-component', HeaderComponent);

// リロード時のstate保持
if (sessionStorage.getItem('TaskApp')) {
  const strageData = JSON.parse(sessionStorage.getItem('TaskApp'));
  if (strageData.auth.user) {
    axios.defaults.headers.common.Authorization = `Bearer ${strageData.auth.user}`;
  }
}

new Vue({
  el: '#app',
  router,
  store,
});
