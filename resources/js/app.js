//require('./bootstrap');
import { createApp } from 'vue'
import './masked-input'
import { BootstrapVue } from "bootstrap-vue"
import { store } from './services/store'
import  'bootstrap-vue/dist/bootstrap-vue.css'

//create an instance of Vue
const app = createApp({})

app.config.warnHandler = function (msg, vm, trace) {
   if (
      msg.includes('deprecation RENDER_FUNCTION') 
      || msg.includes('deprecation OPTIONS_BEFORE_DESTROY') 
      || msg.includes('deprecation INSTANCE_EVENT_EMITTER')
      || msg.includes('deprecation GLOBAL_PROTOTYPE')
      || msg.includes('deprecation GLOBAL_EXTEND')
      || msg.includes('deprecation WATCH_ARRAY')
   ) {
     return;
   }
   console.warn(msg, trace);
 };

//preserve whitespaces in html from vue page
app.config.compilerOptions.whitespace = 'preserve'

//Home
app.component('home-index', require('./pages/home/index.vue').default);

app.use(store)
   .use(BootstrapVue)
   .mount('#app')