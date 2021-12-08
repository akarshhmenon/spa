<template>
  <div class="main">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div
          class="
            card-header
            py-3
            d-flex
            flex-row
            align-items-center
            justify-content-between
          "
        >
          <h5 class="m-0 font-weight-bold text-dark">Purchase Reports</h5>
          <!--FilterButton-->

          <div class="col-md-2 ml-auto">
            <button
              class="btn btn-primary btn-sm float-right rounded-pill"
              @click="viewFilters()"
              v-if="search == false"
            >
              Add Filters<i class="fas fa-filter fa-fw"></i>
            </button>
            <button
              class="btn btn-outline-warning btn-sm float-right rounded-pill"
              @click="hideFilter()"
              v-if="search"
            >
              Clear Filter <i class="far fa-times-circle fa-fw"></i>
            </button>
          </div>
          <!--FilterButton end-->
        </div>
        <div class="" v-if="search">
          <div class="row justify-content-center">
            <div class="" style="">
              <div class="input-group">
                <span class="input-group-text">From</span>
                <input type="Date" class="form-control" v-model="from_date" />
                <span
                  class="input-group-text ml-4 px-3"
                  style="border-left: 0; border-right: 0"
                >
                  To
                </span>
                <input type="Date" class="form-control" v-model="to_date" />
                <button
                  class="btn btn-sm btn-primary ml-4"
                  @click="addFilters()"
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
            class="table align-items-center table-flush table-hover display dataTables_wrapper"
            id="purchaseTable"
            ref="purchaseTable"
          >
            <thead class="thead-light">
              <tr>
                <th>Index</th>
                <th>Invoice Number</th>
                <th>Purchase Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Index</th>
                <th>Invoice Number</th>
                <th>Purchase Date</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(purchase, index) in purchaseData" :key="purchase.id">
                <td>{{ index + 1 }}</td>
                <td>{{ purchase.purchase_invoice_no }}</td>
                <td>{{ purchase.purchase_date | myDate }}</td>

                <td class="">
                  <button
                    class="btn btn-outline-primary btn-sm"
                    data-toggle="modal"
                    data-target="#viewPurchase"
                    @click="viewPurchase(purchase)"
                  >
                    <i class="fa fa-eye fa-fw" title="view"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- add purchase modal -->

      <div
        id="viewPurchase"
        class="modal fade"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <add-purchase :viewOnly="true" :edit="true"></add-purchase>
          </div>
        </div>
      </div>

      <!-- modal end -->

      <!-- add purchase modal -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      search: false,

      purchaseData: {},
      from_date: "",
      to_date: "",
    };
  },

  methods: {
    addFilters() {
      this.getPurchases();
      this.from_date = "";
      this.to_date = "";
    },
    hideFilter() {
      this.getPurchases();
      this.search = false;
      this.from_date = "";
      this.to_date = "";
    },

    viewFilters() {
      this.search = true;
    },

    getPurchases() {
      axios
        .get("get-purchases", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.purchaseData = response.data;
        })
        .catch((err) => {});
    },

    viewPurchase(purchase) {
      //   bus.$emit("view-purchase", purchase);

      bus.$emit("edit-purchase", purchase);
    },
  },

  created() {
    this.getPurchases();
  },

  watch: {
    purchaseData(val) {
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
                    columns: ":visible:not(:eq(3))",
                  },
                },
                {
                  extend: "excel",
                  title: "Purchase Report",
                  exportOptions: {
                    columns: ":visible:not(:eq(3))",
                  },
                },
                {
                  extend: "pdf",
                  title: "Purchase Report",
                  exportOptions: {
                    columns: ":visible:not(:eq(3))",
                  },
                },
                {
                  extend: "print",
                  title: "Purchase Report",
                  exportOptions: {
                    columns: ":visible:not(:eq(3))",
                  },
                },
              ],

          lengthMenu: [
            [5, 30, 25, 50, -3],
            [5, 30, 25, 50, "All"],
          ],
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
                    columns: ":visible:not(:eq(3))",
                  },
                },
                {
                  extend: "excel",
                  title: "Purchase Report",
                  exportOptions: {
                    columns: ":visible:not(:eq(3))",
                  },
                },
                {
                  extend: "pdf",
                  title: "Purchase Report",
                  exportOptions: {
                    columns: ":visible:not(:eq(3))",
                  },
                },
                {
                  extend: "print",
                  title: "Purchase Report",
                  exportOptions: {
                    columns: ":visible:not(:eq(3))",
                  },
                },
              ],

      lengthMenu: [
        [5, 30, 25, 50, -3],
        [5, 30, 25, 50, "All"],
      ],
    });
  },
};
</script>
<style scoped>

</style>
