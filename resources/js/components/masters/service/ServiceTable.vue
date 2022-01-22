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
          <h5 class="m-0 font-weight-bold text-dark">Services</h5>

          <button
            type="button"
            class="btn rounded-pill btn-primary"
            data-toggle="modal"
            data-target="#addService"
          >
            Add Service <i class="fas fa-plus-circle fa-fw"></i>
          </button>
        </div>
        <div class="table-responsive p-3">
          <table
            class="table align-items-center table-flush table-hover display"
            id="ServiceTable"
            ref="ServiceTable"
            data-order=""
          >
            <thead class="thead-light">
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Description</th>
                <th>category</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                v-for="(service, index) in service_details"
                :key="service.id"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ service.name }}</td>
                <td>{{ service.description }}</td>
                <td>{{ service.category.name }}</td>

                <td class="pl-3">
                  <button
                    class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target="#editService"
                    @click="editService(service)"
                  >
                    <i class="fas fa-edit fafw" title="Edit"></i>
                  </button>

                  <button
                    
                    class="btn btn-danger btn-sm ml-1"
                    @click="deleteService(service)"
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
        id="addService"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <add-service></add-service>
          </div>
        </div>
      </div>

      <!--------------Add-Employee-Modal---------------->

      <!--------------Edit-Employee-Modal---------------->
      <div
        id="editService"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <add-service :edit="true"></add-service>
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
      service_details: {},
    };
  },
  created() {
  
    this.getService();
    var _this = this;
    bus.$on("service-added", function () {
      _this.getService();
    });
  },

  methods: {
    getService() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-service")
        .then((res) => {
          this.service_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deleteService(service) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("delete-service",{

              id:service.id,
          } ).then((response) => {
            if (response.data == "success") {
              this.getService();
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

              this.getService();
            }
          });
        }
      });
    },

    editService(service) {
      bus.$emit("edit-service", service);
    },
  },

  watch: {
    service_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.ServiceTable).DataTable({
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
    this.dt = $(this.$refs.ServiceTable).DataTable({
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