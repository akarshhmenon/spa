<template>
  <!-- DataTable with Hover -->
  <pre-loader v-if="preLoader"></pre-loader>
  <div class="main" v-else>
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
          <h5 class="m-0 font-weight-bold text-dark">products</h5>

          <button
            type="button"
            class="btn rounded-pill btn-primary"
            data-toggle="modal"
            data-target="#addproduct"
          >
            Add Product <i class="fas fa-plus-circle fa-fw"></i>
          </button>
        </div>
        <div class="table-responsive p-3">
          <table
            class="table align-items-center table-flush table-hover display"
            id="ProductTable"
            ref="ProductTable"
            data-order=""
          >
            <thead class="thead-light">
              <tr>
                <th>Index</th>
                <th>Name</th>

                <th>Category</th>
                <th>Mrp</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(product, index) in product_details" :key="product.id">
                <td>{{ index + 1 }}</td>
                <td>{{ product.name }}</td>

                <td>{{ product.category.name }}</td>
                <td>{{ product.mrp }}</td>

                <td class="pl-3">
                  <button
                    v-if="product.add_to_home == 0"
                    class="btn btn-primary btn-sm"
                    @click="addToHome(product)"
                  >
                    <i class="far fa-star fafw" title="To Home"></i>
                  </button>
                  <button
                    v-else
                    class="btn btn-primary btn-sm"
                    @click="removeFromHome(product)"
                  >
                    <i class="fas fa-star fafw" title="To Home"></i>
                  </button>

                  <button
                    class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target="#editproduct"
                    @click="editProduct(product)"
                  >
                    <i class="fas fa-edit fafw" title="Edit"></i>
                  </button>

                  <button
                    class="btn btn-danger btn-sm ml-1"
                    @click="deleteProduct(product)"
                  >
                    <i class="fas fa-trash fafw" title="Move to trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!--------------Add-Employee-Modal---------------->
      <div
        id="addproduct"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <add-product></add-product>
          </div>
        </div>
      </div>

      <!--------------Add-Employee-Modal---------------->

      <!--------------Edit-Employee-Modal---------------->
      <div
        id="editproduct"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <add-product :edit="true"></add-product>
          </div>
        </div>
      </div>

      <!--------------Add-Employee-Modal---------------->
    </div>
  </div>
</template>




<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,
      product_details: {},
    };
  },
  created() {
    this.getProduct();
    var _this = this;
    bus.$on("product-added", function () {
      _this.getProduct();
    });
  },

  methods: {
    getProduct() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-product")
        .then((res) => {
          this.product_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deleteProduct(product) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("delete-product", {
              id: product.id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getProduct();
                Toast.fire({
                  icon: "success",
                  title: "Record Deleted successfully",
                });
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getProduct();
              }
            });
        }
      });
    },

    editProduct(product) {
      bus.$emit("edit-product", product);
    },

    addToHome(product) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, mark it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("add-to-home", {
              id: product.id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getProduct();
                Toast.fire({
                  icon: "success",
                  title: "Added successfully",
                });
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getProduct();
              }
            });
        }
      });
    },

    removeFromHome() {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("remove-from-home", {
              id: product.id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getProduct();
                Toast.fire({
                  icon: "success",
                  title: "Removed successfully",
                });
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getProduct();
              }
            });
        }
      });
    },
  },

  watch: {
    product_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.ProductTable).DataTable({
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
    this.dt = $(this.$refs.ProductTable).DataTable({
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