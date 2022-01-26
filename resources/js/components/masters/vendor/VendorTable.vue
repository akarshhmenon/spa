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
          <h5 class="m-0 font-weight-bold text-dark">vendors</h5>

          <button
            type="button"
            class="btn rounded-pill btn-primary"
            data-toggle="modal"
            data-target="#addVendor"
          >
            Add Vendor <i class="fas fa-plus-circle fa-fw"></i>
          </button>
        </div>
        <div class="table-responsive p-3">
          <table
            class="table align-items-center table-flush table-hover display"
            id="vendorsTable"
            ref="vendorsTable"
            data-order=""
          >
            <thead class="thead-light">
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>location</th>
                <th>state</th>
                <th>pincode</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>location</th>
                <th>state</th>
                <th>pincode</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                v-for="(vendor, index) in vendor_details"
                :key="vendor.id"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ vendor.name }}</td>
                <td>{{ vendor.mobile }}</td>
                <td>{{ vendor.location }}</td>
                <td>{{ vendor.state}}</td>
                <td>{{ vendor.pincode }}</td>
                <td class="pl-3">
                  <button
                    class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target="#editVendor"
                    @click="editVendor(vendor)"
                  >
                    <i class="fas fa-edit fafw" title="Edit"></i>
                  </button>

                  <button
                    
                    class="btn btn-danger btn-sm ml-1"
                    @click="deleteVendor(vendor)"
                  >
                    <i class="fas fa-trash fafw" title="Move to trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!--------------Add-vendor-Modal---------------->
      <div
        id="addVendor"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <add-vendor></add-vendor>
          </div>
        </div>
      </div>

      <!--------------Add-vendor-Modal---------------->

      <!--------------Edit-vendor-Modal---------------->
      <div
        id="editVendor"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <add-vendor :edit="true"></add-vendor>
          </div>
        </div>
      </div>

      <!--------------Add-vendor-Modal---------------->
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
    
      preLoader: false,
      vendor_details: {},
    };
  },
  created() {
  
    this.getVendors();
    var _this = this;
    bus.$on("vendor-added", function () {
      _this.getVendors();
    });
  },

  methods: {
    getVendors() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-vendors")
        .then((res) => {
          this.vendor_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deleteVendor(vendor) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("delete-vendor",{

              id:vendor.id,
          } ).then((response) => {
            if (response.data == "success") {
              this.getVendors();
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

              this.getVendors();
            }
          });
        }
      });
    },

    editVendor(vendor) {
    
      bus.$emit("edit-vendor", vendor);
    },
  },

  watch: {
    vendor_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.vendorsTable).DataTable({
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
    this.dt = $(this.$refs.vendorsTable).DataTable({
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