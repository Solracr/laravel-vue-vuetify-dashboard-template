  <template>
  <div class="container" id="crudApp">

    <div class="panel panel-default">

      <div class="panel-heading">    
      </div>


      

<div class="card">
  <div class="card-header">
    <br><br>
        <nav>
        <div class="navbar navbar-light bg-light" style="z-index: 10;  
                              position: absolute;  
                              right: 0;  
                              top: 0;">
        <form class="d-flex" >
            <input class="form-control me-2"  type="text" v-model="query" placeholder="Escriba el dato que busca" />
            <button class="btn btn-outline-success" @click="search()">Buscar</button>
        </form>
        </div>                
        </nav>

  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text"></p>
      <div class="card-body my-2">

      <table class="table table-striped">
        <thead>
          <tr>
                <th>Expediente</th>
                <th>Plaza</th>
                <th>DPI</th>
                <th>Nacionalidad</th>
                <th>Status</th>
                <th>PDF</th>    
          </tr>
        </thead>
        <tbody>
            <tr v-for="row in allData" :key="row">
                <td>{{ row.expediente }}</td>
                <td>{{ row.nombrePlaza }}</td>
                <td>{{ row.numeroDocumento }}</td>
                <td>{{ row.nacionalidad }}</td>
                <td></td>                
                <td><button type="button" name="edit" class="btn btn-primary btn-xs edit" @click="fetchData(row.qr)">Certificación</button></td>              
              </tr>
        </tbody>
      </table>

  <!---CIERRE DE CARDS-->
      </div>
    </div>
    </div>


    </div>



  <!---INICIO MODAL-->

  <div v-if="mModel">
      <transition name="model">
      <div class="modal-mask">
        <div class="modal-wrapper">
        <div class="modal-dialog">
          <div class="modal-content">        
          <div class="modal-body">
          <br>
              <!--div class="modal-header">
             
                    <h4 class="modal-title">{{ dynamicTitle }}</h4>
              </div-->
              <div class="modal-body">
                       <button type="button" class="close" @click="mModel=false"><span aria-hidden="true">&times;</span></button>
                  <div class="form-group">                    
                  <iframe :src="archivoPDF" style="width:90%; height:400px;" frameborder="0"></iframe>
                  </div>
              </div>                                           
          </div>
          </div>
        </div>
        </div>
      </div>
      </transition>
    </div>


  <!---FIN MODAL-->    
  </div>
<!---FIN CONTAINER PRINCIPAL-->    
</template>


  
<script>


    export default {
        mounted() {
            console.log('Component Bandeja Dashboard.')
        },
        data() {

            return {
               indice : 0,
               validacion: false,              
               query: '',
               allData: [],
               allData2: [],            
               mModel: false,
               actionButton: 'Insert',               
               dynamicTitle: 'Bandeja',
            };
        },
        methods: {
        fetchAllData: function() {          
          axios.get('solicitud/bandeja', {
            action: 'fetchall'
          }).then((response) => {                 
            this.allData = response.data;
            this.allData2 = response.data;               
          });
        },
        fetchData: function(qr) {                              
            this.mModel = true;
            this.actionButton = 'Update';
            this.dynamicTitle = '';
            this.archivoPDF = qr;
        },
        search: function() {
          var results = [];
          var searchData = this.allData2;
          if (this.query == "") {
            this.allData = this.fetchAllData();
          } else {
            for (var i = 0; i < searchData.length; i++) {
              var sparam = this.query.toLowerCase();
              var encontrado = 0;
              for (var key in searchData[i]) {
                if (encontrado < 1) {
                  if (searchData[i].hasOwnProperty(key)) {
                    var value = searchData[i][key];
                    if (typeof value == "string" && value.toLowerCase().indexOf(sparam) >= 0) {
                      results.push(searchData[i]);
                      encontrado += 1;
                    }
                  }
                }
              }
            }
            this.allData = results;
          }
        }
      },
      created: function() {
        this.fetchAllData();
      },
      watch: {
        query() {
          this.search();
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
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, .5);
      display: table;
      transition: opacity .3s ease;
    }   
    .my-custom-class .modal-wrapper {    
        height: 90%;
        position: absolute; 
        top: 5%;
        width: 90%;
        border-radius: 25px;
        display: block;
    }


    .modal-body{
      width: 800px;
    }

    .modal-dialog{
        width: 850px;
    }

    .modal-content{
      width: 850px;
    }

    .pdf-modal-body {
      /* overflow-x: scroll;*/
      overflow-y: scroll;
      height: 400px;
      scroll-behavior: smooth;
    }

  </style>