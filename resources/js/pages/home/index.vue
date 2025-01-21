<template>
  <div class="container mt-4">
    <SearchCep />
    
    <hr />

    <div class="row justify-content-center mt-3">
      <div class="col-md-12">
        <h4>Endereços Salvos</h4>
          <AddressesTable />
      </div>
    </div>
  </div>
</template>

<script>
import SearchCep from './SearchCep';
import AddressesTable from './AddressesTable';

export default {
  name: 'home-index',

  components: {
    SearchCep,
    AddressesTable,
  },
}
</script>
