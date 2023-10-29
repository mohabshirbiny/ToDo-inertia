<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
import PrimaryButton from '../../Components/PrimaryButton.vue';
import FlashMessages from '../../Layouts/Shared/FlashMessages.vue';
</script>

<template>
    <Head title="Boards" />

    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Boards</h2>
        </template>

        

        <div class="py-12">
          
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <flash-messages />
              
              
               
             </div>
             <div class="max-w-7xl mx-auto sm:px-6 ">
                <Link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="/boards/create">
                  <span>Create</span>
                  <span class="hidden md:inline">&nbsp;Board</span>
                </Link>
               
             </div>
        </div>
        
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-26 text-gray-900">all user Boards Here {{boards.length}} </div>
                </div>

             </div>
        </div>

        <div class="bg-gradient-to-bl from-blue-50 to-violet-50 flex items-center justify-center lg:h-screen">
          <div class="container mx-auto mx-auto p-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
              <!-- Replace this with your grid items -->
              <div v-for="board in boards" :key="board.id" class="bg-white rounded-lg border p-4">
                
                <div class="px-1 py-4">
                  <div class="font-bold text-xl mb-2">{{board.title}}</div>
                  <p class="text-gray-700 text-base">
                    This is a simple blog card example using Tailwind CSS. You can replace this text with your own blog content.
                  </p>
                </div>
                <div class="px-1 py-4">
                  <Link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" :href="`/boards/${board.id}/create-ticket`">
                  <span>Add Ticket</span>
                </Link>
                </div>
              </div>
              
              <!-- Add more items as needed -->
            </div>
          </div>
        </div>
        
        
    </AuthenticatedLayout>
</template>

<script>

export default {
  components: {
    Head,
    FlashMessages
  },
//   layout: Layout,
  props: {
    boards: Array,
  }
  
}
</script>
