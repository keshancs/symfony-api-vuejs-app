<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li v-for="breadcrumb in breadcrumbs" class="breadcrumb-item" :class="{ active: breadcrumb.isActive }" :aria-current="breadcrumb.isActive ? 'page' : ''">
                <router-link :to="breadcrumb.to" v-if="!breadcrumb.isActive" class="breadcrumb-item-link">{{ breadcrumb.name }}</router-link>
                <span v-else>{{ breadcrumb.name }}</span>
            </li>
        </ol>
    </nav>
</template>

<script>
export default {
    name: "Breadcrumbs",
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
        }
    }
}
</script>

<style lang="less" scoped>
.breadcrumb {
    .breadcrumb-item {
        &:not(.active) {
            font-weight: 500;
        }
    }
}
</style>
