<template>
    <div class="container">
        <Header :links="links" />
        <Menu :menu="menu" :categories="categories" />

        <router-view :key="$route.fullPath" />
    </div>
</template>

<script>
import Header from "./components/Header";
import Menu from "./components/Menu";
import axios from "axios";

export default {
    name: "App",
    data() {
        return {
            menu: [],
            categories: [],
            category: null,
            links: [
                {
                    route: 'home',
                    label: 'Home',
                }
            ]
        }
    },
    async created() {
        const response = await axios.get('/api/categories', {
            params: {
                parent: ''
            }
        });

        this.processCategories(response.data);
    },
    methods: {
        processCategories(categories) {
            for (let i in categories) {
                let category = categories[i];

                this.menu[category.id] = category.children;
            }

            this.categories = categories;
        }
    },
    components: {
        Header,
        Menu,
    }
}
</script>

<style lang="less">
body {
    background-color: #fff;
}

a {
    &:link,
    &:active,
    &:visited {
        color: #242424;
        text-decoration: none;
    }

    &:hover {
        color: #39618f;
    }
}
</style>
