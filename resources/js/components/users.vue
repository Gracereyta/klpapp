<template>
    <div>
        <h1 class="mt-4">Users</h1>
        <button type="button" class="btn btn-light btn-sm" style="float: right; border-color: black">Add new user</button>
        <input type="text" class="form-control" placeholder="Search store..." v-model="searchUsers" style="width: 20%; float: right; margin-right: 5px; height: 32px">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Users</li>
        </ol>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Store handle</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>    
            <tbody v-for="(user, i) in filteredTheme" :key="user.id">
                <tr>
                    <th scope="row">{{ i + 1 }}</th>
                    <td>{{ user.name }}</td>
                    <td v-if="user.user_assigned">{{ user.user_assigned.storeid }}</td> <td v-else></td>
                    <td>
                        <button class="btn btn-primary btn-sm" @click="editUser(user.id)"><i class="far fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="far fa-hand-pointer" style="color: white"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Edit category modal -->
        <div class="modal fade" tabindex="-1" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit="updateUser">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT STORE HANDLE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stores</label>
                                    <v-select
                                        v-model="selectedStore"
                                        :options="stores"
                                        :reduce="stores => stores.id"
                                        label="name"
                                        placeholder="Selec store">
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import "vue-select/dist/vue-select.css";
    export default {
        components: {
            vSelect
        },
        props: {
            users: Array,
            stores: Array
        },
        data() {
            return {
                searchUsers: '',
                editModal: '#editModal',
                selectedStore: '',
                userid: '',
            }
        },
        computed: {
            filteredTheme() {    
                return this.users.filter((a, i) => {
                    return a.name.toLowerCase().includes(this.searchUsers.toLowerCase())
                });
            }
        },
        methods: {
            editUser: function(userid) {
                this.userid = userid
                axios({
                    url: '/users/edit/'+userid,
                    method: 'get',
                }).then(res => {
                    console.log(res.data)
                })
                $(this.editModal).modal('show')
            },
            updateUser: function() {
                axios({
                    url: '/users/update',
                    method: 'post',
                    data: {
                        userid: this.userid,
                        storeid: this.selectedStore
                    }
                }).then(res => {
                    console.log(res.data)
                })
            },
            
        },
        mounted() {
            console.log(this.users)
        }
    }
</script>
