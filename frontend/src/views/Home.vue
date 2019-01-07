<template>
  <div class="home">
  	<div class="jumbotron">
  		<h1>Wellcome</h1>
  		<ApiStatus/>
  	</div>
  </div>
</template>

<script>
// @ is an alias to /src
import ApiStatus from '@/components/ApiStatus.vue'

export default {
  name: 'home',
  components: {
    ApiStatus
  }
}
</script>

<style lang="scss">
  .jumbotron {
    padding: 2rem;
    p:last-of-type {
      margin-bottom: 0;
    }
  }
</style>
