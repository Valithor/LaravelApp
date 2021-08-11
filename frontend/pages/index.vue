<template>
  <div class="max-content">
    <h1>Strona główna</h1>
    <div v-if="$auth.loggedIn">
      <strong>Zalogowany jako:</strong>
      <pre class="mt-3">{{ $auth.user }}</pre>
    </div>
  </div>
</template>

<script>
export default {
  auth: false,
  scrollToTop: true,
  components: {},
  methods: {}
}
</script>
