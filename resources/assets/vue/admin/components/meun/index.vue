<style>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }

    .msg-top {
        top: 100px;
    }
</style>
<template>
    <el-container style="height: 95vh; border: 1px solid #eee">
        <el-header style="text-align: right; font-size: 12px;background-color: #fff;">
            <el-row>
                <el-button @click="showPushDialog" icon="el-icon-plus" plain>添加</el-button>
            </el-row>
        </el-header>

        <el-main>

            <el-table :data="tableData" style="width: 100%" v-loading="loading">
                <!--<el-table-column prop="date" label="日期" width="140">-->
                <!--</el-table-column>-->
                <el-table-column prop="name" label="名称">
                </el-table-column>
                <el-table-column prop="parent_name" label="父级">
                </el-table-column>
                <el-table-column prop="icon" label="图标">
                </el-table-column>
                <el-table-column prop="showMessage" label="显/隐">
                </el-table-column>
                <el-table-column  label="操作">
                    <template slot-scope="scope">
                        <template v-if="scope.row.is_show == 1">
                            <el-button class="table-btn-custom"
                                       type="text"
                                       @click.native.prevent="updateStatusRow(scope.row, 0)"
                                       size="small">
                                隐藏
                            </el-button>
                        </template>
                        <template v-else-if="scope.row.is_show == 0">
                            <el-button class="table-btn-custom"
                                       type="text"
                                       @click.native.prevent="updateStatusRow(scope.row, 1)"
                                       size="small">
                                显示
                            </el-button>
                        </template>
                        <el-button class="table-btn-custom"
                                   type="text"
                                   @click.native.prevent="showPushDialog(scope.row)"
                                   size="small">
                            编辑
                        </el-button>

                        <el-button class="table-btn-custom"
                                   type="text"
                                   @click.native.prevent="deleteRow(scope.row)"
                                   size="small">
                            删除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <page
                @handleCurrentChange="handleCurrentChange"
                @handleSizeChange="handleSizeChange"
                :currentPage="currentPage"
                :pageSize="pageSize"
                :total="total"
                >
                </page>
        </el-main>

        <push-dialog
                :pushDialog="pushDialog"
                @closePushDialog="closePushDialog"
                @getData="getData"
                :pushForm="pushForm"
                :initData="initData">

        </push-dialog>

    </el-container>
</template>
<script>
    import Page from '../common/page'
    import ElHeader from "element-ui/packages/header/src/main.vue";
    import PushDialog from "./dialog/push";


    export default {
        data() {
            return {
                tableData: [],
                total: 0,
                currentPage: 1,
                loading: false,
                pushDialog: false,
                pushForm: {
                    name: "",
                    pid: "",
                    icon: "",
                    url: ""
                }
            }
        },
        components: {
            ElHeader,
            page: Page,
            "push-dialog": PushDialog
        },
        computed: {
            pageSize () {
              return this.$store.state.pageSize
            }
        },
        beforeMount () {
            this.getData(this.pageSize, this.currentPage, 'total');
        },
        async created () {
            // console.log(this.tableData);
        },
        methods: {
            initData (rows)
            {
                let data = null;
                if(!rows.data.hasError && rows.data.code == 200)
                {
                    data = rows.data.data;
                    if(!data)
                        return true;
                }else {
                    this.showErrorMsg(rows.data.error);

                    return false;
                }
                return data;
            },
            async getData (limit=10, page=1, total='total', search=''){
                this.loading = true;
                let rows = await this.$api.getMeunList({
                    offset: (page - 1) * limit,
                    limit: limit
                });
                // console.log(rows);
                let data = this.initData(rows);
                this.tableData = data.rows;
                this.total = data.total;

                if(!!this.tableData)
                {
                    this.loading = false;
                } else {
                    this.loading = false;
                }
            },
            async deleteRow (row) {
                let rows = await this.$api.deleteMeun(row.id);

                if(!!this.initData(rows))
                {
                    this.getData();
                }
            },
            async updateStatusRow (row, status) {
                this.loading = true;
                let rows = await this.$api.updateMeunStatus(row.id, {status: status});
                if(!!this.initData(rows))
                {
                    this.getData();
                }
            },
            handleCurrentChange (val) {
              this.currentPage = val
              console.log(val)
              this.getData(this.pageSize, this.currentPage, this.typeValue, 'total', this.searchKey)
            },
            handleSizeChange (val) {
              this.$store.commit('setPageSize', val)
              this.currentPage = 1
              this.getData(this.pageSize, this.currentPage, this.typeValue, 'total', this.searchKey)
            },
            showPushDialog (rows) {
                this.pushForm.name = rows.name;
                this.pushForm.pid = rows.pid;
                this.pushForm.icon = rows.icon;
                this.pushForm.url = rows.url;
                this.pushDialog = true;
            },
            closePushDialog () {
                this.pushDialog = false;
            },
            showErrorMsg ($msg)
            {
                this.$message({
                    type: "error",
                    customClass: "msg-top",
                    message: $msg
                });
            }
        }
    };
</script>
