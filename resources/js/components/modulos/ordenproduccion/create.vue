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
                              v-model="fillCrearOrdenProduccion.nIdproduct"
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
                              v-int
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

                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-md-1 col-form-label">Empresa</label>
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
                                  format="dd/MM/yyyy"
                              value-format="yyyy-MM-dd"
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
                                format="dd/MM/yyyy"
                               value-format="yyyy-MM-dd"
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

                              <p v-if="calculoFechas">{{ calculoFechas}} Día(s)</p>

                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- INICIO  DE REQUERIMIENTOS DE MATERIALES -->

                  <div class="container-fluid">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">
                                REQUERIMIENTOS DE MATERIALES
                              </h3>
                            </div>
                            <div class="card-body">
                              <div class="form-group row">
                                <label class="col-md-2 col-form-label"
                                  >DESCRIPCION DEL MATERIAL</label
                                >

                                <div class="col-md-10">
                                  <el-select
                                    v-model="fillCrearOrdenProduccion.nIdmaterial"
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
                                    v-int
                                    v-model="fillCrearOrdenProduccion.cCantMaterial"
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
                      class="btn btn-flat btn-primary btnWidth"
                      @click.prevent="setAddPMaterial"
                    >
                      Agregar
                    </button>
                    <button
                      class="btn btn-flat btn-default btnWidth"
                      @click.prevent="setCleanMaterial"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </div>

              <!--  Bandeja de Resultados -->
              <div class="card card-primary">
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
                      <tr v-for="(item, index) in listartempProduccion" :key="index">
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

              <!--         <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button
                      class="btn btn-flat btn-info btnWidth"
                      @click.prevent="setGrabarOrdenProduccion"
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
              </div> -->
            </div>
          </div>
        </div>
      </div>

      <!-- FIN   DE REQUERIMIENTOS DE MATERIALES -->

      <!-- INICIO DE REQUERIMIENTOS MANO DE OBRA -->
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
                  REQUERIMIENTOS MANO DE OBRA (DIAS, HORAS, HOMBRES)
                </h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label"
                    >PERSONAL</label
                  >

                  <div class="col-md-6">
                <input
                                    type="text"
                                    class="form-control"
                                    v-model="fillCrearOrdenProduccion.cPersonal"
                                  />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">DIAS</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearOrdenProduccion.cDiasMObra"
                      v-int
                    />
                  </div>


                </div>


                       <div class="form-group row">
                  <label class="col-md-2 col-form-label">HORAS</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearOrdenProduccion.cHorasMObra"
                      v-int
                    />
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4 offset-4">
              <button
                class="btn btn-flat btn-success btnWidth"
                @click.prevent="setAddMObra"
              >
                Agregar
              </button>
              <button
                class="btn btn-flat btn-default btnWidth"
                @click.prevent="setCleanManoObra"
              >
                Limpiar
              </button>
            </div>
          </div>
        </div>

        <!--  Bandeja de Resultados -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Bandeja de Resultados</h3>
          </div>

          <div class="card-body table-responsive">
            <table
              class="table table-hover table-head-fixed text-nowrap projects"
            >
              <thead>
                <tr>
                  <th>Personal</th>
                  <th>Días</th>
                  <th>Horas</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in listartempMobra" :key="index">
                  <td v-text="item.personal"></td>
                  <td v-text="item.dias"></td>
                  <td v-text="item.horas"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- FIN DE REQUERIMIENTOS MANO DE OBRA -->

      <!-- INICIO DE OTROS REQUERIMIENTOS -->

      <div class="container-fluid">
        <div class="card card-primary">
          <div class="col-md-12">
            <div class="card">
              <div
                class="card-header"
                style="background-color: #9b59b6; color: white"
              >
                <h3 class="card-title">OTROS REQUERIMIENTOS</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label"
                    >DESCRIPCION</label
                  >

                  <div class="col-md-10">
                     <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearOrdenProduccion.cDescripcion"
                    />
                  </div>
                </div>
                  <div class="form-group row">
                  <label class="col-md-2 col-form-label">DIAS</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      v-int
                      v-model="fillCrearOrdenProduccion.cDiasReq"
                    />
                  </div>


                </div>


                       <div class="form-group row">
                  <label class="col-md-2 col-form-label">HORAS</label>
                  <div class="col-md-2">
                    <input
                      type="text"
                      class="form-control"
                      v-int
                      v-model="fillCrearOrdenProduccion.cHorasRequ"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4 offset-4">
              <button
                class="btn btn-flat btnWidth"
                style="background-color: #9b59b6; color: white"
                @click.prevent="setAddRequerimientos"
              >
                Agregar
              </button>
              <button
                class="btn btn-flat btn-default btnWidth"
                @click.prevent="setCleanRequerimientos"
              >
                Limpiar
              </button>
            </div>
          </div>
        </div>

        <!--  Bandeja de Resultados -->
        <div class="card card-light">
          <div
            class="card-header"
            style="background-color: #9b59b6; color: white"
          >
            <h3 class="card-title">Bandeja de Resultados</h3>
          </div>

          <div class="card-body table-responsive">
            <table
              class="table table-hover table-head-fixed text-nowrap projects"
            >
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Días</th>
                  <th>Horas</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in listartempRequerimientos" :key="index">
                  <td v-text="item.descripcion"></td>
                  <td v-text="item.dias"></td>
                  <td v-text="item.horas"></td>


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
                @click.prevent="setRegistrarOProduccion"
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

    <!-- FIN DE OTROS REQUERIMIENTOS -->

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
      fillCrearOrdenProduccion: {
        nIdProveedor: this.$attrs.id,
        nIdproduct: "",
        cReferencia: "",
        cDocumento: "",
        cFechaEmision: "",
        cCantstock: "",
        cRSocial: "",
        cRuc: "",
        nIdmaterial: "",
        cCantMaterial:"",
        cCantidad: "",
        cCantprod: "",
        nIdTipoPago: "",
        nIdTipoMoneda: "",
        nIdUser: sessionStorage.getItem("iduser"),
        FInicio: "",
        FFinal: "",
        cDuracion: "",
        cPersonal:"",
        cDiasMObra:"",
        cHorasMObra:"",
        cDescripcion:"",
        cDiasReq: "",
        cHorasRequ : "",

      },

      listUnidMed: [],
      listProd: [],
      listartempProduccion: [],
      listartempMobra:[],
      listartempRequerimientos:[],
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
    this.getlistTipoCambio();
    this.defaultDiaHora();
    //this.fillCrearOrdenProduccion.FInicio = moment(new Date()).format('YYYY-MM-D');
  },


  methods: {

    defaultDiaHora(){
      this.fillCrearOrdenProduccion.cDiasReq = 0
      this.fillCrearOrdenProduccion.cHorasRequ = 0
      this.fillCrearOrdenProduccion.cDiasMObra = 0
      this.fillCrearOrdenProduccion.cHorasMObra = 0
    },

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

    setAddMObra(){

     var url = "/administracion/ordenProduccion/addMObra";
      axios
        .post(url, {
          cPersonal: this.fillCrearOrdenProduccion.cPersonal,
          cDiasMObra: this.fillCrearOrdenProduccion.cDiasMObra,
          cHorasMObra : this.fillCrearOrdenProduccion.cHorasMObra
        })
        .then((response) => {
         this.listartempMobra = response.data.datos;
         this.setcleanListMObra();

        });
    },

    setcleanListMObra(){
      this.fillCrearOrdenProduccion.cPersonal ='',
      this.fillCrearOrdenProduccion.cDiasMObra =''
      this.fillCrearOrdenProduccion.cHorasMObra =''
    },



    setAddRequerimientos(){
       var url = "/administracion/ordenProduccion/addRequerimientos";
      axios
        .post(url, {
          cDescripcion: this.fillCrearOrdenProduccion.cDescripcion,
          cDiasReq: this.fillCrearOrdenProduccion.cDiasReq,
          cHorasRequ : this.fillCrearOrdenProduccion.cHorasRequ

        })
        .then((response) => {
         this.listartempRequerimientos = response.data.datos;
         this.setLimpiaRequerimientos();
        });
    },

    setLimpiaRequerimientos(){
      this.fillCrearOrdenProduccion.cDescripcion = '',
      this.fillCrearOrdenProduccion.cDiasReq = '',
      this.fillCrearOrdenProduccion.cHorasRequ = ''

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
            nIdmaterial: this.fillCrearOrdenProduccion.nIdmaterial,
          },
        })
        .then((response) => {
          this.listProd = response.data;
        });
    },

    limpiarCriteriosBsq() {
      this.fillCrearOrdenProduccion.cCodProduct = "";
    },
    setRegistrarOProduccion() {
      if (this.validaOrdenProduccion()) {
        this.modalShow = true;
        return;
      }
      this.setGrabarOrdenProduccion();
    },

    setGrabarOrdenProduccion() {
      var url = "/administracion/OrdenProduccion/create";
      axios
        .post(url, {
          nIdproduct : this.fillCrearOrdenProduccion.nIdproduct,
          cCantprod : this.fillCrearOrdenProduccion.cCantprod,
          cCantstock : this.fillCrearOrdenProduccion.cCantstock,
          cRuc : this.fillCrearOrdenProduccion.cRuc,
          FInicio : this.fillCrearOrdenProduccion.FInicio,
          FFinal : this.fillCrearOrdenProduccion.FFinal,
          nIdUser: this.fillCrearOrdenProduccion.nIdUser,

       //Requerimientos de Materiales ////
          nIdmaterial : this.fillCrearOrdenProduccion.nIdmaterial,
          cCantMaterial : this.fillCrearOrdenProduccion.cCantMaterial,
       //Fin de Requerimientos de Materiales ////

       //// Requerimientos de Mano de Obra /////
        cPersonal : this.fillCrearOrdenProduccion.cPersonal,
        cDiasMObra : this.fillCrearOrdenProduccion.cDiasMObra,
        cHorasMObra : this.fillCrearOrdenProduccion.cHorasMObra,
        //// Fin de Requerimientos de Mano de Obra /////

        ///// Otros Requerimientos //////
            cDescripcion : this.fillCrearOrdenProduccion.cDescripcion,
            cDiasReq: this.fillCrearOrdenProduccion.cDiasReq,
            cHorasRequ : this.fillCrearOrdenProduccion.cHorasRequ,
        })
        .then((response) => {


          Swal.fire({
            position: "center",
            icon: response.data.icon,
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500,
          });
            this.setCleanMaterial();
            this.setCleanManoObra();
            this.setCleanRequerimientos();
        });
    },
    abrirModal() {
      this.modalShow = !this.modalShow;
    },
    validaOrdenProduccion() {
      this.error = 0;
      this.mensajeError = [];

      if (!this.fillCrearOrdenProduccion.nIdproduct) {
        this.mensajeError.push("El campo producto es obligatorio");
      }
      if (this.fillCrearOrdenProduccion.cCantidad <= 0) {
        this.mensajeError.push("Cantidad no puede ser menor o igual a cero");
      }
      if (!this.fillCrearOrdenProduccion.cCantidad) {
        this.mensajeError.push("Cantidad es campo obligatorio");
      }
        if (!this.fillCrearOrdenProduccion.cCantstock) {
        this.mensajeError.push("Stock es campo obligatorio");
      }

      if (!this.fillCrearOrdenProduccion.FInicio) {
        this.mensajeError.push("Fecha Inicio es campo obligatorio");
      }

        if (!this.fillCrearOrdenProduccion.FFinal) {
        this.mensajeError.push("Fecha Final es campo obligatorio");
      }

         if (!this.fillCrearOrdenProduccion.nIdTipoPago) {
        this.mensajeError.push("Tipo de Pago es campo obligatorio");
      }



      if (this.mensajeError.length) {
        this.error = 1;
      }

      return this.error;
    },
    setAddPMaterial() {
      var url = "/administracion/ordenProduccion/addOrden";
      axios
        .post(url, {
          nIdmaterial: this.fillCrearOrdenProduccion.nIdmaterial,
          cCantMaterial: this.fillCrearOrdenProduccion.cCantMaterial,
        })
        .then((response) => {
         this.listartempProduccion = response.data.datos;
          this.setLimpiaMaterial();


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

    setLimpiaMaterial(){
      this.fillCrearOrdenProduccion.nIdmaterial='',
      this.fillCrearOrdenProduccion.cCantMaterial = ''
    },



    setLimpiaCampos() {
      this.fillCrearOrdenProduccion.nIdmaterial = null;
      this.fillCrearOrdenProduccion.cCantidad = "";
    },

    setResetCampos() {
      this.fillCrearOrdenProduccion.nIdmaterial = null;
      this.fillCrearOrdenProduccion.cCantidad = "";

      this.fillCrearOrdenProduccion.cReferencia = "";
      this.fillCrearOrdenProduccion.cDocumento = "";
    },

    setCleanMaterial(){
           var url = "/administracion/ordenProduccion/eliminarTemporder";
      axios.get(url, {}).then((response) => {
        this.listartempProduccion = response.data.datos;
      this.setLimpiaMaterial()
      });
    },



    setCleanManoObra(){
           var url = "/administracion/ordenProduccion/CleanMaterialManoOBra";
      axios.get(url, {}).then((response) => {
        this.listartempMobra = response.data.datos;
         this.setcleanListMObra();
      });
    },

       setCleanRequerimientos(){
           var url = "/administracion/ordenProduccion/cleanRequerimientos";
      axios.get(url, {}).then((response) => {
        this.listartempRequerimientos = response.data.datos;
          this.setCleanRequerimientos();
      });
    },


    setListtemOrders() {
      var url = "/administracion/ordenCompra/ListtempOrden";
      axios.get(url, {}).then((response) => {
        this.listartempProduccion = response.data.datos;
      });
    },

    eliminarTempitemOrders() {
      var url = "/administracion/ordenCompra/eliminarTemporder";
      axios.post(url).then((response) => {
        this.setListtemOrders();
      });
    },
  },
  computed:{
      calculoFechas(){
          if (this.fillCrearOrdenProduccion.FFinal != null &&  this.fillCrearOrdenProduccion.FInicio != null){

              let valorfecha =  new Date(this.fillCrearOrdenProduccion.FFinal).getTime()   -  new Date(this.fillCrearOrdenProduccion.FInicio).getTime() ;
              return valorfecha/86400000
          }
      }
  }
};
</script>

<style>
</style>
