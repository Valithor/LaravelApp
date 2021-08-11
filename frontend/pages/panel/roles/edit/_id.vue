<template>
  <section class="max-content">
    <h1>Rola {{ role.name }}</h1>
    <form>
      <div class="form-group">
        <label for="name">Nazwa</label>
        <input id="name" v-model="role.name" type="text" class="form-control" />
      </div>

      <div class="form-group">
        <label for="abiliti">Uprawnienia</label>
        <select
          id="abiliti"
          v-model="newabilities"
          multiple
          class="form-control"
        >
          <option v-for="abiliti in abilities" :key="abiliti" :value="abiliti">
            {{ abiliti }}
          </option>
        </select>
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
    const { role, abilities } = await $axios.$get(
      '/api/roles/edit/' + params.id
    )

    const newabilities = []
    if (role.abilities.length) {
      for (const row of role.abilities) {
        newabilities.push(row)
      }
    }

    return { role, abilities, newabilities }
  },
  methods: {
    async update({ params }) {
      const data = await this.$axios
        .$post('/api/roles/update/' + this.$nuxt._route.params.id, {
          name: this.role.name,
          newabilities: this.newabilities
        })
        .catch(e => {
          return e.response
        })

      if (data.status !== 200) {
        return
      }

      this.$store.commit('alert/show', {
        show: true,
        content: 'Rola została zaktualizowana.',
        style: 'success'
      })
    }
  }
}
</script>
