<template>
  <div class="container">
    <h1 v-if="error.statusCode === 404">
      Strona nie została znaleziona
    </h1>
    <h1 v-else>
      wystąpił błąd
    </h1>
    <div class="mt-3 mb-3">
      {{ error }}
    </div>
    <a href="#" @click="$router.go(-1)">Wróć</a>
  </div>
</template>

<script>
export default {
  props: ['error'],
  layout: 'default' // you can set a custom layout for the error page
}
</script>
