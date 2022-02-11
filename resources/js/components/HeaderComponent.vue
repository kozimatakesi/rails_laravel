<template>
    <nav class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">Vue Laravel SPA</span>
                <div v-if="isLogin">
                    <router-link v-bind:to="{name: 'notice'}">
                        <button v-if="adminCheck == 1" class="btn btn-success">Notices</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'task.list'}">
                        <button class="btn btn-success">List</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'task.create'}">
                        <button class="btn btn-success">ADD</button>
                    </router-link>
                    <button class="btn btn-success" @click="logout">Logout</button>
                    <span v-if="isLogin" class="navbar__item text-info">
                        {{ username }}
                    </span>
                </div>
                <div v-else>
                    <router-link v-bind:to="{name: 'login'}">
                        <button class="btn btn-success">Login</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            isLogin () {
                return this.$store.getters['auth/check']
            },
            username () {
                return this.$store.getters['auth/username']
            },
            adminCheck () {
                return this.$store.getters['auth/adminCheck']
            }
        },
        methods: {
            async logout () {
            await this.$store.dispatch('auth/logout')

            this.$router.push('/login')
            }
        }
    }
</script>
