import { createRouter, createWebHistory } from "vue-router";
import LoginVue from "../views/Login.vue";
import RegisterVue from "@/views/Register.vue";
import FileListVue from "@/views/TaskList.vue";
import EditTask from "@/views/EditTask.vue";
import TaskAdd from "@/views/TaskAdd.vue";
import TaskShared from "@/views/TaskShared.vue";
import TaskAccess from "@/views/TaskAccess.vue";

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
			path: "/task-add",
			name: "add",
			component: TaskAdd,
		},
		{
			path: "/task-shared",
			name: "shared",
			component: TaskShared,
		},
		{
			path: "/task/:id/access",
			name: "access",
			component: TaskAccess,
		},
		{
			path: "/edit/:id",
			name: "edit",
			component: EditTask,
		},
	],
});

router.beforeEach(async (to, from) => {
	const isAuthenticated = !!localStorage.getItem("token");

	if (!isAuthenticated && to.name !== "login" && to.name !== "reg") {
		return { name: "login" };
	}
	if (isAuthenticated && (to.name == "login" || to.name == "reg")) {
		return from;
	}
});

export default router;
