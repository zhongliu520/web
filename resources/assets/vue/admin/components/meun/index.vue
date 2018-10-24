<style>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }
</style>
<template>
    <el-container style="height: 95vh; border: 1px solid #eee">
        <el-container>

            <el-main>
                <el-table :data="tableData" style="width: 100%">
                    <!--<el-table-column prop="date" label="日期" width="140">-->
                    <!--</el-table-column>-->
                    <el-table-column prop="name" label="姓名">
                    </el-table-column>
                    <el-table-column prop="icon" label="图标">
                    </el-table-column>
                    <el-table-column  label="操作">
                        <template slot-scope="scope">
                            <el-button class="table-btn-custom"
                                       type="text"
                                       size="small">
                                删除
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-main>
        </el-container>
    </el-container>

</template>
<script>
    export default {
        data() {
            // const item = {
            //     date: '2016-05-02',
            //     name: '王小虎',
            //     address: '上海市普陀区金沙江路 1518 弄'
            // };
            return {
                tableData: []
            }
        },
        // components: {
        //
        // },
        // computed: {
        //
        // },
        beforeMount () {
            console.log(123);
            this.getData();
            console.log(this.tableData);
        },
        async created () {
            // console.log(this.tableData);
        },
        methods: {
            async getData (){
                let rows = await this.$api.getMeunList();
                console.log(rows);
                this.tableData = [];
                if(rows.data.code == 200)
                {
                    this.tableData = rows.data.data;
                }
            },
        }
    };
</script>
