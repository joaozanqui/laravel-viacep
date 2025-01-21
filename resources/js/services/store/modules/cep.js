import httpClient from '../../http-client';

export default {
  namespaced: true,

  state: {
    cepData: {},
    error: null,
    
    searchCepLoading: false,
    savedAddressesLoading: false,
    addAddressLoading: false,
    removeAddressLoading: false,

    savedAddresses: []
  },

  mutations: {
    SET_CEP_DATA(state, payload) {
      state.cepData = payload;
    },
    SET_ERROR(state, payload) {
      state.error = payload;
    },
    SET_SEARCH_CEP_LOADING(state, payload) {
      state.searchCepLoading = payload;
    },
    SET_SAVED_ADDRESSES_LOADING(state, payload) {
      state.savedAddressesLoading = payload;
    },
    SET_ADD_ADDRESS_LOADING(state, payload) {
      state.addAddressLoading = payload;
    },
    SET_REMOVE_ADDRESS_LOADING(state, id) {
      state.removeAddressLoading = id;
    },
    SET_SAVED_ADDRESSES(state, addresses) {
      state.savedAddresses = addresses;
    },
    ADD_SAVED_ADDRESS(state, address) {
      state.savedAddresses.push(address);
    },
    REMOVE_SAVED_ADDRESS(state, addressId) {
      state.savedAddresses = state.savedAddresses.filter(item => item.id !== addressId);
    }
  },

  actions: {
    /**
     * Busca CEP via /api/cep/{cep}
     */
    async fetchCepData({ commit }, cep) {
      commit('SET_SEARCH_CEP_LOADING', true);
      commit('SET_ERROR', null);
      commit('SET_CEP_DATA', {});

      try {
        const response = await httpClient.get(`/api/cep/${cep}`);
        commit('SET_CEP_DATA', response.data);
      } catch (error) {
        if (error.response && error.response.data && error.response.data.error) {
          commit('SET_ERROR', error.response.data.error);
        } else {
          commit('SET_ERROR', 'Erro ao buscar o CEP. Tente novamente.');
        }
      } finally {
        commit('SET_SEARCH_CEP_LOADING', false);
      }
    },

    /**
     * Lista todos os endereços salvos
     */
    async fetchSavedAddresses({ commit }) {
      try {
        commit('SET_SAVED_ADDRESSES_LOADING', true);
        const response = await httpClient.get('/api/address');
        commit('SET_SAVED_ADDRESSES', response.data);
      } catch (error) {
        console.error('Erro ao buscar endereços salvos:', error);
      } finally {
        commit('SET_SAVED_ADDRESSES_LOADING', false);
      }
    },

    async saveCurrentAddress({ commit, state }) {
      try {
        commit('SET_ADD_ADDRESS_LOADING', true);
        const { cep, logradouro, bairro, localidade, uf } = state.cepData;
        if (!cep) {
          return commit('SET_ERROR', 'Nenhum endereço válido para salvar.');
        }

        const response = await httpClient.post('/api/address', {
          cep,
          logradouro,
          bairro,
          localidade,
          uf
        });

        commit('ADD_SAVED_ADDRESS', response.data);
      } catch (error) {
        console.error('Erro ao salvar endereço:', error);
      } finally {
        commit('SET_ADD_ADDRESS_LOADING', false);
      }
    },

    /**
     * Exclui um endereço pelo id
     */
    async deleteAddress({ commit }, addressId) {
      try {
        commit('SET_REMOVE_ADDRESS_LOADING', addressId);
        await httpClient.delete(`/api/address/${addressId}`);
        commit('REMOVE_SAVED_ADDRESS', addressId);
      } catch (error) {
        console.error('Erro ao excluir endereço:', error);
      } finally {
        commit('SET_REMOVE_ADDRESS_LOADING', addressId);
      }
    }
  },
};
