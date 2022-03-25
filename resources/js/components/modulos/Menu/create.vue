<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Crear Menu</h1>
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Menu</h3>
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
                            v-model="fillCrearMenu.cNombre"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label">Fecha</label>
                        <div class="col-md-5">
                       <el-date-picker
                              v-model="fillCrearMenu.dFecha"
                              type="date"
                              value-format="yyyy-MM-dd"
                              :style="{ width: '180px', height: '38px' }"
                            >
                            </el-date-picker>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Tipo de Menu</label>
                        <div class="col-md-8">
                           <el-select
                            v-model="fillCrearMenu.tipoPlato"
                            placeholder="Seleccione una Tipo"

                          >
                            <el-option
                              v-for="item in listTipoPlato"
                              :key="item.id"
                              :label="item.nombre"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarMenu"
                    >
                      Registrar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="limpiarMenu"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>
            </div>
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
      fillCrearMenu: {
        cNombre: "",
        dFecha:"",
        tipoPlato:"",
      },
      listTipoPlato:[],
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
  mounted(){
this.getListarTipoPlato();
//Carga la fecha Actual
 this.fillCrearMenu.dFecha = new Date();
  },
  methods: {
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    limpiarMenu() {
      this.fillCrearMenu.cNombre = "";

    },

    setRegistrarMenu() {
      if (this.validarMenu()) {
        this.modalShow = true;
        return;
      }
      this.setGuardarMenu();
    },
       getListarTipoPlato() {
      var url = "/administracion/Menu/listTipoPlatoCrear";
      axios.get(url).then((response) => {
        this.listTipoPlato = response.data;
        this.fillCrearMenu.tipoPlato = this.listTipoPlato[0].id;
      });
    },
    setGuardarMenu() {
      var url = "/administracion/Menu/setCrearMenu";
      axios
        .post(url, {
          cNombre: this.fillCrearMenu.cNombre,
          dFecha : this.fillCrearMenu.dFecha,
          tipoPlato : this.fillCrearMenu.tipoPlato
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 2000,
          });
          this.fillCrearMenu.cNombre=''
          //this.$router.push("/proveedor");
        });
    },
    validarMenu() {
      this.error = 0;
      this.mensajeError = [];
      if (!this.fillCrearMenu.cNombre) {
        this.mensajeError.push("El Campo Nombre es un campo obligatorio");
      }

         if (!this.fillCrearMenu.tipoPlato) {
        this.mensajeError.push("El Campo Tipo Menu es un campo obligatorio");
      }


      if (this.mensajeError.length) {
        this.error = 1;
      }
      return this.error;
    },
  },
};
</script>

<style>
</style>
