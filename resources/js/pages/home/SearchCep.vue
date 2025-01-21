<template>
<div>
    <h2 class="text-center mb-4">Busca de CEP</h2>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <CEPInput
          class="form-control mb-2"
          name="cep"
          id="cep_id"
          masked
          required
          placeholder="Digite o CEP"
          v-model="cepValue"
        />

        <button 
          class="btn btn-primary w-100 d-flex justify-content-center align-items-center" 
          @click="buscarCep"
          :disabled="searchCepLoading"
        >
          <LoadingSpinner v-if="searchCepLoading" size="1rem" class="mr-2"/> {{ searchCepLoading ? 'Buscando...' : 'Buscar CEP' }}
        </button>
      </div>
    </div>

    <div class="row justify-content-center mt-3" v-if="error">
      <div class="col-md-6 alert alert-danger">
        {{ error }}
      </div>
    </div>

    <div class="row justify-content-center mt-3" v-if="!error && Object.keys(cepData).length > 0">
      <div class="col-md-6">
        <div class="alert alert-success">
          <strong>CEP:</strong> {{ cepData.cep }} <br>
          <strong>Logradouro:</strong> {{ cepData.logradouro }} <br>
          <strong>Bairro:</strong> {{ cepData.bairro }} <br>
          <strong>Cidade:</strong> {{ cepData.localidade }} <br>
          <strong>Estado (UF):</strong> {{ cepData.uf }} <br>
        </div>

        <button class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center" @click="salvarEndereco" :disabled="addAddressLoading">
          <LoadingSpinner v-if="addAddressLoading" size="1rem" class="mr-2"/> {{ addAddressLoading ? 'Salvando...' : 'Salvar este Endereço' }}          
        </button>
      </div>
    </div>
</div>

</template>

<script>
import { mapState, mapActions } from 'vuex';
import CEPInput from '@/components/CEPInput';
import LoadingSpinner from '@/components/LoadingSpinner';

export default {
    data() {
        return {
            cepValue: '',
        }
    },

    components: {
        CEPInput,
        LoadingSpinner
    },

    computed: {
    ...mapState('cep', [
            'cepData', 
            'error', 
            'searchCepLoading',
            'addAddressLoading',
        ]),
    },

    methods: {
        ...mapActions('cep', [
            'fetchCepData',
            'saveCurrentAddress',
        ]),

        formatCep() {
            this.cepValue = this.cepValue.replace(/\D/g, '');
        },

        buscarCep() {
            if(!this.cepValue) 
                return;
            this.formatCep();
            this.fetchCepData(this.cepValue);
        },

        
        salvarEndereco() {
            this.saveCurrentAddress();
        },
    }

}

</script>