<script setup lang="ts" xmlns="http://www.w3.org/1999/html">
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle,
} from '~/components/shadcn/navigation-menu'
import {Separator} from "~/components/shadcn/separator";
import {PencilSquareIcon, CogIcon, UserCircleIcon, InformationCircleIcon} from "@heroicons/vue/24/solid";
import {getLocaleSpecificVariable} from "~/lib/utils";

const { t, locale, locales } = useI18n();
const localePath = useLocalePath();
const switchLocalePath = useSwitchLocalePath();

const components: { title: string, href: string, subtext: string }[] = [
  {
    title: t('menu.experience_tabs.work'),
    href: '/experience/work',
    subtext: t('menu.experience_tabs.work_subtext'),
  },
  {
    title: t('menu.experience_tabs.studies'),
    href: '/experience/studies',
    subtext: t('menu.experience_tabs.studies_subtext'),
  },
  {
    title: t('menu.experience_tabs.techniques'),
    href: '/experience/subjects',
    subtext: t('menu.experience_tabs.techniques_subtext'),
  },
];

const language_images: { code: string, src: string }[] = [
  {
    code: 'en',
    src: new URL('/assets/images/gb.svg', import.meta.url).href,
  },
  {
    code: 'nl',
    src: new URL('/assets/images/nl.svg', import.meta.url).href,
  },
];

useSeoMeta({
  en: '/en.svg',
  nl: '/nl.svg'
})

const currentLanguageImage = language_images.find(item => item.code === locale.value)!.src;

const title_hover = ref(false);
const personal_hover = ref(false);
const information_hover = ref(false);

const { data : blogs } = await useFetch('http:localhost:8000/api/blogs');
</script>

<template>
  <div class="justify-center px-20 py-4 flex flex-col items-center">
    <div class="p-12 font-bold text-4xl md:text-6xl text-[#808000]" @mouseover="title_hover = true" @mouseleave="title_hover = false">
      <h1 class="flex flex-row hover:text-green-500">
        <CogIcon class="w-8 h-8 animate-spin" v-if="title_hover"/>
        <a href="/">Technique</a>
      </h1>
    </div>
    <NavigationMenu>
      <NavigationMenuList>
        <NavigationMenuItem>
          <NavigationMenuTrigger class="hover:text-green-500">{{t("menu.experience")}}</NavigationMenuTrigger>
          <NavigationMenuContent>
            <ul class="grid w-[200px] gap-3 p-4 md:w-[300px] md:grid-cols-1 lg:w-[400px] ">
              <li v-for="component in components" :key="component.title">
                <NavigationMenuLink as-child>
                  <a
                      :href="localePath(component.href)"
                      class="block select-none space-y-1  rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground hover:text-green-500"
                  >
                    <div class="text-sm font-medium leading-none">{{ component.title }}</div>
                    <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                      {{ component.subtext }}
                    </p>
                  </a>
                </NavigationMenuLink>
              </li>
            </ul>
          </NavigationMenuContent>
        </NavigationMenuItem>
        <NavigationMenuItem>
          <NavigationMenuTrigger class="hover:text-green-500">{{ t('menu.blog') }}</NavigationMenuTrigger>
          <NavigationMenuContent>
            <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px] lg:grid-cols-[minmax(0,.75fr)_minmax(0,1fr)]">
              <li class="row-span-3">
                <NavigationMenuLink as-child>
                  <a
                      class="flex h-full w-full select-none flex-col justify-end rounded-md bg-gradient-to-b from-muted/50 to-muted p-6 no-underline outline-none focus:shadow-md hover:text-green-500"
                      :href="localePath('/blogs')"
                  >
                    <PencilSquareIcon class="h-6 w-6 text-green-500" />
                    <div class="mb-2 mt-4 text-lg font-medium">
                      {{ t('menu.blog_tabs.title') }}
                    </div>
                    <p class="text-sm leading-tight text-muted-foreground">
                      {{ t('menu.blog_tabs.subtext') }}
                    </p>
                  </a>
                </NavigationMenuLink>
              </li>
              <li v-for="blog in blogs" :key="blog.title" >
                <NavigationMenuLink as-child>
                  <a
                      v-if="getLocaleSpecificVariable(blog.title) !== undefined || getLocaleSpecificVariable(blog.description) !== undefined"
                      :href="localePath('/blogs/' + blog.id)"
                      class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent focus:bg-accent focus:text-accent-foreground hover:text-green-500"
                  >
                    <p v-html="getLocaleSpecificVariable(blog.title)" />
                    <p v-html="getLocaleSpecificVariable(blog.description)" class="line-clamp-2 text-sm leading-snug text-muted-foreground" />
                  </a>
                </NavigationMenuLink>
              </li>
            </ul>
          </NavigationMenuContent>
        </NavigationMenuItem>
        <NavigationMenuItem>
          <NavigationMenuLink :href="localePath('/personal')" :class="navigationMenuTriggerStyle()" class="hover:text-green-500 flex flex-row" @mouseover="personal_hover = true" @mouseleave="personal_hover = false">
            <UserCircleIcon class="w-4 h-4 hover:text-green-500" v-if="personal_hover"/>
            <p>{{ t('menu.personal') }}</p>
          </NavigationMenuLink>
        </NavigationMenuItem>
        <NavigationMenuItem>
          <NavigationMenuLink :href="localePath('/contact')" :class="navigationMenuTriggerStyle()" class="hover:text-green-500 flex flex-row" @mouseover="information_hover = true" @mouseleave="information_hover = false">
            <InformationCircleIcon class="w-4 h-4 hover:text-green-500" v-if="information_hover"/>
            <p>{{ t('menu.contact') }}</p>
          </NavigationMenuLink>
        </NavigationMenuItem >
        <NavigationMenuItem >
          <NavigationMenuTrigger>
            <img :src="currentLanguageImage" width="24" height="24" class="rounded-2xl" alt=""/>
          </NavigationMenuTrigger>
          <NavigationMenuContent class="!right-0 left-auto">
            <p class="text-2xl py-2 text-center font-semibold text-[#808000]">{{ t('language.title') }}</p>
            <ul class="grid w-[150px] gap-3 p-4 md:w-[200px] md:grid-cols-1 lg:w-[300px]">
              <li v-for="{code} in locales" :key="code" class="items-end" dir="rtl">
                <NavigationMenuLink as-child >
                  <a
                      :href="switchLocalePath(code)"
                      class="flex select-none rounded-md leading-none no-underline outline-none transition-colors hover:bg-accent
                     hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground justify-items-stretch">
                    <div class="inline-flex gap-3 hover:text-green-500 font-light hover:font-bold">
                      <img :src="language_images.find(i => i.code === code)?.src" width="32" height="32" class="rounded-full"/>
                      <div class="p-2 text-sm  leading-none">{{ t('language.' + code) }}</div>
                    </div>
                  </a>
                  <Separator class="my-2 bg-gray-200"/>
                </NavigationMenuLink>
              </li>
            </ul>
          </NavigationMenuContent>
        </NavigationMenuItem>
      </NavigationMenuList>
    </NavigationMenu>
    <Separator class="my-6" />
  </div>
</template>