import { createRouter, createWebHistory } from "vue-router";
import Home from "./views/Home";
import Category from "./views/Category";
import PageNotFound from "./views/PageNotFound";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/:category',
        name: 'category',
        component: Category,
    },
    {
        path: '/:category/:product',
        name: 'product',
    },
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: PageNotFound,
    }
];

export default createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});
