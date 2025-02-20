<template lang="">
    <div class="p-5 w-100 overflow-y-auto overflow-y-auto">
        <h3 class="mb-4">Права доступа</h3>
        <div>
          <h4 class="mb-3">Предоставить доступ к task "id"</h4>
          <form class="needs-validation mb-4" novalidate="">
            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label for="email" class="form-label">Email пользователя</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="example@user.com"
                  required=""
                  v-model="email"
                />
                <div class="invalid-feedback">Valid email is required.</div>
              </div>
              <div class="col-sm-6 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Добавить</button>
              </div>
            </div>
          </form>
          <h4 class="mb-3">Пользователи, имеющие доступ</h4>
          <ul class="list-group mb-4">
            <li v-for="user in users" class="list-group-item align-items-center d-flex gap-3 py-3">
              <div
                class="bg-success text-white d-flex justify-content-center align-items-center rounded-3 flex-shrink-0"
                style="width: 40px; height: 40px"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 16 16"
                  fill="currentColor"
                  width="20"
                  height="20"
                >
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"
                  />
                </svg>
              </div>
              <div
                class="row w-100 align-items-center justify-content-betweeen"
              >
                <div class="col fw-bold">User Userov</div>
                <div class="col text-muted">example@user.com</div>
                <div class="col d-flex justify-content-end">
                  <button class="btn btn-danger" type="button">Отозвать</button>
                </div>
              </div>
            </li>
          </ul>
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
<script>
import API from '@/config';
import { ref } from 'vue';


let list = ref([])
let email = ref([])

// async function fethTasks() {
//     const token = localStorage.getItem("token")

//     if (token) {
//         const response = await fetch(`${API}/tasks/shared`, {
//             headers: {
//                 "Authorization": `Bearer ${token}`
//             }
//         })

//         if (response.ok) {
//             const data = await response.json();
//             list.value = data.message
//         }
//     } else {
//         alert("Unauthorized")
//     }
// }

// fethTasks()


</script>
<style lang="">

</style>