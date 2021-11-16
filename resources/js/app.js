import Dashboard from './components/dashboard.vue';
import Makeup from './components/category-makeup.vue';
import ProductList from './components/product-list.vue';
import Themes from './components/themes.vue';
import Stores from './components/stores.vue';
import Users from './components/users.vue';
import Cropper from './components/cropper.vue';
import swal from 'sweetalert';

require('./bootstrap');

window.Vue = require('vue').default;

const app = new Vue({
    el: '#app',
    components: {
        Dashboard,
        Makeup,
        ProductList,
        swal,
        Themes,
        Stores,
        Users,
        Cropper,
        swal
    },
});
