<template>

<v-container>     
      <v-card >
        
<nav class="navbar navbar-dark bg-primary">
<h4>Datos del Extranjero</h4>
</nav>


<v-card-text>
  <v-form ref="form" v-model="valid" lazy-validation >
  
      <v-row class="fill-height">
        <v-col cols="12" md="3">
          <v-text-field
            v-model="field.primerNombre"  
            :rules="vacio"          
            label="Primer Nombre"
            required
          ></v-text-field>
        </v-col>

        <v-col  cols="12" md="3" >
          <v-text-field
            v-model="field.otrosNombres"            
            label="otros Nombres"            
          ></v-text-field>
        </v-col>
      
        <v-col cols="12" md="3">
          <v-text-field
            v-model="field.primerApellido"
            :rules="vacio"                      
            label="Primer Apellido"
            required
          ></v-text-field>
        </v-col>

         <v-col cols="12" md="3">
          <v-text-field
            v-model="field.otrosApellidos"              
            label="otros Apellidos"            
          ></v-text-field>
        </v-col>
      </v-row>



      <v-row class="fill-height">       
        <v-col cols="12" md="3">
          <v-text-field
            v-model="field.apellidoCasada"            
            label="Apelllido Casada"            
          ></v-text-field>
        </v-col>
      
        <v-col cols="12" md="3">
          <v-text-field
            v-model="field.numeroTelefono"
            :rules="numberRule"                      
            label="Número de Teléfono"
            required
          ></v-text-field>
        </v-col>        
        <v-col cols="12" md="3" >
            <v-select
            v-model="field.nacionalidad"         
            :items="itemComboNacionalidades"
            item-text="GENTILICIO_NAC"
            item-value="GENTILICIO_NAC"
            label="Nacionalidad"          
            :return-object="false"
            :rules="vacio"
            single-line
          ></v-select>        
        </v-col>
        
          <v-col cols="12" md="3" >
            <v-select
            v-model="field.genero"         
            :items="itemsComboGenero"
            item-text="genero"
            item-value="genero"
            label="Genero"          
            :return-object="false"
            :rules="vacio"
            single-line
          ></v-select>        
        </v-col>
      </v-row>   

      <v-row>
        <v-col  cols="12" md="3" >
          Fecha de nacimiento
          <date-picker v-model="field.fechaNacimiento" valueType="format"></date-picker>
        </v-col>

         <v-col cols="12" md="3" >
            <v-select
            v-model="field.estadoCivil"         
            :items="itemsComboCivil"
            item-text="estadocivil"
            item-value="estadocivil"
            label="Estado Civil"          
            :return-object="false"
            :rules="vacio"
            single-line
          ></v-select>        
        </v-col>

         <v-col cols="12" md="3" >
            <v-select
            v-model="field.documentoIdentificacion"         
            :items="itemsTipoDocumento"
            item-text="tipodocumento"
            item-value="tipodocumento"
            label="Documento Identificación"          
            :return-object="false"
            :rules="vacio"
            single-line
          ></v-select>        
        </v-col>


        <v-col  cols="12" md="3" >
          <v-text-field
            v-model="field.numeroDocumento"
            :rules="vacio"                      
            label="Número de Documento"
            required
          ></v-text-field>
        </v-col>      

        
    
      </v-row>

     
      <v-row>
      <v-card-text>             
          <v-text-field
            v-model="field.direccion"  
            :rules="vacio"          
            label="Dirección"
            required
            hint = 'Ejemplo 1a. calle 2-13 zona 1'
          ></v-text-field>
      </v-card-text>
      </v-row>


      
      <v-row>
         <v-col cols="12" md="4" >
            <v-select
            v-model="field.departamento"         
            :items="itemComboDepartamentos"
            item-text="nombre"
            item-value="codigo"
            label="Departamento"          
            :return-object="false"
            :rules="vacio"
            single-line
            @change="onChangeDepartamento()"
          ></v-select>        
        </v-col>

         <v-col cols="12" md="4" >
            <v-select
            v-model="field.municipio"         
            :items="itemComboMuncipio"
            item-text="nombre"
            item-value="codigo"
            label="Municipio"          
            :return-object="false"
            :rules="vacio"
            single-line
          ></v-select>        
        </v-col>


        <v-col 
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="field.correoElectronico"
            :rules="emailRules"                     
            label="Email"
            required
          ></v-text-field>
        </v-col>      
      </v-row>

                                 
