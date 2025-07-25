// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  css: ['~/assets/css/main.css', '~/assets/scss/main.scss'],

  devtools: { enabled: true },
  devServer: {
    url: 'https://localhost:8000'
  },

  i18n: {
    defaultLocale: 'en',
    locales: [
      { code: 'en', name: 'English', file: 'en.json' },
      { code: 'nl', name: 'Nederlands', file: 'nl.json' }
    ],
    vueI18n: './i18n/i18n.config.ts',
    strategy: 'prefix_except_default',
  },

  modules: ['shadcn-nuxt', '@nuxtjs/i18n', '@pinia/nuxt'],

  shadcn: {
    prefix: '',
    componentDir: './components/shadcn'
  },

  vite: {
    plugins: [
      tailwindcss(),
    ],
  },
})