<template>
    <div>
         <h1 class="mt-4">{{ category }}</h1>
        <button type="button" class="btn btn-light btn-sm" style="float: right; border-color: black" @click="addSubCategory">Add new sub category</button>
        <input type="text" class="form-control" placeholder="Search sub category..." v-model="searchSubCategory" style="width: 20%; float: right; margin-right: 5px; height: 32px">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item" @click="gotoCategory">Category</li>
            <li class="breadcrumb-item active">{{ category }}</li>
        </ol>   
        <div class="row">
            <div class="col-xl-3 col-md-6" v-for="subcategory in filteredSubCategory" :key="subcategory.id">
                <div class="card mb-4">
                    <!-- <div id="face"></div> -->
                    <div class="gallery">
                        <div class="gallery-image">
                        <img :src="subcategory.image" alt="" style="width: 100%; height: 300px;">
                            <div class="gallery-text">
                                <!-- <h3>{{ subcategory.subcategory_name }}</h3> -->
                            </div>   
                            <div class="title-stay">
                                <p>{{ subcategory.subcategory_name }}</p>
                            </div>  
                        </div>  
                           
                    </div>
                    
                    <div class="card-footer d-flex align-items-center justify-content-between" style="padding: 1px;">
                        <a class="small text-dark btn" style="font-size: 14px" href="#" @click="gotoProduct(category_id, subcategory.id)">View {{ subcategory.subcategory_name }}</a>
                        <a class="small text-dark btn" style="font-size: 14px" href="#" @click="editSubcategory(subcategory.id)">Edit Details</a>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Add sub category modal modal-dialog-centered  -->
        <div class="modal fade" tabindex="-1" id="exampleModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="submitForm">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD SUB CATEGORY</h5>
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
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" v-model="subcategory_name" class="form-control" id="exampleFormControlInput1" placeholder="Subcategory name">
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

        <!-- Edit sub category modal modal-dialog-centered  -->
        <div class="modal fade" tabindex="-1" id="edit_subcategory">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="updateSubCategory">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT SUB CATEGORY</h5>
                            <button class="btn btn-sm" aria-label="Close" data-bs-dismiss="modal">
                                <svg width="35" height="35" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-xl-5 col-md-6" style="text-align: center">
                                    <input type="file" class="form-control" @change="onFileChange"><br>
                                    <img v-bind:src="imagePreview" style="width: 80%; height: 205px;" v-show="showPreview"/> 
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" v-model="subcategory_name" class="form-control" id="exampleFormControlInput1" placeholder="Subcategory name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Details</label>
                                        <VueCkeditor v-model="details"></VueCkeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" style="float: right" @click="drop(subcategory_id)">Drop</button>
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
            subcategories: Array,
            category_id: Number,
        },
        data() {
            return {
                picture: '',
                subcategory_name: '',
                subcategory_id: '',
                details: ' ',
                showPreview: '',
                imagePreview: '',
                modal1: '#edit_subcategory',
                modal2: '#exampleModal',
                category_name: '',
                searchSubCategory: '',
            }
        },
         computed: {
            category() {
                axios({
                    url: '/category/name/'+this.category_id,
                    method: 'get'
                    }).then(res => {
                        this.category_name = res.data.name
                    }).catch((error) => {
                        console.log(error);
                    });
                return this.category_name
            },
            filteredSubCategory() {
                return this.subcategories.filter(subcategory => {
                    return subcategory.subcategory_name.toLowerCase().includes(this.searchSubCategory.toLowerCase())
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
            submitForm: function() {
                let formData = new FormData();
                
                formData.append("picture", this.picture);
                formData.append("name", this.subcategory_name);
                formData.append("description", this.details);
                formData.append("category_id", this.category_id);
                formData.append("filename", this.filename);

                axios.post('/category/subcategory/add', formData)
                    .then((res) => {
                        // console.log(res.data);
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
            editSubcategory: function(id) {
                axios({
                    url: '/category/makeup/edit/'+id,
                    method: 'post',
                }).then(res => {
                    this.subcategory_id = id
                    this.subcategory_name = res.data.subcategory_name
                    this.details = res.data.details
                    this.imagePreview = res.data.image
                    this.showPreview = true
                }).catch((error) => {
                    console.log(error);
                });
                $(this.modal1).modal('show')  
            },
            addSubCategory: function() {
                this.subcategory_name = ""
                this.details = ""
                this.imagePreview = ""
                this.showPreview = false
                $(this.modal2).modal('show')  
            },
            updateSubCategory: function() {
                let formData = new FormData();
                
                formData.append("id", this.subcategory_id);
                formData.append("picture", this.picture);
                formData.append("name", this.subcategory_name);
                formData.append("description", this.details);
                formData.append("category_id", this.category_id);
                formData.append("filename", this.filename);

                axios.post('/category/subcategory/update', formData)
                    .then((res) => {
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
            drop: function(id) {
                axios({
                    url: '/category/subcategory/destroy',
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
            gotoCategory: function() {
                window.location.href = '/dashboard';
            },
            gotoProduct: function(category_id, sub) {
                window.location.href = '/category/makeup/products/'+category_id+"/"+sub;
            }
        }
    }
</script>
