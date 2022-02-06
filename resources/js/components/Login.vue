<template>
  <div class="container--small">
    <ul class="list-group">
      <li
        class="list-group-item"
        :class="{'active': tab === 1 }"
        @click="tab = 1"
      >Login</li>
      <li
        class="list-group-item"
        :class="{'active': tab === 2 }"
        @click="tab = 2"
      >Register</li>
    </ul>
    <div class="container">
        <div class="panel" v-show="tab === 1">
        <div class="panel" v-show="tab === 1">
            <form class="form" @submit.prevent="login">
            <label for="login-email" class="form-label">Email</label>
                <div class="mb-3">
                    <input type="text" class="form-contro" id="login-email" v-model="loginForm.email">
                </div>
                <label for="login-password">Password</label>
                <div class="mb-3">
                    <input type="password" class="form-contro" id="login-password" v-model="loginForm.password">
                </div>
                <div class="form__button">
                    <button type="submit" class="button button--inverse">login</button>
                </div>
            </form>
        </div>
        </div>
        <div class="panel" v-show="tab === 2">
            <form class="form" @submit.prevent="register">
                <label for="username">Name</label>
                <div class="mb-3">
                    <input type="text" class="form__item" id="username" v-model="registerForm.name">
                </div>
                <label for="email">Email</label>
                <div class="mb-3">
                    <input type="text" class="form__item" id="email" v-model="registerForm.email">
                </div>
                <label for="password">Password</label>
                <div class="mb-3">
                    <input type="password" class="form__item" id="password" v-model="registerForm.password">
                </div>
                <label for="password-confirmation">Password (confirm)</label>
                <div class="mb-3">
                    <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
                </div>
                <div class="form__button">
                <button type="submit" class="button button--inverse">register</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },

  methods: {
    async login () {
        // authストアのloginアクションを呼び出す
        await this.$store.dispatch('auth/login', this.loginForm)

        // トップページに移動する
        this.$router.push('/tasks')
    },
    async register () {
        // authストアのresigterアクションを呼び出す
        await this.$store.dispatch('auth/register', this.registerForm)

        // トップページに移動する
        this.$router.push('/tasks')
    }
  },
}
</script>
