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
              <button
                class="btn btn-sm btn-primary rounded-pill px-3"
                @click="getImages()"
              >
                Search <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="card mb-4 p-3" v-if="image_collection.length != 0">
          <div class="row">
            <div class="col pb-4">
              <button
                type="button"
                class="btn rounded-pill btn-primary float-right"
                data-toggle="modal"
                data-target="#addImage"
                @click="addNewImage()"
              >
                Add Image <i class="fas fa-plus-circle fa-fw"></i>
              </button>
            </div>
          </div>

          <div class="row">
            <div
              class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5"
              v-for="image in image_collection"
              :key="image.id"
            >
              <img
                :src="'/uploads/' + image.image_name"
                alt="Image"
                class="img-fluid"
              />

              <div class="d-flex justify-content-between">
                <span></span>
                <span
                  class="mt-2 text-danger removeSpan"
                  @click="deleteImage(image)"
                  >Remove</span
                >
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
      image_collection: [],
    };
  },
  created() {
    this.getProductAndService();

    var _this = this;
    bus.$on("image-added", function () {
      _this.getImages();
    });
  },

  methods: {
    getProductAndService() {
      axios
        .get("get-product-service")
        .then((response) => {
          this.item_list = response.data;
        })
        .catch((err) => {
          if (err) {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });
          }
        });
    },

    getImages() {
      if (this.select_item.length == 0) {
        Toast.fire({
          icon: "error",
          title: "please select item",
        });
        return false;
      }
      axios
        .get("get-images", {
          params: {
            id: this.select_item.id,
          },
        })
        .then((response) => {
          this.image_collection = response.data;
        })
        .catch((err) => {
          if (err) {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });
          }
        });
    },

    addNewImage() {
      const item = {
        item_id: this.select_item.id,
        type: this.select_item.type,
      };

      bus.$emit("add-image", item);
    },

    deleteImage(image) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("delete-image", {
              id: image.id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getImages();
                Toast.fire({
                  icon: "error",
                  title: "Record Deleted successfully",
                });
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getImages();
              }
            });
        }
      });
    },
  },

  watch: {
    select_item: function () {
     
      if (this.select_item == null) {
        this.image_collection = [];
      }
      if (this.select_item == []) {
        this.image_collection = [];
      }
    },
  },
  mounted() {},
};
</script>
<style scoped>
.removeSpan:hover {
  color: rgb(252, 15, 7);
  font-weight: bold;
  cursor: pointer;
}
</style>