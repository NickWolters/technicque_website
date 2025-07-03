<script setup lang="ts">

import {Drawer, DrawerClose, DrawerContent, DrawerHeader, DrawerTitle, DrawerTrigger} from "~/components/shadcn/drawer";
import {Button} from "~/components/shadcn/button";
import {LanguageIcon, XMarkIcon} from "@heroicons/vue/24/solid";
import {Separator} from "~/components/shadcn/separator";

const languages: { name: string, href: string, src: string }[] = [
  {
    name: 'English',
    href: '/en',
    src: new URL('~/assets/images/gb.svg', import.meta.url).href,
  },
  {
    name: 'Dutch',
    href: '/nl',
    src: new URL('~/assets/images/nl.svg', import.meta.url).href,
  },
]

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
        <DrawerTitle>Languages</DrawerTitle>
      </DrawerHeader>
      <div class="px-2">
        <ul class="grid gap-4 p-4">
          <li v-for="language in languages" :key="language.name" class="items-end">
            <div >
              <a
                  :href="language.href"
                  class="flex select-none rounded-md leading-none no-underline outline-none transition-colors hover:bg-accent
                     hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground justify-items-stretch">
                <div class="inline-flex gap-3">
                  <img :src="language.src" width="32" height="32" class="rounded-full"/>
                  <div class="p-2 text-sm font-medium leading-none">{{ language.name }}</div>
                </div>
              </a>
            </div>
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