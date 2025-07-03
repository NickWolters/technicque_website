<script setup lang="ts">
  import {Separator} from "~/components/shadcn/separator";
  import {Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious} from "~/components/shadcn/carousel";
  import {Card, CardContent} from "~/components/shadcn/card";
</script>

<template>
  <div class="justify-center m-8 p-4 bg-gray-100 py-16 grid grid-cols-1 rounded-2xl">
    <div class="col-start-1 row-start-1 grid grid-cols-4 grid-rows-5 gap-8 rounded-lg text-center font-mono text-sm leading-6 font-bold">
      <div class="col-span-2 row-span-5 justify-center flex place-content-center rounded-lg p-4">
        <Carousel class="relative w-full max-w-xs">
          <CarouselContent>
            <CarouselItem v-for="(_, index) in 5" :key="index">
              <div class="p-1">
                <Card class="bg-gray-200">
                  <CardContent class="flex aspect-square items-center justify-center p-6 ">
                    <span class="text-4xl font-semibold">{{ index + 1 }}</span>
                  </CardContent>
                </Card>
              </div>
            </CarouselItem>
          </CarouselContent>
          <CarouselPrevious />
          <CarouselNext />
        </Carousel>
      </div>
      <div class="text-left col-span-2 col-start-3 rounded-lg text-2xl">
        <h1 class="px-4"> {{ $t('welcome') }} </h1>
        <Separator class="my-4 bg-gray-900"/>
      </div>
      <div class="text-left col-span-2 row-span-4 col-start-3 row-start-2 rounded-lg bg-[#9AB973] p-4 mx-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
    </div>
  </div>
</template>

<style scoped>

</style>