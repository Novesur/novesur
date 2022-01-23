<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Papeleta de Salida</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/ordenCompra/list'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Papeleta de Salida</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Cliente</label>
                          <div class="col-md-9">
                            <el-select
                              v-model="fillPapeletasalida.nIdCliente"
                              filterable
                              placeholder="Seleccione un cliente"
                              :style="{ width: '300px' }"
                              clearable
                            >
                              <el-option
                                v-for="item in listVendedorUser"
                                :key="item.id"
                                :label="item.razonsocial"
                                :value="item.id"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Motivo</label>
                          <div class="col-md-10">
                            <el-select
                              v-model="fillPapeletasalida.nIdMotivo"
                              placeholder="Select"
                              :style="{ width: '200px' }"
                            >
                              <el-option
                                v-for="item in listMotivo"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>
                      </div>

                                <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Contacto</label>
                          <div class="col-md-10">
                           <input
                              type="text"
                              class="form-control"
                              v-model="fillPapeletasalida.cContacto"

                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Hora de Visita</label
                          >
                          <div class="col-md-4">
                            <el-time-picker

                              v-model="fillPapeletasalida.tHoraSalida"
                              :picker-options="{
                                selectableRange: '08:00:00 - 18:00:00'
                              }"
                              placeholder="Ingrese la Hora"
                               format="hh:mm:ss A"
                                value-format="hh:mm:ss A"
                            >
                            </el-time-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Fin de Visita</label
                          >
                          <div class="col-md-9">
                             <el-time-picker

                              v-model="fillPapeletasalida.tHoraRetorno"
                              :picker-options="{
                                selectableRange: '08:00:00 - 18:00:00'
                              }"
                              placeholder="Ingrese la Hora"
                               format="hh:mm:ss A"
                                value-format="hh:mm:ss A"
                            >
                            </el-time-picker>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">Fecha</label>
                          <div class="col-md-9">
                            <el-date-picker
                              v-model="fillPapeletasalida.cFecha"
                              type="date"
                              placeholder="Ingrese una Fecha"
                              format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-1 col-form-label"
                            >Referencia</label
                          >
                          <div class="col-md-10">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillPapeletasalida.cReferencia"
                              @keypress.prevent.enter="setRegistrarPIngreso"
                            />
                          </div>
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
                      @click.prevent="setGrabarPapeletaSalida"
                    >
                      Guardar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="setResetCampos"
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

    <!--  Modal de Validacion de campos -->
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
    <!--  Fin del  Modal de Validacion de campos -->

    <!-- Modal de editar cantidad de Parte de Ingreso -->
    <div
      class="modal fade"
      :class="{ show: modalCantidad }"
      :style="modalCantidad ? mostrarModal : ocultarModal"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ingrese la cantidad</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            <div class="col-md-9">
              <input
                type="text"
                class="form-control"
                v-model="fillPapeletasalida.cCantidadModal"
                style="width: 300px"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" @click="setEditarCantidad()">
              Editar
            </button>
            <button class="btn btn-secondary" @click="abrirModalCantidad()">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--Fin del  Modal de editar cantidad de Parte de Ingreso -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      fillPapeletasalida: {
        nIdCliente: "",
        nIdUser: sessionStorage.getItem("iduser"),
        tHoraSalida: "",
        tHoraRetorno : "",
        cReferencia: "",
        cContacto: "",
        cFecha: "",
        nIdMotivo: "",


        cCantidadModal: "",
      },
      listVendedorUser: [],
      listarDetalleOrdeCompra: [],
      listMotivo: [],
      estadoProv: false,
      estadoCliente: false,

      modalCantidad: false,

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
  mounted() {
    this.getlistVendedorxUsu();
    this.getListarMotivo();
    this.setConfigTime();




    this.setListtempPIngreso();
    this.fillPapeletasalida.cFecha = new Date();
  },
  computed: {},
  methods: {

      setConfigTime(){
          this.fillPapeletasalida.tHoraSalida = '08:00:00 AM'
          this.fillPapeletasalida.tHoraRetorno = '05:00:00 PM'

      },


    getlistVendedorxUsu() {
      var url = "/administracion/cliente/getListarCliente";
      axios
        .get(url, {
          params: {
            nIdVendedor: this.fillPapeletasalida.nIdUser,
          },
        })
        .then((response) => {
          this.listVendedorUser = response.data;
          this.fillPapeletasalida.nIdCliente = this.listVendedorUser[0].id;
        });
    },

    limpiarCriteriosBsq() {},
    setRegistrarPIngreso() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarPapeletaSalida();
    },



    setGrabarPapeletaSalida() {
      var url = "/administracion/papeletasalida/create";
      axios
        .post(url, {
            nIdUser: this.fillPapeletasalida.nIdUser,
            cfecha: this.fillPapeletasalida.cFecha,
            tHoraSalida: this.fillPapeletasalida.tHoraSalida,
            tHoraRetorno: this.fillPapeletasalida.tHoraRetorno,
            nIdMotivo: this.fillPapeletasalida.nIdMotivo,
            nIdCliente : this.fillPapeletasalida.nIdCliente,
            cContacto : this.fillPapeletasalida.cContacto,
            cReferencia : this.fillPapeletasalida.cReferencia,
        })
        .then((response) => {
          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });
          this.setResetCampos();
          /* this.setLimpiaCampos();
          this.eliminarTempitemPIngreso(); */
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },

    setValorCantidadModal(item) {
      var url =
        "/administracion/DetalleordenCompra/setMandarValorDetalleParteIngresoXId";
      axios
        .post(url, {
          item: item,
        })
        .then((response) => {
          this.fillPapeletasalida.cCantidadModal = response.data.cantidadKardex;
          sessionStorage.item = response.data.id;
          this.abrirModalCantidad();
        });
    },

    setEditarCantidad() {
      var url =
        "/administracion/DetalleordenCompra/setEditarCantidadParteIngre";
      axios
        .post(url, {
          item: sessionStorage.item,
          cCantidadModal: this.fillPapeletasalida.cCantidadModal,
        })
        .then((response) => {
          this.abrirModalCantidad();

          sessionStorage.removeItem(item);
          Swal.fire({
            position: "center",
            icon: response.icon,
            title: response.message,
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },

    abrirModalCantidad() {
      this.modalCantidad = !this.modalCantidad;
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillPapeletasalida.nIdMotivo) {
        this.mensajeError.push("El Campo Motivo es obligatorio");
      }

      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },

    setResetCampos() {
      this.fillPapeletasalida.cReferencia = "";
      this.fillPapeletasalida.nIdMotivo = "";
    },

    setListtempPIngreso() {
      var url = "/administracion/parte_ingreso/ListtempParteIngreso";
      axios.get(url, {}).then((response) => {
        this.listartempPIngreso = response.data.datos;
      });
    },

    eliminarTempitemPIngreso() {
      var url = "/administracion/parte_ingreso/eliminarTempitemPIngreso";
      axios.post(url).then((response) => {
        this.setListtempPIngreso();
      });
    },


    setCambiarEstadoDetalleOC(op, id) {
      Swal.fire({
        title:
          "Estas seguro de" + (op == 2 ? "Poner Pendiente" : "Poner Atendido"),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText:
          op == 2 ? "Si, Poner Pendiente" : "Si, Poner Atendido",
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/DetalleordenCompra/CambiarEstadoDetalleOC";
          axios
            .post(url, {
              nIdDetalleOC: id,
              cEstado: op,
            })
            .then((response) => {
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Se edito el cambio",
                showConfirmButton: false,
                timer: 1500,
              });


            });
        }
      });
    },

    getListarMotivo() {
      var url = "/administracion/PapeletaSalida/Motivo";
      axios.get(url).then((response) => {
        this.listMotivo = response.data;
        this.fillPapeletasalida.nIdMotivo = this.listMotivo[0].id;
      });
    },
  },
};
</script>

<style>
</style>
