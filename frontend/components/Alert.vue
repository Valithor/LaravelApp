<template>
  <div
    class="alert max-content mb-3"
    :class="'alert-' + $store.state.alert.style"
    role="alert"
  >
    <strong>{{ $store.state.alert.content }}</strong>
    <div v-if="isErrors" v-html="errorList" />
  </div>
</template>
<script>
export default {
  computed: {
    isErrors: function() {
      return Object.values(this.$store.state.alert.errors).length
    },
    errorList: function() {
      const errors = this.$store.state.alert.errors
      // console.log(errors)

      let content = ''
      for (const row in errors) {
        content += this.$store.state.alert.errors[row] + '<br />'
      }

      return content
    }
  }
}
</script>
