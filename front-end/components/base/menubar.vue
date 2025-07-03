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
import {PencilSquareIcon} from "@heroicons/vue/24/solid";


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

const { data : blogs } = await useFetch('http:localhost:8000/api/blogs');
</script>

<template>
  <div class="justify-center px-8 py-4 flex flex-col items-center">
    <div class="p-8 font-bold text-4xl text-[#808000]">
      <h1>Technique</h1>
    </div>
    <NavigationMenu>
      <NavigationMenuList>
        <NavigationMenuItem>
          <NavigationMenuTrigger class="hover:text-green-500">Experiences</NavigationMenuTrigger>
          <NavigationMenuContent>
            <ul class="grid w-[200px] gap-3 p-4 md:w-[300px] md:grid-cols-1 lg:w-[400px] ">
              <li v-for="component in components" :key="component.title">
                <NavigationMenuLink as-child>
                  <a
                      :href="component.href"
                      class="block select-none space-y-1  rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground hover:text-green-500"
                  >
                    <div class="text-sm font-medium leading-none">{{ component.title }}</div>
                    <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                      {{ component.description }}
                    </p>
                  </a>
                </NavigationMenuLink>
              </li>
            </ul>
          </NavigationMenuContent>
        </NavigationMenuItem>
        <NavigationMenuItem>
          <NavigationMenuTrigger class="hover:text-green-500">Blog</NavigationMenuTrigger>
          <NavigationMenuContent>
            <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px] lg:grid-cols-[minmax(0,.75fr)_minmax(0,1fr)]">
              <li class="row-span-3">
                <NavigationMenuLink as-child>
                  <a
                      class="flex h-full w-full select-none flex-col justify-end rounded-md bg-gradient-to-b from-muted/50 to-muted p-6 no-underline outline-none focus:shadow-md hover:text-green-500"
                      href="/blogs"
                  >
                    <PencilSquareIcon class="h-6 w-6 text-green-500" />
                    <div class="mb-2 mt-4 text-lg font-medium">
                      Technique Blogs
                    </div>
                    <p class="text-sm leading-tight text-muted-foreground">
                      Personal blogs related to either tech, design or any other subject that might intrest me personally.
                    </p>
                  </a>
                </NavigationMenuLink>
              </li>
              <li v-for="blog in blogs" :key="blog.title" >
                <NavigationMenuLink as-child>
                  <NuxtLink
                      :to="'/blogs/' + blog.id"
                      class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent focus:bg-accent focus:text-accent-foreground hover:text-green-500"
                  >
                    <p v-html="blog.title" />
                    <p v-html="blog.description" class="line-clamp-2 text-sm leading-snug text-muted-foreground" />
                  </NuxtLink>
                </NavigationMenuLink>
              </li>
            </ul>
          </NavigationMenuContent>
        </NavigationMenuItem>
        <NavigationMenuItem>
          <NavigationMenuLink href="/personal" :class="navigationMenuTriggerStyle()" class="hover:text-green-500">
            Personal
          </NavigationMenuLink>
        </NavigationMenuItem>
        <NavigationMenuItem>
          <NavigationMenuLink href="/home/technique/dev/technique/front-end/pages/contact" :class="navigationMenuTriggerStyle()" class="hover:text-green-500">
            Contact
          </NavigationMenuLink>
        </NavigationMenuItem >
        <NavigationMenuItem >
          <NavigationMenuTrigger><img src="../../assets/images/gb.svg" width="24" height="24" class="rounded-2xl"/></NavigationMenuTrigger>
          <NavigationMenuContent class="!right-0 left-auto">
            <ul class="grid w-[150px] gap-3 p-4 md:w-[200px] md:grid-cols-1 lg:w-[300px]">
              <li v-for="language in languages" :key="language.name" class="items-end" dir="rtl">
                <NavigationMenuLink as-child >
                  <a
                      :href="language.href"
                      class="flex select-none rounded-md leading-none no-underline outline-none transition-colors hover:bg-accent
                     hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground justify-items-stretch">
                    <div class="inline-flex gap-3 ">
                      <img :src="language.src" width="32" height="32" class="rounded-full"/>
                      <div class="p-2 text-sm font-medium leading-none">{{ language.name }}</div>
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
    <Separator class="my-4" />
  </div>
</template>