<template>
  <!-- DataTable with Hover -->
  <pre-loader v-if="preLoader"></pre-loader>
  <div class="col-lg-12" v-else>
    <div class="card mb-4">
      <div
        class="
          card-header
          py-7
          d-flex
          flex-row
          align-items-center
          justify-content-between
        "
      >
        <h5 class="m-0 font-weight-bold text-dark">Attendance Report</h5>
        <!--FilterButton-->

        <div class="col-md-2 ml-auto">
          <button
            class="btn btn-primary btn-sm float-right rounded-pill"
            @click="showFilter()"
            v-if="search == false"
          >
            Add Filters <i class="fas fa-filter fa-fw"></i>
          </button>
          <button
            class="btn btn-outline-warning btn-sm float-right rounded-pill"
            @click="clearSearch()"
            v-if="search"
          >
            Clear Filters<i class="far fa-times-circle fa-fw"></i>
          </button>
        </div>

        <!--FilterButton end-->
      </div>

      <!-------------------------->
      <div class="" v-if="search">
        <div class="row justify-content-center">
          <div class="" style="">
            <div class="input-group">
              <span class="input-group-text">From</span>
              <input type="Date" class="form-control" v-model="from_date" />
              <span
                class="input-group-text ml-4 px-7"
                style="border-left: 0; border-right: 0"
              >
                To
              </span>
              <input type="Date" class="form-control" v-model="to_date" />
              <button
                class="btn btn-primary btn-sm ml-4 px-7"
                @click="getAttendance()"
              >
                Search <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-------------------------->
      <div class="table-responsive p-3">
        <table
          class="table table-sm align-items-center table-flush table-hover"
          id="AttendanceTable"
          ref="AttendanceTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Name</th>
              <th>Full Day</th>
              <th>Half Day</th>
              <th>Absent</th>
              <th>Leave</th>

              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="employee in Attendance_list" :key="employee.employee_id">
              <td>{{ employee.name }}</td>
              <td>{{ employee.full_day }}</td>
              <td>{{ employee.half_day }}</td>
              <td>{{ employee.absent }}</td>
              <td>{{ employee.leave }}</td>
              <td class="text-center" style="white-space: nowrap">
                <!-- <button
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#editsale"
                  @click="editSale(sale)"
                >
                  <i class="fas fa-edit fafw" title="Edit"></i>
                </button> -->
                <button
                  class="btn btn-outline-primary btn-sm"
                  data-toggle="modal"
                  data-target="#viewOnly"
                  @click="viewOnly(employee)"
                >
                  <i class="fa fa-eye fa-fw" title="view"></i>
                </button>
                <!-- 
                <button
                  class="btn btn-success btn-sm"
                  data-toggle="modal"
                  data-target="#printInvoice"
                  @click="saleReportInvoice(sale)"
                >
                  <i class="fas fa-file-invoice" title="invoice"></i>
                </button>

                <button class="btn btn-danger btn-sm" @click="deleteSale(sale)">
                  <i class="fas fa-trash fafw" title="Move to trash"></i>
                </button> -->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- edit modal  -->
    <div
      class="modal fade"
      id="editsale"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <!-- *** -->
        </div>
      </div>
    </div>
    <!-- end modal -->

    <!-- invoice modal  -->
    <div
      class="modal fade"
      id="printInvoice"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <!-- **** -->
        </div>
      </div>
    </div>
    <!-- invoice modal -->
    <!-- viewOnly modal  -->
    <div
      class="modal fade"
      id="viewOnly"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <!-- **** -->
          <div class="modal-header bg-primary">
            <h5
              class="modal-title modal-title-custom"
              id="addEmployeeLabel"

            >  Attendance Card  </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              ref="close_employee_attendance_modal"
            >
              <span aria-hidden="true" class="modal-title-custom">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="card-body"> 



<div class="row">
  <div class="col">
