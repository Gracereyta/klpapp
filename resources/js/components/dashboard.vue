<template>
    <div>
        <h1 class="mt-4">{{ store.name }} Dashboard</h1>
        <button type="button" class="btn btn-light btn-sm" style="float: right; border-color: black" @click="addCategory">Add new category</button>
        <input type="text" class="form-control" placeholder="Search category..." v-model="searchCategory" style="width: 20%; float: right; margin-right: 5px; height: 32px">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Category</li>
        </ol>
        <div class="row">
            <div class="col-xl-4 col-md-4" v-for="category in filteredCategory" :key="category.id">
                <div class="card text-white mb-4">
                    <img :src="category.image" alt="" style="width: 100%; height: 200px">
                    <div class="card-footer d-flex align-items-center justify-content-between" style="padding: 1px;">
                        <a class="small text-dark btn" style="font-size: 14px" href="#" @click="gotoMakeup(category.id)">View {{ category.name }}</a>
                        <a class="small text-dark btn" style="font-size: 14px" href="#" @click="editCategory(category.id)">Edit Details</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add category modal  -->
        <div class="modal fade" tabindex="-1" id="exampleModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="submitForm">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD CATEGORY</h5>
                            <button class="btn btn-sm" aria-label="Close" data-bs-dismiss="modal">
                                <svg width="35" height="35" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-md-6" style="text-align: center">
                                    <input type="file" class="form-control" @change="onFileChange" required><br>
                                    <img v-bind:src="imagePreview" style="width: 80%; height: 205px;" v-show="showPreview"/> 

                                    <label style="margin-top: 10px;"><b>ADD BANNER</b></label>
                                    <input type="file" class="form-control" @change="onFileChange2"><br>
                                    <img v-bind:src="imagePreview2" style="width: 80%; height: 205px;" v-show="showPreview2"/> 
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" v-model="name" class="form-control" id="exampleFormControlInput1" placeholder="Category name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Details</label>
                                        <VueCkeditor v-model="details"></VueCkeditor>
                                    </div>
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
        <!-- Edit category modal  -->
        <div class="modal fade" tabindex="-1" id="editCategory">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="updateCategory">
                        <div class="modal-header">
                            <h5 class="modal-title">UPDATE CATEGORY</h5>
                            <button class="btn btn-sm" aria-label="Close" data-bs-dismiss="modal">
                                <svg width="35" height="35" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-md-6" style="text-align: center">
                                    <input type="file" class="form-control" @change="onFileChange"><br>
                                    <img v-bind:src="imagePreview" style="width: 80%; height: 205px;" v-show="showPreview"/> 

                                    <label style="margin-top: 10px;"><b>ADD BANNER</b></label>
                                    <input type="file" class="form-control" @change="onFileChange2"><br>
                                    <img v-bind:src="imagePreview2" style="width: 80%; height: 205px;" v-show="showPreview2"/> 
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" v-model="name" class="form-control" id="exampleFormControlInput1" placeholder="Category name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Details</label>
                                        <VueCkeditor v-model="details"></VueCkeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" style="float: right" @click="drop(category_id)">Drop</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueCkeditor from 'vue-ckeditor2';
    export default {
        components: {
            VueCkeditor
        },
        props: {
            categories: Array,
            store: Object
        },
        data() {
            return {
                modal1: '#exampleModal',
                modal2: '#editCategory',
                showPreview: '',
                imagePreview: '',
                showPreview2: '',
                imagePreview2: '',
                name: '',
                details: '',
                picture: '',
                picture2: '',
                filename: '',
                filename2: '',
                category_id: '',
                searchCategory: '',
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
            onFileChange2(event){
                this.picture2 = event.target.files[0];
                this.filename2 = event.target.files[0].name;
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreview2 = true;
                    this.imagePreview2 = reader.result;
                }.bind(this), false);

                if( this.picture2 ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.picture2.name ) ) {
                        reader.readAsDataURL( this.picture2 );
                    }
                }
            },
            submitForm: function() {
                let formData = new FormData();
                
                formData.append("picture", this.picture);
                formData.append("name", this.name);
                formData.append("description", this.details);
                formData.append("filename", this.filename);

                formData.append("filename2", this.filename2);
                formData.append("picture2", this.picture2);

                axios.post('/category/add', formData)
                    .then((res) => {
                        console.log(res.data)
                        $(this.modal1).modal('hide');
                        swal({
                            title: "Successfully Saved!",
                            // text: "You clicked the button!",
                            icon: "success",
                            button: false,
                            text: " ",
                            timer: 1500,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            editCategory: function(id) {
                axios({
                    url: '/category/edit/'+id,
                    method: 'get',
                }).then(res => {
                    this.category_id = id
                    this.name = res.data.name
                    this.details = res.data.description
                    this.imagePreview = res.data.image
                    this.showPreview = true
                    if (res.data.banner_image) {
                        this.imagePreview2 = res.data.banner_image
                        this.showPreview2 = true
                    } else {
                        this.imagePreview2 = ''
                        this.showPreview2 = false
                    }

                }).catch((error) => {
                    console.log(error);
                });
                $(this.modal2).modal('show');
            },
            updateCategory: function() {
                let formData = new FormData();
                
                formData.append("id", this.category_id);
                formData.append("picture", this.picture);
                formData.append("name", this.name);
                formData.append("description", this.details);
                formData.append("filename", this.filename);

                formData.append("filename2", this.filename2);
                formData.append("picture2", this.picture2);

                axios.post('/category/update', formData)
                    .then((res) => {
                        $(this.modal2).modal('hide');
                        swal({
                            title: "Successfully Saved!",
                            // text: "You clicked the button!",
                            icon: "success",
                            button: false,
                            text: " ",
                            timer: 1500,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                });
            },
            addCategory: function() {
                this.name = ""
                this.details = ""
                this.imagePreview = ""
                this.showPreview = false
                this.imagePreview2 = ""
                this.showPreview2 = false
                $(this.modal1).modal('show');  
            },
            gotoMakeup: function(id) {
                window.location.href = '/category/makeup/'+id;
            },
            drop: function(id) {
                axios({
                    url: '/category/destroy',
                    method: 'POST',
                    data: { id: id }
                }).then(res => {
                    $(this.modal1).modal('hide');
                    swal({
                        title: "Successfully Deleted!",
                        // text: "You clicked the button!",
                        icon: "success",
                        button: false,
                        text: " ",
                        timer: 1500,
                    });
                })
            },
        },
        computed: {
            filteredCategory(){
                return this.categories.filter(category => {
                    return category.name.toLowerCase().includes(this.searchCategory.toLowerCase())
                })
            },
        },
            
    }
</script>
