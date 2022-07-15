<template>
  <div>
    <header>
      <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
          <router-link class="navbar-brand" :to="{ name: 'home' }">
            Home
          </router-link>
          <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'advancedsearch' }">
                  Search Page
                </router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'apartments' }">
                  Apartments
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- route outlet -->
    <!-- component matched by the route will render here -->
    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
export default {
  name: "app",
};
</script>

<style lang="scss" scoped>
h1 {
  text-align: center;
  margin-top: 2rem;
}
</style>
