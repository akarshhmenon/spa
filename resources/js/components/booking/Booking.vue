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
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control bg-transparent p-4"
                      placeholder="Your Email"
                      required="required"
                    />
                  </div>
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
                    />
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <select
                      class="custom-select bg-transparent px-4"
                      style="height: 47px"
                    >
                      <option selected>Select A Service</option>
                      <option value="1">Service 1</option>
                      <option value="2">Service 1</option>
                      <option value="3">Service 1</option>
                    </select>
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
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <select
                      class="custom-select bg-transparent px-4"
                      style="height: 47px"
                    >
                      <option selected>Select Employ</option>
                      <option value="1">Employ -1</option>
                      <option value="2">Employ-2</option>
                      <option value="3">employ-3</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-row">
                 <label class="btn btn-outline-primary  control-label" for="options"> 10:00 am</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="option"
                  id="options"
                  autocomplete="off"
                  
                />
                <label class="btn btn-outline-primary" for="option">11:00 am</label>
                 <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option"
                  autocomplete="off"
                  
                />
                <label class="btn btn-outline-primary" for="option">12:00 pm</label>
                 <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option"
                  autocomplete="off"
                  
                />
                <label class="btn btn-outline-primary" for="option1">13:00 pm</label>
                 <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  
                />
               
              </div>
            <div class="form-row">
                 <label class="btn btn-outline-primary" for="option1">14:00 pm</label>
                <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  
                />
                <label class="btn btn-outline-primary" for="option1">15:00 pm</label>
                 <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  
                />
                <label class="btn btn-outline-primary" for="option1">16:00 pm</label>
                 <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  
                />
                <label class="btn btn-outline-primary" for="option1">17:00pm</label>
                 <input
                  type="radio"
                  class="btn btn-check"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  
                />
               
              </div>


              <div class="col-sm-6">
                <button
                  class="btn btn-primary btn-block"
                  type="submit"
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
export default {};
     
</script>

<style scoped>
.btn-outline-primary{
 
  color:white;
}
.btn-outline-primary{
  background-color: #F9A392;
}

.btn-check {
 opacity: 0;
    

   
}

/* input:checked {
   background-color:rgb(34, 94, 224); 
} */

input:focus + label
{
    background-color: #d82626;
    color:white;
}

</style>
