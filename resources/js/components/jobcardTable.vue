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


          "
        >
          <h5 class="m-0 font-weight-bold text-dark">Jobcards</h5>

<div class="ml-3 ">
<button class="btn btn-outline-primary rounded btn-sm shadow-sm ">Pending Jobcards - Completion <i class="fas fa-hourglass-half fa-fw"></i></button>
<button class="btn btn-outline-primary rounded btn-sm shadow-sm">Pending Delivery <i class="fas fa-truck-loading fa-fw"></i></button>
</div>

<button
            type="button"
            class="btn rounded-pill btn-primary ml-auto "
            data-toggle="modal"
            data-target="#addJobcard"
          >
            Add Jobcard <i class="fas fa-plus-circle fa-fw"></i>
          </button>
        </div>

        <div class="table-responsive p-3">

          <table
            class="table align-items-center table-flush table-hover display table-sm"
            id="jobcardTable"
            ref="jobcardTable"
            data-order=""
          >

            <thead class="thead-light">
              <tr>
                <th>Index</th>
                <th>Date</th>
                <th>Jobcard No</th>
                <th>Customer Name</th>
                <th>Vehicle</th>
                <th>Reg No</th>
                <th >Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Index</th>
                <th>Date</th>
                <th>Jobcard No</th>
                <th>Customer Name</th>
                <th>Vehicle</th>
                <th>Reg No</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr >
                <td>{{ 'index + 1 '}}</td>
 <td>{{ "005" }}</td>
                <td>{{ "11-11-21" }}</td>
                <td>{{ "Anurag" }}</td>
                <td>{{ " Yamaha Fz" }}</td>
 <td>{{ "kl 57 l 007" }}</td>


                <td class="">
                  <button
                    class="btn btn-warning btn-xs"
                    data-toggle="modal"
                    data-target="#"
                  >
                    <i class="fas fa-edit " title="Edit"></i>
                  </button>

                  <button class="btn btn-info btn-xs">
                   <i class="fas fa-print" title="print jobcard"></i>
                  </button>



 <button class="btn btn-success btn-xs">
                    <i class="fas fa-check" title="completed"></i>
                  </button>

<button class="btn btn-dark btn-xs">
                    <i class="fas fa-file-invoice" title="print receipt"></i>

                  </button>



                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>


<div
        id="addJobcard"
        class="modal fade"
        tabindex="-1"
        data-backdrop="static"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <add-jobcard></add-jobcard>
          </div>
        </div>
      </div>







    </div>
  </div>
</template>

<script>
import addJobcard from './addJobcard.vue';
export default {
  components: { addJobcard },
  data() {
    return {
      jobcardsData: {},
    };
  },

  methods: {
    getJobcards() {
      axios
        .get("get-jobcards")
        .then((response) => {
          this.jobcardsData = response.data;
        })
        .catch((err) => {});
    },
  },

  created() {
    this.getJobcards();
  },

  watch: {
    jobcardsData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.jobcardTable).DataTable({
          pageLength: 10,
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.jobcardTable).DataTable({
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
    });
  },
};
</script>
<style scoped>
.btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>
