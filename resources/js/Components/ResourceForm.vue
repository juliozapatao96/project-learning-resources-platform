<script setup >
import { ref, onMounted} from "vue";
import axios from "axios";
import PrimaryButton from '@/Components/PrimaryButton.vue';

let categories = ref([]);
let title = ref("");
let description = ref("");
let link = ref("");
let category_id = ref(null);

onMounted(() => {
    axios.get("api/categories").then((response) => {
        categories.value = response.data;
    });
});

function createResource(){
    axios
        .post("/api/resources", {
            title: title.value,
            description: description.value,
            link: link.value,
            category_id: category_id.value,
        })
        .then((response) => {
            // console.log(response);
            window.location.href = "/";
        }).catch((error) => {
            // Se puede manejar el error en este espacio, mostrando algo al user
            alert(error.message);
        })
        ;
}

</script>

<template>
    <div class="m-8">
        <!-- <p>{{ title }}</p> -->
        <input 
            type="text" 
            placeholder="Título del recurso..." 
            class="w-60 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            v-model="title">
        <input 
            type="text" 
            placeholder="Describa su recurso..." 
            class="w-60 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            v-model="description">
        <input 
            type="text"
            placeholder="Enlace a su recurso..." 
            class="w-60 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
            v-model="link">
        <select 
            class="w-60 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
            v-model="category_id">
            <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
            </option>
        </select>
        <!-- <button @click="createResource">Ingresar recurso</button> -->
        <PrimaryButton @click="createResource" class="mt-4">Ingresar recurso</PrimaryButton>
    </div>
</template>