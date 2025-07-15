<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod'
import { useForm } from 'vee-validate'
import { h } from 'vue'
import * as z from 'zod'

import { Button } from '~/components/shadcn/button'
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '~/components/shadcn/form'
import { Input } from '~/components/shadcn/input'
import { toast } from 'vue-sonner'
import { Textarea } from "~/components/shadcn/textarea";

const formSchema = toTypedSchema(z.object({
  full_name: z.string().min(2).max(50),
  email: z.string().min(5).email().max(100),
  content: z.string().min(20),
}))


const { isFieldDirty, handleSubmit } = useForm({
  validationSchema: formSchema,
})

const onSubmit = handleSubmit(async (values) => {
  const res = await $fetch('http://localhost:8000/api/contact_request', {
    method: 'POST',
    body: JSON.stringify(values, null, 2)
  })

  toast('You submitted the contact form using the following email:', {
    description: h('pre', {class: 'mt-2 w-[340px] rounded-md bg-slate-950 p-4'}, h('code', {class: 'text-white'}, res.valueOf().email)),
  });
})
</script>

<template>
  <div class="items-center flex flex-col gap-6">
    <div class="items-center flex flex-col gap-10 py-8">
      <h1 class="text-3xl lg:text-6xl text-[#808000]"> Contact Form </h1>
      <p class="font-light text-sm lg:text-md px-8"> Place a general piece of text about the contact form. </p>
    </div>
    <form class="w-2/3 space-y-6" @submit="onSubmit">
      <FormField v-slot="{ componentField }" name="full_name" :validate-on-blur="!isFieldDirty">
        <FormItem>
          <FormLabel>Name</FormLabel>
          <FormControl>
            <Input type="text" placeholder="Full Name" v-bind="componentField" />
          </FormControl>
          <FormDescription>
            Please enter your full name.
          </FormDescription>
          <FormMessage />
        </FormItem>
      </FormField>

      <FormField v-slot="{ componentField }" name="email" :validate-on-blur="!isFieldDirty">
        <FormItem>
          <FormLabel>Your Email</FormLabel>
          <FormControl>
            <Input type="email" placeholder="Email-address" v-bind="componentField" />
          </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>

      <FormField v-slot="{ componentField }" name="content" :validate-on-blur="!isFieldDirty">
        <FormItem>
          <FormLabel>Content</FormLabel>
          <FormControl>
             <Textarea
                 placeholder="Tell your story here."
                 class="h-40"
                 v-bind="componentField"
             />
          </FormControl>
          <FormMessage />
          <FormDescription>
            <i>To <b>increase</b> the size of this field drag down on the bottom right side.</i>
          </FormDescription>
        </FormItem>
      </FormField>

      <div class="flex items-center flex-col pt-10">
        <!-- TODO: Enable submission when Resend domain is fixed. -->
        <Button type="submit" class="bg-[#808000] font-bold text-xl px-20" disabled="true">
          Send
        </Button>
      </div>
    </form>
  </div>

</template>