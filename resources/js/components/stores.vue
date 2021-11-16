<template>
    <div>
        <h1 class="mt-4">Stores</h1>
        <button type="button" class="btn btn-light btn-sm" style="float: right; border-color: black" @click="addStoreModal">Add new store</button>
        <input type="text" class="form-control" v-model="searchStore" placeholder="Search store..." style="width: 20%; float: right; margin-right: 5px; height: 32px">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Stores</li>
        </ol>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No.</th>
                    <th scope="col">Store name</th>
                    <th scope="col">Location</th>
                    <th scope="col" style="color: red">ID for Api</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>    
            <tbody v-for="(store, i) in filteredStore" :key="store.id">
                <tr>
                    <th>
                        <div v-if="store.selected == 1">
                            <input type="checkbox" disabled checked>
                        </div>
                        <div v-else>
                            <input type="checkbox" disabled>
                        </div>
                    </th>
                    <th scope="row">{{ i + 1 }}</th>
                    <td>{{ store.name }}</td>
                    <td>{{ store.location }}</td>
                    <td style="color: red">{{ store.id }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" @click="editStoreModal(store.id)"><i class="far fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                        <button class="btn btn-warning btn-sm" @click="confirmation(store.id)"><i class="far fa-hand-pointer" style="color: white"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- Add category modal  -->
        <div class="modal fade" tabindex="-1" id="exampleModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="addStore">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD STORE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input type="text" v-model="storename" class="form-control" id="exampleFormControlInput1" placeholder="Store name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Location</label>
                                    <input type="text" v-model="location" class="form-control" id="exampleFormControlInput1" placeholder="Location">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Details</label>
                                    <input type="text" v-model="details" class="form-control" id="exampleFormControlInput1" placeholder="Details">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Image/Logo</label>
                                    <input type="file" class="form-control" @change="onFileChange"><br>
                                    <img v-bind:src="imagePreview" style="width: 80%; height: 205px;" v-show="showPreview">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit category modal -->
        <div class="modal fade" tabindex="-1" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="updateStore">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT STORE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input type="text" v-model="storename" class="form-control" id="exampleFormControlInput1" placeholder="Store name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Location</label>
                                    <input type="text" v-model="location" class="form-control" id="exampleFormControlInput1" placeholder="Location">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Details</label>
                                    <input type="text" v-model="details" class="form-control" id="exampleFormControlInput1" placeholder="Details">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Image/Logo</label>
                                    <input type="file" class="form-control" @change="onFileChange"><br>
                                    <img v-bind:src="imagePreview" style="width: 80%; height: 205px;" v-show="showPreview">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Confirmation  -->
        <div class="modal fade" tabindex="-1" id="confirmation">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <form @submit="selectStore">
                        <div class="modal-header">
                            <h5 class="modal-title">Store</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to select this store ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            stores: Array
        },
        data() {
            return {
                storename: '',
                location: '',
                details: '',
                modal1: '#exampleModal',
                modal2: '#editModal',
                modal3: '#confirmation',
                imagePreview: '',
                showPreview: '',
                picture: '',
                filename: '',
                storeid: '',
                ifchecked: '',
                searchStore: ''
            }
        },
        computed: {
            filteredStore() {
                return this.stores.filter(store => {
                    return store.name.toLowerCase().includes(this.searchStore.toLowerCase())
                })
            }
        },
        methods: {
            onFileChange(event){
                this.picture = event.target.files[0];
                this.filename = event.target.files[0].name;
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreview = true;
                    this.imagePreview = reader.result;
                }.bind(this), false);

                if( this.picture ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.picture.name ) ) {
                        reader.readAsDataURL( this.picture );
                    }
                }
            },
            addStore: function() {
                let formData = new FormData();

                formData.append("storename", this.storename)
                formData.append("location", this.location)
                formData.append("details", this.details)
                formData.append("picture", this.picture)

                axios.post('/store/add', formData).then(res => {
                })
            },
            addStoreModal: function() {
                $(this.modal1).modal('show');  
            },
            editStoreModal: function(storeid) {
                axios({
                    url: '/store/edit/'+storeid,
                    method: 'get',
                }).then(res => {
                    this.storeid = storeid
                    this.storename = res.data.name
                    this.location = res.data.location
                    this.details = res.data.description
                    this.imagePreview = '/storage/images/category/'+res.data.image
                    this.showPreview = true;

                })
                $(this.modal2).modal('show');  
            },
            updateStore: function() {
                let formData = new FormData();

                formData.append("storeid", this.storeid)
                formData.append("storename", this.storename)
                formData.append("location", this.location)
                formData.append("details", this.details)
                formData.append("picture", this.picture)

                axios.post('/store/update', formData).then(res => {
                })
            },
            confirmation: function(storeid) {
                this.storeid = storeid
                $(this.modal3).modal('show');
            },
            selectStore: function() {
                axios({
                    url: '/store/select/'+this.storeid,
                    method: 'get'
                }).then(res => {
                })
            }
        }
    }
</script>
