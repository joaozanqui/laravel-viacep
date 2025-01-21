//require('./bootstrap');
import { createApp } from 'vue'
import './masked-input'
import { BootstrapVue } from "bootstrap-vue"
import { store } from './services/store'
import  'bootstrap-vue/dist/bootstrap-vue.css'

//create an instance of Vue
const app = createApp({})

//preserve whitespaces in html from vue page
app.config.compilerOptions.whitespace = 'preserve'

//Home
app.component('home-index', require('./pages/home/index.vue').default);

app.use(store)
   .use(BootstrapVue)
   .mount('#app')