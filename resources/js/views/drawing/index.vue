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
      <el-form-item>
        <el-button type="primary" @click="handleRegister">図面登録</el-button>
      </el-form-item>
    </el-form>
    <el-table
      v-if="drawings.length > 0"
      class="drawing-table"
      border
      style="width:80%"
      :data="drawings"
      :header-cell-style="{ color: '#303133' }"
    >
      <el-table-column prop="Title" label="製品番号" />
      <el-table-column prop="ExtProdName" label="名称" />
      <el-table-column prop="ExtChgNo" label="設変" />
      <el-table-column prop="ExtCustCd" label="得意先" />
      <el-table-column prop="AddDate" label="登録日" />
      <el-table-column prop="UpdateDate" label="更新日" />
    </el-table>
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
      isRegister: false,
    };
  },
  computed: {
    ...mapGetters(['jwtToken', 'drawings']),
  },
  methods: {
    onSubmit() {
      this.$store.dispatch('drawing/getDrawings', {
        keyword: this.formSearch.keyword,
        type: this.formSearch.type,
        limit: this.formSearch.limit,
        jwtToken: this.jwtToken,
      });
    },
    handleRegister() {},
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.drawing {
  display: flex;
  flex-direction: column;

  &-search {
    margin: 0 auto;
  }

  &-table {
    margin: 0 auto;

    &-header {
      color: black;
    }
  }
}
</style>
