<template>
  <pre-loader v-if="preLoader"></pre-loader>
  <!-- DataTable with Hover -->
  <div class="col-lg-12" v-else>
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
        <h5 class="m-0 font-weight-bold text-dark">bookings</h5>

        <!--FilterButton-->

        <div class="col-md-2 ml-auto">
          <button
            class="btn btn-primary btn-sm float-right rounded-pill"
            @click="showFilter()"
            v-if="search == false"
          >
            Add Filters <i class="fas fa-filter fa-fw"></i>
          </button>
          <button
            class="btn btn-outline-warning btn-sm float-right rounded-pill"
            @click="clearSearch()"
            v-if="search"
          >
            Clear Filters<i class="far fa-times-circle fa-fw"></i>
          </button>
        </div>

        <!--FilterButton end-->
      </div>

      <!-------------------------->
      <div class="" v-if="search">
        <div class="row justify-content-center">
          <div class="" style="">
            <div class="input-group">
              <span class="input-group-text">From</span>
              <input type="Date" class="form-control" v-model="from_date" />
              <span
                class="input-group-text ml-4 px-7"
                style="border-left: 0; border-right: 0"
              >
                To
              </span>
              <input type="Date" class="form-control" v-model="to_date" />
              <button
                class="btn btn-primary btn-sm ml-4 px-7"
                @click="getBookings()"
              >
                Search <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-------------------------->

      <div class="table-responsive p-3">
        <table
          class="table align-items-center table-flush table-hover"
          id="bookingTable"
          ref="bookingTable"
        >
          <thead class="thead-light">
            <tr>
              <th>Index</th>

              <th>Name</th>
              <th>Mobile</th>

              <th>Date</th>
              <th>Service</th>
              <th>Time</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(booking, index) in booking_details" :key="booking.id">
              <td>{{ index + 1 }}</td>
              <td>{{ booking.customer.name }}</td>
              <td>{{ booking.customer.mobile }}</td>
              <td>{{ booking.date | myDate }}</td>
              <td>{{ booking.service.name }}</td>
              <td>{{ booking.time }}:00</td>
              <td>
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  data-toggle="modal"
                  data-target="#addPayment"
                  name=""
                  @click="addPayment(booking)"
                >
                  <i class="fas fa-hand-holding-usd"></i>
                </button>

                <button
                  type="button"
                  class="btn btn-sm btn-danger"
                  data-toggle="modal"
                  data-target="#deletebooking"
                  name=""
                  @click="deleteBooking(booking)"
                >
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
      id="addPayment"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-payment></add-payment>
        </div>
      </div>
    </div>

    <!-- end modal -->
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["user"],
  data() {
    return {
      from_date: "",
      to_date: "",
      search: false,
      preLoader: false,
      booking_details: {},
    };
  },
  created() {
    this.getBookings();
    var _this = this;
    bus.$on("booking-added", function () {
      _this.getBookings();
    });
       bus.$on("payment-added", function () {
      _this.getBookings();
    });
  },

  methods: {
    getBookings() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-bookings", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((res) => {
          this.booking_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    clearSearch() {
      this.from_date = "";
      this.to_date = "";
      this.search = false;
      this.getBookings();
    },

    showFilter() {
      this.search = true;
    },
    addPayment(booking) {
      bus.$emit("add-payment", booking);
    },

    deleteBooking(booking) {
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
            .post("delete-booking", {
              id: booking.id,
              name: booking.name,
              email: booking.email,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getBookings();
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

                this.getBookings();
              }
            });
        }
      });
    },
  },


  watch: {
    booking_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.bookingTable).DataTable({
          pageLength: 10,
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          bSort: false,
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.bookingTable).DataTable({
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      bSort: false,
    });
  },
};
</script>
