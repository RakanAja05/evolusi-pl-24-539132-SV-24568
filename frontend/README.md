# Frontend Tugas CRUD - Vue 3

Aplikasi frontend Vue 3 untuk menampilkan data Tugas CRUD dari Laravel backend.

## Setup

### Prerequisites
- Node.js 20+
- Laravel backend berjalan di `http://localhost:8000`

### Install dependencies
```bash
npm install
```

### Environment
Copy `.env.example` ke `.env` dan sesuaikan:
```
VITE_API_URL=http://localhost:8000
VITE_ROUTER_HISTORY=false
```

### Run development server
```bash
npm run dev
```

### Build untuk production
```bash
npm run build
```

### Run unit tests
```bash
npm run test:unit
```

### Lint
```bash
npm run lint
```

## Struktur
```
frontend/
├── src/
│   ├── main.ts
│   ├── pages/
│   │   ├── Home.vue
│   │   └── TugasList.vue
│   └── example.test.ts
├── .github/workflows/cicd.yml
├── package.json
└── vite.config.ts
```

## CI/CD Pipeline
Pipeline menjalankan 4 job:
1. **lint** - ESLint untuk code quality
2. **test** - Vitest untuk unit tests
3. **build** - Build production
4. **deploy** - Deploy hanya dari branch `main`

PR tidak menjalankan deploy job.
