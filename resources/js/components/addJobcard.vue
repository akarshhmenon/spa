<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addProductLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_product_modal"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <form
      class="form-horizontal"
      method="POST"
      enctype="multipart/form-data"
    >
      <div class="modal-body">
        <div class="card-body">
<div class="row">
<div class="col">
<div class="form-group">
              <label for="customer" class="required">Select Customer</label>
              <select
                class="form-control"
                name="customer"

              >
                <option value="">Select Customer</option>
 <option>
Customer1
                </option>
                <option>
Customer2
                </option>
              </select>
              <small class="text-danger"></small>

            </div>
</div>
</div>
<div class="row">

<div class="col">
<div class="form-group">
              <label for="location">Location</label>
              <input
                type="text"
                class="form-control"
                placeholder="Enter Location"
              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>

<div class="col">
<div class="form-group">
              <label for="location">Mobile Number</label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Mobile Number"
              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>

<div class="col">
<div class="form-group">
              <label for="location">Vehicle</label>
              <input
                type="text"
                class="form-control"
                placeholder="Enter Vehicle Name"
              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>

</div><!--row end-->

<div class="row">



<div class="col">
<div class="form-group">
              <label for="location">Register Number</label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Register Number"
              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>

<div class="col">
<div class="form-group">
              <label for="location">Chasis Number</label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Chasis Number"
              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>


<div class="col">
<div class="form-group">
              <label for="location">Odometer Reading</label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Odometer Reading"
              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>

</div><!--row end-->


<div class="row">

<div class="col">
  <div class="form-group">
              <label for="customer" class="required">Select Job Advisor</label>
              <select
                class="form-control"
                name="customer"

              >
                <option value="">Select Job Advisor</option>
 <option>
advisor1
                </option>
                <option>
advisor2
                </option>
              </select>
              <small class="text-danger"></small>

            </div>
</div>


<div class="col">
  <div class="form-group">
              <label for="customer" class="required">Select Technician</label>
              <select
                class="form-control"
                name="customer"

              >
                <option value="">Select Technician</option>
 <option>
Technician1
                </option>
                <option>
Technician2
                </option>
              </select>
              <small class="text-danger"></small>

            </div>
</div>


<div class="col">
<div class="form-group">
              <label for="location">Expected Delivery Date</label>
              <input
                type="date"
                class="form-control"

              />
              <small class="text-danger" >
               </small
              >
            </div>
</div>

</div><!--row end-->




<div class="row">


<div class="col">
<div class="form-group">
              <label for="location">Customer Voice</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              <small class="text-danger" >
               </small
              >
            </div>
</div>




</div><!--row end-->
<div class="row">


<div class="col">
<div class="form-group">
              <label for="location">Technician Voice</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              <small class="text-danger" >
               </small
              >
            </div>
</div>




</div><!--row end-->


        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary rounded-pill">
          {{' Save Changes' }}

        </button>
      </div>
    </form>
  </div>
</template>
<script>
import { ModelListSelect } from "vue-search-select";
export default {
  components: {
    ModelListSelect,
  },

  data() {
    return {
title:'Add Jobcard',



    };
  },

  computed: {

  },
  created() {


  },

  methods: {

  },
};
</script>
