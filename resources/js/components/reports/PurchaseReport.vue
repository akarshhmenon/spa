<template>
  <!-- DataTable with Hover -->
  <pre-loader v-if="preLoader"></pre-loader>
  <div class="col-lg-12" v-else>
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
        <h5 class="m-0 font-weight-bold text-dark">Purchase Report</h5>
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
                @click="getPurchases()"
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
          class="table table-sm align-items-center table-flush table-hover text-center"
          id="purchaseTable"
          ref="purchaseTable"
        >
          <thead class="thead-light">
            <tr>
              <th> Index</th>
              <th>Date</th>
              <th>Bill No</th>
              <th>Vendor Name</th>
              <th>Amount</th>
           

              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(purchase,index) in purchase_list" :key="purchase.id">
              <td>{{ index+1 }}</td>
              <td>{{ purchase.purchase_date|myDate }}</td>
               <td>{{ purchase.purchase_invoice_no }}</td>
              <td>{{ purchase.vendors.name }}</td>
              <td>{{ purchase.total_amount }}</td>
             
              <td class="text-center" style="white-space: nowrap">
            
                <button
                  class="btn btn-outline-primary btn-sm"
                  data-toggle="modal"
                  data-target="#viewOnly"
                  @click="viewOnly(purchase)"
                >
                  <i class="fa fa-eye fa-fw" title="view"></i>
                </button>
       
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>



 
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
          <!-- **** -->
          <div class="modal-header bg-primary">
            <h5 class="modal-title modal-title-custom" id="addEmployeeLabel">
              Purchase Card
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              ref="close_purchases_modal"
            >
              <span aria-hidden="true" class="modal-title-custom">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="card-body" v-if="this.purchase_details.length != 0">
            ****
           
            </div>
          </div>
          <!-- **** -->
        </div>
      </div>
    </div>
    <!-- viewOnly modal -->
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,

      purchase_list: {},
      from_date: "",
      to_date: "",
      search: false,
      view_only_attendance: [],
purchase_details:[],
item_list:[],
  
    };
  },

  created() {
    this.getPurchases();
    var _this = this;
    bus.$on("purchase-added", function () {
      _this.getPurchases();
    });
  },
  methods: {
    getPurchases() {
      this.preLoader = true;
      axios
        .get("get-purchase-report", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.purchase_list = response.data;
          this.preLoader = false;
        })
        .catch((err) => {
          this.preLoader = false;
          console.log(err);
        });
    },

    clearSearch() {
      this.from_date = "";
      this.to_date = "";
      this.search = false;
      this.getPurchases();
    },

    showFilter() {
      this.search = true;
    },
    viewOnly(purchase) {
    

        
      
    },
  },

  watch: {
    purchase_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.purchaseTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Purchase Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "excel",
              title: "Purchase Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "pdf",
              title: "Purchase Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "print",
              title: "Purchase Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
          ],

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
          bSort: false,
        });
      });
    },


  },

  mounted() {
    this.dt = $(this.$refs.purchaseTable).DataTable({
      pageLength: 5,

      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Purchase Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "excel",
          title: "Purchase Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "pdf",
          title: "Purchase Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "print",
          title: "Purchase Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
      ],

      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      bSort: false,
    });


  },
};
</script>

<style>
</style>
