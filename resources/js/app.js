import VueRouter from 'vue-router';
import HeaderComponent from './components/HeaderComponent';
import TaskListComponent from './components/TaskListComponent';
import TaskCreateComponent from './components/TaskCreateComponent';
import TaskShowComponent from './components/TaskShowComponent';
import TaskEditComponent from './components/TaskEditComponent';
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
    },
    {
      path: '/tasks/create',
      name: 'task.create',
      component: TaskCreateComponent,
    },
    {
      path: '/tasks/:taskId',
      name: 'task.show',
      component: TaskShowComponent,
      props: true,
    },
    {
      path: '/tasks/:taskId/edit',
      name: 'task.edit',
      component: TaskEditComponent,
      props: true,
    },
  ],
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('header-component', HeaderComponent);

const app = new Vue({
  el: '#app',
  router,
});
