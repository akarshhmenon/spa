<template>
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div
        class="
          card-header
          pt-4
          d-flex
          flex-row
          align-items-center
          justify-content-between
        "
      >
        <h5 class="m-0 font-weight-bold text-dark">Payments Report</h5>
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
                class="input-group-text ml-4 px-5"
                style="border-left: 0; border-right: 0"
              >
                To
              </span>
              <input type="Date" class="form-control" v-model="to_date" />
              <button class="btn btn-sm btn-primary ml-4" @click="addFilters()">
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
          id="paymentTable"
          ref="paymentTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>
              <th>Name</th>
              <th>Payment Date</th>
              <th>Payment Type</th>
              <th>Payment Amount</th>

              <th class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(payment, index) in payments_list" :key="payment.id">
              <td>{{ index + 1 }}</td>
              <td>{{ payment.customer["name"] }}</td>
              <td>{{ payment.payment_date | myDate }}</td>
              <td>{{ payment.pay_type }}</td>
              <td>{{ payment.amount }}</td>

              <td class="pl-4 text-center" style="white-space: nowrap">
                <button
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#editPayments"
                  @click="editPayment(payment)"
                >
                  <i class="fas fa-edit fafw" title="Edit"></i>
                </button>

                <button
                  class="btn btn-danger btn-sm"
                  @click="deletePayment(payment)"
                >
                  <i class="fas fa-trash fafw" title="Move to trash"></i>
                </button>

                <button
                  class="btn btn-success btn-sm"
                  data-toggle="modal"
                  data-target="#paymentReceipt"
                  @click="receiptDownload(payment)"
                >
                  <i class="fas fa-file-invoice" title="Bill"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- payment invoice modal  -->
    <div
      class="modal fade"
      id="paymentReceipt"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <payment-receipt></payment-receipt>
        </div>
      </div>
    </div>
    <!-- invoice modal -->

    <!-- editPayments modal  -->
    <div
      class="modal fade"
      id="editPayments"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <add-payment :edit="true"></add-payment>
        </div>
      </div>
    </div>
    <!-- editPayments modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      payments_list: {},
      from_date: "",
      to_date: "",
      search: false,
    };
  },

  created() {
    this.getPayment();
    var _this = this;
    bus.$on("payment-added", function () {
      _this.getPayment();
    });
  },
  methods: {
    getPayment() {
      axios
        .get("/admin/get-payments", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.payments_list = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    editPayment(payment) {
      bus.$emit("edit-payment", payment);
    },

    hideFilter() {
      this.getPayment();
      this.search = false;
      this.from_date = "";
      this.to_date = "";
    },

    viewFilters() {
      this.search = true;
    },
    addFilters() {
      this.getPayment();
      this.from_date = "";
      this.to_date = "";
    },

    receiptDownload(payment) {
      bus.$emit("payment-receipt", payment);
    },

    deletePayment(payment) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5085d6",
        cancelButtonColor: "#d5",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("/admin/delete-payment", {
              id: payment.id,
            })
            .then((response) => {
              if (response.data == "Success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getPayment();
              }
            })
            .catch((err) => {
              Toast.fire({
                icon: "error",
                title: "Request failed ",
              });
            });
        }
      });
    },
  },

  watch: {
    payments_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.paymentTable).DataTable({
          pageLength: 5,

          dom: "lBfrtip",

          buttons: [
            {
              extend: "copy",
              title: "Payment Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "excel",
              title: "Payment Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "pdf",
              title: "Payment Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "print",
              title: "Payment Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
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
    this.dt = $(this.$refs.paymentTable).DataTable({
      pageLength: 5,

      dom: "lBfrtip",

      buttons: [
        {
          extend: "copy",
          title: "Payment Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "excel",
          title: "Payment Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "pdf",
          title: "Payment Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "print",
          title: "Payment Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
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
