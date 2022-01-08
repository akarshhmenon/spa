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

          <button v-if="this.date_check==true"
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
            class="
              table
              align-items-center
              table-flush table-hover
              display
              text-center
            "
            id="attendanceTable"
            ref="attendanceTable"
            data-order=""
          >
            <thead class="thead-light">
              <tr>
                <th>Date</th>
                <th>Number of Employees</th>
                <th>Full Day</th>
                <th>Half Day</th>
                <th>Absent</th>
                <th>Leave</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr
                v-for="employee in employee_attendance_details"
                :key="employee.id"
              >
                <td >{{ employee.date | myDate }}</td>
                <td>{{ employee.count }}</td>
                <td>{{ employee.full_day }}</td>
                <td>{{ employee.half_day }}</td>
                <td>{{ employee.absent }}</td>
                <td>{{ employee.leave }}</td>

                <td class="pl-3">
                  <button
                    class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target="#editEmployeeAttendance"
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

      <!--------------Add-Attendance-Modal---------------->
      <div
        id="addEmployeeAttendance"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <add-employee-attendance></add-employee-attendance>
          </div>
        </div>
      </div>

      <!--------------Add-Attendance-Modal---------------->

      <!--------------Edit-Attendance-Modal---------------->
      <div
        id="editEmployeeAttendance"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <add-employee-attendance :edit="true"></add-employee-attendance>
          </div>
        </div>
      </div>

      <!--------------Add-Attendance-Modal---------------->
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,
      employee_attendance_details: [],
date_check:true,
today_date:moment().format("YYYY-MM-DD"),
    };
  },
  created() {
    this.getEmployeesAttendance();
    var _this = this;
    bus.$on("attendance-added", function () {
      _this.getEmployeesAttendance();
    });



  },

  methods: {


    getEmployeesAttendance() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-employees-attendance")
        .then((res) => {
          this.employee_attendance_details = res.data;

if(this.employee_attendance_details.length!=0){
 for(let date in this.employee_attendance_details ){

   if(this.employee_attendance_details[date].date==this.today_date){


this.date_check=false;
   }

 }

}

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
