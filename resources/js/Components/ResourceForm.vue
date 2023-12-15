<script setup >
import { ref } from "vue";
let title = ref("");
let description = ref("");
let link = ref("");

function createResource(){
    console.log("Creando recurso");
    console.log(title.value);
    console.log(description.value);
    console.log(link.value);
}

</script>

<template>
    <div class="m-8">
        <!-- <p>{{ title }}</p> -->
        <input type="text" v-model="title">
        <input type="text" v-model="description">
        <input type="text" v-model="link">
        <button @click="createResource">Ingresar recurso</button>
    </div>
</template>