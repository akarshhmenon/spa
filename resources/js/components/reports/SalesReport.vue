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
                @click="getSales()"
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
          id="salesTable"
          ref="salesTable"
        >
          <thead class="thead-light">
            <tr>
              <th> Index</th>
              <th>Date</th>
              <th>Customer Name</th>
              <th>Pay Type</th>
               <th>Amount</th>
                  <th>Discount</th>
              <th>Payable Amount</th>
             

              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(sales,index) in sales_list" :key="sales.id">
              <td>{{ index+1 }}</td>
              <td>{{ sales.date|myDate }}</td>
              <td>{{ sales.customer.name }}</td>
              <td>{{ sales.pay_type }}</td>
                <td>{{parseFloat( sales.total_amount ).toFixed(2)}}</td>
                   <td>{{parseFloat( sales.total_discount ).toFixed(2)}}</td>
                    <td>{{parseFloat( sales.total_pay_amount ).toFixed(2)}}</td>
              
              <td class="text-center" style="white-space: nowrap">
            
                <button
                  class="btn btn-outline-primary btn-sm"
                  data-toggle="modal"
                  data-target="#viewOnly"
                  @click="viewOnly(sales)"
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
              Sales Card
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              ref="close_sales_modal"
            >
              <span aria-hidden="true" class="modal-title-custom">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="card-body">


           <add-sales :edit="true" :viewOnly='true'> </add-sales>
           
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

      sales_list: {},
      from_date: "",
      to_date: "",
      search: false,
      view_only_attendance: [],
sales_details:[],
item_list:[],
  
    };
  },

  created() {
    this.getSales();
    var _this = this;
    bus.$on("sales-added", function () {
      _this.getSales();
    });
  },
  methods: {
    getSales() {
      this.preLoader = true;
      axios
        .get("get-sales-report", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.sales_list = response.data;
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
      this.getSales();
    },

    showFilter() {
      this.search = true;
    },
    viewOnly(sales) {
    
bus.$emit("edit-sale", sales);
        
      
    },
  },

  watch: {
    sales_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.salesTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "excel",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "pdf",
              title: "Sales Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "print",
              title: "Sales Report",
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
    this.dt = $(this.$refs.salesTable).DataTable({
      pageLength: 5,

      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "excel",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "pdf",
          title: "Sales Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "print",
          title: "Sales Report",
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
