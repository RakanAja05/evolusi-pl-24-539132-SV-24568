<template>
  <div class="tugas-list">
    <h1>Daftar Tugas</h1>

    <div v-if="loading" class="loading">
      <p>Memuat data...</p>
    </div>

    <div v-else-if="error" class="error">
      <p>Error: {{ error }}</p>
    </div>

    <div v-else-if="tugas.length === 0" class="empty">
      <p>Tidak ada tugas tersedia.</p>
    </div>

    <table v-else class="tugas-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Status</th>
          <th>Dibuat</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tugasItem in tugas" :key="tugasItem.id">
          <td>{{ tugasItem.id }}</td>
          <td>{{ tugasItem.judul }}</td>
          <td>{{ tugasItem.deskripsi }}</td>
          <td>
            <span :class="['status-badge', `status-${tugasItem.status || 'pending'}`]">
              {{ tugasItem.status || 'pending' }}
            </span>
          </td>
          <td>{{ formatDate(tugasItem.created_at) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'

interface Tugas {
  id: number
  judul: string
  deskripsi: string
  status: string
  created_at: string
}

const tugas = ref<Tugas[]>([])
const loading = ref(true)
const error = ref<string | null>(null)

const fetchTugas = async () => {
  loading.value = true
  error.value = null

  try {
    const response = await fetch(import.meta.env.VITE_API_URL + '/api/tugas')
    if (!response.ok) {
      throw new Error('Gagal memuat data tugas')
    }
    const data = await response.json()
    tugas.value = data
  } catch (err) {
    error.value = err instanceof Error ? err.message : 'Terjadi kesalahan'
  } finally {
    loading.value = false
  }
}

const formatDate = (dateString: string) => {
  if (!dateString) return '-'
  const date = new Date(dateString)
  return date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  })
}

onMounted(() => {
  fetchTugas()
})
</script>

<style scoped>
.tugas-list {
  max-width: 1000px;
  margin: 0 auto;
  padding: 2rem;
}

.loading,
.error,
.empty {
  text-align: center;
  padding: 2rem;
}

.error {
  color: #e74c3c;
}

.tugas-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}

.tugas-table th,
.tugas-table td {
  padding: 1rem;
  border: 1px solid #ddd;
  text-align: left;
}

.tugas-table th {
  background-color: #f8f9fa;
}

.status-badge {
  display: inline-block;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.875rem;
  font-weight: 500;
}

.status-pending {
  background-color: #fff3cd;
  color: #856404;
}

.status-selesai {
  background-color: #d1e7dd;
  color: #0f5132;
}

.status-dibatalkan {
  background-color: #f8d7da;
  color: #842029;
}
</style>
