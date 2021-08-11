<template>
  <section class="max-content">
    <h1 class="mb-3">
      Uprawnienia
    </h1>
    <h4>Dodaj uprawnienie:</h4>
    <form class="form-inline mb-3">
      <label class="sr-only" for="inputFormCreateName">Nazwa</label>
      <input
        id="inputFormCreateName"
        v-model="create.name"
        type="text"
        class="form-control m-1"
        placeholder="Nazwa"
      />
      <button
        type="submit"
        class="btn btn-success m-1"
        @click.prevent="createAbility"
      >
        Dodaj
      </button>
    </form>
    <h4>Role ({{ abilities.length }}):</h4>
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">
              ID
            </th>
            <th scope="col">
              Nazwa
            </th>

            <th scope="col" />
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in abilities" :key="row.id">
            <th scope="row">
              {{ row.id }}
            </th>
            <td>{{ row.name }}</td>
            <td>
              <nuxt-link :to="'/panel/abilities/edit/' + row.id">
                <button type="button" class="btn btn-primary">
                  Edytuj
                </button>
              </nuxt-link>

              <button
                type="button"
                class="btn btn-danger"
                @click="deleteAbility(row.id)"
              >
                Usuń
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
export default {
  auth: true,
  scrollToTop: true,
  data() {
    return {
      create: {
        name: ''
      }
    }
  },
  async asyncData({ $axios }) {
    const { abilities } = await $axios.$get('/api/abilities')

    return { abilities }
  },
  methods: {
    async deleteAbility(id) {
      const { abilities } = await this.$axios.$get(
        '/api/abilities/destroy/' + id
      )
      this.abilities = abilities

      this.$store.commit('alert/show', {
        show: true,
        content: 'Rola została usunięta.',
        style: 'success'
      })
    },
    async createAbility() {
      const data = await this.$axios
        .$post('/api/abilities/store', this.create)
        .catch(e => {
          return e.response
        })

      if (data.status !== 200) {
        return
      }

      this.abilities = data.abilities

      this.$store.commit('alert/show', {
        show: true,
        content: 'Uprawnienie zostało dodane.',
        style: 'success'
      })
    }
  }
}
</script>
