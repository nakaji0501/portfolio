<<<<<<< HEAD
import './bootstrap'
=======
// font-awsesomeの設定
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(fas, far, fab);
Vue.component('font-awesome-icon', FontAwesomeIcon)

import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'

new Vue({
el: '#app',
router,
store,
components: {　App },
template: '<App />'
});
>>>>>>> f07ed35296987b50c4e246e1b3ddfc0439547af2
