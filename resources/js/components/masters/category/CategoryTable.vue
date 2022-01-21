<template>
  <div>
    <pre-loader v-if="preLoader"></pre-loader>

    <div class="main-div">
      <div class="col-lg-12 add-category" v-show="showAddCard">
        <div class="card mb-4">
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
            <h5 class="m-0 font-weight-bold text-dark">{{ card_title }}</h5>

            <button
              type="button"
              class="btn btn-primary rounded-pill"
              @click="showTableComponent()"
            >
              Category Table<i class="fas fa-table fa-fw"></i>
            </button>
          </div>
          <!-- add designation component  -->
          <add-category :edit="showEdit"> </add-category>
          <!-- add designation component  end -->
        </div>
      </div>

      <div class="col-lg-12" v-if="showTable">
        <div class="card mb-4">
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
            <h5 class="m-0 font-weight-bold text-dark">Categories</h5>

            <button
              type="button"
              class="btn btn-primary rounded-pill"
              @click="showAddComponent()"
            >
              Add Category<i class="fas fa-plus-circle fa-fw"></i>
            </button>
          </div>
          <div class="table-responsive p-3">
            <table
              class="table align-items-center table-flush table-hover"
              id="categoryTable"
              ref="categoryTable"
            >
              <thead class="thead-light">
                <tr>
                  <th>Index</th>

                  <th>Name</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  v-for="(category, index) in category_details"
                  :key="category.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ category.name }}</td>
                  <td>{{ category.description }}</td>
                 

                  <td>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      @click="editCategory(category)"
                    >
                      <i class="fas fa-edit fa-fw"></i>
                    </button>

                    <button
                      type="button"
                      class="btn btn-sm btn-danger"
                      name=""
                      @click="deleteCategory(category)"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
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
      card_title: "",
      category_details: {},
      errors: {},
      edit: false,
      showTable: true,
      showEdit: true,
      showAddCard: false,
    };
  },
  created() {
    this.getCategories();
    var _this = this;
    bus.$on("category-added", function () {
      _this.showAddCard = false;
      _this.showTable = true;
      _this.showEdit = true;
      _this.getCategories();
    });
  },

  methods: {
    getCategories() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-categories")
        .then((res) => {
          this.category_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deleteCategory(category) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("delete-category", {
              id: category.id,
            })
            .then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getCategories();
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getCategories();
              }
            })
            .catch((err) => {
              Toast.fire({
                icon: "error",
                title: "Request failed ",
              });
            });
        }
      });
    },

    editCategory(category) {
      this.card_title = "Edit Category";
      this.showAddCard = true;
      this.showTable = false;
      bus.$emit("edit-category", category);
    },
    showAddComponent() {
      this.card_title = "Add Category";
      this.showAddCard = true;
      this.showTable = false;
      this.showEdit = false;
    },

    showTableComponent() {
      bus.$emit("clear-field");
      this.card_title = "";
      this.showAddCard = false;
      this.showTable = true;
      this.showEdit = true;
    },
  },

  watch: {
    category_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.categoryTable).DataTable({
          pageLength: 5,
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
          bSort: false,
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.categoryTable).DataTable({
    pageLength: 5,
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
      bSort: false,
    });
  },
};
</script>
<style scoped>

</style>