<template>
<div class="container">  
<div class="card">
  <div class="card-header">
    Agregar Empresa
  </div>
  <div class="card-body">
    <h5 class="card-title">Ingrese el Nit a Consultar</h5>
    <p class="card-text"></p>
      <div class="card-body my-2">
     <form id="submit_form" @submit.prevent="submit_form">
           
        <v-col cols="12" md="4">
          <v-text-field
            :rules="cantidad"
            v-model="fields.nit"            
            label="Nit: no usar guiones"
            required
          ></v-text-field>
        </v-col>
    
    <v-snackbar
      v-model="snackbar"
    >
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="white"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>


       <br>           
       <input type="submit" value="Consultar Nit" class="btn btn-primary">         
        <div class="content">
          <br><br>
            <!--input type="text" v-model="fields.nit"  class="form-control"-->            
                <div class="form-row">
                    <div class="form-group col-md-3">            
                    <input type="text" class="form-control form-control-sm"   v-model="fields.nit"  id="nit" name="nit" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>                                 

                    <div class="form-group col-md-6">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.razonSocial" id="razonSocial" name="razonSocial" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>

                    <div class="form-group col-md-3">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.domicilio" id="domicilio" name="domicilio" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>
                     <input type="hidden" name="_token" :value="csrf">
                </div>
                <h5 class="card-title">Actividad Económica y Datos del Representante Legal</h5>


<div class="form-row">                
                    <div class="form-group col-md-8">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.actividadEconomica" id="actividadEconomica" name="actividadEconomica" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>

                    <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  v-model="fields.nitRepresentante" id="ninitRepresentantetrep" name="nitRepresentante" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>


                    <div class="form-group col-md-3">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.primerNombreRepresentante" id="primerNombreRepresentante" name="primerNombreRepresentante" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>

                    <div class="form-group col-md-3">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.otrosNombresRepresentante" id="otrosNombresRepresentante" name="otrosNombresRepresentante" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>

                    <div class="form-group col-md-3">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.primerApellidoRepresentante" id="primerApellidoRepresentante" name="primerApellidoRepresentante" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>

                    <div class="form-group col-md-3">            
                    <input type="text" class="form-control form-control-sm"  v-model="fields.segundoApellidoRepresentante" id="segundoApellidoRepresentante" name="segundoApellidoRepresentante" disabled>            
                    <div class="invalid-feedback">Porfavor llene este campo</div>
                    </div>
</div>
        <v-select
          v-model="fields.tipoEntidad"         
          :items="itemsCombo"
          item-text="textos"
          item-value="valores"
          label="Tipo de Entidad"          
          :return-object="false"
          :rules="cantidad"
          single-line
        ></v-select>        

<br>

 <v-container>
     <v-form ref="form" v-model="valid" lazy-validation>      
      <v-card>
    <v-card-title>

        <v-col cols="12" md="4">
          <v-text-field
            v-model="fields.telefono"            
            label="Teléfono"
            required
          ></v-text-field>
        </v-col>
        
        <v-col cols="12" md="4">
          <v-text-field
            v-model="fields.correo"            
            label="Correo"
            required
          ></v-text-field>
        </v-col>
        
        <v-col cols="12" md="4">
          <v-text-field
            v-model="fields.direccionNotificaciones"            
            label="Dirección Notificaciones"
            required
          ></v-text-field>
        </v-col>
        
        <v-col cols="12" md="4">
          <v-text-field
            :rules="cantidad"
            v-model="fields.cantidadTrabajadores"            
            label="Cantidad Trabajadores"
            required
          ></v-text-field>
        </v-col>

           <v-col cols="12" md="4">
          <v-text-field
            :rules="cantidad"
            v-model="fields.cargo"            
            label="Cargo"
            required
          ></v-text-field>
        </v-col>
 
    </v-card-title>
    </v-card>
     <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="registrarEmpresa"
    >
      Registrar Empresa
    </v-btn>

      <v-alert
        v-model="alert"
        dismissible
        type="error"
      >
        Debe completar el formulario
      </v-alert>
    </v-form>
    </v-container>

        </div>
        
     </form>
   </div>
    <!--a href="#" class="btn btn-primary">Go somewhere</a-->
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


   <!--DIV CONTEINTER FINAL-->
</div>
</template>

<script>     

