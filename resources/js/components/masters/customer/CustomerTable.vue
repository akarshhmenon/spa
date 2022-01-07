<template>
  <pre-loader v-if="preLoader"></pre-loader>
  <!-- DataTable with Hover -->
  <div class="col-lg-12" v-else>
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
        <h5 class="m-0 font-weight-bold text-dark">Customers</h5>

        <button
          type="button"
          class="btn btn-primary rounded-pill"
          data-toggle="modal"
          data-target="#addcustomer"
          id="#myBtn"
        >
          Add Customer<i class="fas fa-plus-circle fa-fw"></i>
        </button>
      </div>
      <div class="table-responsive p-3">
        <table
          class="table align-items-center table-flush table-hover"
          id="customerTable"
         ref="customerTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>

              <th>Name</th>
              <th>Mobile</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="(customer, index) in customer_details"
              :key="customer.id"
            >
              <td>{{ index + 1 }}</td>
              <td>{{ customer.name }}</td>
              <td>{{ customer.mobile }}</td>
            

              <td>
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  name=""
                  data-toggle="modal"
                  data-target="#editcustomer"
                  @click="editCustomer(customer)"
                >
                  <i class="fas fa-edit fa-fw"></i>
                </button>

                <button
                  type="button"
                  class="btn btn-sm btn-danger"
                  data-toggle="modal"
                  data-target="#deletecustomer"
                  name=""
                  @click="deleteCustomer(customer)"
                 
                >
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- modal -->
    <div
      class="modal fade"
      id="addcustomer"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-customer></add-customer>
        </div>
      </div>
    </div>

    <!-- end modal -->

    <!-- edit modal  -->
    <div
      class="modal fade"
      id="editcustomer"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-customer :edit="true"></add-customer>
        </div>
      </div>
    </div>
    <!-- end modal -->
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,
      customer_details: {},
    };
  },
  created() {
    this.getCustomers();
    var _this = this;
    bus.$on("customer-added", function () {
      _this.getCustomers();
    });
  },

  methods: {
    getCustomers() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-customers")
        .then((res) => {
          this.customer_details = res.data;
 this.preLoader = false; //the loading end
        })
        .catch((err) => {
this.preLoader = false; //the loading end
          console.log(err);

        });

    },
deleteCustomer(customer) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("delete-customer",{

              id:customer.id,
          } ).then((response) => {
            if (response.data == "success") {
              this.getCustomers();
              Toast.fire({
                icon: "error",
                title: "Record Deleted successfully",
              });
            }

            if (response.data == "failed") {
              Toast.fire({
                icon: "error",
                title: "Some Error Occurred,Please Try Again Later",
              });

              this.getCustomers();
            }
          });
        }
      });
    },

    editCustomer(customer) {
      bus.$emit("edit-customer", customer);
    },
  },

watch: {
    customer_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.customerTable).DataTable({
          pageLength: 10,
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
        });
      });
    },
  },

 mounted() {
    this.dt = $(this.$refs.customerTable).DataTable({
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
    });
  },
};
</script>
