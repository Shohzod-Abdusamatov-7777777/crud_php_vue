var app = Vue.createApp({
    data() {
        return {
            users: [],
            currentUser: {},
            newUser: { name: "", age: "", country: "" },
        };
    },
    mounted() {
        this.getUser();
    },
    methods: {
        async getUser() {
            const res = await fetch("http://crud-vue-php/process.php?action=read");
            const result = await res.json();
            if (result.error) {
                Swal.fire({
                    position: "center-center",
                    icon: "error",
                    title: result.err_msg,
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                this.users = result.users;
            }
        },
        deleteUser(id) {
            var formData = new FormData();
            formData.append("id", id);
            axios
                .post("http://crud-vue-php/process.php?action=delete", formData)
                .then((res) => res.data)
                .then((result) => {
                    if (result.error) {
                        this.errMsg = result.err_msg;
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: result.err_msg,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.users = this.getUser();
                        this.sucMsg = result.msg;
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                });
            $("#deleteUserModal").modal("hide");
        },
        addUser() {
            var formData = new FormData();
            formData.append("name", this.newUser.name);
            formData.append("age", this.newUser.age);
            formData.append("country", this.newUser.country);
            axios
                .post("http://crud-vue-php/process.php?action=create", formData)
                .then((res) => res.data)
                .then((result) => {
                    if (result.error) {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: result.err_msg,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.users = this.getUser();
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                });
            (this.newUser = { name: "", age: "", country: "" }),
                setTimeout(() => {
                    $(".alert").alert("close");
                }, 2000);
            $("#addUserModal").modal("hide");
        },
        editUser() {
            var formData = new FormData();
            formData.append("name", this.currentUser.name);
            formData.append("age", this.currentUser.age);
            formData.append("country", this.currentUser.country);
            formData.append("id", this.currentUser.id);
            axios
                .post("http://crud-vue-php/process.php?action=update", formData)
                .then((res) => res.data)
                .then((result) => {
                    if (result.error) {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: result.err_msg,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else {
                        this.users = this.getUser();
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                });
            this.currentUser = {};
            $("#editUserModal").modal("hide");
        },
        closeModal() {
            $("#deleteUserModal").modal("hide");
        },
    },
});

app.mount("#app");
