import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import HeaderComponent from './components/HeaderComponent';
import TaskListComponent from './components/TaskListComponent';
import TaskCreateComponent from './components/TaskCreateComponent';
import TaskShowComponent from './components/TaskShowComponent';
import TaskEditComponent from './components/TaskEditComponent';
import Login from './components/Login';
import store from './store';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/tasks',
      name: 'task.list',
      component: TaskListComponent,
      beforeEnter(to, from, next) {
        if (!store.getters['auth/check']) {
          next('/login');
        } else {
          next();
        }
      },
    },
    {
      path: '/tasks/create',
      name: 'task.create',
      component: TaskCreateComponent,
      beforeEnter(to, from, next) {
        if (!store.getters['auth/check']) {
          next('/login');
        } else {
          next();
        }
      },
    },
    {
      path: '/tasks/:taskId',
      name: 'task.show',
      component: TaskShowComponent,
      props: true,
      beforeEnter(to, from, next) {
        if (!store.getters['auth/check']) {
          next('/login');
        } else {
          next();
        }
      },
    },
    {
      path: '/tasks/:taskId/edit',
      name: 'task.edit',
      component: TaskEditComponent,
      props: true,
      beforeEnter(to, from, next) {
        if (!store.getters['auth/check']) {
          next('/login');
        } else {
          next();
        }
      },
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      beforeEnter(to, from, next) {
        if (store.getters['auth/check']) {
          next('/tasks');
        } else {
          next();
        }
      },
    },
  ],
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('header-component', HeaderComponent);

// リロード時のstate保持
if (sessionStorage.getItem('TaskApp')) {
  const strageData = JSON.parse(sessionStorage.getItem('TaskApp'));
  if (strageData.auth.user) {
    axios.defaults.headers.common.Authorization = `Bearer ${strageData.auth.user}`;
  }
}

const app = new Vue({
  el: '#app',
  router,
  store,
});
