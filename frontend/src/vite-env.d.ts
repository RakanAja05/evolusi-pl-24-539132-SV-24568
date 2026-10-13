/// <reference types="vite/client" />

declare module '*.vue' {
  import type { DefineComponent } from 'vue'
  const component: DefineComponent<{}, {}, any>
  export default component
}

declare const importMetaEnv: {
  readonly VITE_API_URL: string
  readonly VITE_ROUTER_HISTORY: string
}

declare const importMeta: {
  readonly env: typeof importMetaEnv
}
