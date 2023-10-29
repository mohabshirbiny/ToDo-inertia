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
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Ticket in board : {{ board.title }}</h2>
      </template>


      <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
              <form class="w-full max-w-lg" @submit.prevent="store">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Ticket Title
                    </label>
                    <input v-model="form.title" :error="form.errors.title" class="appearance-none block w-full bg-gray-200 text-gray-700 border   rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="">
                    <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                  </div>
                  
                </div>
                
                 
                
                
                
                <loading-button :loading="form.processing" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="submit">Create Ticket</loading-button>
                
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
        title: ''
      }),
    }
  },
  methods: {
    store() {
      this.form.post(`/boards/${this.board.id}/create-ticket`)
    },
  },
  props: {
    board: Object,
  }
}
</script>
