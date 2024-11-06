import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "Home",
        component: () => import("../example.vue")
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
