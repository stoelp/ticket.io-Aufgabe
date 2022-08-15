require("./bootstrap");

import App from "./vue/app.vue";
import EventForm from "./vue/event-form.vue";
import { createWebHistory, createRouter } from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
import { createApp, defineAsyncComponent } from "vue";

const routes = [
    {
        name: "home",
        path: "/",
        component: defineAsyncComponent(() => import("./vue/list.vue")),
    },
    {
        name: "create",
        path: "/create",
        component: defineAsyncComponent(() => import("./vue/create.vue")),
    },
    {
        name: "edit",
        path: "/edit/:id",
        component: defineAsyncComponent(() => import("./vue/edit.vue")),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .component("EventForm", EventForm)
    .mount("#app");
