<template>
  <div class="container-fluid py-5">
    <div class="container py-5">
      <div class="row mx-0 justify-content-center text-center">
        <div class="col-lg-6">
          <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">
            Appointment
          </h6>
        </div>
      </div>
      <div class="row justify-content-center bg-appointment mx-0">
        <div class="col-lg-6 py-5">
          <div class="p-5 my-5" style="background: rgba(33, 30, 28, 0.7)">
            <h1 class="text-white text-center mb-4">Make Appointment</h1>
            <form>
              <div class="form-row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control bg-transparent p-4"
                      placeholder="Your Name"
                      required="required"
                      v-model="booking.name"
                    />
                  </div>
                   <small class="text-danger" v-if="errors.name">{{
                  errors.name[0]
                }}</small>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control bg-transparent p-4"
                      placeholder="Your Email"
                      required="required"
                      v-model="booking.email"
                    />
                  </div>
                   <small class="text-danger" v-if="errors.email">{{
                  errors.email[0]}}</small>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input
                      type="phone"
                      class="form-control bg-transparent p-4"
                      placeholder="Your Mobile"
                      required="required"
                      v-model="booking.mobile"
                      
                    />
                  </div>
                  <small class="text-danger" v-if="errors.mobile">{{
                  errors.mobile[0]}}</small>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <select
                      class="custom-select bg-transparent px-4"
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
                  errors.service_id[0]}}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input
                      type="date"
                      class="form-control bg-transparent p-4"
                      placeholder="date"
                      required="required"
                      v-model="booking.date"
                    />
                  </div>
                  <small class="text-danger" v-if="errors.date">{{
                  errors.date[0]}}</small>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <select
                      class="custom-select bg-transparent px-4"
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
                  errors.employee_id[0]}}</small>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <label class="btn btn-outline-primary" for="ten">10:00 am</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="10:00am"
                  id="ten"
                  value="10:00am"
                  v-model="booking.time"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="11">11:00 am</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="11.00"
                  id="11"
                  value="11:00am"
                  v-model="booking.time"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="12">12:00 pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="12.00"
                  id="12"
                  value="12"
                  v-model="booking.time"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="13">13:00 pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="13"
                  v-model="booking.time"
                  id="13"
                  value="13"
                  autocomplete="off"
                />
              </div>
              <div class="form-row">
                <label class="btn btn-outline-primary" for="14">14:00 pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="14"
                  v-model="booking.time"
                  id="14"
                  value="14"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="15">15:00 pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="15"
                  v-model="booking.time"
                  id="15"
                  value="15"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="16">16:00 pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="16"
                  v-model="booking.time"
                  id="16"
                  value="16"
                  autocomplete="off"
                />
                <label class="btn btn-outline-primary" for="17">17:00pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="17"
                  v-model="booking.time"
                  id="17"
                  value="17"
                  autocomplete="off"
                />
              </div>

              <div class="col-sm-6">
                <button
                  class="btn btn-primary btn-block"
                  @click="newBooking()"
                  style="height: 47px; width: 200px; margin-left: 120px; margin-top: 30px"
                >
                  Make Appointment
                </button>
              </div>
            </form>
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
      axios.get("get-service").then((response)=>{
        this.services=response.data
        
      });
    },
    getEmployees() {
      axios.get("get-employees").then((response)=>
      {this.employees=response.data});
    },
    newBooking() {

      this.loading = true;
      axios.post("new-booking", this.booking).then((response)=>{
        console.log('success');
      });
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
  opacity: 1;
}

/* input:checked {
   background-color:rgb(34, 94, 224); 
} */

/* 
input:focus + label {
  background-color: #d82626;
  color: white;
} */

</style>