<nav class="navbar navbar-dark bg-primary">
<h4>Datos Académicos</h4>
</nav>      
        <v-row>
          <v-col cols="12" md="3">
            <v-text-field v-model="field.profesion" :rules="vacio"  label="Profesión" required></v-text-field>
          </v-col>
          <v-col cols="12" md="3">            
            <v-select v-model="field.nivelEstudio" :items="iniveEstudio" item-text="nivel" item-value="nivel" label="Nivel Estudio" :return-object="false" :rules="vacio" single-line></v-select> 
          </v-col>
          <v-col cols="12" md="3">
             <v-select v-model="field.experiencia" :items="iexperiencia" item-text="experiencia" item-value="vexperiencia" label="Experiencia" :return-object="false" :rules="vacio" single-line></v-select> 
          </v-col>     
          <v-col cols="12" md="3">
            <v-text-field v-model="field.ocupacion" :rules="vacio"  label="Ocupación" required></v-text-field>
          </v-col>          
        </v-row>

        <v-row>          
          <v-col cols="12" md="6">
            <v-text-field v-model="field.especificarCarrera" :rules="vacio"  label="Especificar Carrera" required></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field v-model="field.observaciones" :rules="vacio"  label="Observaciones" required></v-text-field>
          </v-col>     
        </v-row>


     


<nav class="navbar navbar-dark bg-primary">
<h4>Datos de la Plaza</h4>
</nav>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field v-model="field.nombrePlaza" :rules="vacio"  label="Nombre Plaza" required></v-text-field>
          </v-col>          
          <v-col cols="12" md="3" >
            <v-select
            v-model="field.periodicidadPago"         
            :items="itemsComboPeriodicidad"
            item-text="periodicidad"
            item-value="periodicidad"
            label="Periodicidad de Pago"          
            :return-object="false"
            :rules="vacio"
            single-line>
            </v-select>        
        </v-col>
          <v-col cols="12" md="3">
            <v-text-field v-model="field.montoPago" :rules="vacio"  label="Monto de Pago" required></v-text-field>
          </v-col>          
        </v-row>              
        <v-row>    
        <v-col cols="12" md="4"> 
           <v-autocomplete
            v-model="field.idiomas"
            :items="itemComboIdiomas"
            chips
            deletable-chips
            multiple
            :menu-props="{align:'center', maxHeight: '400', maxWidth: '50%' }"
            label="Idiomas que requiere el puesto"            
            persistent-hint
            v-on:change="agregarIdioma()"
          ></v-autocomplete>        
          </v-col>
          <v-col cols="12" md="6">
            <v-subheader >
              <v-text-field v-model="field.funcionesGenerales" :rules="vacio"  label="Funciones Generales" required></v-text-field>
            </v-subheader>
          </v-col>
          
        </v-row>