export default {
  data() {
    return {  
      snackbar: false,
      text: 'El nit ingresado no es válido',
      alert: false,
      valid: false,
      cantidad: [
        v => !!v || 'Debe ingresar un dato',        
      ],    
      combos: ["Sociedad_Mercantil", "Empresa_Individual", "Entidad_No_Lucrativa"],
      mModel:false,
      fields: [],
      csrf: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '',
      modoEditar: false,
      
      itemsCombo: [
        { textos: 'Sociedad Mercantil', valores: 'Sociedad_MercantilL' },
        { textos: 'Empresa Individual', valores: 'Empresa_Individual' },
        { textos: 'Entidad No Lucrativa', valores: 'Entidad_No_Lucrativa' },        
      ],
      fields: {
                  "nit":"",
                  "razonSocial":"",
                  "domicilio":"",
                  "correo":"",
                  "telefono":"",
                  "actividadEconomica":"",
                  "nitRepresentante":"",
                  "primerNombreRepresentante":"", 
                  "otrosNombresRepresentante":"",
                  "primerApellidoRepresentante":"", 
                  "segundoApellidoRepresentante":"",
                  "tipoEntidad":"",
                  "direccionNotificaciones":"",
                  "cantidadTrabajadores":"",
                  "cargo":"",
                  "user_id":"",
                  "nacionalidad":"Guatemalteco"
              }     
      }
  },
  created() {
    
    if (! this.csrf) {
            console.warn('The CSRF token is missing. Ensure that the HTML header includes the following: <meta name="csrf-token" content="{{ csrf_token() }}">');
        }
  },
  computed: {
    axiosParams() {
        const params = new URLSearchParams();
        params.append('nit', this.fields.nit);
        //params.append('param2', 'value2');
        return params;
    }
  },
  methods:{
    validate () {
      //  this.$refs.form.validate(),
         this.$refs.submit_form.validate()
      },  
      registrarEmpresa(){          
           if(this.fields.cantidadTrabajadores === '' || this.fields.razonSocial === '' || this.fields.cargo === '' || this.fields.tipoEntidad === ''){            
              this.alert = true;        
            }else{
            axios.post('registrarEmpresa', this.fields)
                .then(response=>{                  
                  console.log(response.data);
                  //this.$router.push('/Empresa')
                  this.$router.push('/')
                })
              }
      },
      submit_form(){   
          this.mModel = true          
          axios.get('consultarNit', {
          params: this.axiosParams
          }).then((response) => {     
            
            if(response.data.code == '200'){
                console.log(response.data);  
                this.$store.dispatch('showSuccessSnackbar', 'Datos recuperados exitosamente');
                this.fields = response.data.contribuyente;    
                this.mModel=false  
                this.valid = true
            }else{
                this.mModel=false
                //this.snackbar=true
                this.valid = true                
                this.$store.dispatch('showErrorSnackbar', 'El nit ingresado no es válido');
         
                                 
            }                        
          })
        .catch((error) => console.log(error))
        //.finally(() => this.mModel=false)
    },    
    agregar(){
      if(this.fields.nombre.trim() === '' || this.fields.domicilio.trim() === ''){
        alert('Debes completar todos los campos antes de guardar');
        return;
      }
      const nNueva = this.fields;
      this.fields = {nit: '', nombre: '', domicilio: ''};    
      axios.post('empresa/store', nNueva)
        .then((res) =>{
          const fieldsServidor = res.data;
          this.fields.push(fieldsServidor);
        })
    },
    editarFormulario(item){
      this.fields.nombre = item.nombre;
      this.fields.domicilio = item.domicilio;
      this.fields.id = item.id;
      this.modoEditar = true;
    },
    editarfields(fields){
      const params = {nombre: fields.nombre, domicilio: fields.domicilio};
      axios.put(`empresa/${fields.id}`, params)
        .then(res=>{
          this.modoEditar = false;
          const index = this.fields.findIndex(item => item.id === fields.id);
          this.fields[index] = res.data;
        })
    },
    eliminarfields(fields, index){
      const confirmacion = confirm(`Eliminar  ${fields.nombre}`);
      if(confirmacion){
        axios.delete(`empresa/${fields.id}`)
          .then(()=>{
            this.fields.splice(index, 1);
          })
      }
    },
    cancelarEdicion(){
      this.modoEditar = false;
      this.fields = {nit: '', nombre: '', domicilio: ''};
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

