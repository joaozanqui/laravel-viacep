import { createStore } from 'vuex';
import cep from './modules/cep';

export const store = createStore({
  modules: {
    cep
  }
});
