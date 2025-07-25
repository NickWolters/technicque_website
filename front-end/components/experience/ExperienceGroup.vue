<script setup lang="ts">
import { CalendarIcon } from 'lucide-vue-next'
import { ChevronDoubleRightIcon, BoltIcon } from "@heroicons/vue/24/solid";

import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from '@/components/shadcn/avatar'
import { Button } from '@/components/shadcn/button'
import {
  HoverCard,
  HoverCardContent,
  HoverCardTrigger,
} from '@/components/shadcn/hover-card'

defineProps<{
  experience_group : {
    name: string,
    description: string,
    experiences? : [{
      title: string,
      description: string,
      icon_abbreviation: string,
      id: number,
      start_year: number
    }]
  }
}>()

const currentCardImageURL = ref('');
const { t } = useI18n();

function get_proficiency_related_color(color: string) : string {
  switch (color) {
    case "minimal":
      return 'text-[#F78914]';
    case "basic":
      return 'text-[#FFDA38]';
    case "ok":
      return 'text-[#C2D96C]';
    case "good":
      return 'text-[#83AB3E]';
    case "excellent":
      return 'text-[#547517]';
    default:
      return 'text-[#000000]';
  }
}


    async function getIcon(id: number) {
  if (id != null && id >= 1) {
    await useFetch(`http://localhost:8000/api/experience/download/${id}`, {
      onResponse: function ({response}) {
        currentCardImageURL.value = response._data;
      },
    })
  }
}
</script>

<template>
  <div class="flex gap-5 px-10 lg:px-30 py-6 flex-col mb-6">
    <div class="font-bold text-3xl flex flew-row gap-4">
      <ChevronDoubleRightIcon class="h-8 w-8" />
      {{ experience_group.name }}
    </div>
    <Separator></Separator>
    <span class="pt-2" v-html="experience_group.description"></span>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 pt-4 py-2">
      <div v-for="experience in experience_group.experiences" class="flex justify-center flex-col">
        <HoverCard>
          <HoverCardTrigger as-child @mouseover="getIcon(experience.id)">
            <Button variant="link" class="bg-green-100 py-4 text-sm lg:text-md hover:bg-green-600 hover:text-white" >
              {{ experience.title }}
            </Button>
          </HoverCardTrigger>
          <HoverCardContent class="w-80">
            <div class="flex justify-between space-x-4">
              <Avatar>
                <AvatarFallback class="bg-green-600 text-white font-bold">{{ experience.icon_abbreviation }}</AvatarFallback>
                <AvatarImage class="p-1" :src='currentCardImageURL'/>
              </Avatar>
              <div class="space-y-1">
                <h4 class="text-sm font-semibold">
                  {{ experience.title }}
                </h4>
                <Separator class="my-2"></Separator>
                <p class="text-sm">
                  <span v-html="experience.description"></span>
                </p>
                <Separator class="my-2"></Separator>
                <div class="flex items-center pt-2">
                  <CalendarIcon class="mr-2 h-4 w-4 opacity-70" />
                  <span class="text-xs text-muted-foreground">
                    {{ t('experience.since') }} <span v-html="experience.start_year"></span>
                  </span>
                </div>
                <div class="flex items-center pt-2">
                  <BoltIcon class="mr-2 h-4 w-4" :class="`${get_proficiency_related_color(experience.proficiency)}`" />
                  <span class="text-xs text-muted-foreground">
                    {{ t('experience.proficiency') }} <span v-html="experience.proficiency"></span>
                  </span>
                </div>
            </div>
            </div>
          </HoverCardContent>
        </HoverCard>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>