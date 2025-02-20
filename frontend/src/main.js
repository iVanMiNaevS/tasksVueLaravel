import "./assets/main.css";
import "./template/static/bootstrap.min.css";
import "./template/static/bootstrap.min.js";
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

const app = createApp(App);

app.use(router);

app.mount("#app");
