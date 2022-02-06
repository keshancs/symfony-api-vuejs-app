<template>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <ul class="nav col-6 offset-md-3 mb-2 justify-content-center mb-md-0">
            <li v-for="link in links">
                <router-link :to="{ name: link.route }"
                             class="nav-link px-2"
                             exact-active-class="link-secondary"
                             @click="$emit('navigate', link.route)">
                    {{ link.label }}
                </router-link>
            </li>
        </ul>
    </header>
</template>

<script>
export default {
    name: "Header",
    props: {
        links: {
            required: true
        }
    }
}
</script>

<style scoped>
    .nav-link:not(.link-secondary) {
        color: #242424;
    }
</style>
