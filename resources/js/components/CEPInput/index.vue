<template>
  <input
    type="text"
    ref="cepInput"
    :maxlength="maxLength"
    v-model="inputVal"
    class="form-control"
    v-bind="$attrs"
  />
</template>

<script>
import httpClient from "@/services/http-client";
import Inputmask from "inputmask";
import { mapMutations } from "vuex";

export default {
  props: {
    masked: {
      type: Boolean,
      default: true,
    },
    value: {
      type: String,
    },
  },

  computed: {
    maxLength() {
      return this.masked ? 10 : 8;
    },
    inputVal: {
      get() {
        return this.value;
      },
      async set(val) {
        let cep = val.split(/[._-]/g).join('').trim()
        if(this.masked && cep.length == 8)
          this.$emit('searchCEP', await this.buscaCEP(cep))
        this.$emit("input", val);
      },
    },
  },

  methods: {
    ...mapMutations(["setLoadCEP"]),

    async buscaCEP(cep) {
      this.setLoadCEP(true);
      try {
        const response = await httpClient.get(
          `https://viacep.com.br/ws/${cep}/json/`
        );
        return response.data;
      } catch (err) {
        console.log(err);
      } finally {
        this.setLoadCEP(false);
      }
    },
  },

  mounted() {
    if (this.masked) {
      Inputmask({ mask: "99.999-999" }).mask(this.$refs.cepInput);
    }
  },
};
</script>
