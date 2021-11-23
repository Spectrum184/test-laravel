<template>
  <div class="app-container drawing">
    <el-form :inline="true" :model="formSearch" class="drawing-search">
      <el-form-item :label="$t('label.productCode')">
        <el-input
          v-model="formSearch.keyword"
          autofocus
          :placeholder="$t('placeholder.productCode')"
          @keyup.enter.native="onSubmit"
        />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">{{
          $t('button.search')
        }}</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  name: 'Drawing',
  data() {
    return {
      formSearch: {
        keyword: '',
        type: 'productCode',
        limit: 50,
      },
      drawings: [],
    };
  },
  computed: {
    ...mapGetters(['jwtToken']),
  },
  methods: {
    onSubmit() {
      console.log(this.jwtToken);
      this.$store.dispatch('drawing/getDrawings', {
        keyword: this.formSearch.keyword,
        type: this.formSearch.type,
        limit: this.formSearch.limit,
        jwtToken: this.jwtToken,
      });
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.drawing {
  display: flex;
  justify-content: center;
}
</style>
