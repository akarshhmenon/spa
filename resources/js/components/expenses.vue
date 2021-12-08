<template>
  <div class="main">
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
          <h5 class="m-0 font-weight-bold text-dark">Expenses</h5>

          <button
            type="button"
            class="btn btn-primary rounded-pill"
            data-toggle="modal"
            data-target="#addExpense"
          >
            Add Expenses <i class="fas fa-plus-circle fa-fw"></i>
          </button>
        </div>
        <div class="table-responsive p-3">
          <table
            class="table align-items-center table-flush table-hover display"
            id="expensesTable"
            ref="expensesTable"
            data-order='[[ 0, "desc" ]]'
          >
            <thead class="thead-light">
              <tr>
                <th>S/N</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Pay Type</th>
                <th>Remarks</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S/N</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Pay Type</th>
                <th>Remarks</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr  v-for="(expense, index) in expenses"
              :key="expense.id">
                <td>{{ index+1 }}</td>

                <td>{{ expense.expensecategory.name }}</td>
                <td>{{ expense.amount }}</td>
                <td>{{ expense.pay_type }}</td>
                <td>{{ expense.remarks }}</td>

                <td class="pl-3">

                    <button
                  type="button"
                    class="btn btn-sm btn-primary"
                  name=""
                  data-toggle="modal"
                  data-target="#editExpense"
                  @click="editExpense(expense)"
                >
                  <i class="fas fa-edit fa-fw"></i>
                </button>
                  <button
                    class="btn btn-danger btn-sm ml-1"
                    @click="deleteExpense(expense)"
                  >
                    <i class="fas fa-trash fafw" title="Move to trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- add product modal -->

      <div
        id="addExpense"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <add-expense></add-expense>
          </div>
        </div>
      </div>


    </div>
    <!-- edit modal  -->
    <div
      class="modal fade"
      id="editExpense"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-expense :edit="true"></add-expense>
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
      expenses: {},
    };
  },

  methods: {
    getExpenses() {
      axios
        .get("get-today-expenses")
        .then((response) => {
          this.expenses = response.data;
        })
        .catch((err) => {});
    },

    editExpense(expense) {
      bus.$emit("edit-expense", expense);
    },

    deleteExpense(expense) {
      Swal.fire({
        title: "Are you sure?",
        // text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("delete-expense", {
              id: expense.id,
            })
            .then((response) => {
            if (response.data == "Success") {
              this.getExpenses();
              Toast.fire({
                icon: "error",
                title: "Record Deleted successfully",
              });
            }
          });
        }
      });
    },
  },

  created() {
    this.getExpenses();

    var _this = this;
    bus.$on("expense-added", function () {
      _this.getExpenses();
    });
  },

  watch: {

  },

  mounted() {

  },
};
</script>
