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
                <Link class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" href="/boards/create">
                  <span>Create</span>
                  <span class="hidden md:inline">&nbsp;Board</span>
                </Link>
               
             </div>
        </div>
        
        <div  >
            <div class="max-w-7xl mx-auto  ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900">All user boards count : {{boards.length}} </div>
                </div>

             </div>
        </div>
        
        <div  v-if="boards.length > 0" class="bg-gradient-to-bl from-blue-50 to-violet-50 flex items-center justify-center ">
          <div class="container   p-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
              <!-- Replace this with your grid items -->
              <div v-for="board in boards" :key="board.id" class="bg-white rounded-lg border p-4">
                
                <div class="px-1 py-4">
                  <div class="font-bold text-xl mb-2">{{board.title}}</div>
                  <br>
                  <div class="grid grid-cols-2 text-center">
                    <div >
                      <span class="font-bold">
                        Working 
                      </span>
                      <br>
                      <br>
                      <div>
                        <div v-for="(workingTicket , index ) in board.working_tickets" :key="workingTicket.id">
                          {{ index+1  }} - {{workingTicket.title}} 
                          <Link class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300" :href="`/tickets/${workingTicket.id}/make-done`">
                            <span>Done</span>
                          </Link>
                        </div>
                      </div>
                    </div>
                    
                    <div >
                      <span class="font-bold">
                        Done 
                      </span>
                      <br>
                      <br>
                      <div>
                        <div v-for="(doneTicket,index) in board.done_tickets" :key="doneTicket.id">
                          {{ index+1  }} - {{doneTicket.title}}
                        </div>
                      </div>
                    </div>

                  </div>
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
  props: {
    boards: Array,
  }
  
}
</script>
