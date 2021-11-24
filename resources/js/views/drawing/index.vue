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
      <el-form-item v-if="checkPermission(['admin', 'manager'], ['ADMIN'])">
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
      <el-table-column label="図面">
        <template slot-scope="{ row }">
          <el-button type="primary">
            <a :href="generateLink(row)" target="_blank">写真</a>
          </el-button>
        </template>
      </el-table-column>
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
import checkRoles from '@/utils/role';
import checkDepartments from '@/utils/department';
import { SERVER_DRAWING_URL } from '@/utils/link';

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
    checkPermission(roles, departments) {
      const hasRole = checkRoles(roles);
      const hasDepartment = checkDepartments(departments);

      if (hasRole || hasDepartment) {
        return true;
      }

      return false;
    },
    generateLink(row) {
      return SERVER_DRAWING_URL + row.FileName + '.' + row.Prefix;
    },
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
