<template>
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
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
        <h5 class="m-0 font-weight-bold text-dark">Expense Categories</h5>

        <button
          type="button"
          class="btn btn-primary rounded-pill"
          data-toggle="modal"
          data-target="#addexpensecategory"
          id="#myBtn"
        >
          Add Expense Category<i class="fas fa-plus-circle fa-fw"></i>
        </button>
      </div>
      <div class="table-responsive p-3">
        <table
          class="table align-items-center table-flush table-hover"
          id="expensecategoryTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>

              <th>Name</th>
             
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="(expensecategory, index) in expensecategories"
              :key="expensecategory.id"
            >
              <td>{{ index + 1 }}</td>
              <td>{{ expensecategory.name }}</td>
             

              <td>
                <button
                  type="button"
                    class="btn btn-sm btn-primary"
                  name=""
                  data-toggle="modal"
                  data-target="#editexpensecategory"
                  @click="editExpenseCategory(expensecategory)"
                >
                  <i class="fas fa-edit fa-fw"></i>
                </button>

                <button type="button" class="btn btn-sm btn-danger" name="" @click="deleteExpenseCategory(expensecategory)">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- modal -->
    <div
      class="modal fade"
      id="addexpensecategory"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-expense-category></add-expense-category>
        </div>
      </div>
    </div>

    <!-- end modal -->

    <!-- edit modal  -->
    <div
      class="modal fade"
      id="editexpensecategory"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-expense-category :edit="true"></add-expense-category>
        </div>
      </div>
    </div>
    <!-- end modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      expensecategories: {},
    };
  },
  created() {
    this.getExpenseCategories();
    var _this = this;
    bus.$on("expensecategory-added", function () {
      _this.getExpenseCategories();
    });
  },

  methods: {
    getExpenseCategories() {
      axios
        .get("/admin/get-expense-categories")
        .then((res) => {
          this.expensecategories = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    deleteExpenseCategory(expensecategory) {
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
            .post("/admin/delete-expense-category", {
              id: expensecategory.id,
            })
            .then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getExpenseCategories();
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

    editExpenseCategory(expensecategory) {
      bus.$emit("edit-expensecategory", expensecategory);
    },
  },
};
</script>
