<template>
  <section class="max-content">
    <h1>Uprawnienie {{ ability.name }}</h1>
    <form>
      <div class="form-group">
        <label for="name">Nazwa</label>
        <input
          id="name"
          v-model="ability.name"
          type="text"
          class="form-control"
        />
      </div>

      <button type="submit" class="btn btn-primary" @click.prevent="update">
        Zapisz
      </button>
    </form>
  </section>
</template>

<script>
export default {
  scrollToTop: true,
  auth: true,
  data() {
    return {}
  },
  async asyncData({ params, $axios }) {
    const { ability } = await $axios.$get('/api/abilities/edit/' + params.id)

    return { ability }
  },
  methods: {
    async update({ params }) {
      const data = await this.$axios
        .$post('/api/abilities/update/' + this.$nuxt._route.params.id, {
          name: this.ability.name
        })
        .catch(e => {
          return e.response
        })

      if (data.status !== 200) {
        return
      }

      this.$store.commit('alert/show', {
        show: true,
        content: 'Uprawnienie zostało zaktualizowane.',
        style: 'success'
      })
    }
  }
}
</script>
