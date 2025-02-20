import { createRouter, createWebHistory } from "vue-router";
import LoginVue from "../views/Login.vue";
import RegisterVue from "@/views/Register.vue";
import FileListVue from "@/views/FileList.vue";
import EditTask from "@/views/EditTask.vue";

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: "/",
			name: "fileList",
			component: FileListVue,
		},
		{
			path: "/login",
			name: "login",
			component: LoginVue,
			meta: { hideNavigation: true },
		},
		{
			path: "/register",
			name: "reg",
			component: RegisterVue,
			meta: { hideNavigation: true },
		},
		{
			path: "/edit:id",
			name: "edit",
			component: EditTask,
		},
	],
});

router.beforeEach(async (to) => {
	const isAuthenticated = !!localStorage.getItem("token");

	if (!isAuthenticated && to.name !== "login" && to.name !== "reg") {
		return { name: "login" };
	}
});

export default router;
