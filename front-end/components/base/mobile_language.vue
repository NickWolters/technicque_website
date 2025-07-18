<script setup lang="ts">

import {Drawer, DrawerClose, DrawerContent, DrawerHeader, DrawerTitle, DrawerTrigger} from "~/components/shadcn/drawer";
import {Button} from "~/components/shadcn/button";
import {LanguageIcon, XMarkIcon} from "@heroicons/vue/24/solid";
import {Separator} from "~/components/shadcn/separator";

const language_images: { code: string, src: string }[] = [
  {
    code: 'en',
    src: new URL('~/assets/images/gb.svg', import.meta.url).href,
  },
  {
    code: 'nl',
    src: new URL('~/assets/images/nl.svg', import.meta.url).href,
  },
];

const { t } = useI18n();
const localePath = useLocalePath();
const { locale, locales } = useI18n();
const switchLocalePath = useSwitchLocalePath();
</script>

<template>
  <Drawer direction="top">
    <DrawerTrigger as-child>
      <Button class="h-6 w-6" variant="ghost">
        <LanguageIcon class="brand_icon"/>
      </Button>
    </DrawerTrigger>
    <DrawerContent class="bg-[#F4EFE6]">
      <DrawerHeader>
        <DrawerTitle> {{ t('language.title') }} </DrawerTitle>
      </DrawerHeader>
      <div class="px-2">
        <ul class="grid gap-3 p-4 md:grid-cols-1 lg:w-[300px]">
          <li v-for="{code} in locales" :key="code" class="items-end ">
              <a
                  :href="switchLocalePath(code)"
                  class="flex select-none rounded-md leading-none no-underline outline-none transition-colors hover:bg-accent
                      hover:text-green-500 hover:font-bold focus:bg-accent focus:text-accent-foreground justify-items-stretch">
                <div class="inline-flex gap-3 font-light">
                  <img :src="language_images.find(i => i.code === code)?.src" width="32" height="32" class="rounded-full"/>
                  <div class="p-2 text-sm leading-none">{{ t('language.' + code) }}</div>
                </div>
              </a>
            <Separator class="my-2 bg-gray-200"/>
          </li>
        </ul>
      </div>
      <DrawerClose class="py-2">
        <Button class="h-8 w-8 p-1 py-4 rounded-full" variant="secondary">
          <XMarkIcon class="brand_icon"/>
        </Button>
      </DrawerClose>
    </DrawerContent>
  </Drawer>
</template>

<style scoped>

</style>