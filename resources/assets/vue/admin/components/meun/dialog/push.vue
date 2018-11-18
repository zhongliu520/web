<template>
    <el-dialog title="添加菜单" :visible.sync="pushDialog" :before-close="closePushDialog">
        <el-form  ref="pushForm" :model="pushForm" :rules="rules" label-width="80px">
            <!--<file></file>-->
            <el-form-item label="菜单名称">
                <el-input v-model="pushForm.name"></el-input>
            </el-form-item>

            <el-form-item label="菜单图标">
                <el-input v-model="pushForm.icon"></el-input>
            </el-form-item>

            <el-form-item label="菜单链接">
                <el-input v-model="pushForm.url"></el-input>
            </el-form-item>

            <el-form-item label="父级菜单">
                <el-select v-model="pushForm.pid" filterable placeholder="请选择" @change="choseParent">
                    <el-option
                            v-for="item in tableData"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id"
                    >
                    </el-option>
                </el-select>
            </el-form-item>
        </el-form>

        <div slot="footer" class="dialog-footer">
            <el-button @click="closePushDialog">取 消</el-button>
            <el-button type="primary" @click="submitForm('pushForm')">确 定</el-button>
        </div>
    </el-dialog>
</template>

<script>
    import file from '../../common/file'

    export default {
        props: {
            pushDialog: Boolean,
            initData: [Function],
            pushForm: Object
        },
        data() {
            return {
                tableData: [],
                rules: {
                    name: [
                        { required: true, message: '请输入菜单名称', trigger: 'blur' },
                        { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
                    ]
                }
            }

        },
        components: {
            file
        },
        computed: {

        },
        beforeMount() {

        },
        created() {
            this.pushDialog = false;
            this.getData();
        },
        methods: {
            async getData (limit=100, page=1, total='total', search=''){
                let rows = await this.$api.getMeunList({
                    offset: (page - 1) * limit,
                    limit: limit
                });
                console.log(rows);
                this.tableData = [];
                if(!rows.data.hasError && rows.data.code == 200)
                {
                    this.tableData = rows.data.data.rows;
                }
            },
            async submitForm(formName) {
                this.$refs[formName].validate (async (valid) => {
                    if (valid) {
                        let rows = await this.$api.saveMeun(0, this.pushForm);
                        if(!!this.initData(rows))
                        {
                            this.closePushDialog();
                            this.$emit("getData");
                            return false;
                        }
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            closePushDialog () {
                this.$emit("closePushDialog", false);
            },
            choseParent(index) {
//                this.pushForm.pid = index;
//                console.log(index);
            }

        }
    };
</script>