<template>
    <tr>
        <td>{{ address.cep }}</td>
        <td>{{ address.logradouro }}</td>
        <td>{{ address.bairro }}</td>
        <td>{{ address.localidade }}</td>
        <td>{{ address.uf }}</td>
        <td>
        <button 
            class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
            @click="excluirEndereco(address.id)"
            :disabled="removeAddressLoading === address.id"
        >
            <LoadingSpinner 
                v-if="removeAddressLoading === address.id" 
                size="1rem" 
                class="mx-2"
            /> {{ removeAddressLoading === address.id ? '' : 'Excluir' }}
        </button>
        </td>
    </tr>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import LoadingSpinner from '@/components/LoadingSpinner';

export default {
    props: ['address'],

    components: {
        LoadingSpinner,
    },

    computed: {
        ...mapState('cep', [
            'removeAddressLoading',
        ]),
    },

    methods: {
        ...mapActions('cep', [
            'deleteAddress'
        ]),

        excluirEndereco(id) {
            this.deleteAddress(id);
        },
    },
}

</script>