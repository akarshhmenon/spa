<template>
  <!-- DataTable with Hover -->
  <div class="col-lg-12">


    <div class="card mb-4">
      <div
        class="
          card-header
          py-7
          d-flex
          flex-row
          align-items-center
          justify-content-between
        "
      >
        <h5 class="m-0 font-weight-bold text-dark">Sales Report</h5>
        <!--FilterButton-->

        <div class="col-md-2 ml-auto">
          <button
            class="btn btn-primary btn-sm float-right rounded-pill"
            @click="showFilter()"
            v-if="search == false"
          >
            Add Filters <i class="fas fa-filter fa-fw"></i>
          </button>
          <button
            class="btn btn-outline-warning btn-sm float-right rounded-pill"
            @click="clearSearch()"
            v-if="search"
          >
            Clear Filters<i class="far fa-times-circle fa-fw"></i>
          </button>
        </div>

        <!--FilterButton end-->
      </div>

      <!-------------------------->
      <div class="" v-if="search">
        <div class="row justify-content-center">
          <div class="" style="">
            <div class="input-group">
              <span class="input-group-text">From</span>
              <input type="Date" class="form-control" v-model="from_date" />
              <span
                class="input-group-text ml-4 px-7"
                style="border-left: 0; border-right: 0"
              >
                To
              </span>
              <input type="Date" class="form-control" v-model="to_date" />
              <button
                class="btn btn-primary btn-sm ml-4 px-7"
                @click="getSale()"
              >
                Search <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-------------------------->
      <div class="table-responsive p-3">
        <table
          class="table table-sm align-items-center table-flush table-hover"
          id="customerTable"
          ref="customerTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>
              <th>Name</th>
              <th>Bill Type</th>
              <th v-if="vehiclecheck">Vehicle</th>
              <th v-if="vehiclecheck">Register No</th>
              <th>Total Amount</th>
              <th>Reward Point</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(sale, index) in sales_list" :key="sale.id">
              <td>{{ index + 1 }}</td>
              <td>{{ sale.customer["name"] }}</td>
              <td v-if="sale.bill_type == 2">CASH</td>
              <td v-if="sale.bill_type == 1">CREDIT</td>
              <td v-if="vehiclecheck">{{ sale.vehicle }}</td>
              <td v-if="vehiclecheck">{{ sale.register_no }}</td>
              <td>{{ sale.pay_amount }}</td>
              <td>{{ sale.reward_points }}</td>

              <td class="text-center" style="white-space: nowrap">
                <button
                  class="btn btn-outline-primary btn-sm"
                  data-toggle="modal"
                  data-target="#viewOnly"
                  @click="viewSale(sale)"
                >
                  <i class="fa fa-eye fa-fw" title="view"></i>
                </button>

                <button
                  class="btn btn-success btn-sm"
                  data-toggle="modal"
                  data-target="#printInvoice"
                  @click="saleReportInvoice(sale)"
                >
                  <i class="fas fa-file-invoice" title="invoice"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- invoice modal  -->
    <div
      class="modal fade"
      id="printInvoice"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <sales-invoice></sales-invoice>
        </div>
      </div>
    </div>
    <!-- invoice modal -->
    <!-- viewOnly modal  -->
    <div
      class="modal fade"
      id="viewOnly"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <add-sale :viewOnly="true"></add-sale>
        </div>
      </div>
    </div>
    <!-- viewOnly modal -->
  </div>
</template>

<script>
export default {
  props:['user'],
  data() {
    return {
      sales_list: {},
      from_date: "",
      to_date: "",
      search: false,
      vehiclecheck:false,
    };
  },

  created() {
    if(this.user.vehicle==1){
      this.vehiclecheck=true;

    }
    this.getSale();
    var _this = this;
    bus.$on("sale-added", function () {
      _this.getSale();
    });
  },
  methods: {
    getSale() {
      axios
        .get("/admin/get-sales", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.sales_list = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    viewSale(sale) {
      bus.$emit("view-sale", sale);
    },
    clearSearch() {
      this.from_date = "";
      this.to_date = "";
      this.search = false;
      this.getSale();
    },

    showFilter() {
      this.search = true;
    },

    saleReportInvoice(sale) {
      bus.$emit("sale-invoice", sale);
    },
  },

  watch: {
    sales_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.customerTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(7))",
              },
            },
            {
              extend: "excel",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(7))",
              },
            },
            {
              extend: "pdf",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(7))",
              },
            },
            {
              extend: "print",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(7))",
              },
            },
          ],

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.customerTable).DataTable({
      pageLength: 5,
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(7))",
          },
        },
        {
          extend: "excel",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(7))",
          },
        },
        {
          extend: "pdf",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(7))",
          },
        },
        {
          extend: "print",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(7))",
          },
        },
      ],

      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
    });
  },
};
</script>

<style>
</style>
