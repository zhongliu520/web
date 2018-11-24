<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }

    input[type=file] {
        display: none;
    }
</style>

<template>
    <el-dialog title="添加用户" :visible.sync="pushDialog" :before-close="closePushDialog">
        <el-form  ref="pushForm" :model="pushForm" :rules="rules" label-width="80px">
            <!--<file></file>-->
            <el-form-item label="头像">
                <el-upload
                        class="avatar-uploader"
                        action="/admin/file/upload"
                        :show-file-list="false"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload"
                        v-loading="loading">
                    <img v-if="imageUrl" :src="imageUrl" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>

            <el-form-item label="姓名">
                <el-input v-model="pushForm.name"></el-input>
            </el-form-item>

            <el-form-item label="邮箱">
                <el-input v-model="pushForm.email"></el-input>
            </el-form-item>

            <el-form-item label="密码">
                <el-input v-model="pushForm.password"></el-input>
            </el-form-item>

            <el-form-item label="确认密码">
                <el-input v-model="pushForm.repeatPassword"></el-input>
            </el-form-item>
        </el-form>

        <div slot="footer" class="dialog-footer">
            <el-button @click="closePushDialog">取 消</el-button>
            <el-button type="primary" @click="submitForm('pushForm')">确 定</el-button>
        </div>
    </el-dialog>
</template>

<script>
    export default {
        props: {
            pushDialog: Boolean,
            initData: [Function],
            pushForm: Object
        },
        data() {
            return {
                imageUrl: "",
                tableData: [],
                loading: false,
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
                        let rows = await this.$api.createUser(this.pushForm);
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
            },

            handleAvatarSuccess(res, file) {

                console.log(res);
                let tempImage = this.initData({data: res});
                if(tempImage) {
                    this.loading = false;
                    this.imageUrl = tempImage;
                    this.pushForm.headPortrait = tempImage;
                }
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;
                this.loading = true;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
            }

        }
    };
</script>