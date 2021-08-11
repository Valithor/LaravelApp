<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <nuxt-link to="/" class="navbar-brand">
      <!-- <img src="~assets/images/logo.png" alt="" /> -->
    </nuxt-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon" />
    </button>

    <div id="navbarSupportedContent" class="collapse navbar-collapse">
      <ul class="navbar-nav w-100 justify-content-end">
        <li class="nav-item active">
          <nuxt-link to="/" class="nav-link" href="#">
            Home
          </nuxt-link>
        </li>

        <li v-if="$auth.loggedIn" class="nav-item">
          <nuxt-link to="/panel/users" class="nav-link" href="#">
            Użytkownicy
          </nuxt-link>
        </li>

        <li v-if="$auth.loggedIn" class="nav-item">
          <nuxt-link to="/panel/roles" class="nav-link" href="#">
            Role
          </nuxt-link>
        </li>

        <li v-if="$auth.loggedIn" class="nav-item">
          <nuxt-link to="/panel/abilities" class="nav-link" href="#">
            Uprawnienia
          </nuxt-link>
        </li>

        <li v-if="!$auth.loggedIn" class="nav-item">
          <nuxt-link to="/login" class="nav-link" href="#">
            Login
          </nuxt-link>
        </li>
        <li v-else class="nav-item">
          <nuxt-link to="/logout" class="nav-link" href="#">
            Wyloguj
          </nuxt-link>
        </li>
      </ul>
    </div>
  </nav>
</template>
