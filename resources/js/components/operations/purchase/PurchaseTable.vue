<template>
    <div>
    <pre-loader v-if="preLoader"></pre-loader>

    <div class="main-div">
      <div class="col-lg-12 add-purchase" v-show="showAddCard">
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
            <h5 class="m-0 font-weight-bold text-dark">{{ card_title }}</h5>

            <button
              type="button"
              class="btn btn-primary rounded-pill"
              @click="showTableComponent()"
            >
              Purchase Table<i class="fas fa-table fa-fw"></i>
            </button>
          </div>
          <!-- add purchase component  -->
          <add-purchase :edit="showEdit"> </add-purchase>
          <!-- add purchase component  end -->
        </div>
      </div>

      <div class="col-lg-12" v-if="showTable">
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
            <h5 class="m-0 font-weight-bold text-dark">Purchase</h5>

            <button
              type="button"
              class="btn btn-primary rounded-pill"
              @click="showAddComponent()"
            >
              Add Purchase<i class="fas fa-plus-circle fa-fw"></i>
            </button>
          </div>
          <div class="table-responsive p-3">
            <table
              class="table align-items-center table-flush table-hover"
              id="purchaseTable"
              ref="purchaseTable"
            >
              <thead class="thead-light">
                <tr>
                  <th>Index</th>

                  <th>Vendor Name</th>
                  <th>remarks</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  v-for="(purchase, index) in purchase_details"
                  :key="purchase.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ purchase.vendors.name }}</td>
                  <td>{{ purchase.remarks }}</td>
                  
                  <td>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      @click="editPurchase(purchase)"
                    >
                      <i class="fas fa-edit fa-fw"></i>
                    </button>

                    <button
                      type="button"
                      class="btn btn-sm btn-danger"
                      name=""
                      @click="deletePurchase(purchase)"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

    



</template>


<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,
      card_title: "",
      purchase_details: {},
      errors: {},
      edit: false,
      showTable: true,
      showEdit: true,
      showAddCard: false,
    };
  },
  created() {
    this.getPurchases();
    var _this = this;
    bus.$on("purchase-added", function () {
      _this.showAddCard = false;
      _this.showTable = true;
      _this.showEdit = true;
      _this.getPurchases();
    });
  },

  methods: {
    getPurchases() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-purchases")
        .then((res) => {
          this.purchase_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deletePurchase(purchase) {
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
            .post("delete-purchase", {
              id: purchase.id,
            })
            .then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getPurchases();
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getPurchases();
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

    editPurchase(purchase) {
      this.card_title = "Edit Purchase";
      this.showAddCard = true;
      this.showTable = false;
      bus.$emit("edit-purchase", purchase);
    },
    showAddComponent() {
      this.card_title = "Add Purchase";
      this.showAddCard = true;
      this.showTable = false;
      this.showEdit = false;
    },

    showTableComponent() {
      bus.$emit("clear-field");
      this.card_title = "";
      this.showAddCard = false;
      this.showTable = true;
      this.showEdit = true;
    },
  },

  watch: {
    purchase_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.purchaseTable).DataTable({
          pageLength: 5,
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
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
      bSort: false,
    });
  },
};
</script>
<style scoped>




</style>