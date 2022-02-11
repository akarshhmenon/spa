<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addserviceLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_service_modal"
        @click="clearFormData()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <form
      class="form-horizontal"
      method="POST"
      enctype="multipart/form-data"
      @submit.prevent="addService()"
    >
      <div class="modal-body">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="serviceName" class="required"> Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  placeholder="Enter service Name"
                  v-model="service.name"
                  :disabled="edit"
                />
                <small class="text-danger" v-if="errors.name">{{
                  errors.name[0]
                }}</small>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="description" class="">description</label><small>{{ remaincharactersText }} </small>




                <textarea
                  class="form-control form-height item shadow-sm"
                  name="description"
                  v-model="service.description"
                  @keyup="remaincharCount()"
                >
                </textarea>

                <small class="text-danger" v-if="errors.description">{{
                  errors.description[0]
                }}</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="rate" class="">rate</label>
                <input
                  type="number"
                  class="form-control"
                  name="rate"
                   min="1"
                              oninput="validity.valid||(value='');"
                  placeholder="Enter Rate "
                  v-model="service.rate"
                />
                <small class="text-danger" v-if="errors.rate">{{
                  errors.rate[0]
                }}</small>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="category" class="required">Select category</label>
                <select
                  class="form-control"
                  name="category_id"
                  v-model="service.category_id"
                >
                  <option value="">Select category</option>
                  <option
                    v-for="category in category"
                    :key="category.id"
                    v-bind:value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <small class="text-danger" v-if="errors.category_id">{{
                  errors.category_id[0]
                }}</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Time</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Time period"
                  name="time"
                  v-model="service.time"
                />
                <small class="text-danger" v-if="errors.time">{{
                  errors.time[0]
                }}</small>
              </div>
            </div>
          </div>

          <div class="row" v-if="!this.edit">
            <div class="col">
              <div class="form-group">
                <label>Image</label>
                <input
                  type="file"
                  class="form-control-file"
                  placeholder="image"
                  name="image"
                  @change="selectImage($event)"
                />
                <small class="text-danger">{{ image_error }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button
          type="submit"
          class="btn btn-primary rounded-pill"
          :disabled="loading"
        >
          {{ button_title }}
          <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
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
  props: ["edit"],

  data() {
    return {
      image_error: "",
      title: "Add service",
      toastTitle: "Service added successfully",
      errors: {},

      loading: false,
      category: {},
 maxcharacter: 200,
      mincharecter: 150,
      remaincharactersText: "Min 150 characters.",
      service: {
        id: "",
        name: "",
        type: "service",
        description: "",
        category_id: "",
        time: "",
        rate: "",
        image: "",
      },
    };
  },

  computed: {
    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Changes";
      }
    },
  },
  created() {
    this.getCategory();

    if (this.edit) {
      var _this = this;
      _this.title = "Edit service";
      _this.toastTitle = "Service data Updated successfully";
      bus.$on("edit-service", function (service) {
        _this.clearFormData();
        _this.service.category_id = service.category.id;
        _this.service.id = service.id;
        _this.service.name = service.name;
        _this.service.description = service.description;
        _this.service.time = service.time;
        _this.service.rate = service.mrp;
      });
    }
  },

  methods: {
    //image
    selectImage(e) {
      console.log(e);
      var vm = this;

      vm.image_error = "";
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        vm.image_error = "Size must not exceed 200 kb.";

        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          var height = this.height;
          var width = this.width;
          if (height < 598 || height > 602 && width < 498 || width > 502) {
            vm.image_error = "Invalid image dimension! recomended(500*600)";

            return false;
          } else {
            vm.service.image = e.target.files[0];
          }
        };
      };
    },

    //image ends

    getCategory() {
      axios
        .get("get-categories")
        .then((response) => {
          this.category = response.data;
        })
        .catch((err) => {});
    },

    addService() {
      let upload = new FormData();
      if (this.edit) {
        upload.append("id", this.service.id);
      }
      upload.append("name", this.service.name);
      upload.append("description", this.service.description);
      upload.append("rate", this.service.rate);
      upload.append("time", this.service.time);
      upload.append("category_id", this.service.category_id);
      upload.append("type", this.service.type);
      upload.append("image", this.service.image);
      if (this.service.image == "" && !this.edit) {
        this.image_error = "this field required";
        return false;
      }
      this.loading = true;
      console.log(upload);
      axios
        .post("add-service", upload)
        .then((response) => {
          this.loading = false;
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("service-added");
            this.$refs.close_service_modal.click();
            this.clearFormData();
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });

            bus.$emit("service-added");
            this.$refs.close_service_modal.click();
            this.clearFormData();
          }
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      this.service.name = "";
      this.service.description = "";
      this.service.category_id = "";
      this.service.image = "";
      this.service.rate = "";
      this.service.time = "";
      this.errors = {};
      this.image_error = "";
    },
        remaincharCount() {
      var remainCharacters =
        this.mincharecter - this.service.description.length;
      if (this.service.description.length > this.maxcharacter) {
        this.remaincharactersText = " Exceeded limit. ";
      } else if (this.service.description.length < this.mincharecter) {
        this.remaincharactersText = remainCharacters + " characters needed. ";
      } else {
        this.remaincharactersText = "Max 200 charecters";
      }
    },
  },
};
</script>

<style scoped>
.form-height {
  height: 43px;
}
</style>