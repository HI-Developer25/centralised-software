<x-layout.app>
    <style>
        .recovery-row:nth-child(2n) {
            background: #f0f0f0;
        }
        input:read-only {
            background: #f5f5f5;
            cursor: not-allowed;
        }
        input:disabled {
            background: #f5f5f5;
        }
    </style>
    <main class="h-full pb-16" id="app" style="overflow: auto;">
        <div class="container px-6 mx-auto grid">
            <h2 class="mt-6 mb-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">View Payment Schedule</h2>
            <button v-if="!is_fetching_members" @click="showMembers" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-top: 20px; width: 150px; margin-bottom: 20px; text-align: center;">Select Member</button>
            <button disabled v-else @click="showMembers" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-top: 20px; width: 150px; margin-bottom: 20px; text-align: center; display: flex; width: 150px; justify-content: center;">
                <span class="loader"></span>
            </button>
            <div v-if="is_fetching_sheet" class="loading-panel" style="display: flex; justify-content: center;">
                <span class="loader big purple" style="margin: auto;"></span>
            </div>
            <div v-show="!is_fetching_sheet" class="member-info" v-if="member.id">
                <button @click="getSheet(member.id)" style="margin-bottom: 10px; margin-top: 10px; margin-right: 10px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Print
                </button>
                <button @click="copyURL(member.user_token)" style="margin-bottom: 10px; margin-top: 10px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span v-if="!is_copied">Copy URL <sub>(Save before copying URL)</sub></span>
                    <span v-else>Copied</span>
                </button>
                <div class="container px-6 mx-auto grid mx-6" style="border-radius: 10px; background: white;">
                    <table style="color: white;">
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member Name: <span v-text="member.member_name"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member File No: <span v-text="member.file_number"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Membership Number: <span v-text="member.membership_number"></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member CNIC: <span v-text="member.cnic_passport"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member Phone No: <span v-text="member.phone_number"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Alt Phone No <span v-text="member.alternate_ph_number"></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member Address: <span v-text="member.residential_address"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="container px-6 mx-auto grid mx-6" style="margin-top: 20px; border-radius: 10px; background: white;">
                    <table style="color: white;">
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Membership Type: <span v-text="member.membership.card_name"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Form Fee: <span v-text="member.form_fee.toLocaleString()"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Processing Fee: <span v-text="member.processing_fee.toLocaleString()"></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">First Payment: <span v-text="member.first_payment.toLocaleString()"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Total Installment: <span v-text="member.total_installment.toLocaleString()"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Months: <span v-text="member.installment_month"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div v-show="!is_fetching_sheet" class="member-installment" style="margin-top: 20px; border-radius: 10px;" v-if="member.id">
                <div class="container grid" style="border-radius: 10px;">
                    <table class="w-full whitespace-no-wrap" style="margin-right: 20px;">
                <thead>
                    <tr style="font-size: 10px;" class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Month</th>
                    <th class="px-4 py-3">Due <br> Amount</th>
                    <th class="px-4 py-3">Due <br> Date</th>
                    <th class="px-4 py-3">Payment <br> Description</th>
                    <th class="px-4 py-3">Current <br> Month <br> Payable</th>
                    <th class="px-4 py-3">Late <br> Month <br> Charges</th>
                    <th class="px-4 py-3">Payable</th>
                    <th class="px-4 py-3">Paid</th>
                    <th class="px-4 py-3">Due B/F</th>
                    <th class="px-4 py-3">Balance</th>
                    <th class="px-4 py-3">Total <br> Balance</th>
                    <th class="px-4 py-3">Add</th>
                    <th class="px-4 py-3">Remove</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400 recovery-row" v-for="(row, index) in rows" :key="row.id">
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input v-model="row.month" style="font-size: 10px;" type="date" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.due_amount" style="font-size: 10px;" readonly class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="date" v-model="row.due_date" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.payment_description" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text"
                                    :value="Number(row.current_month_payable).toLocaleString('en-US')"
                                    @input="row.current_month_payable = $event.target.value.replace(/,/g, '')"
                                    style="font-size: 10px;"
                                    class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                />
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text"
                                        :value="row.late_month_charges === null ? '' : Number(row.late_month_charges).toLocaleString('en-US')"
                                        @input="row.late_month_charges = $event.target.value.replace(/,/g, '')"
                                        style="font-size: 10px;"
                                        class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    />
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.payable" style="font-size: 10px;" readonly class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text"
                                        :value="row.paid === null ? '' : Number(row.paid).toLocaleString('en-US')"
                                        @input="row.paid = $event.target.value.replace(/,/g, '')"
                                        style="font-size: 10px;"
                                        class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    />
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.due" readonly style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="double-cols padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.balance" readonly style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.total_balance" readonly style="font-size: 10px;" readonly class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px;">
                            <button @click="addRow" v-if="index === rows.length - 1" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                +
                            </button>
                        </td>
                        <td style="padding-left: 15px;">
                            <button @click="deleteRow(row.id)" v-if="index === rows.length - 1" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                -
                            </button>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
            <button v-if="!is_saving_in_database" @click="saveInDatabase(member.id)" style="width: 50px; margin-top: 10px; margin-bottom: 10px; text-align: center; display: flex; justify-content: center;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Save
            </button>
            <button v-else style="margin-top: 10px; margin-bottom: 10px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span class="loader"></span>
            </button>
        </main>


    <script>
