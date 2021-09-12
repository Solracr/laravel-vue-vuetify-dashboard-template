<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cargar los requisitos</div>
    
                    <div class="card-body">
                      <div v-if="validacion" class="alert alert-danger" role="alert">
                        <p class="text-sm-left">Formato PDF es requerido</p>
                        </div>                        
                        <form @submit="formSubmit" enctype="multipart/form-data">
                        
                        <!--strong>Expediente: {{$route.params.id }}</strong-->
                        
                        <strong><b>Fotocopia autenticada de la Representación legal :</b></strong>
                        <input type="file" class="form-control" v-on:change="onFileChange1">    
                         
                        <strong><b>Fotocopia autenticada pasaporte</b></strong>
                        <input type="file" class="form-control" v-on:change="onFileChange2">    
                        

                        <strong><b>Fotocopia autenticada situación migratoria</b> </strong>
                        <input type="file" class="form-control" v-on:change="onFileChange3">    
                        

                        <strong><b>Acta notarial </b></strong>
                        <input type="file" class="form-control" v-on:change="onFileChange4">    
                        

                        <strong><b>Certificación contable </b></strong>
                        <input type="file" class="form-control" v-on:change="onFileChange5">    
                        

                        <strong><b>Fotocopia autenticada del nombramiento del extranjero </b></strong>
                        <input type="file" class="form-control" v-on:change="onFileChange6">    
                        

                        <strong>Declaración jurada </strong>
                        <input type="file" class="form-control" v-on:change="onFileChange7">    
                        <br><br>
                        <button class="btn btn-success">
                            Finalizar
                        </button>


                        </form>
                        <br><br>
                          <div v-if="success != ''" class="alert alert-success" role="alert">
                          {{success}}
                        </div>
                    </div>
                </div>
            </div>
        </div>





<div id="xy" style="display: none;">
    <img :src="'/img/loading.gif'" >    
</div>
<div v-if="mModel">
    <transition name="model">
     <div class="modal-mask">
      <div class="modal-wrapper">
       <div class="modal-dialog">
        <div class="modal-content">
         <!--div class="modal-header">          
          Conectando..
         </div-->       
        <div class="modal-body">
        <br>
         <img :src="'/img/loading.gif'" style="  width:60px;
                                                              height:60px;
                                                              position: fixed;    
                                                              top: 61%;
                                                              left: 54%;
                                                              margin-top: -100px;
                                                              margin-left: -100px;" > 

                                                                                              
          
         </div>
        </div>
       </div>
      </div>
     </div>
    </transition>
   </div>




    </div>





</template>
   
<script>


    export default {
        mounted() {
           // console.log('Component mounted.' + $route.params.expediente );
        },
        data() {

            return {
              mModel: false,
              expediente: '',
              validacion: false,              
              name: '',
              file_1: '',
              file_2: '',
              file_3: '',
              file_4: '',
              file_5: '',
              file_6: '',
              file_7: '',
              success: ''
            };
        },
        methods: {
            onFileChange1(e){                                
                //this.mModel = true                
                this.file_1 = e.target.files[0];                
                if (this.file_1.type === 'application/pdf' ) {                    
                    e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                    let formData = new FormData();
                    formData.append('file_1', this.file_1);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                                            
                        //currentObj.success = response.data.success;
                        //this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });


                    this.validacion = false;
                    
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                                        
                    this.validacion = true;
                    this.file_1 = '';
                    return; 
                }             
            },
            onFileChange2(e){                
                //console.log(e.target.files[0]);
                //this.mModel = true                
                this.file_2 = e.target.files[0];                
                if (this.file_2.type === 'application/pdf' ) {
                    this.validacion = false;
                     e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                   let formData = new FormData();
                    formData.append('file_2', this.file_2);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                    
                        currentObj.success = response.data.success;
                        this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });
                                        
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                    
                    this.validacion = true;
                    this.file_2 = '';
                    return; 
                }             
            },
            onFileChange3(e){                
                //console.log(e.target.files[0]);
                this.file_3 = e.target.files[0];                
                if (this.file_3.type === 'application/pdf' ) {
                     this.validacion = false;
                     e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                   let formData = new FormData();
                    formData.append('file_3', this.file_3);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                    
                        currentObj.success = response.data.success;
                        this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                    
                    this.validacion = true;
                    this.file_3 = '';
                    return; 
                }             
            },
            onFileChange4(e){                
                //console.log(e.target.files[0]);
                this.file_4 = e.target.files[0];                
                if (this.file_4.type === 'application/pdf' ) {
                     this.validacion = false;
                     e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                   let formData = new FormData();
                    formData.append('file_4', this.file_4);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                    
                        currentObj.success = response.data.success;
                        this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                    
                    this.validacion = true;                    
                    this.file_4 = '';
                    return; 
                }             
            },
            onFileChange5(e){                
                console.log(e.target.files[0]);
                this.file_5 = e.target.files[0];                
                if (this.file_5.type === 'application/pdf' ) {
                     this.validacion = false;
                     e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                   let formData = new FormData();
                    formData.append('file_5', this.file_5);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                    
                        currentObj.success = response.data.success;
                        this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                    
                    this.validacion = true;
                    this.file_5 = '';
                    return; 
                }             
            },
            onFileChange6(e){                
                console.log(e.target.files[0]);
                this.file_6 = e.target.files[0];                
                if (this.file_6.type === 'application/pdf' ) {
                    this.validacion = false;
                     e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                   let formData = new FormData();
                    formData.append('file_6', this.file_6);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                    
                        currentObj.success = response.data.success;
                        this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                    
                    this.validacion = true;
                    this.file_6 = '';
                    return; 
                }             
            },
            onFileChange7(e){                
                console.log(e.target.files[0]);
                this.file_7 = e.target.files[0];                
                if (this.file_7.type === 'application/pdf' ) {
                    this.validacion = false;
                     e.preventDefault();
                    let currentObj = this;
    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
    
                   let formData = new FormData();
                    formData.append('file_7', this.file_7);                       
                    axios.post('requisito/upload', formData, config)
                    .then(function (response) {
                        this.$store.dispatch('showSuccessSnackbar', 'Archivo correcto, continue agregando los requisitos');                    
                        currentObj.success = response.data.success;
                        this.mModel = false                
                    })
                    .catch(function (error) {
                        currentObj.success = error;
                        currentObj.output = error;
                        this.mModel = false                

                    });
                }else{
                    this.$store.dispatch('showWarningSnackbar', 'El formato aceptado para archivos es PDF');                    
                    this.validacion = true;
                    this.file_7 = '';
                    return; 
                }             
            },
            
            formSubmit(e) 
            {
                this.$router.push('/');
                //cac
             // this.$route.
            }
        }
    }
</script>

 <style>
   .modal-mask {
     position: fixed;
     z-index: 9998;
     top: 0;
     left: 0;
    
     width: 50%;
     height: 100%;
     background-color: rgba(0, 0, 0, .5);
     display: table;
     transition: opacity .3s ease;
   }

   .modal-wrapper {
     display: table-cell;
     vertical-align: middle;
   }
   .fl {float:left;}  
  </style>

