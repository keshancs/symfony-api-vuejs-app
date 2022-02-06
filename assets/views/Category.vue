<template>
    <div class="mt-4">
        <Breadcrumbs :breadcrumbs="breadcrumbs" />

        <Spinner v-if="category === null" />
        <div v-else-if="category.id">
            <h1>{{ category.name }}</h1>

            <div class="i-products__container">
                <router-link :to="{ name: 'category', params: { category: child.slug } }" class="i-product__card" v-for="child in category.children">
                    <div class="card-body">
                        <img class="i-product__card-image" src="https://via.placeholder.com/340/fff/fff" alt="{{ child.name }}" />
                        <h6 class="text-center">{{ child.name }}</h6>
                    </div>
                </router-link>
            </div>
        </div>
        <div v-else>
            <div class="alert alert-danger">yooo</div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Breadcrumbs from "../components/Breadcrumbs";
import Spinner from "../components/Spinner";

export default {
    name: "Category",
    components: {
        Breadcrumbs,
        Spinner,
    },
    data() {
        return {
            breadcrumbs: [],
            category: null,
            products: [],
        }
    },
    async created() {
        let response = await axios.get(`/api/categories/${this.$route.params.category}`);

        await this.loadBreadcrumbs();

        this.category = response.data;

        document.title = this.category.name;
    },
    methods: {
        async loadBreadcrumbs() {
            let response = await axios.get(`/api/categories/${this.$route.params.category}`, {
                params: {
                    groups: 'breadcrumbs'
                }
            });

            this.buildBreadcrumbs(response.data);
        },
        buildBreadcrumbs(category) {
            this.breadcrumbs.push({
                to: { name: 'category', params: { category: category.slug } },
                name: category.name,
                isActive: true
            });

            let parent = category.parent;
            while (parent) {
                this.breadcrumbs.push({
                    to: { name: 'category', params: { category: parent.slug } },
                    name: parent.name,
                    isActive: false
                });

                parent = parent.parent;
            }

            this.breadcrumbs.reverse();
        }
    }
}
</script>

<style lang="less" scoped>
.i-products__container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 45px 0;

    .i-product__card {
        border: 2px solid rgb(0 0 0 / 13%);
        border-radius: 6px;
        flex: 0 0 calc((100% - (15px * 3)) / 4);

        &:hover {
            border-color: rgb(0 0 0 / 23%);
        }

        .i-product__card-image {
            height: 171px;
        }
    }
}
</style>
