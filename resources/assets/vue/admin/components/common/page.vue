<template>
  <div class="pages">
    <el-pagination
    background
    @current-change="handleCurrentChange"
    @size-change="handleSizeChange"
    :current-page="currentPage"
    layout="total, sizes, prev, pager, next, jumper"
    :page-sizes="[10, 20, 30, 40, 50]"
    :page-size="pageSize"
    :total="total">
    </el-pagination>
  </div>
</template>
<script>
export default {
  name: 'page',
  props: {
    currentPage: {
      type: Number,
      default: 1
    },
    pageSize: Number,
    total: Number
  },
  data () {
    return {
    }
  },
  methods: {
    handleCurrentChange (val) {
      this.$emit('handleCurrentChange', val)
    },
    handleSizeChange (val) {
      this.$emit('handleSizeChange', val)
    }
  }
}
</script>
<style>
</style>
