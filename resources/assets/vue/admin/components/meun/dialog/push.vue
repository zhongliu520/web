<template>
    <el-dialog title="添加菜单" :visible.sync="pushDialog" :before-close="closePushDialog">
        <el-form  ref="ruleForm" :model="ruleForm" :rules="rules" label-width="80px">
            <el-form-item label="菜单名称">
                <el-input v-model="ruleForm.name"></el-input>
            </el-form-item>

            <el-form-item label="菜单图标">
                <el-input v-model="ruleForm.icon"></el-input>
            </el-form-item>

            <el-form-item label="菜单链接">
                <el-input v-model="ruleForm.url"></el-input>
            </el-form-item>

            <el-form-item label="父级菜单">
                <el-select v-model="ruleForm.pid" filterable placeholder="请选择">
                    <el-option
                            v-for="item in tableData"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-form>

        <div slot="footer" class="dialog-footer">
            <el-button @click="closePushDialog">取 消</el-button>
            <el-button type="primary" @click="submitForm('ruleForm')">确 定</el-button>
        </div>
    </el-dialog>
</template>

<script>
    export default {
        props: {
            pushDialog: Boolean
        },
        data() {
            return {
                tableData: [],
                ruleForm: {
                    name: "",
                    pid: "",
                    icon: "",
                    url: ""
                },
                rules: {
                    name: [
                        { required: true, message: '请输入菜单名称', trigger: 'blur' },
                        { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
                    ]
                }
            }

        },
        components: {

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
                        let rows = await this.$api.saveMeun(0, this.ruleForm);

                        if(!rows.data.hasError && rows.data.code == 200)
                        {
                            this.closePushDialog();
                            this.$emit("getData");
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
            }

        }
    };
</script>