<nav class="navbar navbar-dark bg-primary">
<h4>Situación Migratoria</h4>
</nav>        
          <v-row>
          <v-col cols="12" md="4" >
          <v-select v-model="field.situacionMigratoria" :items="isituacionMigratoria" item-text="mvalue" 
            item-value="mvalue" label="Tipo Situación" :return-object="false" :rules="vacio" single-line v-on="verificarCampos()">
          </v-select>        
          </v-col>
          <v-col cols="12" md="4" v-if="this.field.situacionMigratoria === 'Permanente'">
            <v-text-field v-model="field.expedienteMigracion"   label="Expediente Migracion" ></v-text-field>
          </v-col>
          <v-col cols="12" md="4" v-if="this.field.situacionMigratoria === 'Permanente'">
            <v-text-field v-model="field.llaveMigracion"   label="Llave Migracion" ></v-text-field>
          </v-col>
          <!--v-col cols="12" md="4" v-if="situacionFlag">            
            <v-select v-model="field.perfilPlaza" :items="iniveEstudio" item-text="nivel" item-value="nivel" label="Nivel Estudio" :return-object="false" :rules="vacio" single-line></v-select> 
          </v-col-->        
        </v-row>



          

     <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="agregar"
    >
      Validar
    </v-btn>    
    </v-form>
    
  </v-card-text>
</v-card>





</v-container>
</template>





<script>
//var csrf_token = $('meta[name="csrf-token"]').attr('content');
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';


