<template lang="">
    <div class="w-100">
        <div
      class="text-center d-flex justify-content-center align-items-center h-100"
    >
      <main style="max-width: 300px" class="form-signin w-100">
        <form @submit.prevent='submit'>
          <img
            src="./static/icon.svg"
            style="width: 70px"
            alt=""
            class="mb-4"
          />
          <h1 class="h3 mb-4">Вход в аккаунт</h1>
          <div class="form-floating mb-2">
            <input
              type="email"
              class="form-control"
              id="floatingInput"
              placeholder="name@example.com"
              v-model="email"
            />
            <label for="floatingInput">Почта</label>
          </div>
          <div class="form-floating mb-2">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Password"
              v-model="password"
            />
            <label for="floatingPassword">Пароль</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">
            Войти
          </button>
          <div class="mt-4">
            Нет аккаунта? <router-link to="/register">Зарегистрироваться</router-link>
          </div>
          <p class="mt-4 mb-3 text-muted">© 2021-2024</p>
        </form>
      </main>
    </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import API from "../config"
import { useRouter } from 'vue-router';

let password = ref("")
let email = ref("")

const router = useRouter()

async function submit(e) {
    const response = await fetch(`${API}/authorization`, {
        method: "POST", body: JSON.stringify({
            email: email.value,
            password: password.value
        }), headers: {
            "content-type":
                "application/json"
        }
    })
    if (response.ok) {
        const data = await response.json()
        localStorage.setItem("token", data.token)
        router.push('/')
    } else {
        alert("error")
    }

}

</script>
<style lang="">

</style>