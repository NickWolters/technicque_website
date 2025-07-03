// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  devtools: { enabled: true },
  css: ['~/assets/css/main.css', '~/assets/scss/main.scss'],

  devServer: {
    url: 'https://localhost:8000'
  },

  modules: ['shadcn-nuxt', '@nuxtjs/i18n'],
  shadcn: {
    /**
     * Prefix for all the imported component
     */
    prefix: '',
    /**
     * Directory that the component lives in.
     * @default "./components/ui"
     */
    componentDir: './components/shadcn'
  },
  i18n: {
    defaultLocale: 'en',
    locales: [
      { code: 'en', name: 'English', file: 'en.json' },
      { code: 'nl', name: 'Nederlands', file: 'nl.json' }
    ],
    vueI18n: './i18n/i18n.config.ts'
  },

  vite: {
    plugins: [
      tailwindcss(),
    ],
  },
})