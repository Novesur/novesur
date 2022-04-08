<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orden de Producción</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/proveedor'">
              <i class="fas fa-arrow-left"></i>Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Orden de Producción</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-9">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >Producto</label
                          >
                          <div class="col-md-10">
                            <el-select
                              v-model="fillCrearOrdenProduccion.nIdprod"
                              style="width: 800px"
                              filterable
                              placeholder="Select"
                            >
                              <el-option
                                v-for="item in listProd"
                                :key="item.id"
                                :label="
                                  item.codigo + ' - ' + item.familia.nombre
                                "
                                :value="item.id"
                              >
                              </el-option>
                            </el-select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label"
                            >Cantidad</label
                          >
                          <div class="col-md-3">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrdenProduccion.cCantprod"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Preferencias de Pago</label
                        >
                        <div class="col-md-9">
                          <el-select
                            v-model="fillCrearOrdenProduccion.nIdTipoPago"
                            placeholder="Select"
                            style="width: 70%"
                          >
                            <el-option
                              v-for="item in listDescripPago"
                              :key="item.id"
                              :label="item.label"
                              :value="item.value"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div
                    v-if="fillCrearOrdenProduccion.nIdTipoPago == 1"
                    class="col-md-9"
                  >
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-md-6 col-form-label"
                          >Para Stock</label
                        >
                        <div class="col-md-5">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearOrdenProduccion.cCantstock"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div
                    v-if="fillCrearOrdenProduccion.nIdTipoPago == 2"
                    class="col-md-12"
                  >
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Busqueda de Clientes</label
                        >
                        <div class="col-md-9">
                          <div class="input-group">
                            <input
                              type="text"
                              class="form-control"
                              v-model="fillCrearOrdenProduccion.cRuc"
                            />
                            <div class="col">
                              <span
                                ><button
                                  class="btn btn-success btn-sm"
                                  @click.prevent="consultaRuc"
                                >
                                  Buscar Por Ruc
                                </button></span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Empresa</label>
                        <div class="col-md-9">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearOrdenProduccion.cRSocial"
                            :disabled="true"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                              <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Fecha Inicio</label
                        >
                        <div class="col-md-6">
                          <el-date-picker
                            v-model="fillCrearOrdenProduccion.FInicio"
                            type="date"
                            placeholder="Indique la fecha"
                          >
                          </el-date-picker>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-6">
                          <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Fecha Final</label
                        >
                        <div class="col-md-6">
                          <el-date-picker
                            v-model="fillCrearOrdenProduccion.FFinal"
                            type="date"
                            placeholder="Indique la fecha"
                          >
                          </el-date-picker>
                        </div>
                      </div>
                    </div>

                    </div>

                    </div>
                  </div>


                       <div class="col-md-12">
                    <div class="row">
                              <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >Duracion</label
                        >
                        <div class="col-md-3">
                          <input
                            type="text"
                            class="form-control"
                            v-model="fillCrearOrdenProduccion.cDuracion"

                          />
                        </div>
                      </div>
                    </div>

                    </div>
                  </div>

                  <div class="container-fluid">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">REQUERIMIENTOS DE MATERIALES</h3>
                            </div>
                            <div class="card-body">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >DESCRIPCION DEL MATERIAL</label
                                >

                                <div class="col-md-10">
                                  <el-select
                                    v-model="fillCrearOrdenProduccion.nIdprod"
                                    style="width: 90%"
                                    filterable
                                    placeholder="Select"
                                  >
                                    <el-option
                                      v-for="item in listProd"
                                      :key="item.id"
                                      :label="
                                        item.codigo +
                                        ' - ' +
                                        item.familia.nombre
                                      "
                                      :value="item.id"
                                    >
                                    </el-option>
                                  </el-select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >CANTIDAD</label
                                >
                                <div class="col-md-3">
                                  <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillCrearOrdenProduccion.cCantidad"
                                  />
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setRegistrarPIngreso"
                    >
                      Agregar
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

              <!--  Bandeja de Resultados -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Bandeja de Resultados</h3>
                </div>

                <div class="card-body table-responsive">
                  <table
                    class="
                      table table-hover table-head-fixed
                      text-nowrap
                      projects
                    "
                  >
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listartempOrder" :key="index">
                        <td v-text="item.codigo"></td>
                        <td v-text="item.cantidad"></td>

                        <td
                          v-text="
                            item.productoFamilia +
                            ' ' +
                            item.productoSubfamilia +
                            ', MARCA :' +
                            item.productoMarca +
                            ', MODELO/TIPO :' +
                            item.productoModelotipo +
                            ', MATERIAL :' +
                            item.material
                          "
                        ></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setGrabarOrderCompra"
                    >
                      Guardar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="eliminarTempitemOrders"
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
  </div>
</template>

