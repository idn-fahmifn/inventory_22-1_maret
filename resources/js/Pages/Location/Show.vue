<script setup>
import Modal from '@/Components/Modal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';


const props = defineProps({
    user: Object,
    locations: Array
});

// mengatur modal open/close

const deleteItem = () => {
    // konfirmasi delete
    if(confirm('Are you sure...?')){
        
        // Mengirim method untuk delete data
        router.delete(route('user.destroy', props.user.id));
    }
}

</script>

<template>

    <Head title="Detail user" + user.name />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Detail User
                </h2>

                <button @click="deleteItem"
                    class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-red-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                    Delete
                </button>
            </div>

        </template>


        <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div
                    class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="overflow-x-auto p-6">
                        <div class="group space-x-2 mb-2">
                            <p class="text-slate-600 dark:text-slate-300 font-bold text-md">User Fullname : </p>
                            <p class="text-slate-600 dark:text-slate-300 text-md"> {{ user.name }} </p>
                        </div>
                        <div class="group space-x-2 mb-2">
                            <p class="text-slate-600 dark:text-slate-300 font-bold text-md">User Email : </p>
                            <p class="text-slate-600 dark:text-slate-300 text-md"> {{ user.email }} </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div
                    class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                    <th class="px-8 py-5">Location Name</th>
                                    <th class="px-8 py-5">Size</th>
                                    <th class="px-8 py-5 text-center">#</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                <tr v-for="location in locations" :key="location.id"
                                    class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-0.5">
                                        <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">{{ location }}
                                        </div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                            {{ location }}</div>
                                    </td>
                                    <td class="px-8 py-0.5">
                                        <span class="text-sm text-slate-600 dark:text-slate-400 px-3 py-1 rounded-lg">
                                            {{ location }} Location
                                        </span>
                                    </td>
                                    <td class="px-8 py-0.5 text-right">
                                        <a href="#"
                                            class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors mx-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <!-- <tr v-if="locations.length === 0">
                                    <td colspan="3" class="px-8 py-3 text-center">Location not found</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
