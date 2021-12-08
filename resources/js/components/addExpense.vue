<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addExpenseLabel">
        {{ "Expense" }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_expense_modal"
        @click="clearExpenseData()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="card-body">
<div class="row">

<div class="col">
 <div class="form-group">
          <label for="expensecategory" class="required">Select Expense Category</label>

          <!-- saleitem search component-->

          <model-list-select
            :list="this.expenseCategories"
            v-model="expense.expense_category_id"
            option-value="id"
            :custom-text="expenseCategoryName"
            placeholder="select Expense Category"
            name="expense_category_id"
          >
          </model-list-select>

          <!-- saleitem search component end-->
          <small class="text-danger" v-if="errors.expense_category_id">
            {{ "The Expense Category name field is required" }}</small
          >
        </div>
</div>

<div class="col">
 <div class="form-group">
          <label for="date" class="required">Select Date</label>
          <input
            type="date"
            class="form-control"
            name="date"
            v-model="expense.date"
          />
          <small class="text-danger" v-if="errors.date">
              {{ errors.date[0] }}</small
          >
        </div>

</div>

</div>

<div class="row">
<div class="col">
     <div class="form-group">
          <label for="paytype" class="required">Select Pay Type</label>
          <select
            class="form-control"
            id="expensePaytype"
            name="expense_pay_type"
            v-model="expense.pay_type"
          >
            <option value="">Select Pay Type</option>
            <option value="Cash">Cash</option>
            <option value="Bank">Bank</option>
          </select>
          <small class="text-danger" v-if="errors.pay_type">
            {{ "The Payment Type field is required" }}</small
          >
        </div>
</div>

<div class="col">
 <div class="form-group">
          <label for="amount" class="required">Enter Amount</label>
          <input
            type="number"
            class="form-control"
            id="expenseAmount"
            placeholder="Enter Amount"
            name="expense_amount"
            v-model="expense.amount"
          />
          <small class="text-danger" v-if="errors.amount">
            {{ "The Expense Amount field is required" }}</small
          >
        </div>
</div>
</div>

<div class="row">
<div class="col">
<div class="form-group">
          <label for="remarks" class="required">Enter Remarks</label>
          <input
            type="text"
            class="form-control"
            id="expenseRemarks"
            placeholder="Enter Remarks"
            name="expense_remarks"
            v-model="expense.remarks"
          />
          <small class="text-danger" v-if="errors.remarks">
             {{ "The Expense remarks field is required" }}</small
          >
        </div>
</div>
</div>




      </div>
    </div>
    <div class="modal-footer">
      <button
        type="submit"
        class="btn btn-primary rounded-pill"
        @click="addExpense"
            :disabled=loading
      >
         {{ button_title }} <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
    <!-- </form>-->
  </div>
</template>
<script>
import { ModelListSelect } from "vue-search-select";
import moment from "moment";
export default {

    props: ["edit"],

  components: {
    ModelListSelect,
  },

  data() {
    return {
loading:false,

      expenseCategories: [],
      toastTitle: "Expense added successfully",

      expense: {
        id: "",
        expense_category_id: "",
date:moment().format("YYYY-MM-DD"),
        amount: "",
        pay_type:"",
        remarks:""
      },
      errors: {},
    };
  },

  created() {
      if (this.edit) {
      var _this = this;


      _this.toastTitle = "Expense updated successfully";
      bus.$on("edit-expense", function (expense) {
console.log(expense);
        _this.clearExpenseData();
        _this.expense.id = expense.id;
        _this.expense.expense_category_id = expense.expense_category_id;
 _this.expense.date = moment(expense.created_at).format("YYYY-MM-DD");
        _this.expense.amount = expense.amount;
        _this.expense.pay_type = expense.pay_type;
        _this.expense.remarks = expense.remarks;


      });
    }
    this.getExpenseCategories();
  },

  methods: {
    getExpenseCategories() {
      axios
        .get("get-expense-categories")
        .then((response) => {
          this.expenseCategories = response.data;
        })
        .catch((err) => {
          console.log(" errors in expensecategories".err);
        });
    },

    expenseCategoryName(item) {
      return `${item.name}`;
    },

    addExpense() {
this.loading=true;
      axios
        .post("add-expense", this.expense)
        .then((response) => {
          if (response.data == "success") {

            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("expense-added");
            this.$refs.close_expense_modal.click();
            this.clearExpenseData();
          }
this.loading=false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
this.loading=false;
          console.log("errors");
        });
    },

    clearExpenseData() {
      this.expense.expense_category_id = "";
      this.expense.remarks = "";
      this.expense.pay_type = "";
      this.expense.amount = "";
      this.errors = {};
    },
  },

  watch: {},
  computed: {
    button_title () {
      if (this.loading == true) {
        return 'Saving  ';
      }else{
 return 'Save Changes';
      }
    },
  },
};
</script>
