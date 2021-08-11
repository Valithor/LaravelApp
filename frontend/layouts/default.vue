<template>
  <div class="wrapper">
    <div class="container-fluid">
      <MainMenu />
      <alert v-if="$store.state.alert.show" />
      <nuxt />
    </div>
  </div>
</template>
<script>
import MainMenu from '~/components/MainMenu.vue'

export default {
  components: {
    MainMenu
  },
  watch: {
    // resetuje alery przy przechodzeniu między widokami
    '$route.path': function() {
      this.$store.commit('alert/destroy')
    }
  }
}
</script>
