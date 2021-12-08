<template>
  <!-- DataTable with Hover -->
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
        <h5 class="m-0 font-weight-bold text-dark">Credits Report</h5>
      </div>

      <div class="table-responsive p-3">
        <table
          class="table table-sm align-items-center table-flush table-hover"
          id="creditTable"
          ref="creditTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>
              <th>Name</th>
              <th>Transactions</th>
              <th>Credit Amount</th>

              <th class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(credit, index) in credits_list" :key="credit.id">
              <td>{{ index + 1 }}</td>
              <td>{{ credit.customer_name }}</td>
              <td>{{ credit.transactions_count }}</td>
              <td>{{ credit.amount }}</td>

              <td class="pl-4 text-center" style="white-space: nowrap">
                <button
                  class="btn btn-outline-primary btn-sm"
                  data-toggle="modal"
                  data-target="#viewTransactions"
                  @click="viewTransaction(credit)"
                >
                  <i class="fa fa-eye fa-fw" title="view"></i>
                </button>

                <button
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#addpayment"
                  @click="addPayment(credit)"
                >
                  <i class="fas fa-hand-holding-usd" title="Add Payment"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- viewTransactions modal  -->
    <div
      class="modal fade"
      id="viewTransactions"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <view-transactions></view-transactions>
        </div>
      </div>
    </div>
    <!-- viewTransactions modal -->

    <!-- addpayment modal  -->
    <div
      class="modal fade"
      id="addpayment"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-payment></add-payment>
        </div>
      </div>
    </div>
    <!-- addpayment modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      credits_list: {},

      search: false,
    };
  },

  created() {
    this.getCredit();
    var _this = this;
    bus.$on("payment-added", function () {
      _this.getCredit();
    });
  },
  methods: {
    getCredit() {
      axios
        .get("/admin/get-credits")
        .then((response) => {
          this.credits_list = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    viewTransaction(customer) {
      bus.$emit("transaction-history", customer);
    },

    addPayment(customer) {
      bus.$emit("add-payment", customer);
    },
  },

  watch: {
    credits_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.creditTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Credit Report",
              exportOptions: {
                columns: ":visible:not(:eq(4))",
              },
            },
            {
              extend: "excel",
              title: "Credit Report",
              exportOptions: {
                columns: ":visible:not(:eq(4))",
              },
            },
            {
              extend: "pdf",
              title: "Credit Report",
              exportOptions: {
                columns: ":visible:not(:eq(4))",
              },
            },
            {
              extend: "print",
              title: "Credit Report",
              exportOptions: {
                columns: ":visible:not(:eq(4))",
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
    this.dt = $(this.$refs.creditTable).DataTable({
      pageLength: 5,

      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Credit Report",
          exportOptions: {
            columns: ":visible:not(:eq(4))",
          },
        },
        {
          extend: "excel",
          title: "Credit Report",
          exportOptions: {
            columns: ":visible:not(:eq(4))",
          },
        },
        {
          extend: "pdf",
          title: "Credit Report",
          exportOptions: {
            columns: ":visible:not(:eq(4))",
          },
        },
        {
          extend: "print",
          title: "Credit Report",
          exportOptions: {
            columns: ":visible:not(:eq(4))",
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

<style scoped>
</style>
