<template>
  <div>
    <div class="row p-4">
      <div class="col">
        <div class="form-group">
          <label for="categoryName" class="required">Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="Enter Name"
            name="name"
            v-model="category.name"
          />
        </div>

        <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</small>
      </div>

      <div class="col">
        <div class="form-group">
          <label class="required">Description</label>
          <input
            type="text"
            class="form-control"
            placeholder="Enter Description"
            name="description"
            v-model="category.description"
          />
        </div>

        <small class="text-danger" v-if="errors.description">
          {{ errors.description[0] }}</small
        >
      </div>
    </div>

    <div class="row text-center pb-3">
      <div class="col">
        <button
          type="button"
          @click="addCategory()"
          class="btn btn-primary rounded-pill"
          :disabled="loading"
        >
          {{ button_title
          }}<i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["edit"],
  data() {
    return {
      loading: false,

      button_title: "Add CATEGORY",
      toastTitle: "Added successfully",
      category: {
        id: "",
        name: "",
        description: "",
      },
      errors: {},
    };
  },

  created() {
    var _this = this;
    bus.$on("clear-field", function () {
      _this.clear_form_data();
    });

    if (this.edit) {
      var _this = this;
      bus.$on("edit-category", function (category) {
        _this.category.id = category.id;
        _this.category.name = category.name;
        _this.category.description = category.description;
        _this.button_title = "Update Category";
        _this.toastTitle = "Updated successfully";
      });
    }
  },


  methods: {
    addCategory() {
      this.loading = true;
      axios
        .post("add-category", this.category)
        .then((response) => {
          this.loading = false;
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });

            this.clear_form_data();
            bus.$emit("category-added");
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });
          }
        })
        .catch((err) => {
          this.loading = false;
          if (err) {
            this.loading = false;
            this.errors = err.response.data.errors;
            Toast.fire({
              icon: "error",
              title: "Try Again !",
            });
          }
        });
    },

    clear_form_data() {
      for (let item in this.category) {
        this.category[item] = "";
      }

      for (let err in this.errors) {
        this.errors[err] = "";
      }

      this.button_title = "Add Category";
      this.toastTitle = "Added successfully";
    },
  },
};
</script>

<style scoped>

</style>