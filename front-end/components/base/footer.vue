<script setup lang="ts">
import { useWindowSize } from '@vueuse/core'
import RefIconButton from "~/components/other/RefIconButton.vue";

const { width } = useWindowSize()

interface Contact {
  id: number,
  name: string,
  href: string,
  media_url: string,
}

const { data } = await useFetch('http:localhost:8000/api/contact');
const contactArray = data.value as Array<Contact>;

const { t } = useI18n();

const contactIconList = contactArray.map((value) => {
  return {
    contact: value,
  }
})
</script>

<template>
  <div class="grid lg:grid-cols-8 grid-cols-3 lg:grid-rows-3 grid-rows-3 flex-col lg:flex-row">
    <div class="lg:col-span-2 col-span-3 lg:row-span-3 row-span-1 pt-5 pl-4">
      <div class="footer_branding">
        <img src="../../assets/images/t-solid.svg" class="brand_icon content-center"/>
        <Separator orientation="vertical" class="bg-gray-500" />
        <a href="/" class="text-center text-xl lg:text-3xl font-semibold content-center hover:text-shadow-sm">Technique</a>
      </div>
    </div>
    <div class="lg:col-span-4 col-span-3 row-span-2 lg:row-span-3 lg:col-start-3 col-start-1 lg:mt-4">
      <div class="grid lg:grid-cols-4 grid-cols-1 grid-rows-3 lg:grid-rows-1 lg:gap-4 gap-1 lg:pt-5 pl-4 lg:pb-4">
        <div class="footer_refs">
          <a href="/experience/work" class="font-normal lg:font-semibold">{{ t('menu.experience') }}</a>
          <div class="flex-row grid gap-4 py-5" v-if="width >= 1024">
            <a href="/experience/work" class="hover:underline hover:font-medium font-light text-sm">{{ t('menu.experience_tabs.work') }}</a>
            <a href="/experience/studies" class="hover:underline hover:font-medium  font-light text-sm">{{ t('menu.experience_tabs.studies') }}</a>
            <a href="/experience/subjects" class="hover:underline hover:font-medium  font-light text-sm">{{ t('menu.experience_tabs.techniques') }}</a>
          </div>
        </div>
        <div class="footer_refs">
          <a class="hover:underline hover:font-bold font-medium" href="/blogs"> {{ t('menu.blog') }} </a>
        </div>
        <div class="footer_refs">
          <a class="hover:underline hover:font-bold font-medium" href="/personal"> {{ t('menu.personal') }} </a>
        </div>
      </div>
    </div>
    <div class="lg:col-span-2 col-span-3 row-span-1 lg:row-span-3 lg:col-start-7 pl-6 lg:pl-0 lg:pt-9 flex flex-col lg:w-50 lg:gap-3">
      <div class="py-2 font-semibold"> {{ t('menu.contact') }} </div>
      <div class="flex flex-row py-2 gap-4">
        <div v-for="contact in contactIconList">
         <RefIconButton  :reference="contact.contact" />
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>

</style>