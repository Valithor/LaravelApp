<template>
  <section class="max-content">
    <h1>Wylogowano</h1>
  </section>
</template>

<script>
export default {
  auth: true,
  scrollToTop: true,
  async asyncData({ app }) {
    await app.$auth.logout()
    app.router.replace('/login')
  }
}
</script>
