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
        <h5 class="m-0 font-weight-bold text-dark">Sales</h5>

        <button
          type="button"
          class="btn btn-primary rounded-pill"
          data-toggle="modal"
          data-target="#addsale"
          id="#myBtn"
          @click="addSale = true"
        >
          Add Sale<i class="fas fa-plus-circle fa-fw"></i>
        </button>
      </div>

      <div class="table-responsive p-3">
        <table
          class="table table-sm align-items-center table-flush table-hover"
          ref="salesTable"
          id="customerTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>

              <th>Name</th>
              <th>Bill Type</th>
              <th v-if="vehiclecheck">Vehicle</th>
              <th v-if="vehiclecheck"> Register No</th>
              <th>Total Amount</th>
              <th  v-if="vehiclecheck">Reward Point</th>
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
              <td  v-if="rewardcheck">{{ sale.reward_points }}</td>

              <td class="pl-3"  style='white-space: nowrap;'>
                <button
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#editsale"
                  @click="editSale(sale)"
                  :disabled='sale.gst_bill==1 && authUser==false'
                >
                  <i class="fas fa-edit fafw" title="Edit"></i>
                </button>

                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteSale(sale)"
                >
                  <i class="fas fa-trash fafw" title="Move to trash"></i>
                </button>

            <button
                  class="btn btn-success btn-sm"
                  data-toggle="modal"
                  data-target="#printInvoice"
                  @click="saleInvoice(sale)"
                >
                  <i class="fas fa-file-invoice" title="invoice"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- modal -->
    <div
      v-if="addSale"
      class="modal fade"
      id="addsale"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <add-sale :usergst="this.user.gst" :vehicle="this.user.vehicle" ></add-sale>
        </div>
      </div>
    </div>

    <!-- end modal -->

    <!-- edit modal  -->
    <div
      class="modal fade"
      id="editsale"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <add-sale :edit="true" :usergst="this.user.gst" :vehicle="this.user.vehicle"></add-sale>
        </div>
      </div>
    </div>
    <!-- end modal -->

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
  </div>
</template>

<script>
export default {
  props: ['user'],
  data() {
    return {
      sales_list: {},
      vehiclecheck:false,
      rewardcheck:false,
      addSale: false,
      authUser:false,
    };
  },

  created() {

if(this.user.gst==1){
this.authUser=true;

}
if(this.user.vehicle==1){
this.vehiclecheck=true;

}
if(this.user.reward==1){
this.rewardcheck=true;

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
        .get("/admin/get-today-sales")

        .then((response) => {
          this.sales_list = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    editSale(sale) {
      bus.$emit("edit-sale", sale);
    },

 saleInvoice(sale) {
      bus.$emit("sale-invoice", sale);
    },

    deleteSale(sale) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("/admin/delete-sale", {
              id: sale.id,
            })
            .then((response) => {
              if (response.data == "Success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getSale();
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
    sales_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.salesTable).DataTable({
          pageLength: 5,
          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.salesTable).DataTable({
      pageLength: 5,
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
