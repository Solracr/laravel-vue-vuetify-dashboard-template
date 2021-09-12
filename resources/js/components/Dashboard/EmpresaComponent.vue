<template>
      <div class="container">
        <div class="card-body">
          <form @submit.prevent="submit_form">
            <input type="text" v-model="fields.tipoSolicitud"  class="form-control">
            <br>       
            <input type="submit" value="Guardar" class="btn btn-primary">
            <div>
      </div>

     </form>
   </div>
</div>
</template>

<script>
export default {
  data(){
    return{
      fields:{
        'tipoSolicitud': '1', 
        'user_id':'1',
      }
    }
  },
  props: {
            userName: String,
  },
  methods:{
    submit_form(){      
      axios.post('solicitud', this.fields)
        .then(response=>{
          this.$router.push('/')
        })
    }    
  }

}
</script>



