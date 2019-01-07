<template>
  <div id="app">

    <header class="app-header">
      <Nav/>
    </header>

    <div class="app-content">
      <main class="container">
        <router-view/>
      </main>
    </div>

    <footer class="app-footer">
      <div class="container">
        <hr/>
        <p>OK</p>
      </div>
    </footer>
  </div>
</template>

<script>
//подключаем компонент навигационого меню
  import Nav from '@/components/Nav.vue'
//определяем на странице компоненты
  export default {
    components: {
      Nav
    }
  }
</script>

<style lang="scss">
  @import "~bootstrap/scss/bootstrap";
  @import "~bootstrap-vue/dist/bootstrap-vue.css";
  @import "~@fortawesome/fontawesome-free/css/all.css";


body{
  min-height: 100vh;
}

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  min-height: 100vh;
  display: flex;
  flex-direction: column 
}
.app-content {
  flex: 1;
  padding: 1rem 0;
}
#nav {
  padding: 30px;
  a {
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
