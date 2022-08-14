require("./bootstrap");

import App from "./vue/app.vue";
import List from "./vue/list.vue";
import Create from "./vue/create.vue";
import Edit from "./vue/edit.vue";
const routes = [
    {
        name: "home",
        path: "/",
        component: List,
    },
    {
        name: "create",
        path: "/create",
        component: Create,
    },
    {
        name: "edit",
        path: "/edit/:id",
        component: Edit,
    },
];

import VueAxios from "vue-axios";
import axios from "axios";

import { createWebHistory, createRouter } from "vue-router";
const router = createRouter({
    history: createWebHistory(),
    routes,
});

import EventForm from "./vue/event-form.vue";

import { createApp } from "vue";
createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .component("EventForm", EventForm)
    .mount("#app");
