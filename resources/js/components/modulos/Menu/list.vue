<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedido de Menus</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/material/crear'">
              <i class="fas fa-plus-square"></i>Regresar
            </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <form role="form">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="text-center">ENTRADA</h3>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">MENU</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in listMenuEntrada"
                          :key="index"
                        >
                          <th v-text="index + 1"></th>
                          <td v-text="item.nombre"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-md-4">
                    <h3 class="text-center">SEGUNDO</h3>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">MENU</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in listMenuSegundo"
                          :key="index"
                        >
                          <th v-text="index + 1"></th>
                          <td v-text="item.nombre"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-md-4">
                    <h3 class="text-center">EXTRA</h3>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col" class="">MENU</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in listMenuExtra" :key="index">
                          <th v-text="index + 1"></th>
                          <td v-text="item.nombre"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de Busqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-2 col-form-label"
                            >TIPO DE MENU</label
                          >
                          <div class="col-md-6">
                            <el-select
                              v-model="fillBsqPedidoMenu.nIdTipo"
                              filterable
                              placeholder="Seleccione una Tipo"
                              :style="{ width: '350px' }"
                                @change="onChange(fillBsqPedidoMenu.nIdTipo)"

                            >
                              <el-option
                                v-for="item in this.listTipoMenu"
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
                  </div>

                  <div class="col-md-12">
                    <div class="row">
                      <label class="col-md-1 col-form-label">ENTRADA</label>

                      <div class="col-md-3">
                        <el-select
                          v-model="fillBsqPedidoMenu.nIdTipoEntrada"
                          filterable
                          placeholder="Seleccione una Tipo"
                          :style="{ width: '350px' }"
                          clearable
                        >
                          <el-option
                            v-for="item in this.listMenuEntrada"
                            :key="item.id"
                            :label="item.nombre"
                            :value="item.id"
                            :disabled="EstadoMenuEntrada"
                          >
                          </el-option>
                        </el-select>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                          <el-input-number
                            v-model="fillBsqPedidoMenu.numEntrada"
                            :min="1"
                            :max="10"
                          ></el-input-number>
                        </div>
                      </div>
                    </div>
                  </div>

                              <div class="col-md-12">
                    <div class="row">
                      <label class="col-md-1 col-form-label">SEGUNDO</label>

                      <div class="col-md-3">
                        <el-select
                          v-model="fillBsqPedidoMenu.nIdTipoSegundo"
                          filterable
                          placeholder="Seleccione una Tipo"
                          :style="{ width: '350px' }"
                          clearable
                        >
                          <el-option
                            v-for="item in this.listMenuSegundo"
                            :key="item.id"
                            :label="item.nombre"
                            :value="item.id"
                            :disabled="EstadoMenuSegundo"
                          >
                          </el-option>
                        </el-select>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                          <el-input-number
                            v-model="fillBsqPedidoMenu.numSegundo"
                            :min="1"
                            :max="10"
                          ></el-input-number>
                        </div>
                      </div>
                    </div>
                  </div>


            <div class="col-md-12">
                    <div class="row">
                      <label class="col-md-1 col-form-label">EXTRA</label>

                      <div class="col-md-3">
                        <el-select
                          v-model="fillBsqPedidoMenu.nIdTipoExtra"
                          filterable
                          placeholder="Seleccione una Tipo"
                          :style="{ width: '350px' }"
                          clearable
                        >
                          <el-option
                            v-for="item in this.listMenuExtra"
                            :key="item.id"
                            :label="item.nombre"
                            :value="item.id"
                             :disabled="EstadoMenuExtra"
                          >
                          </el-option>
                        </el-select>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                          <el-input-number
                            v-model="fillBsqPedidoMenu.numExtra"
                            :min="1"
                            :max="10"
                          ></el-input-number>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                          >OBSERVACION</label
                        >
                        <div class="col-md-6">
                          <div class="col-md-12">
                            <input
                              type="text"
                              class="form control"
                              style="width: 410px"
                              v-model="fillBsqPedidoMenu.cObservacion"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4 offset-4">
                        <button
                          class="btn btn-flat btn-info btnWidth"
                          @click.prevent="getGuardarMenu"
                        >
                          Guardar
                        </button>
                        <button
                          class="btn btn-flat btn-default btnWidth"
                          @click.prevent="limpiarCriteriosBsq"
                        >
                          Limpiar
                        </button>
                      </div>
                    </div>
                  </div>

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
                            <th>Fecha</th>
                            <th>Vendedor</th>
                            <th>cant. Entrada</th>
                            <th>Entrada</th>
                            <th>cant. Segundo</th>
                            <th>Segundo</th>
                            <th>cant. Extra</th>
                            <th>Extra</th>
                            <th>Tipo de Menu</th>
                            <th>Observación</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in listeMenusxFecha"
                            :key="index"
                          >
                            <td>{{ item.menu.fecha | moment("DD - MM - Y") }}</td>
                             <td>{{ item.menu.user.fullname }}</td>
                            <td v-text="item.cantEntrada"></td>
                            <td v-text="item.menuentrada.nombre"></td>
                            <td v-text="item.cantSegundo"></td>
                            <td v-text="item.menusegundo.nombre"></td>
                              <td v-text="item.cantExtra"></td>
                            <td v-text="item.menuextra.nombre"></td>
                            <td v-text="item.tipomenu.nombre"></td>
                            <td v-text="item.menu.observacion"></td>

                              <button
                                class="btn btn-info btn-sm"
                                @click.prevent="abrirAnularMenu(item.menu.id)"
                              >
                                <i class="far fa-calendar-check"></i> Anular
                              </button>

                          </tr>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </form>
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalle de Papeleta de Salida</h5>

            <button class="close" @click="abrirModal(item.id)"></button>
          </div>
          <div class="modal-body">
            <!-- Listado de Detalle de Cotizaciones -->

            <div class="card-body table-responsive">
              <table
                class="table table-hover table-head-fixed text-nowrap projects"
              >
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Fundamento</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(item, index) in this.listModalVendedorAdmin"
                    :key="index"
                  >
                    <td v-text="item.cliente.razonsocial"></td>

                    <td v-text="item.contacto"></td>
                    <td v-text="item.papeletasalida.fundamento"></td>
                  </tr>
                </tbody>
              </table>
            </div>
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
      fillBsqPedidoMenu: {
        cNombre: "",
        nIdTipo: "",
        nIdTipoEntrada: "",
        nIdTipoSegundo: "",
        nIdTipoExtra: "",
        itemid: "",
        dFecha: "",
        nIdtEstadoCoti: "",
        nIdMotivo: "",
        cMotivoRechazo: "",
        nIdUser: sessionStorage.getItem("iduser"),
        cObservacion: "",
         numEntrada: 1,
         numSegundo : 1,
         numExtra : 1,
      },

      activeName: "first",
      EstadoMenuEntrada: false,
      EstadoMenuSegundo: false,
      EstadoMenuExtra: true,

      txtrechazo: {
        margin: 15,
      },


      listDetPapeletaSalida: [],
      listModalVendedorAdmin: [],
      listTipoMenu: [],
      listVendedorUser: [],
      listPaginacion: [],
      listMenuEntrada: [],
      listMenuSegundo: [],
      listMenuExtra: [],
      listClientAdmin: [],
      listClient: [],
      listeMenusxFecha: [],
      listPapeleByClient: [],
      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),

      modalShow: false,
      modalEstado: false,
      mostrarModal: {
        display: "block",
        background: "#0000006b",
        position: "fixed",
      },
      ocultarModal: {
        display: "none",
      },

      listRolPermisoByUsuario: JSON.parse(
        sessionStorage.getItem("listRolPermisosByUsuario")
      ),

      ///Formato de la Fecha
      pickerOptions: {
        disabledDate(time) {
          return time.getTime() > Date.now.Date();
        },
        shortcuts: [
          {
            text: "Today",
            onClick(picker) {
              picker.$emit("pick", new Date());
            },
          },
          {
            text: "Yesterday",
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24);
              picker.$emit("pick", date);
            },
          },
          {
            text: "A week ago",
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit("pick", date);
            },
          },
        ],
      },
    };
  },

  mounted() {
    this.getlistTipoMenu();
    this.cargaFechaActual();
    this.getlistEntrada();
    this.getlistSegundo();
    this.getlistExtra();
    this.cargaListMenus();
  },


  methods: {

      cargaListMenus(){
                var url = "/administracion/Menu/ListMenubyDate";
      axios
        .get(url)
        .then((response) => {
            console.log(response.data)
          this.listeMenusxFecha = response.data;
        });
      },


    cargaFechaActual() {
      this.fillBsqPedidoMenu.dFecha = new Date();
    },

    onChange(tipo) {
        //SOLO ENTRADA
     if (this.fillBsqPedidoMenu.nIdTipo == 1) {
        this.EstadoMenuEntrada = false;
        this.EstadoMenuSegundo = true;
        this.fillBsqPedidoMenu.nIdTipoSegundo=''
        this.EstadoMenuExtra = true;
        this.fillBsqPedidoMenu.nIdTipoExtra=''
      }

      //SOLO SEGUNDO

         if (this.fillBsqPedidoMenu.nIdTipo == 2) {
        this.EstadoMenuEntrada = true;
        this.fillBsqPedidoMenu.nIdTipoEntrada=''
        this.EstadoMenuSegundo = false;
        this.EstadoMenuExtra = true;
         this.fillBsqPedidoMenu.nIdTipoExtra=''
      }

     // MENU COMPLETO
          if (this.fillBsqPedidoMenu.nIdTipo == 3) {
        this.EstadoMenuEntrada = false;
        this.EstadoMenuSegundo = false;
        this.EstadoMenuExtra = true;
         this.fillBsqPedidoMenu.nIdTipoExtra=''
      }

      // SOLO EXTRA
          if (this.fillBsqPedidoMenu.nIdTipo == 4) {
        this.EstadoMenuEntrada = true;
            this.fillBsqPedidoMenu.nIdTipoEntrada=''
        this.EstadoMenuSegundo = true;
             this.fillBsqPedidoMenu.nIdTipoSegundo=''
        this.EstadoMenuExtra = false;
      }

         // SOLO EXTRA Y ENTRADA
          if (this.fillBsqPedidoMenu.nIdTipo == 5) {
        this.EstadoMenuEntrada = false;
        this.EstadoMenuSegundo = true;
          this.fillBsqPedidoMenu.nIdTipoSegundo=''
        this.EstadoMenuExtra = false;

      }


    },
    abrirModalbyVendedor(item) {
      this.modalShow = !this.modalShow;
      this.fillBsqPedidoMenu.itemid = item;
      this.BuscaClientePapeletaS(item);
    },
    abrirModal(item) {
      this.modalShow = !this.modalShow;
      this.fillBsqPedidoMenu.itemid = item;
    },

    abrirEstadobyVendedor(item) {
      this.modalEstado = !this.modalEstado;
      this.fillBsqPedidoMenu.itemid = item;
      this.BuscaClientePapeletaS(item);
    },
    abrirAnularMenu(item) {

      Swal.fire({
        title: "Desea cancelar el menu?",
        text: "No podrás revertir esto.!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, dale de baja!",
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/menu/setAnularMenu";
          axios
            .post(url, {
              item: item,
            })
            .then((response) => {
              this.cargaListMenus()
            });

          Swal.fire(
            "Anulado!",
            "Tu Papeleta de Salida fue dado de Baja.",
            "success"
          );
        }
      });
    },

    aprobarPartidaSalida(item) {
      Swal.fire({
        title: "Desea aprobar la papeleta de salida?",
        text: "No podrás revertir esto.!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, quiero aprobarlo!",
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "/administracion/papeletasalida/setAprobarPapeletaSalida";
          axios
            .post(url, {
              item: item,
            })
            .then((response) => {
              //this.getListarOrdenServicioxProveedor();
              this.getGuardarMenu();
            });

          Swal.fire(
            "Aprobado!",
            "Tu Papeleta de Salida fue  aprobado.",
            "success"
          );
        }
      });
    },

    limpiarCriteriosBsq() {
      this.fillBsqPedidoMenu.nIdTipo = 3;
      this.fillBsqPedidoMenu.numEntrada=1;
      this.fillBsqPedidoMenu.numSegundo=1;
      this.fillBsqPedidoMenu.numExtra = 1;
      this.fillBsqPedidoMenu.nIdTipoEntrada="";
      this.fillBsqPedidoMenu.nIdTipoSegundo="";
      this.fillBsqPedidoMenu.numExtra="";
      this.fillBsqPedidoMenu.cObservacion = "";

    },
    limpiarBandejaMaterial() {
      this.listDetPapeletaSalida = [];
    },

    getlistTipoMenu() {
      var url = "/administracion/Menu/ListTipoMenuCrear";
      axios.get(url).then((response) => {
        this.listTipoMenu = response.data;
        this.fillBsqPedidoMenu.nIdTipo = this.listTipoMenu[2].id;
      });
    },

    getlistEntrada() {
      var url = "/administracion/Menu/ListMenuEntrada";
      axios
        .get(url, {
          params: {
            dFecha: this.fillBsqPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          this.listMenuEntrada = response.data;
        });
    },

    getlistSegundo() {
      var url = "/administracion/Menu/ListMenuSegundo";
      axios
        .get(url, {
          params: {
            dFecha: this.fillBsqPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          this.listMenuSegundo = response.data;
        });
    },

    getlistExtra() {
      var url = "/administracion/Menu/ListMenuExtra";
      axios
        .get(url, {
          params: {
            dFecha: this.fillBsqPedidoMenu.dFecha,
          },
        })
        .then((response) => {
          this.listMenuExtra = response.data;
        });
    },

    getGuardarMenu() {
      var url = "/administracion/Menu/createMenu";
      axios
        .post(url, {

            nIdUser: this.fillBsqPedidoMenu.nIdUser,
            nIdTipo : this.fillBsqPedidoMenu.nIdTipo,
            cObservacion : this.fillBsqPedidoMenu.cObservacion,
            numEntrada : this.fillBsqPedidoMenu.numEntrada,
            nIdTipoEntrada : this.fillBsqPedidoMenu.nIdTipoEntrada,
            numSegundo : this.fillBsqPedidoMenu.numSegundo,
            nIdTipoSegundo: this.fillBsqPedidoMenu.nIdTipoSegundo,
            numExtra : this.fillBsqPedidoMenu.numExtra,
            nIdTipoExtra : this.fillBsqPedidoMenu.nIdTipoExtra,

        })
        .then((response) => {
            Swal.fire(
            "Grabado!",
            "Nuevo Menu Agregado.",
            "success"
          );

           this.cargaListMenus();

        });
    },

    BuscaClientePapeletaS(item) {
      var url = "/administracion/ClientePapeletaSalida/BuscaClientePapeletaS";
      axios
        .get(url, {
          params: {
            item: item,
          },
        })
        .then((response) => {
          this.listModalVendedorAdmin = response.data;
        });
    },

    getPdfPSalidabyVendedor(item) {
      var config = { responseType: "blob" };
      var url = "/administracion/papeletasalida/PapeletasalidaPdf";
      axios
        .post(
          url,
          {
            params: {
              item: item,
            },
          },
          config
        )
        .then((response) => {
          var oMyBlob = new Blob([response.data], { type: "application/pdf" });
          var url = URL.createObjectURL(oMyBlob);
          window.open(url);
          //window.print();
        });
    },

    getlistClientAdmin() {
      var url = "/administracion/cliente/getListarAllCliente";
      axios.get(url).then((response) => {
        this.listClientAdmin = response.data;
      });
    },

    getlistClient() {
      var url = "/administracion/cliente/getListarCliente";
      axios
        .get(url, {
          params: {
            nIdTipo: this.fillBsqPedidoMenu.nIdUser,
          },
        })
        .then((response) => {
          this.listClient = response.data;
        });
    },


  },
};
</script>

<style>
</style>
