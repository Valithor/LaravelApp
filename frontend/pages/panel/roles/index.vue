<template>
  <section class="max-content">
    <h1 class="mb-3">
      Role
    </h1>
    <h4>Dodaj rolę:</h4>
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
        @click.prevent="createRole"
      >
        Dodaj
      </button>
    </form>
    <h4>Role ({{ roles.length }}):</h4>
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

            <th scope="col">
              Uprawnienia
            </th>
            <th scope="col" />
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in roles" :key="row.id">
            <th scope="row">
              {{ row.id }}
            </th>
            <td>{{ row.name }}</td>

            <td>
              <div v-if="row.abilities.length">
                <span
                  v-for="role in row.abilities"
                  :key="role.id"
                  class="badge badge-primary"
                  >{{ role.title }}</span
                >
              </div>
            </td>
            <td>
              <nuxt-link :to="'/panel/roles/edit/' + row.id">
                <button type="button" class="btn btn-primary">
                  Edytuj
                </button>
              </nuxt-link>

              <button
                type="button"
                class="btn btn-danger"
                @click="deleteRole(row.id)"
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
        name: '',
        abilities: []
      }
    }
  },
  async asyncData({ $axios }) {
    const { roles } = await $axios.$get('/api/roles')
    const { abilities } = await $axios.$get('/api/roles/create')

    return { roles, abilities }
  },
  methods: {
    async deleteRole(id) {
      const { roles } = await this.$axios.$get('/api/roles/destroy/' + id)
      this.roles = roles

      this.$store.commit('alert/show', {
        show: true,
        content: 'Rola została usunięta.',
        style: 'success'
      })
    },
    async createRole() {
      const data = await this.$axios
        .$post('/api/roles/store', this.create)
        .catch(e => {
          return e.response
        })

      if (data.status !== 200) {
        return
      }

      this.roles = data.roles

      this.$store.commit('alert/show', {
        show: true,
        content: 'Rola została dodana.',
        style: 'success'
      })
    }
  }
}
</script>
