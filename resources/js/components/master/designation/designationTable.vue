<template>
  <div>
    <pre-loader v-if="preLoader"></pre-loader>

    <div class="main-div" v-else>
      <div class="col-lg-12 add-designation">
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
            <h5 class="m-0 font-weight-bold text-dark">Add New Designation</h5>

            <button type="button" class="btn btn-primary rounded-pill">
              Designation Table<i class="fas fa-table fa-fw"></i>
            </button>
          </div>
          <!-- add designation component  -->
          <add-designation :edit="this.edit"  :editData="this.editData">    </add-designation > 
          <!-- add designation component  end -->
        </div>
      </div>

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
            <h5 class="m-0 font-weight-bold text-dark">Designations</h5>

            <button type="button" class="btn btn-primary rounded-pill">
              Add Designation<i class="fas fa-plus-circle fa-fw"></i>
            </button>
          </div>
          <div class="table-responsive p-3">
            <table
              class="table align-items-center table-flush table-hover"
              id="designationTable"
              ref="designationTable"
            >
              <thead class="thead-light">
                <tr>
                  <th>Index</th>

                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  v-for="(designation, index) in designation_details"
                  :key="designation.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ designation.name }}</td>
                  <td>{{ designation.Description }}</td>
                  <td v-if="designation.status==0"><span class="text-success font-weight-bold"> Active </span></td>

                  <td>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      @click="editDesignation(designation)"
                    >
                      <i class="fas fa-edit fa-fw"></i>
                    </button>

                    <button
                      type="button"
                      class="btn btn-sm btn-danger"
                      name=""
                      @click="deleteDesignation(designation)"
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
import addDesignation from "./addDesignation.vue";
export default {
  components: { addDesignation },
  props: ["user"],
  data() {
    return {
      preLoader: false,
      designation_details: {},
      errors: {},
      edit:false,
      editData:{},
    };
  },
  created() {

this.getDesignations();


  },

  methods: {
    getDesignations() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-designation")
        .then((res) => {
          this.designation_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deleteDesignation(designation) {
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
            .post("#", {
              id: designation.id,
            })
            .then((response) => {
                
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getDesignations();
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getDesignations();
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

    editDesignation(designation) {

        this.edit=true;
         this.editData=designation;
    },
  },

  watch: {
    designation_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.designationTable).DataTable({
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
    this.dt = $(this.$refs.designationTable).DataTable({
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
    });
  },
};
</script>
