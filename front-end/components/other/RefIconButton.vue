<script setup lang="ts">

defineProps<{
  reference : {
    href: string,
    media_url: string,
    name: string
  },
}>()
</script>

<template>
  <TooltipProvider>
    <Tooltip>
      <TooltipTrigger asChild>
        <div class="w-10 h-10 bg-amber-100 hover:bg-amber-500 rounded-full">
          <a :href="reference.href" >
            <img :src="reference.media_url" alt="" class="w-full p-3"/>
          </a>
        </div>
      </TooltipTrigger>
      <TooltipContent class="fade-in-30">
        <p>{{ reference.name }}</p>
      </TooltipContent>
    </Tooltip>
  </TooltipProvider>
</template>