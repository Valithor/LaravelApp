<template>
  <section class="max-content">
    <h1 class="mb-3">
      Użytkownicy
    </h1>
    <h4>Dodaj użytkownika:</h4>
    <form class="form-inline mb-3">
      <label class="sr-only" for="inputFormCreateName">Nazwa</label>
      <input
        id="inputFormCreateName"
        v-model="create.name"
        type="text"
        class="form-control m-1"
        placeholder="Nazwa"
      />

      <label class="sr-only" for="inputFormCreateEmail">Email</label>
      <div class="input-group m-1">
        <div class="input-group-prepend">
          <div class="input-group-text">
            @
          </div>
        </div>
        <input
          id="inputFormCreateEmail"
          v-model="create.email"
          type="text"
          class="form-control"
          placeholder="Email"
        />
      </div>

      <label class="sr-only" for="inputFormCreateName">Hasło</label>
      <input
        id="inlineFormInputPassword"
        v-model="create.password"
        type="password"
        class="form-control m-1"
        placeholder=""
      />

      <label class="sr-only" for="inputFormCreateRole">Rola</label>
      <select
        id="role"
        v-model="create.roles"
        multiple
        size="2"
        class="form-control m-1"
        placeholder="Wybierz rolę"
      >
        <option v-for="role in roles" :key="role" :value="role">
          {{ role }}
        </option>
      </select>

      <button
        type="submit"
        class="btn btn-success m-1"
        @click.prevent="createUser"
      >
        Dodaj
      </button>
    </form>
    <h4>Użytkownicy ({{ users.length }}):</h4>
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
              Email
            </th>
            <th scope="col">
              Rola
            </th>
            <th scope="col" />
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in users" :key="row.id">
            <th scope="row">
              {{ row.id }}
            </th>
            <td>{{ row.name }}</td>
            <td>{{ row.email }}</td>
            <td>
              <div v-if="row.roles.length">
                <span
                  v-for="role in row.roles"
                  :key="role.id"
                  class="badge badge-primary"
                  >{{ role.title }}</span
                >
              </div>
            </td>
            <td>
              <nuxt-link :to="'/panel/users/edit/' + row.id">
                <button type="button" class="btn btn-primary">
                  Edytuj
                </button>
              </nuxt-link>

              <button
                type="button"
                class="btn btn-danger"
                @click="deleteUser(row.id)"
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
        email: '',
        password: '',
        roles: []
      }
    }
  },
  async asyncData({ $axios }) {
    const { users } = await $axios.$get('/api/users')
    const { roles } = await $axios.$get('/api/users/create')

    return { users, roles }
  },
  methods: {
    async deleteUser(id) {
      const { users } = await this.$axios.$get('/api/users/destroy/' + id)

      // aktualizuje listę użytkowników bo usunęliśmy
      this.users = users

      this.$store.commit('alert/show', {
        show: true,
        content: 'Użytkownik został usunięty.',
        style: 'success'
      })
    },
    async createUser() {
      const data = await this.$axios
        .$post('/api/users/store', this.create)
        .catch(e => {
          return e.response
        })

      if (data.status !== 200) {
        return
      }

      // aktualizuje listę użytkowników bo dodaliśmy nowego
      this.users = data.users

      // pokazuje alert że wszystko ok
      this.$store.commit('alert/show', {
        show: true,
        content: 'Użytkownik został dodany.',
        style: 'success'
      })
    }
  }
}
</script>
