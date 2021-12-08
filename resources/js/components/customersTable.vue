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
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>

              <th>Name</th>
              <th>Mobile</th>
              <th v-if="user.gst">GST no</th>
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
               <td v-if="user.gst">{{ customer.gst_no }}</td>


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

                <button type="button" class="btn btn-sm btn-danger" name="" @click="deleteCustomer(customer)">
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
          <add-customer :usergst="this.user.gst"></add-customer>
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
          <add-customer :edit="true" :usergst="this.user.gst"></add-customer>
        </div>
      </div>
    </div>
    <!-- end modal -->
  </div>
</template>

<script>
export default {
props: ['user'],
  data() {
    return {
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
      axios
        .get("/admin/get-customers")
        .then((res) => {
          this.customer_details = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    deleteCustomer(customer) {
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
            .post("/admin/delete-customer", {
              id: customer.id,
            })
            .then((response) => {
              if (response.data == "Success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getCustomers();
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

    editCustomer(customer) {
      bus.$emit("edit-customer", customer);
    },
  },
};
</script>
