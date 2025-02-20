<template lang="">
    <div class="d-flex h-100 w-100 justify-content-center align-items-center px-4">
      <div style="max-width: 600px">
        <main>
          <div class="mb-5 text-center">
            <img
              src="./static/icon.svg"
              style="width: 70px"
              alt=""
              class="mb-4 mx-auto d-block"
            />
            <h2>Регистрация</h2>
          </div>
          <div>
            <form class="needs-validation" @submit.prevent='submit' novalidate="">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="firstName" class="form-label">Имя</label>
                  <input
                    type="text"
                    class="form-control"
                    id="firstName"
                    placeholder=""
                    v-model="lastName"
                    value=""
                    required=""
                  />
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Фамилия</label>
                  <input
                    type="text"
                    class="form-control"
                    id="lastName"
                    v-model='lastName'
                    placeholder=""
                    value=""
                    required=""
                  />
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Почта</label>
                  <input
                    type="email"
                    v-model="email"
                    class="form-control"
                    id="email"
                    placeholder="you@example.com"
                  />
                  <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                  </div>
                </div>

                <div class="col-12">
                  <label for="password" class="form-label">Пароль</label>
                  <input
                    type="password"
                    v-model='password'
                    class="form-control"
                    id="password"
                    placeholder="*******"
                    required=""
                  />
                  <div class="invalid-feedback">
                    Please enter your password.
                  </div>
                </div>
                <div>
                  <button class="w-100 btn btn-primary btn-lg" type="submit">
                    Зарегистрироваться
                  </button>
                </div>
              </div>
            </form>
          </div>
        </main>
        <div class="mt-4">
          Уже есть аккаунт? <router-link to="/login">Войти</router-link>
        </div>
        <footer class="my-3 pt-3 text-muted text-center text-small">
          <p>© 2021-2024 File Storage</p>
        </footer>
      </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import API from "../config"
import { useRouter } from 'vue-router';

let password = ref("")
let email = ref("")
let firstName = ref("")
let lastName = ref("")

const router = useRouter()

async function submit(e) {
    const response = await fetch(`${API}/registration`, {
        method: "POST", body: JSON.stringify({
            email: email.value,
            password: password.value,
            first_name: firstName.value,
            last_name: lastName.value

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