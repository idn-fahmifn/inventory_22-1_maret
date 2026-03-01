<script setup>
import Modal from '@/Components/Modal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';


const props = defineProps({
    locations: Array,
    items: Array,
});

// mengatur modal open/close

const showModal = ref(false);

// fungsi untuk membuka modal
const openModal = () => {
    form.reset();
    form.clearErrors();
    showModal.value = true;
}

const form = useForm({
    name: '',
    location: '',
    category: '',
    condition: '',
    stock: '',
    image: null,
    description: '',
})

const closeModal = () => {
    showModal.value = false;
    form.reset();
}

const submit = () => {
    form.post(route('item.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal()
    });
};

</script>

<template>

    <Head title="Items Page" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Items Page
                </h2>

                <button @click="openModal"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                    + Add New
                </button>
            </div>

        </template>

        <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div
                    class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                    <th class="px-8 py-5">Item Name</th>
                                    <th class="px-8 py-5">Stok</th>
                                    <th class="px-8 py-5 text-center">#</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                <tr v-for="item in items" :key="item.id"
                                    class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-0.5">
                                        <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">{{
                                            item.item_name }}
                                        </div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                            {{ item.category }}</div>
                                    </td>
                                    <td class="px-8 py-0.5">
                                        <span class="text-sm text-slate-600 dark:text-slate-400 px-3 py-1 rounded-lg">
                                            {{ item.stock }}
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
                                <tr v-if="items.length === 0">
                                    <td colspan="3" class="px-8 py-3 text-center text-slate-600 dark:text-slate-400">
                                        Item not
                                        found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="showModal" @close="closeModal">
            <div class="p-8 dark:bg-slate-900">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-xl font-black text-slate-800 dark:text-white">
                            Add Item
                        </h2>
                        <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Form insert new item.</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="">
                            <InputLabel for="name" value="Item Name" class="text-slate-600 dark:text-slate-400" />
                            <TextInput id="name" v-model="form.name" type="text"
                                class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-lg" />
                            <div v-if="form.errors.name" class="text-rose-500">{{ form.errors.name }}</div>
                        </div>
                        <div class="">
                            <InputLabel for="location" value="Location" class="text-slate-600 dark:text-slate-400" />
                            <select v-model="form.location" id="user"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                                <option value="" disabled>choose location</option>
                                <option v-for="location in locations" :key="location.id" :value="location.id">{{
                                    location.location_name }}</option>
                            </select>
                            <div v-if="form.errors.location" class="text-rose-500">{{ form.errors.location }}</div>
                        </div>
                    </div>
                    <div class="">
                        <InputLabel for="stock" value="Stok" class="text-slate-600 dark:text-slate-400" />
                        <TextInput id="stock" v-model="form.stock" type="number"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-lg" />
                        <div v-if="form.errors.stock" class="text-rose-500">{{ form.errors.stock }}</div>
                    </div>
                    <div class="">
                        <InputLabel for="category" value="category" class="text-slate-600 dark:text-slate-400" />
                        <select v-model="form.category" id="category"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                            <option value="" disabled>choose category</option>
                            <option value="tools">tools</option>
                            <option value="electronic">electronic</option>
                            <option value="transportation">transportation</option>
                            <option value="etc">etc</option>
                        </select>
                        <div v-if="form.errors.category" class="text-rose-500">{{ form.errors.category }}</div>
                    </div>
                    <div class="">
                        <InputLabel for="condition" value="condition" class="text-slate-600 dark:text-slate-400" />
                        <select v-model="form.condition" id="condition"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                            <option value="" disabled>choose condition</option>
                            <option value="good">good</option>
                            <option value="broke">Broke</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                        <div v-if="form.errors.condition" class="text-rose-500">{{ form.errors.condition }}</div>
                    </div>

                    <div class="">
                        <InputLabel for="image" value="Image" class="text-slate-600 dark:text-slate-400 " />
                
                        <input id="image" type="file"
                            @input="form.image = $event.target.files[0]"
                            class="py-6 px-3 mt-1 block w-full border border-dashed rounded-lg" >

                        <div v-if="form.errors.image" class="text-rose-500">{{ form.errors.image }}</div>

                    </div>

                    <div class="">
                        <InputLabel for="description" value="description" class="text-slate-600 dark:text-slate-400" />
                        <TextAreaInput v-model="form.description"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-md" />
                        <div v-if="form.errors.description" class="text-rose-500">{{ form.errors.description }}</div>
                    </div>




                    <div class="mt-8 flex justify-end gap-3">
                        <!-- button cancel -->
                        <button type="button" @click="closeModal"
                            class="px-6 py-2 rounded-lg text-sm text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition">close</button>

                        <button type="submit" :disabled="form.processing"
                            class="bg-blue-600 px-6 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-50 dark:hover:bg-blue-800 transition">
                            {{ form.processing ? 'saving data..' : 'save' }}
                        </button>
                    </div>

                </form>

            </div>
        </Modal>


    </AuthenticatedLayout>
</template>
