<template>
  <div class="home">
    <h1>Halaman Utama</h1>
    <p>Selamat datang di aplikasi frontend untuk Tugas CRUD.</p>
    <nav>
      <router-link to="/tugas">
        Lihat Daftar Tugas
      </router-link>
    </nav>
  </div>
</template>

<script setup lang="ts">
</script>

<style scoped>
.home {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem;
}
nav {
  margin-top: 1.5rem;
}
nav a {
  color: #42b883;
  text-decoration: none;
  font-weight: bold;
}
nav a:hover {
  text-decoration: underline;
}
</style>