const app = Vue.createApp({
    data() {
        return {
            is_copied: false,
            selectedId: "",
            member: [],
            balances: [],
            due_amounts: [0],
            is_fetching_members: false,
            is_fetching_sheet: false,
            is_saving_in_database: false,
            rows: [
                {
                    id: 1,
                    month: "",
                    due_amount: "",
                    due_date: "",
                    payment_description: "",
                    current_month_payable: "",
                    late_month_charges: 0,
                    payable: "",
                    paid: "",
                    due: "",
                    balance: "",
                    total_balance: ""
                }
            ],
        }
    },
    watch: {
        rows: {
            handler(newRows) {
                this.doCalculation(newRows);
            },
            deep: true
        },
        async selectedId(newValue) {
            this.is_fetching_sheet = true;
            const response = await axios.get(route("api.member.getById", { member: newValue }));
            const second_response = await axios.get(route("api.recovery.get", { member: newValue }));
            console.log(second_response.data.status);

            if(second_response.data.data.length > 0) {
                const rows = second_response.data.data;
                this.rows = rows;
            }

            this.member = response.data;
            const member = this.member;
            this.balances[0] = member.form_fee + member.processing_fee + member.first_payment + member.total_installment;
            this.is_fetching_sheet = false;
        }
    },
  methods: {
    copyURL(user_token) {
        navigator.clipboard.writeText(route("member.recovery.sheet.download", { member: user_token }));
        this.is_copied = true;
        setTimeout(() => {
            this.is_copied = false;
        }, 2000)
    },
    getNextMonth(yesterday) {
        const date = new Date(yesterday);
        date.setMonth(date.getMonth() + 1);

        // Format back to YYYY-MM-DD
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // months are 0-based
        const day = String(date.getDate()).padStart(2, '0');

        const newDateStr = `${year}-${month}-${day}`;

        return newDateStr;
    },
    doCalculation(newRows) {
        let lastDue = 0;
        let balance = this.firstBalance();
        let yesterday = null;
        let yesterdaysDueDate = null;

        newRows.forEach((row, index) => {
            // const currentPayablePlusLateMonth = parseInt(row.current_month_payable) + parseInt(row.late_month_charges) + parseInt(lastDue);
            // const dues = currentPayablePlusLateMonth - parseInt(row.paid);
            // row.due_amount = lastDue;
            // lastDue = dues;

            // row.payable = currentPayablePlusLateMonth || "";
            // row.due = dues;
            // row.balance = balance;
            // balance -= row.paid;

            // if(row.late_month_charges) balance += parseInt(row.late_month_charges);

            // row.total_balance = balance;
        
        const currentPayable = parseInt(row.current_month_payable) || 0;

        const lateCharges = parseInt(row.late_month_charges) || 0;
        const paid = parseInt(row.paid);

        const currentPayableWithLate = currentPayable + lateCharges + (lastDue < 0 ? 0 : lastDue);
        const dues = currentPayableWithLate - paid;
        
        if(!isNaN(paid)) {
            row.due_amount = lastDue < 0 ? 0 : lastDue.toLocaleString('en-US');
        } else {
            row.due_amount = null;
        }

        if(!isNaN(paid)) {
            row.payable = currentPayableWithLate ? currentPayableWithLate.toLocaleString('en-US') : "";
        } else {
            row.payable = null;
        }

        if(!isNaN(paid)) {
            row.due = (dues < 0) ? 0 : dues.toLocaleString("en-US");
        } else {
            row.due = null;
        }

        if(!isNaN(paid)) {
            row.balance = balance.toLocaleString('en-US');
        } else {
            row.balance = null;
        }

        if(!isNaN(paid)) {
            row.total_balance = (balance - paid + lateCharges).toLocaleString('en-US');
        } else {
            row.total_balance = null;
        }

        if(!row.month && yesterday) {
            row.month = this.getNextMonth(yesterday);
        }

        if(!row.due_date && yesterdaysDueDate) {
            row.due_date = this.getNextMonth(yesterdaysDueDate);
        }

        yesterday = row.month;
        yesterdaysDueDate = row.due_date;

        lastDue = dues;
        balance = balance - paid + lateCharges;


        });
    },
    async saveInDatabase(id) {
        this.is_saving_in_database = true;
        const request = await axios.post(route("recovery.create", { member: id }), { rows: this.rows });
        if(request.data.status === "200") {
           Swal.fire({
                icon: 'success',
                title: 'Saved',
                showConfirmButton: false,
            });
        }
        this.is_saving_in_database = false;
    },
    firstBalance() {
        const member = this.member;
        return member.form_fee + member.processing_fee + member.first_payment + member.total_installment;
    },
    addRow() {
        this.rows.push({
            id: this.rows.length + 1,
            month: "",
            due_amount: "",
            due_date: "",
            payment_description: "",
            current_month_payable: "",
            late_month_charges: null,
            payable: "",
            paid: null,
            due: "",
            balance: "",
            total_balance: ""
        });
    },
    deleteRow(id) {
        if(this.rows.length == 1) return;
        this.rows = this.rows.filter(row => row.id != id);
        this.doCalculation(this.rows);
    },
    select(id) {
        this.selectedId = id;
        Swal.close();
    },
    getSheet() {
        window.location = route("member.recovery.sheet", { member: this.member.id });
    },
    async showMembers() {
        this.is_fetching_members = true;
        const self = this;
      try {
        const response = await axios.get(route('api.member.all'));
        const members = response.data.data;

        let rows = members.map(member => `
          <tr style="width: 80%;">
            <td>${member.member_name}</td>
            <td>${member.cnic_passport}</td>
            <td>${member.membership_number}</td>
            <td>${member.file_number}</td>
            <td>${member.residential_address.length > 20
      ? member.residential_address.slice(0, 20) + '...'
      : member.residential_address}</td>
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
