<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_image_modal"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="card-body">
          <div class="row">
            <div class="imageBox mx-auto">
              <div class="card">
                <img
                  :src="url"
                  class="card-img-top"
                  alt="default image not found"
                />
                <div class="card-body text-center">
                  <input
                    type="file"
                    ref="chooseImage"
                    class="hideInputFile"
                    name="image"
                    @change="selectImage($event)"
                  />
                  <button
                    class="btn btn-primary"
                    @click="chooseImage()"
                    type="button"
                  >
                    Choose Image
                  </button>
                </div>
              </div>

              <div class="text-center">
                <span class="text-danger"> {{ image_errors }} </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="submit"
          class="btn btn-primary rounded-pill"
          :disabled="loading || image_errors != ''"
          @click="addImage()"
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
      title: "Add Image",
      toastTitle: "Image added successfully",
      errors: {},
      url: "/images/nofilechoosen.png",
      loading: false,
      image_errors: "",
upload:{
      item_id: "",
      type: "",
      image: "",
      }
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
    var _this = this;

    bus.$on("add-image", function (item) {
      _this.upload.item_id = item.item_id;
      _this.upload.type = item.type;
    });
  },

  methods: {
    chooseImage() {
      this.$refs.chooseImage.click();
      this.image_errors = "";
    },
    selectImage(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);

      var vm = this;

      vm.image_errors = "";

      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        vm.image_errors = "Size must not exceed 200 kb.";
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
          if (height < 320 || (height > 350 && width < 520) || width > 550) {
            vm.image_errors = "Image has invalid image dimension";

            return false;
          } else {
            vm.upload.image = e.target.files[0];
          }
        };
      };
    },

    addImage() {
      if (this.upload.image == "") {
        this.image_errors = "this field required";
        return false;
      }

      let upload = new FormData();
      upload.append("image", this.upload.image);
      upload.append("item_id", this.upload.item_id);
      upload.append("type", this.upload.type);

      this.loading = true;

      axios
        .post("add-image", upload)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("image-added");
            this.$refs.close_image_modal.click();
            this.clearFormData();
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });

            bus.$emit("image-added");
            this.$refs.close_image_modal.click();
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
      this.upload.image = "";
      this.upload.item_id = "";
      this.upload.type = "";
      this.url = "/images/nofilechoosen.png";
    },
  },
};
</script>
<style scoped>
.hideInputFile {
  display: none;
}

.card-img-top {
  max-width: 450px;
  max-height: 300px;
}
</style>