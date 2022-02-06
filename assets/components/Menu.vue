<template>
    <section class="i-menu__container mt-3 d-none d-md-flex">
        <div class="i-menu">
            <ul class="i-menu__list i-menu__list-root" v-if="categories.length">
                <li class="i-menu__list-item" v-for="category in categories" @mouseenter="select(category.id)" @mouseleave="select(null)">
                    <router-link class="i-menu__list-item-link" :to="{ name: 'category', params: { category: category.slug } }" :class="{ selected: category.id === this.selected }">
                        <font-awesome-icon :icon="category.icon" /> {{ category.name }}
                    </router-link>
                    <div class="i-menu__list-container" :class="{ show: category.id === this.selected }" v-if="menu[category.id].length > 0">
                        <ul class="i-menu__list i-menu__list-level-1">
                            <li class="i-menu__list-item" v-for="child in menu[category.id]">
                                <router-link class="i-menu__list-item-link" :to="{ name: 'category', params: { category: child.slug } }">
                                    {{ child.name }}
                                </router-link>
                                <ul class="i-menu__list i-menu__list-level-2" v-if="child.children">
                                    <li class="i-menu__list-item" v-for="grandChild in child.children">
                                        <router-link class="i-menu__list-item-link" :to="{ name: 'category', params: { category: grandChild.slug } }">
                                            {{ grandChild.name }}
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="i-menu__list i-menu__list-root" v-else>
                <li class="i-menu__list-item" v-for="n in 8">
                    <a class="i-menu__list-item-link placeholder-glow">
                        <span class="placeholder" :class="{ ['col-' + getRandomInt(3, 12)]: true }"></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="i-menu__banner">
            <img src="https://via.placeholder.com/1046x352" alt="Dummy Banner" />
        </div>
    </section>
</template>

<script>
export default {
    name: "Menu",
    props: {
        menu: {
            type: Array,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            selected: null,
        }
    },
    methods: {
        select(id) {
            this.selected = id;
        },
        getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);

            return Math.floor(Math.random() * (max - min) + min);
        }
    }
}
</script>

<style lang="less" scoped>
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .i-menu__container {
        display: flex;
        position: relative;

        .i-menu {
            flex-grow: 0;
            flex-shrink: 0;
            min-height: 352px;
            width: 250px;

            .i-menu__list {
                &.i-menu__list-root {
                    & > .i-menu__list-item {
                        & > .i-menu__list-item-link {
                            color: #242424;
                            display: block;
                            text-decoration: none;
                            font-weight: 500;
                            padding: 10px 15px;

                            svg {
                                margin: 0 5px 2px 0;
                                vertical-align: middle;
                                width: 20px;
                            }

                            &:hover,
                            &.selected {
                                color: #39618f;
                                background-color: #e8f6ff;
                            }

                            &:hover {
                                & + li {
                                    border-top: 0;
                                }
                            }

                            &.placeholder-glow {
                                .placeholder {
                                    margin: 2px 0;
                                }
                            }
                        }
                    }
                }

                .i-menu__list-container {
                    background-color: #fff;
                    box-shadow: 3px 0 13px rgb(0 0 0 / 13%);
                    border: 0;
                    display: none;
                    height: 352px;
                    left: 250px;
                    top: 0;
                    position: absolute;
                    width: auto;

                    &.show {
                        display: block;
                    }
                }

                &.i-menu__list-level-1 {
                    column-count: 4;
                    height: inherit;
                    min-width: 410px;
                    padding: 17px 25px 25px;

                    & > .i-menu__list-item {
                        flex: 1 1;
                        margin-bottom: 15px;
                        min-width: 205px;
                        page-break-inside: avoid;

                        & > .i-menu__list-item-link {
                            font-size: 18px;
                            font-weight: 500;
                            margin-bottom: 5px;
                        }
                    }
                }

                &.i-menu__list-level-2 {
                    .i-menu__list-item {
                        .i-menu__list-item-link {
                            font-size: 14px;
                        }
                    }
                }
            }
        }
    }

    .i-menu__banner {
        flex-grow: 1;

        img {
            width: 100%;
        }
    }
</style>
