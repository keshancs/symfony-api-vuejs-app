import { createApp } from "vue";
import router from "./router";
import App from "./App.vue";
import "bootstrap/dist/css/bootstrap.css";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import {
    faTv,
    faLaptop,
    faMobile,
    faLaptopHouse,
    faBlender,
    faWeight,
    faScrewdriver,
    faFingerprint
} from '@fortawesome/free-solid-svg-icons';

library.add(
    faTv,
    faLaptop,
    faMobile,
    faLaptopHouse,
    faBlender,
    faWeight,
    faScrewdriver,
    faFingerprint
);

createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).mount('#app');
