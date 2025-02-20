<template lang="">
    <div class="p-5 w-100 overflow-y-auto overflow-y-auto">
        <h3 class="mb-4">Редактирование файла</h3>
        <div>
          <h4 class="mb-3">Файл "id"</h4>
          <form class="needs-validation" novalidate="">
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <label for="fileName" class="form-label">Название</label>
                <input
                  type="text"
                  class="form-control"
                  id="fileName"
                  placeholder=""
                  value="старое название"
                  required=""
                  v-model='fileName'
                />
                <div class="invalid-feedback">Valid file name is required.</div>
              </div>
              <div class="col-sm-6 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Сохранить</button>
              </div>
            </div>
          </form>
          <a class="d-flex align-items-center gap-1" href="./files-list.html"
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
            Назад</a
          >
        </div>
      </div>
</template>
<script setup>
import { ref } from 'vue';

let fileName = ref('')

async function fethTasks() {
    const token = localStorage.getItem("token")

    if (token) {
        const response = await fetch(`${API}/tasks/disk`, {
            headers: {
                "Authorization": `Bearer ${token}`
            }
        })

        if (response.ok) {
            const data = await response.json();
            return data
        }
    } else {
        alert("Unauthorized")
    }
}

fethTasks().then(data => { data.filter() })

async function updateTask(id) {
    const token = localStorage.getItem("token")
    if (token) {

        const response = await fetch(`${API}/tasks/${id}`, {
            method: "Patch", headers: {
                "Authorization": `Bearer ${token}`
            }
        })
        if (response.ok) {
            const data = await response.json()

        }
    }
}

</script>
<style lang="">

</style>