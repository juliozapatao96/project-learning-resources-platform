<script setup >
import { ref, onMounted} from "vue";
import axios from "axios";

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
        })
        .then((response) => {
            console.log(response);
        });
}

</script>

<template>
    <div class="m-8">
        <!-- <p>{{ title }}</p> -->
        <input type="text" v-model="title">
        <input type="text" v-model="description">
        <input type="text" v-model="link">
        <select v-model="category_id">
            <option v-for="category in categories" :key="category.id">
                {{ category.name }}
            </option>
        </select>
        <button @click="createResource">Ingresar recurso</button>
    </div>
</template>