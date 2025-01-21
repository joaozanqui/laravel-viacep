<template>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr v-if="savedAddressesLoading">
                <td colspan="6" class="text-center">
                <LoadingSpinner size="1rem" class="mr-2"/> Carregando endereços salvos...
                </td>
            </tr>

            <tr v-else-if="savedAddresses.length === 0">
                <td colspan="6" class="text-center">Nenhum endereço salvo ainda.</td>
            </tr>

            <TableItem 
                v-else 
                v-for="address in savedAddresses" 
                :key="address.id" 
                :address="address"
            />

        </tbody>
    </table>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import LoadingSpinner from '@/components/LoadingSpinner';
import TableItem from './TableItem';

export default {
    components: {
        LoadingSpinner,
        TableItem
    },

    computed: {
        ...mapState('cep', [
            'savedAddressesLoading',
            'savedAddresses'
        ]),
    },

    methods: {
        ...mapActions('cep', [
            'fetchSavedAddresses',
        ]),
    },

    mounted() {
        this.fetchSavedAddresses();
    },
}

</script>