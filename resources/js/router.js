import Vue from 'vue';
import VueRouter from 'vue-router';
import TaskListComponent from './components/TaskListComponent';
import TaskCreateComponent from './components/TaskCreateComponent';
import TaskShowComponent from './components/TaskShowComponent';
import TaskEditComponent from './components/TaskEditComponent';
import Login from './components/Login';
import NoticeComponent from './components/NoticeComponent';
import store from './store';

Vue.use(VueRouter);

const routes = [
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
  {
    path: '/notice',
    name: 'notice',
    component: NoticeComponent,
    beforeEnter(to, from, next) {
      if (store.getters['auth/adminCheck']) {
        next('/tasks');
      } else {
        next();
      }
    },
  },
];

const router = new VueRouter({
  mode: 'history',
  routes,
});

export default router;
