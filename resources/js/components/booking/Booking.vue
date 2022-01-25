<template>
  <div class="container-fluid py-5">
    <div class="container py-5">
      <div class="row mx-0 justify-content-center text-center">
        <div class="col-lg-6">
          <h6
            class="
              d-inline-block
              bg-light
              text-primary text-uppercase
              py-1
              px-2
            "
          >
            Appointment
          </h6>
        </div>
      </div>
      <div class="row justify-content-center bg-appointment mx-0">
        <div class="col-lg-6 py-5">
          <div class="p-5 my-5" style="background: rgba(33, 30, 28, 0.7)">
            <h1 class="text-white text-center mb-4">Make Appointment</h1>

            <div class="form-row">
              <div class="col-sm-6">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control bg-transparent p-4"
                    :class="booking.name==''?'field-null' :'field-not-null' "
                    placeholder="Your Name"
                    required="required"
                    v-model="booking.name"
                  />
                  <small class="text-danger" v-if="errors.name">{{
                    errors.name[0]
                  }}</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input
                    type="email"
                    class="form-control bg-transparent p-4"
                    :class="booking.email==''?'field-null' :'field-not-null' "
                    placeholder="Your Email"
                    required="required"
                    v-model="booking.email"
                  />
                  <small class="text-danger" v-if="errors.email">{{
                    errors.email[0]
                  }}</small>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-6">
                <div class="form-group">
                  <input
                    type="phone"
                    class="form-control bg-transparent p-4"
                    :class="booking.mobile==''?'field-null' :'field-not-null' "
                    placeholder="Your Mobile"
                    required="required"
                    v-model="booking.mobile"
                  /><small class="text-danger" v-if="errors.mobile">{{
                    errors.mobile[0]
                  }}</small>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <input
                    type="date"
                    class="form-control bg-transparent p-4 "
                    :class="booking.date==''?'field-null' :'field-not-null' "
                    placeholder="date"
                    name="date"
                    required="required"
                    v-model="booking.date"
                  />
                  <small class="text-danger" v-if="errors.date">{{
                    errors.date[0]
                  }}</small>
                </div>
              </div>
            </div>
            <div class="form-row test" >
              <div class="col-sm-6">
                <div class="form-group">
                  <select
                    class="form-control custom-select bg-transparent px-4"
                    :class="booking.service_id==''?'field-null' :'field-not-null' "
                    style="height: 47px"
                    name="service_id"
                    v-model="booking.service_id"
                  >
                    <option value="">Select Service</option>
                    <option
                      v-for="service in services"
                      :key="service.id"
                      v-bind:value="service.id"
                    >
                      {{ service.name }}
                    </option>
                  </select>
                  <small class="text-danger" v-if="errors.service_id">{{
                    errors.service_id[0]
                  }}</small>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <select
                    class="form-control custom-select bg-transparent px-4 "
                    :class="booking.employee_id==''?'field-null' :'field-not-null' "
                    style="height: 47px"
                    name="employee_id"
               
                    v-model="booking.employee_id"
                  >
                    <option value="">Select Employee</option>
                    <option
                      v-for="employee in employees"
                      :key="employee.id"
                      v-bind:value="employee.id"
                    >
                      {{ employee.name }}
                    </option>
                  </select>
                  <small class="text-danger" v-if="errors.employee_id">{{
                    errors.employee_id[0]
                  }}</small>
                </div>
              </div>
            </div>


<!-- radio buttons  -->


            <div class="form-row">
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="10:00am"
                  id="ten"
                  value="10:00am"
                  v-model="booking.time"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="ten"
                  >10:00 am</label
                >
              </div>
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="11.00"
                  id="11"
                  value="11:00am"
                  v-model="booking.time"
                  autocomplete="off"
                /><label class="btn btn-outline-primary" for="11"
                  >11:00 am</label
                >
              </div>
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="12.00"
                  id="12"
                  value="12"
                  v-model="booking.time"
                  autocomplete="off"
                /><label class="btn btn-outline-primary" for="12"
                  >12:00 pm</label
                >
              </div>
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="13"
                  v-model="booking.time"
                  id="13"
                  value="13"
                  autocomplete="off"
                /><label class="btn btn-outline-primary" for="13"
                  >13:00 pm</label
                >
              </div>
            </div>
            <div class="form-row">
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="14"
                  v-model="booking.time"
                  id="14"
                  value="14"
                  autocomplete="off"
                /><label class="btn btn-outline-primary" for="14"
                  >14:00 pm</label
                >
              </div>
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="15"
                  v-model="booking.time"
                  id="15"
                  value="15"
                  autocomplete="off"
                /><label class="btn btn-outline-primary" for="15"
                  >15:00 pm</label
                >
              </div>
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="16"
                  v-model="booking.time"
                  id="16"
                  value="16"
                  autocomplete="off"
                /><label class="btn btn-outline-primary" for="16"
                  >16:00 pm</label
                >
              </div>
              <div class="col" align="center">
                <input
                  type="radio"
                  class="btn btn-check"
                  name="17"
                  v-model="booking.time"
                  id="17"
                  value="17"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="17">17:00pm</label>
              </div>
            </div>


<!-- radio buttons ends -->

            <div class="form-row">
              <div class="col" align="center">
                <button
                  class="btn btn-bg btn-block mt-3"
                  @click="addBooking()"
                  style="height: 47px; width: 200px"
                >
                  Make Appointment
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      toastTitle: "Booking Added",
      services: {},
      employees: {},
      errors: {},
      booking: {
        id: "",
        name: "",
        email: "",
        mobile: "",
        service_id: "",
        employee_id: "",
        date: "",
        time: [],
      },
    };
  },
  created() {
    this.getService();
    this.getEmployees();
  },
  methods: {
    getService() {
      axios.get("get-service").then((response) => {
        this.services = response.data;
      });
    },
    getEmployees() {
      axios.get("get-employees").then((response) => {
        this.employees = response.data;
      });
    },
    addBooking() {


if(this.booking.time.length==0){

   Toast.fire({
              icon: "warning",
              title: 'Please select a time slot',
            });

return false;
}



      this.loading = true;
      axios
        .post("new-booking", this.booking)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });

            this.clear_form_data();
            bus.$emit("booking-added");
          }
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.errors = err.response.data.errors;
        });
    },

    clear_form_data() {
      for (let item in this.booking) {
        this.booking[item] = "";
      }

      this.booking.time = [];

      for (let err in this.errors) {
        this.errors[err] = "";
      }
    },
  },
};
</script>

<style scoped>
.btn-outline-primary {
  color: white;
}
.btn-outline-primary {
  background-color: #f9a392;
}

.btn-check {
  opacity: 0;
}

label {
  display: block;
  width: 96px;
  font-size: 15px;
}

input[type="radio"]:checked + label {
  background-color: #aa4430;
  color: white;
}

.field-not-null {
  color: #aa4430;
}
.field-null {
  color: #f9a392 !important;
}

.field-null::placeholder{
  color: #f9a392 !important;
}


.btn-bg{
  background-color: #0d0908;
}

.btn-bg:hover{
color: rgb(250, 250, 250)
}

</style>
