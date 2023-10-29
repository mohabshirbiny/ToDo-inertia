<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessages from '../../Layouts/Shared/FlashMessages.vue';

import LoadingButton from '@/Layouts/Shared/LoadingButton.vue'
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Create Board" />

  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Board</h2>
      </template>


      <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
              <form class="w-full max-w-lg" @submit.prevent="store">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Board Title
                    </label>
                    <input v-model="form.title" :error="form.errors.title" class="appearance-none block w-full bg-gray-200 text-gray-700 border   rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="">
                    <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                  </div>
                  
                </div>
                
                 
                
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      invite users
                    </label>
                    <select  multiple v-model="form.users" :error="form.errors.users"  class="select2 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                     
                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.email}}</option>
                  </select>                  
                </div>

                  
                  
                </div>
                
                <loading-button :loading="form.processing" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="submit">Create Board</loading-button>
                
              </form>
              <flash-messages />
            </div>
        </div>
  </AuthenticatedLayout>
</template>
 
<script>


export default {
  components: {
    // FileInput,
    Head,
    // Link,
    // LoadingButton,
    // SelectInput,
    // TextInput,
  },
  // layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        title: '',
        users: []
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/boards')
    },
  },
  props: {
    users: Array,
  }
}
</script>
