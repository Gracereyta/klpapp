<template>
    <div>
        <h1 class="mt-4">All Products</h1>
        <button type="button" class="btn btn-light btn-sm" style="float: right; border-color: black" @click="addProduct">Add new product</button>
        <input type="text" class="form-control" placeholder="Search product..." v-model="searchProduct" style="width: 20%; float: right; margin-right: 5px; height: 32px">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item" @click="gotoCategory">Category</li>
            <li class="breadcrumb-item" @click="gotoMakeup">{{ categoryName }}</li>
            <li class="breadcrumb-item active">{{ subCategory }}</li>
        </ol>   
        <div class="row">
         <div class="col-xl-2 col-md-6" v-for="product in filteredProducts" :key="product.product_id">
            <div class="card mb-4" style="text-align: center">
                <img :src="'https://klpshop-spaces.sgp1.digitaloceanspaces.com/public/images/products/'+JSON.parse(product.images)[0].image" alt="" style="width: 100%; height: 300px;">
                <div class="card-footer d-flex align-items-center justify-content-between" style="padding: 1px;"> 
                    <a class="small text-dark btn" style="font-size: 13px" href="#" @click="editSubcategory(product.product_id)">View {{product.name}}</a>
                </div>
            </div>
                <!-- <div class="card mb-4"> --> 
                    <!-- <div id="face"></div> -->
                        <!-- <div v-if="product.productimages.length == 0">
                           <img :src="'/storage/images/test/noimage.png'" alt="" style="width: 100%; height: 300px;">
                            
                        </div>
                        <div v-else>
                            <img :src="'/storage/images/test/'+product.productimages[0].image_name" alt="" style="width: 100%; height: 300px;">
                        </div>
                    <div class="card-footer d-flex align-items-center justify-content-between" style="padding: 1px;"> -->
                        <!-- <a class="small text-dark btn" style="font-size: 13px" href="#">View Details</a> -->
                        <!-- <a class="small text-dark btn" style="font-size: 13px" href="#" @click="editSubcategory(product.id)">View Details</a>
                    </div>
                </div>-->
            </div> 
        </div>
        <!-- Add products modal -->
        <div class="modal fade" tabindex="-1" id="exampleModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="submitForm">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD PRODUCT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-md-6" style="text-align: center">
                                    <p style="font-size: 12px; color: red">{{ invalid }}</p>
                                    <input type="file" class="form-control" @change="onFileChange" multiple><br>
                                    <div v-for="pic in pictures" :key="pic.imagePreview">
                                        <img v-bind:src="pic.imagePreview" style="width: 80%; height: 205px;" v-show="pic.showPreview"/> 
                                    </div>
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label" >Name</label>
                                        <input type="text" class="form-control" v-model="product_name" id="exampleFormControlInput1" placeholder="Product name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Price</label>
                                        <input type="text" class="form-control" v-model="price" id="exampleFormControlInput1" placeholder="Price">
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: 12px; color: red">{{ invalidVideo }}</p>

                                        <label for="exampleFormControlInput1" class="form-label">Video</label>
                                        <input type="file" class="form-control" @change="onVideoChange" multiple><br>
                                        <div v-for="pic in videos" :key="pic.imagePreview">
                                            <video style="width: 100%; height: 205px;" controls>
                                            <source v-bind:src="pic.imagePreview" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Details</label>
                                        <VueCkeditor v-model="details" :config="editorConfig"></VueCkeditor>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">How to use</label>
                                        <VueCkeditor v-model="howtouse" :config="editorConfig"></VueCkeditor>
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

        <!-- Edit products modal -->
        <div class="modal fade" tabindex="-1" id="edit_product" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="updateProduct">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT PRODUCT</h5>
                            <a class="btn btn-sm" aria-label="Close" @click="closeModal">
                                <svg width="35" height="35" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </a>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-md-6" style="text-align: center">
                                    <p style="font-size: 12px; color: red">{{ invalid }}</p>
                                    <input type="file" ref="fileInput" class="form-control" @change="onFileChange" multiple><br>
                                        <div v-for="(img, i) in product_images" :key="img.image">
                                            <a href="#" @click="removeImage(product_id, img.image, i)" style="color: red; font-size: 13px; text-decoration: none;">Remove</a>
                                            <img v-bind:src="'https://klpshop-spaces.sgp1.digitaloceanspaces.com/public/images/products/'+img.image" style="width: 80%; height: 205px;"/> 
                                        </div>

                                    <!-- <div v-for="img in itemsimage" :key="img.image">
                                        <a href="#" @click="removeImage(product_id, img.image)" style="color: red; font-size: 13px; text-decoration: none;">Remove</a>
                                        <img v-bind:src="'/storage/images/test/'+img.image" style="width: 80%; height: 205px;"/> 
                                    </div> -->


                                    <!-- <div v-if="product_images">
                                        <div v-for="pic in product_images" :key="pic.id">
                                            <a href="#" @click="removeImage(pic.id, pic.product_id)" style="color: red; font-size: 13px; text-decoration: none;">Remove</a>
                                            <img v-bind:src="'/storage/images/test/'+pic.image_name" style="width: 80%; height: 205px;"/> 
                                        </div> 
                                    </div>
                                    <div v-else>
                                        <img v-bind:src="'/storage/images/test/noimage.png'" style="width: 80%; height: 205px;"/> 
                                    </div> -->
                                    <div v-for="pic in pictures" :key="pic.imagePreview">
                                        <img v-bind:src="pic.imagePreview" style="width: 80%; height: 205px;" v-show="pic.showPreview"/> 
                                    </div> 
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label" >Name</label>
                                        <input type="text" class="form-control" v-model="product_name" id="exampleFormControlInput1" placeholder="Product name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Price</label>
                                        <input type="text" class="form-control" v-model="price" id="exampleFormControlInput1" placeholder="Price">
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: 12px; color: red">{{ invalidVideo }}</p>

                                        <label for="exampleFormControlInput1" class="form-label">Video</label>
                                        <input type="file" class="form-control" @change="onVideoChange" multiple><br>
                                        <div v-for="(pic, i) in video" :key="pic.video">
                                            <div v-if="video.length == 1">
                                                <a href="#" @click="deleteVideo(product_id, pic.video, i)" style="color: red; font-size: 13px; text-decoration: none;">Delete</a>
                                            </div>
                                            <div v-else>
                                                <a href="#" @click="removeVideo(product_id, pic.video, i)" style="color: red; font-size: 13px; text-decoration: none;">Remove</a>
                                            </div>
                                            <video style="width: 100%; height: 205px;" controls>
                                            <source v-bind:src="'https://klpshop-spaces.sgp1.digitaloceanspaces.com/public/images/products/'+pic.video" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        <div v-for="pic in videos" :key="pic.imagePreview">
                                            <video style="width: 100%; height: 205px;" controls>
                                            <source v-bind:src="pic.imagePreview" type="video/mp4" v-show="pic.showPreview">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Details</label>
                                        <VueCkeditor v-model="details" :config="editorConfig"></VueCkeditor>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">How to use</label>
                                        <VueCkeditor v-model="howtouse" :config="editorConfig"></VueCkeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" style="float: right" @click="drop(product_id)">Drop</button>
                            <button type="submit" class="btn btn-primary">Update changes</button>
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
            products: Array,
            subcategory: Number,
            category: Number,
            itemsimage: Array
        }, 
        data() {
            return {
                subcategory_name: '',
                modal1: '#exampleModal',
                modal2: '#edit_product',
                showPreview: '',
                imagePreview: '',
                pictures: [],
                images: [],
                product_name: '',
                price: '',
                details: '',
                howtouse: '',
                product_id: '',
                product_images: '',
                category_name: '',
                searchProduct: '',
                editorConfig: {
                    height: '130px'
                },
                selectedFiles: '',
                frontimage1: '',
                invalid: '',
                selectedVideo: '',
                invalidVideo: '',
                video: [],
                showPreviewVideo: '',
                videoPreview: '',
                videos: [],
                uploadVideo: []
            }
        },
        mounted(){
            // console.log(this.itemsimage)
        },
        computed:{
            subCategory(){
                axios({
                    url: '/category/subcategory/'+this.subcategory,
                        method: 'get'
                    }).then(res => {
                        this.subcategory_name = res.data.subcategory_name
                    }).catch((error) => {
                        console.log(error);
                    });
                return this.subcategory_name
            },
            categoryName() {
                axios({
                    url: '/category/name/'+this.category,
                    method: 'get'
                    }).then(res => {
                        this.category_name = res.data.name
                    }).catch((error) => {
                        console.log(error);
                    });
                return this.category_name
            },
            filteredProducts() {    
                 return this.products.filter((a, i) => {
                    return a.name.toLowerCase().includes(this.searchProduct.toLowerCase())
                });
            },
            frontimage() {
                return this.products.forEach(element => {
                     axios({
                        url: '/category/product/select-images',
                        method: 'POST',
                        data: { id: element.product_id }
                    }).then(res => {
                        // console.log(res.data)
                    })
                });
                
               
            },
        },
        methods: {
            onVideoChange(event){
                this.selectedVideo = event.target.files;
                    for (let i = 0; i < this.selectedVideo.length; i++) {
                        const file = this.selectedVideo[i];
                        this.uploadVideo.push(file)              

                        let reader  = new FileReader();
                        reader.addEventListener("load", function () {
                            this.showPreviewVideo = true;
                            this.videoPreview = reader.result;
                            let img = {
                                showPreview: this.showPreviewVideo,
                                imagePreview: this.videoPreview
                            }
                            this.videos.push(img)

                        }.bind(this), false);

                        if( file ){
                            if ( /\.(mp4)$/i.test( file.name ) ) {
                                reader.readAsDataURL( file );
                                this.invalidVideo = ''
                            } else {
                                this.invalidVideo = "Video file is invalid!"
                            }
                        }
                    }
                
                
            },
            onFileChange(event){
                this.selectedFiles = event.target.files;
                if (event.target.files[0].size > '1500000') {
                    this.invalid = "Image size is too large!"
                } else {
                    for (let i = 0; i < this.selectedFiles.length; i++) {
                        const file = this.selectedFiles[i];

                        this.images.push(file)

                        let reader  = new FileReader();
                        reader.addEventListener("load", function () {
                            this.showPreview = true;
                            this.imagePreview = reader.result;
                            let img = {
                                showPreview: this.showPreview,
                                imagePreview: this. imagePreview
                            }
                            this.pictures.push(img)

                        }.bind(this), false);

                        if( file ){
                            if ( /\.(jpe?g|png)$/i.test( file.name ) ) {
                                reader.readAsDataURL( file );
                                this.invalid = ''
                            } else {
                                this.invalid = "Image file is invalid!"
                            }
                        }
                    }
                }
                
            },
            submitForm: function() {
                let formData = new FormData();

                this.images.forEach(element => {
                    formData.append("picture[]", element);
                });
                this.uploadVideo.forEach(element => {
                    formData.append("videos[]", element);
                });
                formData.append("product_name", this.product_name);
                formData.append("price", this.price);
                formData.append("details", this.details);
                formData.append("howtouse", this.howtouse);

                formData.append("category_id", this.category);
                formData.append("sub_category_id", this.subcategory);

                axios.post('/category/product/add', formData)
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
            editSubcategory: function(id) {
                axios({
                    url: '/category/product/edit/'+id,
                    method: 'POST',
                }).then(res => {
                    console.log(res)
                    this.product_id = id
                    this.product_name = res.data.name
                    this.price = res.data.price
                    this.details = res.data.details
                    this.howtouse = res.data.howtouse
                    this.product_images = JSON.parse(res.data.images)
                    if (res.data.video) {
                        this.video = JSON.parse(res.data.video)  
                    }
                }).catch((error) => {
                    console.log(error);
                });
                 $(this.modal2).modal('show') 
            },
            updateProduct: function() {
                let formData = new FormData();

                this.images.forEach(element => {
                    formData.append("picture[]", element);
                });
                this.uploadVideo.forEach(element => {
                    formData.append("videos[]", element);
                });
                formData.append("id", this.product_id);
                formData.append("product_name", this.product_name);
                formData.append("price", this.price);
                formData.append("details", this.details);
                formData.append("howtouse", this.howtouse);

                axios.post('/category/product/update', formData)
                    .then((res) => {
                        this.pictures = []
                        this.videos = []
                        this.product_images = []
                        this.imagePreview = null
                        this.images = []
                        const input = this.$refs.fileInput
                        input.type = 'text'
                        input.type = 'file'
                        $(this.modal2).modal('hide');
                        swal({
                            title: "Successfully Saved!",
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
            addProduct: function() {
                this.product_name = ""
                this.price = ""
                this.video = ""
                this.details = ""
                this.howtouse = ""
                this.imagePreview = ""
                this.showPreview = false
                this.pictures = []
                $(this.modal1).modal('show')  
            },
            removeImage(product_id, image, index) {
                axios({
                    url: '/category/product/remove-image',
                    method: 'POST',
                    data: { product_id: product_id, image: image, index: index }
                }).then(res => {
                    this.editSubcategory(product_id)
                })
            },
            removeVideo(product_id, video, index) {
                axios({
                    url: '/category/product/remove-video',
                    method: 'POST',
                    data: { product_id: product_id, image: video, index: index }
                }).then(res => {
                    this.editSubcategory(product_id)
                })
            },
            deleteVideo(product_id, video, index) {
                axios({
                    url: '/category/product/delete-video',
                    method: 'POST',
                    data: { product_id: product_id, image: video, index: index }
                }).then(res => {
                    this.editSubcategory(product_id)
                })
            },
            closeModal: function() {
                 this.video = []
                $(this.modal2).modal('hide') 
            },
            drop: function(id) {
                axios({
                    url: '/category/product/destroy',
                    method: 'POST',
                    data: { id: id }
                }).then(res => {
                    $(this.modal2).modal('hide');
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
            gotoMakeup: function() {
                window.location.href = '/category/makeup/'+this.category;
            }
        }
    }
</script>