export default { 
  components: { DatePicker },
  data() {
    return {  
      valid: true, 
      time1: null,
       action: [
        {
          key: 'today',
          highlight: {
            backgroundColor: '#1ebb42',
            borderRadius: '5px',
 	          borderColor: '#1ebb42',
            borderWidth: '4px'
          },
          contentStyle: {
            color: '#fff',
            borderWidth: '4px',
            borderRadius: '5px'
          },
          dates: [new Date('2018/10/17'), new Date(), new Date('2018/10/21')]
        }
      ],
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      situacionFlag: false,
      menu: false,
      modal: false,
      menu2: false,   
      mModel:false,
      field: [], 
      e6: [],     
      itemsComboGenero: [
          { genero: 'Hombre' },
          { genero: 'Mujer' }          
      ],
      itemsComboCivil:[
          {estadocivil: 'Casado'},
          {estadocivil: 'Soltero'},
          {estadocivil: 'Unido'},
      ],
      itemsComboPeriodicidad:[
          {periodicidad: 'Quincenal'},
          {periodicidad: 'Mensual'},
          {periodicidad: 'Semanal'},
      ],
      isituacionMigratoria:[
        {mvalue: 'Permanente', tvalue: 'Permanente'},
        {mvalue: 'TemporalEnTramite', tvalue: 'Residencia en Trámite'},
        {mvalue: 'Temporal', tvalue: 'Residencia Temporal'},
        {mvalue: 'PermaenteEnTramite', tvalue: 'Residencia Permanente en Trámite'},
      ],                                    
      iniveEstudio:[
          {nivel: 'Primaria'},
          {nivel: 'Básico'},
          {nivel: 'Diversificado'},
          {nivel: 'Técnico'},
          {nivel: 'Universitario'},
          {nivel: 'Maestria'},
          {nivel: 'Ninguno'},
      ],
      iexperiencia:[
          {vexperiencia: '1-5', experiencia: '1 a 5 años'},
          {vexperiencia: '6-10', experiencia: '6 a 10 años'},
          {vexperiencia: '10+', experiencia: '10 o más'},
          {vexperiencia: '0', experiencia: 'Sin Experiencia'},          
      ],
      itemsTipoDocumento:[
          {tipodocumento: 'DPI'},
          {tipodocumento: 'Pasaporte'}          
      ],
      itemComboNacionalidades: [],
      itemComboDepartamentos: [],
      itemComboMuncipio: [],
      itemComboIdiomas: [],
      arrayIdiomas:[],
      emailRules: [ 
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Escriba una dirección de E-mail'
      ],
      vacio: [
        v => !!v || 'Debe ingresar un dato',        
      ],   
      numberRule: [v => Number.isInteger(Number(v)) || "Debe ingresar un valor numerico",
      v => v.length == 8 || "El valor debe ser de 8 digitos"], 
      modoEditar: false,  
      vueyear:'',
      vuemonth:'',
      vueday:'',    
      field: {
                  //token   : csrf_token,
                  primerNombre:'',
                  otrosNombres:'',
                  primerApellido:'',
                  otrosApellidos:'',
                  apellidoCasada:'',
                  numeroTelefono:'',
                  fechaNacimiento:null,
                  nacionalidad:'',
                  genero:'',
                  estadoCivil:'',                  
                  documentoIdentificacion:'',
                  numeroDocumento:'',
                  direccion:'',
                  departamento:0,
                  municipio:0,
                  correoElectronico:'',


                  profesion:'',
                  nivelEstudio:'',
                  especificarCarrera:'',
                  experiencia:'',
                  ocupacion:'',
                  idiomas:'',
                  observaciones:'',
                  
                  situacionMigratoria:'',
                  expedienteMigracion:'',
                  llaveMigracion:'',
                  
                  nombrePlaza:'',
                  perfilPlaza:'',
                  funcionesGenerales:'',
                  periodicidadPago:'',
                  montoPago:0,
                  status:'',
                  codigoEmpresa:0,
                  qr:'',

                  tipo1:'Solicitud',
                  tipo2:'D',
                  expediente:'',
                  user_id:''
              }     
      }
  },
  
  mounted(){
     
  },
  created() {  
       //console.log('Recibiendo ' + IdEmpresa);
       axios.get('solicitud/nacionalidades').then((res) =>{                          
          this.itemComboNacionalidades = res.data;
        })
        .catch((error) => console.log(error))

        axios.get('solicitud/departamentos').then((res) =>{                          
          this.itemComboDepartamentos = res.data;
        })
        .catch((error) => console.log(error))

        axios.get('solicitud/idiomas').then((res) =>{                          
          this.itemComboIdiomas = res.data;                                
        })
        .catch((error) => console.log(error))
            
  },
  computed: {   
   attributes() {
      return [
        // Today attribute
          {
            highlight: {
              backgroundColor: 'black',
              borderColor: 'red',
              borderWidth: '3px',
              borderStyle: 'solid',
              width: '2.4rem',
              height: '2.4rem',
            },
            contentStyle: {
              color: 'grey',
            }                             
        },
      ];
    },
  },
  
  methods:{
    verificarCampos(){    
    },
    agregarIdioma(){    
    },
    onChangeDepartamento(){
        console.log("El codigo de municipo " + this.field.departamento)
        axios.put('solicitud/municipios', this.field).then((res) =>{                          
          this.itemComboMuncipio = res.data;
        }).catch((error) => console.log(error))        
    },
    onFileChange(e){
        this.file_representanteLegal = event.target.files[0];
        console.log(e.target.files[0]);
        this.file = e.target.files[0];
    },                 
    agregar(){     
      if(this.$refs.form.validate()){
        this.field.idiomas = this.field.idiomas.join()
        if(this.field.fechaNacimiento){
          this.mModel = true   
          this.$store.dispatch('showSuccessSnackbar', 'Datos recuperados exitosamente');
          axios.post('solicitud/store',this.field).then((res) =>{                
            console.log("el ID de la solicitud es: " + res.data);          
            this.mModel=false;
            //window.location.href = 'home#/Requisitos';


            this.$router.push('/Requisitos');
            console.log("DATA OK: " + res.data);          
            //retornar a home
            // this.$router.push('/')
          })
          .catch((error) => console.log(error))
        }else{
          this.$store.dispatch('showErrorSnackbar', 'Debe llenar fecha de nacimiento');  
        }
        
      }else{
        this.$store.dispatch('showErrorSnackbar', 'Debe llenar todos los campos obligatorios');
      }
      
    },     
  }
}
</script>


 <style>
 .selectB {
    border: 1;
    outline: 1;
    background: #6cb2eb;    
    outline-offset: -2px;
    border-color: whitesmoke;
    outline-color: whitesmoke;        
  }
   .modal-mask {
     position: fixed;
     z-index: 9998;
     top: 0;
     left: 0;
    
     width: 100%;
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
   
   .font-class-name * {
   font-size: 9px;
    }

    .datepicker {
      width: 50px;
      height: 20px;
    }
  </style>


