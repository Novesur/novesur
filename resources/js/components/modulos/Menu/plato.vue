<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Platos</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Registrar Plato Entrada</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomEntrada"
                          />
                        </div>
                      </div>
                    </div>
                  </div>



                </form>
              </div>
              <div class="card-footer  ">
                  <div class="btn-group offset-4" >

                    <button
                      class="btn btn-flat btn-info btnWidth float-left"
                      @click.prevent="setValidarPEntrada"
                      style="margin-right: 5px"
                    >
                      Registrar
                    </button>
                        <button
                      class="btn btn-flat btn-success btnWidth"
                      @click.prevent="setBuscarPEntrada"
                      style="margin-right: 5px"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth float-right"
                      @click.prevent="limpiarPEntrada"
                    >
                      Limpiar
                    </button>

                </div>
              </div>
            </div>
          </div>
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Listado de Platos de Entrada</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listPEntradaPaginated"
                      :key="index"
                    >
                      <td v-text="item.nombre"></td>
                      <td>
                        <router-link class="btn btn-info btn-sm" :to="{name:'marca.editar', params:{id: item.id}}">
                          <i class="fas fa-pencil-alt"></i>Editar
                        </router-link>

                            <button
                          class="btn btn-danger btn-sm"
                          @click.prevent="setConfirmaDeleteUsuario(item.id)"
                        >
                          <i class="fas fa-trash"></i>Eliminar
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="#" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in pagesListPEntrada"
                      :key="index"
                      :class="[page == pageNumber ? 'active' : '']"
                    >
                      <a
                        href="#"
                        class="page-link"
                        @click.prevent="selectPage(page)"
                        >{{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage"
                        >Post</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>


      </div>


    <!--   Menu Segundo -->

         <div class="card">

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Registrar Plato Segundo</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomSegundo"
                          />
                        </div>
                      </div>
                    </div>


                  </div>



                </form>
              </div>
              <div class="card-footer">
                <div class="btn-group offset-4" >

                    <button
                      class="btn btn-flat btn-info btnWidth float-left"
                      @click.prevent="setValidarPSegundo"
                      style="margin-right: 5px"
                    >
                      Registrar
                    </button>
                        <button
                      class="btn btn-flat btn-success btnWidth"
                      @click.prevent="setBuscarPSegundo"
                      style="margin-right: 5px"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth float-right"
                      @click.prevent="limpiarPEntrada"
                    >
                      Limpiar
                    </button>

                </div>
              </div>
            </div>
          </div>

              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de Entrada</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarPSegundoPaginated"
                      :key="index"
                    >
                      <td v-text="item.nombre"></td>
                      <td>
                        <router-link class="btn btn-info btn-sm" :to="{name:'marca.editar', params:{id: item.id}}">
                          <i class="fas fa-pencil-alt"></i>Editar
                        </router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="#" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in  pagesListPSegundo"
                      :key="index"
                      :class="[page == pageNumber ? 'active' : '']"
                    >
                      <a
                        href="#"
                        class="page-link"
                        @click.prevent="selectPage(page)"
                        >{{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage"
                        >Post</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>

        </div>
      </div>
    <!--   Fin del Menu Segundo -->


     <!--   Menu Extra -->

         <div class="card">

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Registrar Plato Extra</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearPlato.cNomExtra"
                          />
                        </div>
                      </div>
                    </div>


                  </div>



                </form>
              </div>
              <div class="card-footer">
                <div class="btn-group offset-4" >

                    <button
                      class="btn btn-flat btn-info btnWidth float-left"
                      @click.prevent="setValidarPExtra"
                      style="margin-right: 5px"
                    >
                      Registrar
                    </button>
                        <button
                      class="btn btn-flat btn-success btnWidth"
                      @click.prevent="setBuscarPExtra"
                      style="margin-right: 5px"
                    >
                      Buscar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth float-right"
                      @click.prevent="limpiarPEntrada"
                    >
                      Limpiar
                    </button>

                </div>
              </div>
            </div>
          </div>
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de Entrada</h3>
              </div>
              <div class="card-body table-responsive">
                <table
                  class="table table-hover table-head-fixed text-nowrap projects"
                >
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(item, index) in listarPExtraPaginated"
                      :key="index"
                    >
                      <td v-text="item.nombre"></td>
                      <td>
                        <router-link class="btn btn-info btn-sm" :to="{name:'marca.editar', params:{id: item.id}}">
                          <i class="fas fa-pencil-alt"></i>Editar
                        </router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" v-if="pageNumber > 0">
                      <a href="#" class="page-link" @click.prevent="prevPage"
                        >Ant</a
                      >
                    </li>
                    <li
                      class="page-item"
                      v-for="(page, index) in pagesListPExtra"
                      :key="index"
                      :class="[page == pageNumber ? 'active' : '']"
                    >
                      <a
                        href="#"
                        class="page-link"
                        @click.prevent="selectPage(page)"
                        >{{ page + 1 }}</a
                      >
                    </li>
                    <li class="page-item" v-if="pageNumber < pageCountPExtra - 1">
                      <a href="#" class="page-link" @click.prevent="nextPage"
                        >Post</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </div>
    <!--   Fin del Menu Extra -->

    </div>
    <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div
              class="callout callout-danger"
              style="padding: 5px"
              v-for="(item, index) in mensajeError"
              :key="index"
              v-text="item"
            ></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      :class="{ show: modalShow }"
      :style="modalShow ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistemas Novesur</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div
              class="callout callout-danger"
              style="padding: 5px"
              v-for="(item, index) in mensajeError"
              :key="index"
              v-text="item"
            ></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>




  </div>
</template>

<script>
export default {
  data() {
    return {
      fillCrearPlato: {
        cNomEntrada: "",
        cNomSegundo:"",
        cNomExtra:""

      },
      listPEntrada:[],
      listPSegundo:[],
      listPExtra:[],
      pageNumber:0,
      perPage : 10,

      modalShow: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
      },
      ocultarModal: {
        display: "none",
      },
      error: 0,
      mensajeError: [],
    };
  },
      computed:{
        pageCount(){
            let a = this.listPEntrada.length,
            b = this.perPage;
            return Math.ceil(a/b);
        },
        pageCountPSegundo(){
            let a = this.listPSegundo.length,
            b = this.perPage;
            return Math.ceil(a/b);
        },
          pageCountPExtra(){
            let a = this.listPExtra.length,
            b = this.perPage;
            return Math.ceil(a/b);
        },
        listPEntradaPaginated(){
            let inicio = this.pageNumber * this.perPage,
            fin = inicio + this.perPage;
            return this.listPEntrada.slice(inicio,fin);
        },
        listarPSegundoPaginated(){
            let inicio = this.pageNumber * this.perPage,
            fin = inicio + this.perPage;
            return this.listPSegundo.slice(inicio,fin);
        },
          listarPExtraPaginated(){
            let inicio = this.pageNumber * this.perPage,
            fin = inicio + this.perPage;
            return this.listPExtra.slice(inicio,fin);
        },
        pagesListPEntrada(){

               let a = this.listPEntrada.length,
            b = this.perPage;
            let PageCount = Math.ceil(a/b);
            let count = 0,
            pagesArray = [];

            while(count < PageCount){
                pagesArray.push(count);
                count++;
            }
        return pagesArray;

        },

               pagesListPSegundo(){

               let a = this.listPSegundo.length,
            b = this.perPage;
            let PageCount = Math.ceil(a/b);
            let count = 0,
            pagesArray = [];

            while(count < PageCount){
                pagesArray.push(count);
                count++;
            }
        return pagesArray;

        },

                  pagesListPExtra(){

               let a = this.listPExtra.length,
            b = this.perPage;
            let PageCount = Math.ceil(a/b);
            let count = 0,
            pagesArray = [];

            while(count < PageCount){
                pagesArray.push(count);
                count++;
            }
        return pagesArray;

        }
    },
  mounted(){

/*    this.setBuscarPEntrada();
   this.setBuscarPSegundo();
   this.setBuscarPExtra(); */
//Carga la fecha Actual
/*  this.fillCrearPlato.dFecha = new Date(); */
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarPEntrada() {
      this.fillCrearPlato.cNomEntrada = "";

    },
        limpiarPSegundo() {
      this.fillCrearPlato.cNomSegundo = "";

    },
        limpiarPExtra() {
      this.fillCrearPlato.cNomExtra = "";

    },

    setGuardarPEntrada() {
      var url = "/administracion/Plato/CrearPlatoEntrada";
      axios
        .post(url, {
          cNomEntrada: this.fillCrearPlato.cNomEntrada,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomEntrada=''
          this.setBuscarPEntrada();
          
        });
    },
   setValidarPEntrada() {
      if (this.validarRegistrarPEntrada()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarPEntrada();
    },


/* setGuardarPSegundo(){
    var url = "/administracion/Plato/CrearPlatoSegundo";
      axios
        .post(url, {
          cNomSegundo: this.fillCrearPlato.cNomSegundo,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomSegundo =''
          this.setBuscarPSegundo();
        });
}, */

   setValidarPSegundo() {
      if (this.validarRegistrarPSegundo()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarPSegundo();
    },

       setValidarPExtra() {
      if (this.validarRegistrarPExtra()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarPExtra();
    },



    validarRegistrarPEntrada() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomEntrada) {
        this.mensajeError.push("Ingrese Plato de Entrada");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    validarRegistrarPSegundo() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomSegundo) {
        this.mensajeError.push("Ingrese Plato de Segundo");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },

    validarRegistrarPExtra() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearPlato.cNomExtra) {
        this.mensajeError.push("Ingrese Plato Extra");
      }
      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },



    setBuscarPEntrada(){

      var url = '/administracion/Plato/getListarPEntrada'
            axios.get(url,{
                params:{
                    'cNombre' : this.fillCrearPlato.cNomEntrada,
                }
            }).then(response=>{
              this.inicializarPaginacion();
               this.listPEntrada =  response.data;
            })

    },

    setBuscarPSegundo(){
            var url = '/administracion/Plato/getListarPSegundo'
            axios.get(url,{
                params:{
                    'cNombre' : this.fillCrearPlato.cNomSegundo,
                }
            }).then(response=>{
              this.inicializarPaginacion();
               this.listPSegundo =  response.data;
            })

    },

    setBuscarPExtra(){
          var url = '/administracion/Plato/getListarPExtra'
            axios.get(url,{
                params:{
                    'cNombre' : this.fillCrearPlato.cNomExtra,
                }
            }).then(response=>{
              this.inicializarPaginacion();
               this.listPExtra =  response.data;
            })
      
    },
    setGuardarPSegundo(){

      var url = "/administracion/Plato/CrearPlatoSegundo";
      axios
        .post(url, {
          cNomSegundo: this.fillCrearPlato.cNomSegundo,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomSegundo=''
        this.setBuscarPSegundo();
        });
    },

    setGuardarPExtra(){

      var url = "/administracion/Plato/CrearPlatoExtra";
      axios
        .post(url, {
          cNomExtra: this.fillCrearPlato.cNomExtra,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearPlato.cNomExtra=''
          this.setBuscarPExtra();
          //this.$router.push("/proveedor");
        });
    },
      nextPage(){
            this.pageNumber++;
        },
        prevPage(){
            this.pageNumber--;
        },
        selectPage(page){
            this.pageNumber = page;
        },
        inicializarPaginacion(){
          this.pageNumber = 0;
        }

  },
};
</script>

<style>
</style>