<div class="card mb-4" >
 
  <div class="card-body">
  
  <div class="row">
    <div class="col">
      <div>
        <h3>{{employee_name}}</h3>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <div>
        <h5 class="text-success"> Full day</h5> <span> <strong> {{employee_full_day}} </strong> Days</span>
      </div>
    </div>
    <div class="col">
      <div>
        <h5 class="text-info"> Half Day</h5> <span> <strong> {{employee_half_day}} </strong> Days</span>
      </div>
    </div>
    <div class="col">
      <div>
        <h5 class="text-warning"> Absent</h5> <span> <strong> {{employee_absent}} </strong> Days</span>
      </div>
    </div>
    <div class="col">
      <div>
        <h5 class="text-danger"> Leave</h5> <span> <strong> {{employee_leave}}  </strong> Days</span>
      </div>
    </div>
  </div>

  </div>
</div>
  </div>
</div>
<div class="row">
  <div class="col">
    
<div class="card" >
              <div class="table-responsive p-3 ">
                <table
                  class="
                    table
                    align-items-center
                    table-flush table-hover
                    display
                    text-center
                  "
                  id="employeeAttendanceTable"
                  ref="employeeAttendanceTable"
                  data-order=""
                >
                  <thead class="thead-light">
                    <tr> <th>index</th>
                      <th>Date</th>
                      <th>Day</th>
                      <th>Status</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr
                      v-for="(employee,index) in view_only_attendance.slice().reverse()"
                      :key="employee.id"
                    ><td>{{ index + 1}}</td>
                      <td>{{ employee.date | myDate }}</td>
                      <td>{{ employee.date | formatDate }}</td>
                      <td v-if=" employee.status==0"><span class="text-danger">Leave</span></td>
                       <td v-if=" employee.status==1"><span class="text-warning">Absent</span></td>
                        <td v-if=" employee.status==2"><span class="text-info">Half Day</span></td>
                         <td v-if=" employee.status==3"><span class="text-success">Full Day</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
</div>
  </div>
</div>


            </div>
          </div>
          <!-- **** -->
        </div>
      </div>
    </div>
    <!-- viewOnly modal -->
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,

      Attendance_list: {},
      from_date: "",
      to_date: "",
      search: false,
      view_only_attendance:[],

employee_name:'',
employee_full_day:'',
employee_half_day:'',
employee_absent:'',
employee_leave:'',
    };
  },

  created() {
    this.getAttendance();
    var _this = this;
    bus.$on("sale-added", function () {
      _this.getAttendance();
    });
  },
  methods: {
    getAttendance() {
      this.preLoader = true;
      axios
        .get("get-employees-attendance-report", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.Attendance_list = response.data;
          this.preLoader = false;
        })
        .catch((err) => {
          this.preLoader = false;
          console.log(err);
        });
    },

    clearSearch() {
      this.from_date = "";
      this.to_date = "";
      this.search = false;
      this.getAttendance();
    },

    showFilter() {
      this.search = true;
    },
viewOnly(employee){


this.employee_name=employee.name;
this.employee_full_day=employee.full_day;
this.employee_half_day=employee.half_day;
this.employee_absent=employee.absent;
this.employee_leave=employee.leave;
this.view_only_attendance=employee.group_by_attendance;

}
  
  },

  watch: {
    Attendance_list(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.AttendanceTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "excel",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "pdf",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "print",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
          ],

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
          bSort: false,
        });
      });
    },


    view_only_attendance(val) {
      this.ds.destroy();
      this.$nextTick(() => {
        this.ds = $(this.$refs.employeeAttendanceTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "excel",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "pdf",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "print",
              title: "Attendance Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
          ],

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



    this.dt = $(this.$refs.AttendanceTable).DataTable({
      pageLength: 5,

      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "excel",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "pdf",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "print",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
      ],

      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      bSort: false,
    });



 this.ds = $(this.$refs.employeeAttendanceTable).DataTable({
      pageLength: 5,

      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "excel",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "pdf",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "print",
          title: "Attendance Report",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
      ],

      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      bSort: false,
    });
    
  },




  
};
</script>

<style>
</style>
