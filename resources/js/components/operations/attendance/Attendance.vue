<template>
  <div>
    
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addEmployeeLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_employee_attendance_modal"
        @click="clearFormData()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="" class="required">Date</label>
              <input
                type="date"
                class="form-control"
                name="date"
                v-model="attendance.date"
              />
            </div>

            <small class="text-danger" v-if="errors.date">
              {{ errors.date[0] }}</small
            >
          </div>
        </div>
        <!-- table  -->
        <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered attendanceTable">
              <thead class="text-center">
                <tr>
                  <th scope="col" rowspan="2" style="vertical-align: middle">
                    #
                  </th>
                  <th scope="col" rowspan="2" style="vertical-align: middle">
                    Name
                  </th>
                  <th scope="col" rowspan="2" style="vertical-align: middle">
                    code
                  </th>
                  <th
                    scope="col "
                    colspan="4"
                    style="vertical-align: middle; width: 40%"
                  >
                    Status
                  </th>
                </tr>
                <tr>
                  <th style="vertical-align: middle">Present</th>
                  <th style="vertical-align: middle">Half Day</th>
                  <th style="vertical-align: middle">Absent</th>
                  <th style="vertical-align: middle">Leave</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr
                  v-for="(employee, index) in attendance.employee_status"
                  :key="employee.id"
                >
                  <td>
                    {{ index + 1 }}
                  </td>
                  <td>
                    {{ employee.name }}
                  </td>
                  <td>
                    {{ employee.id }}
                  </td>
                  <td>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        :name="'attendanceRadioButton'+employee.id"
                        v-model="employee.status"
                        value="3"
                       :checked="employee.status ==3"
                      />
                      <label
                        class="form-check-label"
                        for="attendanceRadioButton1"
                      >
                        Present
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        :name="'attendanceRadioButton'+employee.id"
                        v-model="employee.status"
                        value="2"
                      />
                      <label
                        class="form-check-label"
                        for="attendanceRadioButton1"
                      >
                        Half Day
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        :name="'attendanceRadioButton'+employee.id"
                        v-model="employee.status"
                        value="1"
                      />
                      <label
                        class="form-check-label"
                        for="attendanceRadioButton1"
                      >
                        Absent
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        :name="'attendanceRadioButton'+employee.id"
                        v-model="employee.status"
                        value="0"
                      />
                      <label
                        class="form-check-label"
                        for="attendanceRadioButton1"
                      >
                        Leave
                      </label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- table end -->
      </div>
    </div>
    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-primary rounded-pill"
        :disabled="loading"
        @click="addAttendance()"

      >
        {{ button_title }}
        <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["edit"],

  data() {
    return {
      title: "Add Attendance",
      toastTitle: "Attendance added successfully",
      errors: {},
      preLoader: false,
      loading: false,

      attendance: {
        id: "",
        date: "",
        employee_status: [],
      },
    };
  },

  computed: {
    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Attendance";
      }
    },
  },
  created() {
    this.getEmployees();
  },

  methods: {
    getEmployees() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-employees")
        .then((res) => {
          var employee_details = res.data;

          if(employee_details.length!=0){
          for (let item in employee_details) {
            this.attendance.employee_status.push({
              id: employee_details[item].id,
              name: employee_details[item].name,
              status:"3",
            });
          }}

          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },
    addAttendance(){

this.loading = true;
axios.post('add-attendance',this.attendance).then((response) =>{
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("attendance-added");
            this.$refs.close_employee_attendance_modal.click();
            this.clearFormData();
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });

            bus.$emit("attendance-added");
            this.$refs.close_employee_attendance_modal.click();
            this.clearFormData();
          }

          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
          console.log("errors");
        });


    },

    clearFormData() {
   this.attendance.id='';
   this.attendance.date='';
this.attendance.employee_status=[];
      this.errors = {};
      this.getEmployees();
    },
  },
};
</script>
<style scoped>
.attendanceTable th {
  padding: 0.1rem !important;
}
</style>