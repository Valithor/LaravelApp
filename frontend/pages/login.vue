<template>
  <section class="max-content">
    <form class="w-50 m-auto">
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input
          id="exampleInputEmail1"
          v-model="user.username"
          type="email"
          class="form-control"
          aria-describedby="emailHelp"
          placeholder="Podaj email"
          required
        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Hasło</label>
        <input
          id="exampleInputPassword1"
          v-model="user.password"
          type="password"
          class="form-control"
          placeholder="Hasło"
          required
        />
      </div>

      <button
        type="submit"
        class="btn btn-primary"
        @click.prevent="passwordGrantLogin"
      >
        Zaloguj
      </button>
    </form>
  </section>
</template>

<script>
export default {
  auth: false,
  scrollToTop: true,
  data() {
    return {
      user: {
        username: '',
        password: ''
      }
    }
  },
  methods: {
    async passwordGrantLogin() {
      await this.$auth.loginWith('password_grant_custom', {
        data: this.user
      })
      this.$router.replace('/')
    }
  }
}
</script>

<style scoped>
div {
  margin: 10px 0;
}
</style>
