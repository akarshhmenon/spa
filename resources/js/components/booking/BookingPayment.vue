<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addcustomerLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_customer_modal"
        @click="clear_form_data()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="card-body">


<h1>hi</h1>


      </div>
    </div>
    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-primary rounded-pill"
        :disabled="loading"
      >
        {{ button_title
        }}<i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Add Payment",
      loading: false,
    };
  },


  methods: {
    clear_form_data() {},
  },
  computed:{
button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Changes";
      }
    },
  },
};
</script>

<style>
</style>