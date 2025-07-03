<script setup lang="ts">

import {Drawer, DrawerClose, DrawerContent, DrawerHeader, DrawerTitle, DrawerTrigger} from "~/components/shadcn/drawer";
import {ArrowRightIcon, Bars3Icon, ChevronUpDownIcon, XMarkIcon} from "@heroicons/vue/24/solid";
import {Collapsible, CollapsibleContent, CollapsibleTrigger} from "~/components/shadcn/collapsible";
import {Button} from "~/components/shadcn/button";

const isOpen = ref(false)

const components: { title: string, href: string, description: string }[] = [
  {
    title: 'Work Experience',
    href: '/experience/work',
    description: 'A list of all current and previous working experiences.',
  },
  {
    title: 'Studies',
    href: '/experience/studies',
    description: 'A list of all obtained studies and certificates.',
  },
  {
    title: 'Techniques',
    href: '/experience/subjects',
    description: 'All technical and non-technical obtained experiences.',
  },
]
</script>

<template>
  <Drawer direction="top">
    <DrawerTrigger as-child>
      <div class="flex justify-center pt-6 col-start-7" >
        <Button class="h-6 w-6" variant="ghost">
          <Bars3Icon class="brand_icon"/>
        </Button>
      </div>
    </DrawerTrigger>
    <DrawerContent class="bg-[#F4EFE6]">
      <DrawerHeader>
        <DrawerTitle class="p-2 text-2xl text-[#808000]">Menu Options</DrawerTitle>
        <separator class="mt-2 mx-2bg-gray-300"></separator>
      </DrawerHeader>
      <div class="px-4">
        <Collapsible v-model:open="isOpen" class="space-y-2 py-4">
            <CollapsibleTrigger as-child>
              <div class="flex items-center space-x-4 px-2 flex-row justify-between">
                <p class="text-sm font-semibold">
                  Experience
                </p>
                <Button variant="secondary" size="sm" class="p-0 rounded-full">
                  <ChevronUpDownIcon class="h-4 w-4" />
                  <span class="sr-only">Toggle</span>
                </Button>
              </div>
            </CollapsibleTrigger>
          <CollapsibleContent class="space-y-2">
            <ul class="grid gap-3 p-1">
              <li v-for="component in components" :key="component.title">
                <div class="px-4 py-1 font-mono text-sm flex-row flex">
                  <ArrowRightIcon class="h-3 w-4 content-center"/>
                  <a :href="component.href" class="pl-3">{{ component.title }}</a>
                </div>
              </li>
            </ul>
          </CollapsibleContent>
        </Collapsible>
        <div class="flex gap-8 flex-col pb-4">
          <div class="text-sm font-semibold space-x-4 px-2">
            <a href="/blogs">
              Blogs
            </a>
          </div>
          <div class="text-sm font-semibold space-x-4 px-2">
            <a href="/personal">
              Personal
            </a>
          </div>
          <div class="text-sm font-semibold space-x-4 px-2">
            <a href="/home/technique/dev/technique/front-end/pages/contact">
              Contact
            </a>
          </div>
        </div>
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