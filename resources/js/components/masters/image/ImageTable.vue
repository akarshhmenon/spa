<template>
  <div>
    <pre-loader v-if="preLoader"></pre-loader>
    <div class="main" v-else>
      <div class="col-lg-12">
        <div class="card mb-4 p-3">
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
            <h5 class="m-0 font-weight-bold text-dark">Images</h5>
          </div>

          <div class="text-center mr-5">
            <label for="" class="">Select Item</label>
          </div>

          <div class="input-group mb-3 justify-content-center mt-1">
            <div class="w-50" style="">
              <div class="input-group justify-content-center">
                <!-- search vendor -->

                <multiselect
                  v-model="select_item"
                  placeholder="Search for a item"
                  label="name"
                  :options="item_list"
                  track-by="id"
                  :options-limit="4"
                ></multiselect>

                <!-- search vendor end  -->
              </div>
            </div>
            <div class="input-group-append ml-4">
              <button class="btn btn-sm btn-primary rounded-pill px-3">
                Search <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="card mb-4 p-3">
          <div class="row">
            <div class="col pb-4">
              <button
                type="button"
                class="btn rounded-pill btn-primary float-right "
                data-toggle="modal"
                data-target="#addImage"
              >
                Add Image <i class="fas fa-plus-circle fa-fw"></i>
              </button>
            </div>
          </div>

          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
              <img src="/images/course.jpg" alt="Image" class="img-fluid" />

              <div class="d-flex justify-content-between">
                <span></span>
                <span class="mt-2 text-danger">Remove</span>
              </div>
            </div>
          </div>
        </div>

        <!--------------add-image-Modal---------------->
        <div
          id="addImage"
          class="modal fade"
          tabindex="-1"
          data-backdrop="static"
          role="dialog"
          aria-labelledby="myLargeModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <add-image></add-image>
            </div>
          </div>
        </div>

        <!--------------add-image-Modal---------------->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,
      select_item: [],
      item_list: [],
    };
  },
  created() {},

  methods: {},

  watch: {},
  mounted() {},
};
</script>
