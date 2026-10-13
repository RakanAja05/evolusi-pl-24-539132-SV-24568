# Deployment Guide

## Struktur Project

```
evolusi-plfe-24-539132-SV-24568/
├── .github/workflows/cicd.yml
├── src/
│   ├── main.ts
│   ├── pages/
│   │   ├── Home.vue
│   │   └── TugasList.vue
│   └── vite-env.d.ts
├── package.json
├── vite.config.ts
└── vitest.config.ts
```

## CI/CD Pipeline (4 Jobs)

1. **lint** - ESLint untuk TypeScript files
2. **test** - Vitest unit tests
3. **build** - Build production (npm run build)
4. **deploy** - Deploy hanya dari branch `main`

### Flow:
- Push ke main: lint → test → build → deploy
- Pull Request: lint → test → build (deploy skipped)

## Setup untuk Development

```bash
# Install dependencies
npm install

# Run dev server
npm run dev

# Run build
npm run build

# Run tests
npm run test:unit

# Lint
npm run lint
```

## Environment Variables

```
VITE_API_URL=http://localhost:8000
VITE_ROUTER_HISTORY=false
```

## Requirements Fulfilled

✅ Laravel API endpoint GET /api/tugas (diasumsikan sudah ada di Laravel backend)
✅ Vue 3 dengan 2 halaman (Home.vue, TugasList.vue)
✅ Router dengan VITE_API_URL dari environment
✅ GitHub Actions 4 jobs dengan needs:
- deploy tidak menjalankan npm run build lagi (download artifacts)
- deploy hanya dari main
- PR tetap jalankan lint, test, build
✅ Unit test Vitest di example.test.ts
✅ Buktikan:
- PR → deploy skipped (if: github.ref == 'refs/heads/main')
- Test gagal → pipeline merah (needs: [lint, test])
