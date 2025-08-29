<x-layout.app>
    <main class="h-full pb-16" id="app">
        <div class="container px-6 mx-auto grid">
            <h2 class="mt-6 mb-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Receipt</h2>
            <button v-if="!is_fetching_members" @click="showMembers" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-top: 20px; width: 150px; margin-bottom: 20px; text-align: center;">Select Member</button>
            <button disabled v-else @click="showMembers" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-top: 20px; width: 150px; margin-bottom: 20px; text-align: center; display: flex; width: 150px; justify-content: center;">
                <span class="loader"></span>
            </button>
        <form @submit="submit">
            <div class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
  <h5 class="dark:text-gray-200" style="margin-bottom: 20px;">Personal Information</h5>

  <div style="display: flex; column-gap: 20px;">
    <!-- Member's Name -->
    <div style="width: 33.33%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Member's name</span>
        <input
          data-message="member_field_message"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="shahmir ahsanullah"
          v-model="member_name"
          readonly
        >
        {{-- <span v-if="errors.errors?.paid_amount?.length ?? null > 0" v-text="errors.errors?.paid_amount[0]" class="member_field_message text-xs text-red-600 dark:text-red-400"></span> --}}
      </label>
    </div>

    <!-- Date of Birth -->
    <div style="width: 33.33%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Paid Amount</span>
        <input
          data-message="date_of_birth_field_message"
          placeholder="Paid Amount field is required"
          type="text"
          @input="onPaidAmountInput"
          :value="formattedPaidAmount"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
        >
        <span v-if="errors.errors?.paid_amount?.length ?? null > 0" v-text="errors.errors?.paid_amount[0]" class="member_field_message text-xs text-red-600 dark:text-red-400"></span>
      </label>
    </div>

    <!-- CNIC/Passport -->
    <div style="width: 33.33%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Reference Number</span>
        <input
          data-message="cnic_field_message"
          v-model="reference_number"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Reference Number"
        >
        <span v-if="errors.errors?.reference_number?.length ?? null > 0" v-text="errors.errors?.reference_number[0]" class="member_field_message text-xs text-red-600 dark:text-red-400"></span>
      </label>
    </div>
  </div>

  <div style="display: flex; column-gap: 20px;">
    <!-- Gender -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Payment Methods</span>
        <select
            v-model="payment_method"
            data-message="gender_field_message"
            class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                      focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                      dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          >
          @foreach($payment_methods as $payment_method)
              <option value="{{ $payment_method->id }}">{{ $payment_method->payment_method }}</option>
          @endforeach
        </select>
        <span class="gender_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Payment Method field is required
        </span>
      </label>
    </div>

    <!-- Marital Status -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Date</span>
        <input
            v-model="date"
            type="date"
          data-message="cnic_field_message"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Date"
        >
        <span class="cnic_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Date field is required
        </span>
        <span v-if="errors.errors?.date?.length ?? null > 0" v-text="errors.errors?.date[0]" class="member_field_message text-xs text-red-600 dark:text-red-400"></span>
      
      </label>
    </div>
  </div>
<button style="width: 70px; height: 30px;" class="relative px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
  <span 
    v-if="is_storing"
    class="loader"
  ></span>
  Save
</button>

</div>
</form>

        </main>
    
 
    <script>
const app = Vue.createApp({
    data() {
        return {
            member_name: "",
            paid_amount: "",
            reference_number: "",
            payment_method: "1",
            date: "",
            selectedId: "",
            errors: [],
            is_storing: false
        }
    },
    watch: {
        async selectedId(newValue) {
            const response = await axios.get(route("api.member.getById", { member: newValue }));
            this.member_name = response.data.member_name;
        }
    },
  computed: {
    formattedPaidAmount() {
      return this.paid_amount
        ? this.paid_amount.toLocaleString('en-US')
        : '';
    },
  },
  methods: {
    onPaidAmountInput(event) {
      // Remove commas and parse as number
      const raw = event.target.value.replace(/,/g, '');
      const num = parseFloat(raw);
      this.paid_amount = isNaN(num) ? 0 : num;
    },
    async submit(e) {
        e.preventDefault();

        this.is_storing = true;
        try {
          const response = await axios.post(
            route("api.member.receipt", { member: this.selectedId }),
              { 
                  paid_amount: this.paid_amount, 
                  reference_number: this.reference_number, 
                  payment_method_id: this.payment_method, 
                  date: this.date 
              }
            );
          if(response.data.status === "200") {
            window.location = route("member.recovery.receipts.get");
          }
        } catch(e) {
          this.errors = e.response.data;
        } finally {
          this.is_storing = false;
        }
        
    },
    select(id) {
        this.selectedId = id;
        Swal.close();
    },
    async showMembers() {
        this.is_fetching_members = true;
        const self = this;
      try {
        const response = await axios.get(route('api.member.all'));
        const members = response.data.data;
        
        let rows = members.map(member => `
          <tr>
            <td>${member.member_name}</td>
            <td>${member.cnic_passport}</td>
            <td>${member.membership_number}</td>
            <td>${member.file_number}</td>
            <td>${member.residential_address}</td>
            <td>
                <button data-member='${member.id}' class="select-member-button px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  Select
                </button>
            </td>
          </tr>
        `).join('');

        Swal.fire({
          title: 'Members List',
          html: `
            <table id="swal-datatable" class="display" style="width:100%; text-align: left; font-size: 13px;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>CNIC</th>
                  <th>Membership #</th>
                  <th>File No</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                ${rows}
              </tbody>
            </table>
          `,
          width: 1000,
          didOpen: () => {
            let table = $('#swal-datatable').DataTable();
            table.on("draw", function() {
                document.querySelectorAll('.select-member-button').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const memberData = JSON.parse(e.currentTarget.getAttribute('data-member'));
                        self.select(memberData);
                    });
                });
            });
              document.querySelectorAll('.select-member-button').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const memberData = JSON.parse(e.currentTarget.getAttribute('data-member'));
                    console.log(memberData);
                    self.select(memberData);
                });
            });
          }
        });
      } catch (error) {
        console.error("Error fetching members:", error);
        Swal.fire('Error', 'Could not load members.', 'error');
      } finally {
        this.is_fetching_members = false;
      }
    }
  }
}).mount("#app");
</script>
</x-layout.app>