<template>
  <v-form v-model="valid">
    <v-container>
         <v-form ref="form" v-model="valid" lazy-validation>     
          <v-card>
            <v-card-title>
              
                  <div class='flotar'>
                    <div style='float: left;'>
                        <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                      ></v-text-field>  
                    </div>
                    <div style='float: right;'>
                        <router-link
                          to="/WebServiceSat"
                        >
                         <v-btn color="primary" dark>Agregar Empresa
                          <v-icon dark right>check_circle</v-icon>
                        </v-btn>
                          
                        </router-link>     
                  </div>               
                </div>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="items"
              :search="search">

               <template v-slot:item="row">
                <tr>
                  <td>{{row.item.nit}}</td>
                  <td>{{row.item.razonSocial}}</td>
                  <td>{{row.item.domicilio}}</td>
                  <td>{{row.item.telefono}}</td>
                  <td>{{row.item.correo}}</td>
                  <td>
                    <router-link :to="{ path: '/Form_Solicitud', params: { IdEmpresa: row.item.id }}">
                    <v-btn color="primary" dark>Nueva Solicitud
                          <v-icon dark right>check_circle</v-icon>
                        </v-btn>                          
                    </router-link>
                        <!--router-link
                          to="/Form_Solicitud"
                        >
                         <v-btn color="primary" dark>Nueva Solicitud
                          <v-icon dark right>check_circle</v-icon>
                        </v-btn>                          
                        </router-link-->     
                  

                     <!--v-btn v-on:click="greet" depressed small color="primary" > Nueva Solicitud 
                     </v-btn-->                    


                  </td>
                </tr>
            </template>
            </v-data-table>
          </v-card>
        
    </v-form>
    </v-container>
  </v-form>
</template>



<script>
  export default {
    data () {
      return {
        search: '',
        headers: [
          {
            text: 'Nit',
            align: 'start',
            filterable: false,
            value: 'nit',
          },
          { text: 'Razón Social', value: 'razonSocial' },
          { text: 'Domicilio', value: 'domicilio' },
          { text: 'Teléfono', value: 'telefono' },
          { text: 'Correo', value: 'correo' },
          { text: 'Acción', value: 'solicitud' },
        ],
        items: [
          {
            id: '',
            nit: '',
            razonSocial: '',
            domicilio: '',
            telefono: '',
            correo: '',                      
          },        
        ],
      }
    },
    created: function() {
      this.fetchAllData();
    },
     methods: {
        greet: function (event) {        
          //alert('Hello ' + this.name + '!')        
          if (event) {
            alert(event.target.tagName)
          }
        },
        fetchAllData: function() {          
          axios.get('listadoEmpresas', {
            action: 'fetchall'
          }).then((response) => {        
            console.log('Data:::::: ' + response.data);        
            this.items = response.data;            
            //console.log(this.allData);            
          });
        },
      }
  }
</script>


<style>
  .flotar {
  width:100%;
  display:inline-block;
  overflow: auto;
  white-space: nowrap;
  margin:0px auto;
  border:1px rgb(255, 255, 255) solid;
}

</style>
