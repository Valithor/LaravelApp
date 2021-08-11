<template>
  <section class="max-content">
    <h1>Użytkownik {{ user.name }}</h1>
    <form>
      <div class="form-group">
        <label for="name">Nazwa</label>
        <input id="name" v-model="user.name" type="text" class="form-control" />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          id="email"
          v-model="user.email"
          type="email"
          class="form-control"
          value="user.email"
        />
      </div>
      <div class="form-group">
        <label for="password">Hasło</label>
        <input
          id="password"
          type="password"
          class="form-control"
          placeholder=""
        />
      </div>

      <div class="form-group">
        <label for="role">Rola</label>
        <select id="role" v-model="newroles" multiple class="form-control">
          <option v-for="role in roles" :key="role" :value="role">
            {{ role }}
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
    return {
      password: '',
      newroles: []
    }
  },
  async asyncData({ params, $axios }) {
    const { user, roles } = await $axios.$get('/api/users/edit/' + params.id)

    const newroles = []
    if (user.roles.length) {
      for (const row of user.roles) {
        newroles.push(row)
      }
    }

    return { user, roles, newroles }
  },
  methods: {
    async update({ params }) {
      const data = await this.$axios
        .$post('/api/users/update/' + this.$nuxt._route.params.id, {
          name: this.user.name,
          email: this.user.email,
          password: this.password,
          newroles: this.newroles
        })
        .catch(e => {
          // prostacko przekazuje odpowiedź laravela do const data ;)
          return e.response
        })

      if (data.status !== 200) {
        return
      }

      this.$store.commit('alert/show', {
        show: true,
        content: 'Użytkownik został zaktualizowany.',
        style: 'success'
      })
    }
  }
}
</script>
