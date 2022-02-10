<template>
  <div>
      <header>
          <Header />
      </header>
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
  </div>
</template>
<script>
import Header from './components/HeaderComponent.vue'

export default {
    components: {
        Header
    },
}
</script>