<script>
export default {
  data() {
    return {




      fillCrearOrdenProduccion: {
        nIdProveedor: this.$attrs.id,
        cCodProduct: "",
        cReferencia: "",
        cDocumento: "",
        cFechaEmision: "",
        cCantstock: "",
        cRSocial: "",
        cRuc: "",
        nIdprod: "",

        cCantidad: "",
        cCantprod: "",
        nIdTipoPago: "",
        nIdTipoMoneda: "",
        nIdUser: sessionStorage.getItem("iduser"),
        FInicio:"",
        FFinal:"",
        cDuracion:"",
      },

      listUnidMed: [],
      listProd: [],
      listartempOrder: [],
      listDescripPago: [
        {
          value: "1",
          label: "PARA STOCK",
        },
        {
          value: "2",
          label: "PARA PEDIDO DE CLIENTE",
        },
      ],
      listTipoCambio: [],

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
    this.getListarByProveedor();

    this.getListarproductosByName();
    // this.setListtemOrders();
    //this.getlistDescricionPago();
    this.getlistTipoCambio();
    this.fillCrearOrdenProduccion.cFechaEmision = new Date();
  },
  computed: {},
  methods: {
    consultaRuc() {
      var url = "/administracion/cliente/consultaRuc";
      axios
        .post(url, {
          cRuc: this.fillCrearOrdenProduccion.cRuc,
        })
        .then((response) => {
          if (response.data.success == false) {
            (this.fillCrearOrdenProduccion.cRSocial = ""),
              Swal.fire({
                position: "center",
                icon: "info",
                title: "Ruc no encontrado o numero equivocado",
                showConfirmButton: false,
                timer: 2000,
              });
          } else {
            this.fillCrearOrdenProduccion.cRSocial = response.data.razonSocial;
            /*        (this.fillRegistrarCliente.cDireccion = response.data.direccion),
              (this.estadobutton = false);
            this.disabledbtnRuc = true; */
          }
        });
    },

    getListarByProveedor() {
      var url = "/administracion/proveedor/getListarProveedorById";
      axios
        .get(url, {
          params: {
            nIdProveedor: this.fillCrearOrdenProduccion.nIdProveedor,
          },
        })
        .then((response) => {
          this.fillCrearOrdenProduccion.cCodProduct = response.data.nombre;
        });
    },

    /*     getlistDescricionPago() {
      var url = "/administracion/pago/index";
      axios.get(url).then((response) => {
        this.listDescripPago = response.data;
        this.fillCrearOrdenProduccion.nIdDescripPago =
          this.listDescripPago[0].id;
      });
    }, */

    getlistTipoCambio() {
      var url = "/administracion/ordenCompra/TipoCambio";
      axios.get(url).then((response) => {
        this.listTipoCambio = response.data;
        this.fillCrearOrdenProduccion.nIdTipoMoneda = this.listTipoCambio[0].id;
      });
    },

    getListarproductosByName() {
      var url = "/administracion/detallecotizancion/listProdByName";
      axios
        .get(url, {
          params: {
            nIdprod: this.fillCrearOrdenProduccion.nIdprod,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },


    limpiarCriteriosBsq() {
      this.fillCrearOrdenProduccion.cCodProduct = "";
    },
    setRegistrarPIngreso() {
      if (this.validaPIngreso()) {
        this.modalShow = true;
        return;
      }
      this.setAddPMaterial();
    },

    setGrabarOrderCompra() {
      var url = "/administracion/OrdenServicio/create";
      axios
        .post(url, {
          cFechaEmision: this.fillCrearOrdenProduccion.cFechaEmision,
          cReferencia: this.fillCrearOrdenProduccion.cReferencia,
          nIdProveedor: this.fillCrearOrdenProduccion.nIdProveedor,
          nIdTipoPago: this.fillCrearOrdenProduccion.nIdTipoPago,
          nIdTipoMoneda: this.fillCrearOrdenProduccion.nIdTipoMoneda,
          nIdUser: this.fillCrearOrdenProduccion.nIdUser,
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
          this.eliminarTempitemOrders();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaPIngreso() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillCrearOrdenProduccion.cCodProduct) {
        this.mensajeError.push("El campo nombre es obligatorio");
      }
       if(this.fillCrearOrdenProduccion.cCantidad <=   0){
         this.mensajeError.push("Cantidad no puede ser menor o igual a cero");
      }
        if(!this.fillCrearOrdenProduccion.cCantidad){
         this.mensajeError.push("Cantidad es campo obligatorio");
      }


      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddPMaterial() {
      var url = "/administracion/ordenCompra/addOrden";
      axios
        .post(url, {
          nIdprod: this.fillCrearOrdenProduccion.nIdprod,

          cCantidad: this.fillCrearOrdenProduccion.cCantidad,

          CestadoDet: this.fillCrearOrdenProduccion.CestadoDet,
          cPUnit: this.fillCrearOrdenProduccion.cPUnit,
        })
        .then((response) => {
          this.listartempOrder = response.data.datos;
          this.setLimpiaCampos();

          if (response.data.message == "Ya fue agregado anteriormente") {
            Swal.fire({
              position: "center",
              icon: response.data.icon,
              title: response.data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        });
    },

    setLimpiaCampos() {
      this.fillCrearOrdenProduccion.nIdprod = null;
      this.fillCrearOrdenProduccion.cCantidad = "";

    },

    setResetCampos() {
      this.fillCrearOrdenProduccion.nIdprod = null;
      this.fillCrearOrdenProduccion.cCantidad = "";

      this.fillCrearOrdenProduccion.cReferencia = "";
      this.fillCrearOrdenProduccion.cDocumento = "";
    },

    setListtemOrders() {
      var url = "/administracion/ordenCompra/ListtempOrden";
      axios.get(url, {}).then((response) => {
        this.listartempOrder = response.data.datos;
      });
    },

    eliminarTempitemOrders() {
      var url = "/administracion/ordenCompra/eliminarTemporder";
      axios.post(url).then((response) => {
        this.setListtemOrders();
      });
    },
  },
};
</script>

<style>
</style>
