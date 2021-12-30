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
          <h5 class="m-0 font-weight-bold text-dark">Employees Attendance</h5>

          <button
            type="button"
            class="btn rounded-pill btn-primary"
            data-toggle="modal"
            data-target="#addEmployeeAttendance"
          >
            Mark Attendance <i class="fas fa-plus-circle fa-fw"></i>
          </button>
        </div>
        <div class="table-responsive p-3">
          <table
            class="table align-items-center table-flush table-hover display"
            id="attendanceTable"
            ref="attendanceTable"
            data-order=""
          >
            <thead class="thead-light">
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Designation</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Designation</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                v-for="(employee, index) in employee_attendance_details"
                :key="employee.id"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ employee.name }}</td>
                <td>{{ employee.mobile }}</td>
                <td>{{ employee.designations.name }}</td>

                <td class="pl-3">
                  <button
                    class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target="#editEmployee"
                    @click="editEmployeeAttendance(employee)"
                  >
                    <i class="fas fa-edit fafw" title="Edit"></i>
                  </button>

                
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!--------------Add-Employee-Modal---------------->
      <div
        id="addEmployeeAttendance"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <add-employee-attendance></add-employee-attendance>
          </div>
        </div>
      </div>

      <!--------------Add-Employee-Modal---------------->

      <!--------------Edit-Employee-Modal---------------->
      <div
        id="editEmployeeAttendance"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <add-employee-attendance :edit="true"></add-employee-attendance>
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
     employee_attendance_details: {},
    };
  },
  created() {
  
    this.getEmployeesAttendance();
    var _this = this;
    bus.$on("employee-attendance-added", function () {
      _this.getEmployeesAttendance();
    });
  },

  methods: {
    getEmployeesAttendance() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-employees")
        .then((res) => {
          this.employee_attendance_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

   

    editEmployeeAttendance(employee) {
      bus.$emit("edit-employee-attendance", employee);
    },
  },

  watch: {
    employee_attendance_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.attendanceTable).DataTable({
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
    this.dt = $(this.$refs.attendanceTable).DataTable({
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
