<template>
  <pre-loader v-if="preLoader"></pre-loader>
  <div class="container-fluid" id="container-wrapper" v-else>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h4 class="h4 mb-0 pb-1 text-gray-800">Dashboard</h4>
      <div class="pb-1">
        <select
          id="inputState"
          class="btn btn-sm btn-primary arrow active px-0"
          @change="dateFilter($event)"
        >
          <option class="bg-light text-dark" value="0" selected>Today</option>
          <option class="bg-light text-dark" value="1">This Week</option>
          <option class="bg-light text-dark" value="4">This Month</option>
          <option class="bg-light text-dark" value="3">This Year</option>
        </select>

        <button
          class="btn btn-sm btn-primary active px-2 ml-1"
          @click="viewFilters()"
          v-if="dateCustom == false"
        >
          Custom <i class="fas fa-calendar-alt fa-fw"></i>
        </button>
        <button
          class="btn btn-sm btn-outline-warning ml-1 px-3"
          @click="hideFilter()"
          v-if="dateCustom"
        >
          Clear <i class="far fa-times-circle fa-fw"></i>
        </button>
        <button
          @click.prevent="clickPdf()"
          class="btn btn-primary active btn-sm"
          :disabled="printLoading"
        >
          {{ print_btn_title }}
          <i class="fas fa-print fa-fw" v-if="printLoading == false"></i
          ><i
            class="fas fa-spinner fa-spin fa-fw"
            v-if="printLoading == true"
          ></i>
        </button>
      </div>
    </div>

    <div class="mb-4" v-if="dateCustom">
      <div class="row justify-content-center">
        <div class="" style="">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm"
                >From</span
              >
            </div>
            <input type="Date" class="form-control" v-model="from_date" />
            <div class="input-group-prepend ml-3">
              <span class="input-group-text" id="inputGroup-sizing-sm">To</span>
            </div>
            <input type="Date" class="form-control" v-model="to_date" />
            <button class="btn btn-sm btn-primary ml-4" @click="addFilters()">
              Search <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div>
     

      <div class="container-fluid px-0">
        <!----------DASHBOARD-NEW-STYLE-TEST-START-------------------------------------------------------------------->

    <div class="card mb-3">
          <div
            class="
              card-header
              pt-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
          </div>
          <div class="card-body">


            <div class="row mb-3">
              
              <div class="col-md-4 col-lg-4 mb-4">

             <router-link class="collapse-item text-decoration-none " to="/booking"> <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1 text-dark"
                        >
                         Booking
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{todays_booking}} 
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="far fa-address-book fa-2x text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div></router-link>


              </div>

          
              <div class="col-md-4 col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Completed Booking
                        </div>
                        <div
                          class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                        >
                     
                          {{ completed_booking }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-check fa-2x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
       
              <div class="col-md-4 col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Cancelled Booking
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        
                          {{ cancelled_booking }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-times  fa-2x text-danger"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>


<!-- 
        <div class="row">
          <div class="col-md-4 col-lg-4">
            <div class="card mb-3 pb-4">
              <div
                class="
                  card-header
                  py-0
                  d-flex
                  flex-row
                  align-items-center
                  justify-content-between
                "
              ></div>

              <div class="card-body">

                <div class="row mb-2">
                
                  <div class="col-12">
                    <div class="card h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div
                              class="
                                text-xs
                                font-weight-bold
                                text-uppercase
                                mb-1
                              "
                            >
                              Total Amount Received
                            </div>
                            <div
                              class="
                                h5
                                mb-0
                                mr-3
                                font-weight-bold
                                text-gray-800
                              "
                            >
                              <i class="fas fa-rupee-sign fa-fw"></i>
                              {{ parseFloat().toFixed(2) }}
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-primary"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row pt-3">
                  <div class="col-12">
                    <pie-chart
                      :inputlabel="this.categoryChartlabel"
                      :inputdata="['300','400']"
                      :width="250"
                      :height="250"
                    ></pie-chart>
                  </div>
                </div>
              </div>
              <div class="px-2 values text-center row">
                <div class="col">
                  <h6 class="text-xs">{{ categoryChartlabel[0] }} :</h6>
                  <h6 class="text-xs ml-1">{{ categoryChartlabel[1] }} :</h6>
                  <h6 class="text-xs ml-1">{{ categoryChartlabel[2] }} :</h6>
                </div>

                <div class="col">
                  <h6 class="font-weight-bold text-xs">
                    <i class="fas fa-rupee-sign fa-fw"></i
                    >{{ parseFloat(categoryChartData[0]).toFixed(2) }}
                  </h6>
                  <h6 class="font-weight-bold text-xs">
                    <i class="fas fa-rupee-sign fa-fw"></i
                    >{{ parseFloat(categoryChartData[1]).toFixed(2) }}
                  </h6>
                  <h6 class="font-weight-bold text-xs">
                    <i class="fas fa-rupee-sign fa-fw"></i
                    >{{ parseFloat(categoryChartData[2]).toFixed(2) }}
                  </h6>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-4 col-lg-4">
            <div class="card mb-3 pb-3">
              <div
                class="
                  card-header
                  py-0
                  d-flex
                  flex-row
                  align-items-center
                  justify-content-between
                "
              ></div>
              <div class="card-body">
         


                <div class="row mb-0">
                 
                  <div class="col-12">
                    <div class="card h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div
                              class="
                                text-xs
                                font-weight-bold
                                text-uppercase
                                mb-1
                              "
                            >
                              Total Expense Amount
                            </div>
                            <div
                              class="
                                h5
                                mb-0
                                mr-3
                                font-weight-bold
                                text-gray-800
                              "
                            >
                              <i class="fas fa-rupee-sign fa-fw"></i>
                              {{ parseFloat().toFixed(2) }}
                            </div>
                          </div>
                          <div class="col-auto">
                            <i
                              class="fas fa-search-dollar fa-2x text-danger"
                            ></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row pt-2 pb-3">
                  <div
                    class="col-12 pb-4"
                    v-if="expenseCategoryData.length == ''"
                    style="height: 232px; max-height: 232px"
                  >
                    <h6 class="text-center pt-5 mt-3">No Expenses Found</h6>
                    <div class="div text-center">
                      <i class="far fa-smile fa-4x" style="color: #376e37"></i>
                    </div>
                  </div>

                  <div v-if="expenseCategoryData.length > 0" class="col-12">
                    <bar-chart
                      :inputlabel="this.expenseCategoryLabel"
                      :inputdata="parseFloat(this.expenseCategoryData).toFixed(2)"
                      :height="234"
                      :width="234"
                    ></bar-chart>
                  </div>
                </div>


                <div class="row barchart-exp mt-4">
                  <div class="col">
                    <div
                      class="px-2 text-center"
                      v-for="ex in expenseCategoryLabel"
                      :key="ex"
                    >
                      <h6 class="text-xs">{{ ex }} :</h6>
                    </div>
                  </div>

                  <div class="col">
                    <div
                      class="px-2 text-center"
                      v-for="ed in expenseCategoryData"
                      :key="ed"
                    >
                      <h6 class="font-weight-bold text-xs">
                        <i class="fas fa-rupee-sign fa-fw"></i>{{ ed }}
                      </h6>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
    
          <div class="col-md-4 col-lg-4">
            <div class="card mb-3 pb-4">
              <div
                class="
                  card-header
                  py-0
                  d-flex
                  flex-row
                  align-items-center
                  justify-content-between
                "
              ></div>
              <div class="card-body">



                <div class="row mb-3">
                 
                  <div class="col-12">
                    <div class="card h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div
                              class="
                                text-xs
                                font-weight-bold
                                text-uppercase
                                mb-1
                              "
                            >
                              Total Profit
                            </div>
                            <div
                              class="
                                h5
                                mb-0
                                mr-3
                                font-weight-bold
                                text-gray-800
                              "
                            >
                              <i class="fas fa-rupee-sign fa-fw"></i>
                              {{ parseFloat(total_profit).toFixed(2) }}
                            </div>
                          </div>
                          <div class="col-auto">
                            <i
                              class="fas fa-hand-holding-usd fa-2x text-success"
                            ></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row pt-2 pb-3">
                  <div class="col-12">
                    <pie-chart
                      :inputlabel="this.proftChartLabel"
                      :inputdata="['200','500']"
                      :height="230"
                      :width="230"
                    ></pie-chart>
                  </div>
                </div>


              </div>

              <div class="px-2 values text-center mb-4">
                <h6 class="text-xs">
                  {{ "Bank Profit" }} :<span class="font-weight-bold"
                    ><i class="fas fa-rupee-sign fa-fw"></i
                    >{{ parseFloat(proftChartValues[0]).toFixed(2) }}</span
                  >
                  <span class="text-xs ml-1"></span>
                </h6>
                <h6 class="text-xs">
                  {{ "Cash Profit" }} :<span class="font-weight-bold text-xs"
                    ><i class="fas fa-rupee-sign fa-fw"></i
                    >{{ parseFloat(proftChartValues[1]).toFixed(2) }}
                  </span>
                </h6>
              </div>


            </div>
          </div>

        </div> -->


        
        <!---3diffrentcards sectionend------------------------------>

        <!----------DASHBOARD-NEW-STYLE-TEST-END--------------------------------------------------------------->

        <div class="card mb-3">
          <div
            class="
              card-header
              pt-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Sales Details</h6>
          </div>
          <div class="card-body">


            <div class="row mb-3">
              
              <div class="col-md-4 col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Number Of Sales
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{  }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="far fa-handshake fa-2x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          
              <div class="col-md-4 col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Total Sale Amount
                        </div>
                        <div
                          class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                        >
                          <i class="fas fa-rupee-sign fa-fw"></i>
                          {{ parseFloat().toFixed(2) }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-sort-amount-up fa-2x text-info"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
       
              <div class="col-md-4 col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Todays Sales Amount
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <i class="fas fa-rupee-sign fa-fw"></i>
                          {{ parseFloat().toFixed(2) }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-wallet fa-2x text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>

        
        <!--end-row-->
      </div>

      <!----->
    </div>
  </div>
</template>

<script>
import html2pdf from "html2pdf.js";

import barChart from "../charts/barChart.vue";
import pieChart from "../charts/pieChart.vue";

import moment from "moment";
export default {
  components: {
    barChart,
    pieChart,
  },
  data() {
    return {
      preLoader: false,
      printLoading: false,
      dashboard_print_area: false,

      dateCustom: false,
      chartlabel: [],
      chartData: [],
      paymentChartlabel: [],
      paymentChartData: [],

      categoryChartlabel: [],
      categoryChartData: [],

      expenseCategoryLabel: [],
      expenseCategoryData: [],

      proftChartLabel: [],
      proftChartValues: [],

      sale_item_details: [],
      service_item_details: [],

      from_date: "",
      to_date: "",
      print_date: "",

     

      dashBoardData: {},

todays_booking:'',
completed_booking:'',
cancelled_booking:'',



    };
  },


created(){

this.getDashboard();

},


  mounted() {
    this.dt = $(this.$refs.creditTableDash).DataTable({
      bInfo: false,
      bLengthChange: false,
      pageLength: 4,
    });
  },

  watch: {
    customerCredits(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.creditTableDash).DataTable({
          bInfo: false,
          bLengthChange: false,
          pageLength: 4,
        });
      });
    },
  },

  methods: {


   getDashboard(){
this.preLoader=true;
axios.get('get-dashboard').then((response) => {
  
this.dashBoardData=response.data;
this.todays_booking=response.data[0].todays_booking;
this.completed_booking=response.data[0].completed_booking;
this.cancelled_booking=response.data[0].cancelled_booking;

this.preLoader=false;
}).catch((err) => {
  this.preLoader=false;
  console.log(err);
});


   },



    getformatteddate(date) {
      return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
    },


    dateFilter(event) {
      //value-0 =Today
      if (event.target.value == 0) {
        this.from_date = "";
        this.to_date = "";
        this.getDashboard();
      }
      //value-1 =this-week
      if (event.target.value == 1) {
        this.from_date = moment().startOf("isoWeek").format("YYYY-MM-DD");
        this.to_date = moment().endOf("isoWeek").format("YYYY-MM-DD");
        this.getDashboard();
      }

      //value-5 =This month
      if (event.target.value == 4) {
        this.from_date = moment().startOf("month").format("YYYY-MM-DD");
        this.to_date = moment().endOf("month").format("YYYY-MM-DD");
        this.getDashboard();
      }

      //value-3=this-year
      if (event.target.value == 3) {
        this.from_date = moment().startOf("year").format("YYYY-MM-DD");
        this.to_date = moment().endOf("year").format("YYYY-MM-DD");
        this.getDashboard();
      }
    },

    viewFilters() {
      this.dateCustom = true;
    },
    hideFilter() {
      this.getDashboard();
      this.dateCustom = false;
      this.from_date = "";
      this.to_date = "";
    },
    addFilters() {
      this.getDashboard();
      this.from_date = "";
      this.to_date = "";
    },

    clickPdf() {
      var _this = this;
      _this.printLoading = true;
      var element = document.getElementById("dashboard_print");

      var opt = {
        margin: 0.25,
        filename: "dash",
        image: { type: "jpeg", quality: 1 },
        html2canvas: { scale: 6, logging: true },
        jsPDF: { unit: "in", format: "a4", orientation: "portrait" },

        pagebreak: { avoid: "tr" },
      };

      //

      var result = html2pdf()
        .set(opt)
        .from(element)
        .toPdf()
        .get("pdf")
        .then(function (pdf) {
          //  pdf.autoPrint();
          window.open(pdf.output("bloburl"), "_blank");
          _this.printLoading = false;
        });

      //  var result = html2pdf().from(element).set(opt).save();
    },
  },

  computed: {
    print_btn_title() {
      if (this.printLoading == true) {
        return "Processing  ";
      } else {
        return "Print";
      }
    },
  },


};
</script>

<style  scoped>
.bottom-wrapper {
  margin-top: 0.5em;
}
.stats strong {
  display: block;
  color: #35393bd0;
  font-size: 16px;
  font-weight: 700;
}
.dates span {
  width: 1px;
  height: 40px;
  position: absolute;
  right: 0;
  top: 0;
  background: #ebeff2;
}
.stats {
  height: 320px;
  border-top: 1px solid #ebeff2;
  border-bottom: 8px solid #328bcfd3;
  background: #6777ef1e;

  overflow: auto;
  padding: 15px 0;
  font-size: 16px;
  color: rgba(255, 0, 0, 0.562);
  font-weight: 600;
  border-radius: 0 0 5px 5px;
}
.stats div {
  border-right: 1px solid #eaedf0;
  width: 33.33333%;
  float: left;
  text-align: center;
}

.stats div:nth-of-type(3) {
  border: none;
}

.barchart-exp {
  height: 66px;
  max-height: 66px;
  overflow-y: auto;
}

.barchart-exp::-webkit-scrollbar {
  width: 12px;
}

.barchart-exp::-webkit-scrollbar-track {
  box-shadow: #35393b3b;
  -webkit-box-shadow: inset 0 0 6px rgba(48, 115, 170, 0.699);
  border-radius: 10px;
}

.barchart-exp::-webkit-scrollbar-thumb {
  border-radius: 10px;
  box-shadow: #35393b34;
  -webkit-box-shadow: inset 0 0 6px rgba(112, 127, 216, 0.5);
}

#receipt_table td,
#receipt_table th {
  border: 1px solid #ddd;
  padding-top: 8px;
  padding-left: 8px;
  padding-bottom: 8px;
  word-break: break-all;
  text-align: left;
  word-wrap: break-word;
  font-size: 11px;
  font-family: Arial, Helvetica, sans-serif;
}
#receipt_table thead {
  background-color: #b1c3de;
  font-family: Arial, Helvetica, sans-serif;
}
</style>
