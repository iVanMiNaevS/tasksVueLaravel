<template lang="">
    <div class="w-100 p-5 overflow-y-auto">
        <h3 class="mb-4">Добавить task</h3>
        <form class="needs-validation" novalidate="" @submit.prevent="addTask">
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <label for="fileName" class="form-label">Название</label>
                <input
                  type="text"
                  class="form-control"
                  id="fileName"
                  placeholder="название"
                  required=""
                  v-model="title"
                />
                <div class="invalid-feedback">Valid name is required.</div>
              </div>
              
            </div>
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <label for="desc" class="form-label">Описание</label>
                <input
                  type="text"
                  class="form-control"
                  id="desc"
                  placeholder="описание"
                  required=""
                  v-model="description"
                />
                <div class="invalid-feedback">Valid description is required.</div>
              </div>
            </div>
            <div class="col-sm-6 d-flex align-items-end">
              <button class="btn btn-primary"  type="submit">Сохранить</button>
            </div>
          </form>

        <!-- Drop Zone -->

        <router-link class="d-flex align-items-center gap-1 mt-4" to="/"
          ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            width="16"
            height="16"
          >
            <path
              fill-rule="evenodd"
              d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z"
              clip-rule="evenodd"
            />
          </svg>
          Назад</router-link
        >
      </div>
</template>
<script setup>
import API from '@/config'
import { ref } from 'vue'


let title = ref("")
let description = ref("")

async function addTask() {
    const token = localStorage.getItem("token")
    if (token) {

        const response = await fetch(`${API}/tasks`, {
            method: "POST", body: JSON.stringify({
                title: title.value,
                description: description.value

            }), headers: {
                "content-type":
                    "application/json",
                "Authorization": `Bearer ${token}`
            }
        })
        if (response.ok) {

            router.push('/')
        } else {
            alert("error")
        }
    }
}
</script>
<style lang="">

</style>