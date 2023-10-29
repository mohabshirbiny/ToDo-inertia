<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
        
        <div v-if="$page.props.auth.user.admin" class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"><b>Admin Stats</b></div>
                </div>
                
            </div>
        </div>

        <div  v-if="$page.props.auth.user.admin" class="bg-gradient-to-bl from-blue-50 to-violet-50 flex items-center justify-center ">
          <div class="container   p-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
              <!-- Replace this with your grid items -->
              <div  class="bg-white rounded-lg border p-4">
                
                <div v-if="!!mostIncludedUser" class="px-1 py-4">
                  <div class="font-bold text-xl mb-2">User Included in most boards</div>
                  <table>
                    <tr  >{{ mostIncludedUser.name }} : {{ mostIncludedUser.boards_count }} boards</tr>
                  </table>
                  <br>
                   
                </div>
                 
              </div>
              
              <div  class="bg-white rounded-lg border p-4">
                
                <div class="px-1 py-4">
                  <div class="font-bold text-xl mb-2"> Top 3 Boards most done Tickets to the total</div>
                  <table>
                    <tr v-for="topDoneBoard in topDoneBoards" >{{ topDoneBoard.title }} : {{ topDoneBoard.done_tickets }} done of {{ topDoneBoard.all_tickets }}</tr>
                  </table>
                  <br>
                   
                </div>
                 
              </div>
              
              <div v-if="!!mostActivityBoard" class="bg-white rounded-lg border p-4">
                
                <div class="px-1 py-4">
                  <div class="font-bold text-xl mb-2"> Board with most activity</div>
                  <table>
                    <tr ><b>{{ mostActivityBoard.title }}</b>  : {{ mostActivityBoard.marked_done_tickets }} tickets </tr>
                  </table>
                  <br>
                   
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

  props: {
    mostIncludedUser: Object,
    topDoneBoards: Array,
    mostActivityBoard: Object,
  }
  
}
</script>