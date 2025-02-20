<template lang="">
    <div class="p-5 w-100 overflow-y-auto">
        <h3 class="mb-4">Общие файлы</h3>
        <div v-for="task in list" href="#" class="list-group-item align-items-center d-flex gap-3 py-3">

<div class="row w-100 align-items-center">
    <div class="col">{{ task.title }}</div>
    <div class="col text-muted">{{ task.id }}</div>
</div>
</div>
    </div>

</template>
<script setup>
import API from '@/config';
import { ref } from 'vue';


let list = ref([])

async function fethTasks() {
    const token = localStorage.getItem("token")

    if (token) {
        const response = await fetch(`${API}/tasks/shared`, {
            headers: {
                "Authorization": `Bearer ${token}`
            }
        })

        if (response.ok) {
            const data = await response.json();
            list.value = data.message
        }
    } else {
        alert("Unauthorized")
    }
}

fethTasks()
</script>
<style lang="">

</style>