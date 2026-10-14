<template>
  <div id="app">
    <nav class="main-nav">
      <router-link to="/">Home</router-link>
      <router-link to="/tugas">Daftar Tugas</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script setup lang="ts">
</script>

<style scoped>
.main-nav {
  background-color: #f8f9fa;
  padding: 1rem;
  border-bottom: 1px solid #ddd;
}

.main-nav a {
  margin-right: 1.5rem;
  text-decoration: none;
  color: #42b883;
  font-weight: 500;
}

.main-nav a:hover {
  text-decoration: underline;
}

.main-nav a.router-link-active {
  color: #35495e;
  font-weight: bold;
}
</style>
