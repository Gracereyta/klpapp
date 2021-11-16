<template>
    <div>

        <h1 class="mt-4">Customize Themes</h1>
        <button type="button" class="btn btn-light btn-sm" style="float: right; border-color: black" @click="addThemes">ADD NEW THEMES</button>
        <input type="text" class="form-control" placeholder="Search Theme..." v-model="searchThemes" style="width: 20%; float: right; margin-right: 5px; height: 32px">
        <br /><br /><br />
        <div class="row">
         <div class="col-xl-2 col-md-6" v-for="theme in filteredTheme" :key="theme.id">
            <div class="card mb-4" style="text-align: center;">
                <div v-if="theme.used_themes == 1">
                    <div style="position: absolute; width: 100%; height: 80%; background-color: rgb(0 0 0 / 57%);" class="d-flex align-items-center justify-content-between">
                        <p style="width: 100%; color: white;" class="title-stay">Selected themes</p>
                    </div>
                </div>
                <div v-else>

                </div>
                <img :src="theme.banner" alt="" style="width: 100%; height: 300px;">
                <div class="card-footer d-flex align-items-center justify-content-between" style="padding: 1px;"> 
                
                    <div v-if="theme.used_themes == 1">
                        <button type="button" class="btn m-3 br-3" style="font-size: 13px; background-color: #e8ae00; color: white" @click="confirmation(theme.id)" disabled><i class="far fa-hand-paper"></i> Use Theme </button>
                    </div>
                    <div v-else>
                        <button type="button" class="btn m-3 br-3" style="font-size: 13px; background-color: #e8ae00; color: white" @click="confirmation(theme.id)"><i class="far fa-hand-paper"></i> Use Theme </button>
                    </div>
                    
                    <button type="button" class="btn btn-primary m-3 br-3" style="font-size: 13px" @click="editTheme(theme.id)"><i class="far fa-edit"></i> Edit</button>
                </div>
            </div>
            </div> 
        </div>
        <!-- Add Theme modal -->
        <div class="modal fade" tabindex="-1" id="add_theme">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form ref="addImageForm" @submit.prevent="submitForm">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD NEW THEMES</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Store Logo</label>
                                        <input type="file" class="form-control" @change="onFileChangeStore" required><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label" >Banner image</label>
                                        <input type="file" class="form-control" @change="onFileChangeBanner" required><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label" >Banner icon</label>
                                        <input type="file" class="form-control" @change="onFileChangeIcon" required><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label" >Background image</label>
                                        <input type="file" class="form-control" @change="onFileChangeBG" required><br>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Menu Detail</label>
                                        <VueCkeditor v-model="menuDetail" placeholder="add multiple lines" required></VueCkeditor>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        Preview
                                        <div class="bg-image" v-bind:style="{ 'background-image': 'url(' + imagePreviewBG + ')', 'backgroundPosition': 'center center', 'backgroundSize': 'cover'}">
                                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); min-height: 778px;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <center>
                                                        <h1 v-show="!showPreviewStore" class="text-white mt-4 mb-4">[Store Logo Here]</h1>
                                                        <img v-bind:src="imagePreviewStore" style="width: 120px; height: 120px;" v-show="showPreviewStore"/> 
                                                    </center>
                                                </div>
                                                <br />
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <center>
                                                        <h1 v-show="!showPreviewBanner" class="text-white mt-4 mb-4">[Banner Image Here]</h1>
                                                        <img v-bind:src="imagePreviewBanner" style="width: 100%; height: 200px;" v-show="showPreviewBanner"/> 
                                                    </center>
                                                </div>
                                                <br />
                                                <center>
                                                    <h4 v-show="!showPreviewIcon" class="text-white mt-4 mb-4">[Banner icon Here]</h4>
                                                    <img v-bind:src="imagePreviewIcon" style="width: 30px; height: 30px;" v-show="showPreviewIcon"/> 
                                                </center>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h4 class="text-white mb-0">Menu menu</h4>
                                                </div>
                                                <div style="padding: 10px 100px 10px 100px; word-wrap: break-word; text-align: center;">
                                                    <p v-html="menuDetail"></p>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <center>
                                                        <h4 v-show="!showPreviewIcon" class="text-white mt-4 mb-4">[Banner icon Here]</h4>
                                                        <img v-bind:src="imagePreviewIcon" style="width: 30px; height: 30px;" v-show="showPreviewIcon"/> 
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Theme modal -->
        <div class="modal fade" tabindex="-1" id="edit_theme">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="updateTheme" ref="addImageForm" >
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT THEMES</h5>
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
                                   <!-- <div class="mb-3">
                                        <label for="storeid" class="form-label" >Related Store</label>
                                        <input type="text" class="form-control" v-model="storeid" placeholder="Store ID">
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Store Logo</label>
                                        <input type="file" class="form-control" @change="onFileChangeStore"><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label" >Banner image</label>
                                        <input type="file" class="form-control" @change="onFileChangeBanner"><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label" >Banner icon</label>
                                        <input type="file" class="form-control" @change="onFileChangeIcon"><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label" >Background image</label>
                                        <input type="file" class="form-control" @change="onFileChangeBG"><br>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Menu Detail</label>
                                        <VueCkeditor v-model="menuDetail" placeholder="add multiple lines"></VueCkeditor>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-md-6">
                                    <div class="mb-3">
                                        Preview
                                        <div class="bg-image" v-bind:style="{ 'background-image': 'url(' + imagePreviewBG + ')', 'backgroundPosition': 'center center', 'backgroundSize': 'cover'}">
                                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); min-height: 778px;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <center>
                                                        <img v-bind:src="imagePreviewStore" style="width: 120px; height: 120px;" /> 
                                                    </center>
                                                </div>
                                                <br />
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <center>
                                                        <img v-bind:src="imagePreviewBanner" style="width: 100%; height: 200px;" /> 
                                                    </center>
                                                </div>
                                                <br />
                                                <center>
                                                    <img v-bind:src="imagePreviewIcon" style="width: 30px; height: 30px;" /> 
                                                </center>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h4 class="text-white mb-0">Menu</h4>
                                                </div>
                                                <div style="padding: 10px 100px 10px 100px; word-wrap: break-word; text-align: center;">
                                                    <p v-html="menuDetail"></p>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <center>
                                                        <img v-bind:src="imagePreviewIcon" style="width: 30px; height: 30px;" /> 
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" @click="drop(theme_id)">Drop</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <!-- Confirmation  -->
        <div class="modal fade" tabindex="-1" id="confirmation">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <form @submit.prevent="selectStore">
                        <div class="modal-header">
                            <h5 class="modal-title">Themes</h5>
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
import VueCkeditor from 'vue-ckeditor2';
export default {
    components: {
        VueCkeditor
    },
    props: {
        themes: Array
    }, 
    data() {
        return {
            modalAdd: '#add_theme',
            modalEdit: '#edit_theme',
            storeid: '',
            pictureStore: '',
            filenameStore: '',
            imagePreviewStore: '',
            showPreviewStore: '',
            pictureBanner: '',
            filenameBanner: '',
            imagePreviewBanner: '',
            showPreviewBanner: '',
            pictureBG: '',
            filenameBG: '',
            imagePreviewBG: '',
            showPreviewBG: '', 
            pictureIcon: '',
            filenameIcon: '',
            imagePreviewIcon: '',
            showPreviewIcon: '',
            menuDetail: '',
            searchThemes: '',
            modal3: '#confirmation',
        }
    },
    computed: {
        filteredTheme() {    
                return this.themes.filter((a, i) => {
                return a.banner.toLowerCase().includes(this.searchThemes.toLowerCase())
            });
        },
    },
    mounted() {
        console.log(this.themes)
    },
    methods: {
        onFileChangeStore(event){
            this.pictureStore = event.target.files[0];
            this.filenameStore = event.target.files[0].name;
            let reader  = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreviewStore = true;
                this.imagePreviewStore = reader.result;
            }.bind(this), false);

            if( this.pictureStore ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.pictureStore.name ) ) {
                    reader.readAsDataURL( this.pictureStore );
                }
            }
        },
        onFileChangeBanner(event){
            this.pictureBanner = event.target.files[0];
            this.filenameBanner = event.target.files[0].name;
            let reader  = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreviewBanner = true;
                this.imagePreviewBanner = reader.result;
            }.bind(this), false);

            if( this.pictureBanner ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.pictureBanner.name ) ) {
                    reader.readAsDataURL( this.pictureBanner );
                }
            }
        },
        onFileChangeIcon(event){
            this.pictureIcon = event.target.files[0];
            this.filenameIcon = event.target.files[0].name;
            let reader  = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreviewIcon = true;
                this.imagePreviewIcon = reader.result;
            }.bind(this), false);

            if( this.pictureIcon ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.pictureIcon.name ) ) {
                    reader.readAsDataURL( this.pictureIcon );
                }
            }
        },
        onFileChangeBG(event){
            this.pictureBG = event.target.files[0];
            this.filenameBG = event.target.files[0].name;
            let reader  = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreviewBG = true;
                this.imagePreviewBG = reader.result;
            }.bind(this), false);

            if( this.pictureBG ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.pictureBG.name ) ) {
                    reader.readAsDataURL( this.pictureBG );
                }
            }
        },
        addThemes: function() {
            this.$refs.addImageForm.reset()  

            this.pictureStore= '',
            this.filenameStore= '',
            this.imagePreviewStore= '',
            this.showPreviewStore= '',
            
            this.pictureBanner= '',
            this.filenameBanner= '',
            this.imagePreviewBanner= '',
            this.showPreviewBanner= '',
            
            this.pictureBG= '',
            this.filenameBG= '',
            this.imagePreviewBG= '',
            this.showPreviewBG= '',
            
            this.pictureIcon= '',
            this.filenameIcon= '',
            this.imagePreviewIcon= '',
            this.showPreviewIcon= '',

            this.storeid='',
            this.menuDetail= '',
            $(this.modalAdd).modal('show')  
        },
        editTheme: function(id) {
            console.log(id)
            axios({
                url: '/themes/edit/'+id,
                method: 'POST',
            }).then(res => {

                this.theme_id = id 
                
                this.storeid = res.data.storeid
                this.banner = res.data.banner
                this.banner_icon = res.data.banner_icon
                this.logo = res.data.logo
                this.background = res.data.background
                this.menuDetail = res.data.menu_text

                this.imagePreviewStore = this.logo
                this.imagePreviewBanner = this.banner
                this.imagePreviewBG = this.background
                this.imagePreviewIcon = this.banner_icon
                
            }).catch((error) => {
                console.log(error);
            });
                $(this.modalEdit).modal('show') 
        },

        submitForm: function() {
            let formData = new FormData();
            
            formData.append("storeid", this.storeid);
            formData.append("menuDetail", this.menuDetail);

            formData.append("filenameStore", this.filenameStore);
            formData.append("pictureStore", this.pictureStore);
            
            formData.append("pictureBanner", this.pictureBanner);
            formData.append("filenameBanner", this.filenameBanner);
            
            formData.append("pictureBG", this.pictureBG);
            formData.append("filenameBG", this.filenameBG);
            
            formData.append("pictureIcon", this.pictureIcon);
            formData.append("filenameIcon", this.filenameIcon);

            axios.post('/themes/add', formData)
                .then((res) => {
                    $(this.modalAdd).modal('hide');
                    swal({
                        title: "Successfully Saved!",
                        // text: "You clicked the button!",
                        icon: "success",
                        button: false,
                        text: " ",
                        timer: 1500,
                    }).then(function() {
                        window.location = "/themes";
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateTheme: function() {
            let formData = new FormData();

            formData.append("id", this.theme_id);
            formData.append("storeid", this.storeid);
            formData.append("menuDetail", this.menuDetail);

            formData.append("pictureStore", this.pictureStore);
            formData.append("filenameStore", this.filenameStore);
            
            formData.append("pictureBanner", this.pictureBanner);
            formData.append("filenameBanner", this.filenameBanner);
            
            formData.append("pictureBG", this.pictureBG);
            formData.append("filenameBG", this.filenameBG);
            
            formData.append("pictureIcon", this.pictureIcon);
            formData.append("filenameIcon", this.filenameIcon);

            axios.post('/themes/update', formData)
                .then((res) => {
                    console.log(res.data)
                    // this.pictures = []
                    // this.product_images = []
                    // this.imagePreview = null
                    // this.images = []
                    // const input = this.$refs.fileInput
                    // input.type = 'text'
                    // input.type = 'file'
                    $(this.modalEdit).modal('hide');
                    swal({
                        title: "Successfully Updated!",
                        icon: "success",
                        button: false,
                        text: " ",
                        timer: 1500,
                    }).then(function() {
                        window.location = "/themes";
                    });
                })
                .catch((error) => {
                    console.log(error);
            });
        },
        drop: function(theme_id) {
            axios({
                url: '/themes/destroy',
                method: 'POST',
                data: { id: theme_id }
            }).then(res => {
                $(this.modalEdit).modal('hide');
                swal({
                    title: "Successfully Deleted!",
                    // text: "You clicked the button!",
                    icon: "success",
                    button: false,
                    text: " ",
                    timer: 1500,
                }).then(function() {
                    window.location = "/themes";
                });
            })
        },
        confirmation: function(theme_id) {
            this.theme_id = theme_id
            $(this.modal3).modal('show');
        },
        selectStore: function() {
            axios({
                url: '/themes/used/'+this.theme_id,
                method: 'get'
            }).then(res => {
                console.log(res.data)
            })
        }
    }
}
</script>
