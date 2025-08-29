<x-layout.app>
    <main class="h-full pb-16" id="app" style="overflow: scroll;">
        <div class="container px-6 mx-auto grid">
            <h2 class="mt-6 mb-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create User</h2>
          <form @submit="submit">
            <div class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
  <div style="display: flex; column-gap: 20px;">
    <!-- Member's Name -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Username</span>
        <input
          data-message="member_field_message"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="shahmir ahsanullah"
          v-model="username"
        >
        <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Member's field is required
        </span>
      </label>
    </div>

    <!-- Date of Birth -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Full Name</span>
        <input
          data-message="date_of_birth_field_message"
          placeholder="Full Name"
          type="text"
          v-model="fullname"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
        >
        <span class="date_of_birth_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Paid Amount field is required
        </span>
      </label>
    </div>

    <!-- CNIC/Passport -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Password</span>
        <input
          data-message="cnic_field_message"
          type="password"
          v-model="password"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Password"
        >
        <span class="cnic_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Reference Number field is required
        </span>
      </label>
    </div>
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Email</span>
       <input
          data-message="cnic_field_message"
          type="email"
          v-model="email"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Email"
        >
        <span class="cnic_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Email field is required
        </span>
      </label>
    </div>
  </div>
<div class="abilities">
  <table style="width: 100%;">
    <thead>
      <tr>
        <th colspan="100%" style="text-align: left; display: flex; align-items: center; column-gap: 10px;">
          <h2>Member's database</h2> 
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="member:add" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Add Member</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="member:manage" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Manage Member</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="member:birthdays" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Birthdays</p>
          </label>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th colspan="100%" style="text-align: left; display: flex; column-gap: 10px; align-items: center;">
          <h2>Recovery Section</h2>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="recovery:payment-schedule" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">View Payment Schedule</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="recovery:report-by-members" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Recovery Report by Members</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="recovery:payment-receipt" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Recovery Payment Receipt</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="recovery:report-overall" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Recovery Report Overall</p>
          </label>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th colspan="100%" style="text-align: left;"><h2>Reciprocal Section</h2></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="reciprocal:introletters" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Create Introduction Letter</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="reciprocal:manage-club" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Manage Clubs</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="reciprocal:add-club" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Add Clubs</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="reciprocal:duration-and-fees" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Add duration and fees</p>
          </label>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th colspan="100%" style="text-align: left;"><h2>Membership Card</h2></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="card:add" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Add card</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="card:manage" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Manage card</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="card:members" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Membership Cards</p>
          </label>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th colspan="100%" style="text-align: left;"><h2>Complains &amp; Inquiry</h2></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="complains:by-member" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Member Complain</p>
          </label>
        </td>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="complains:types" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Complain Types</p>
          </label>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th colspan="100%" style="text-align: left;"><h2>Users</h2></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="user:actions" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Give privilege to perform actions on users</p>
          </label>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th colspan="100%" style="text-align: left;"><h2>Payment Methods</h2></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="payment:actions" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Give privilege to perform actions on Payment Methods</p>
          </label>
        </td> 
      </tr>
    </tbody>

      <thead>
      <tr>
        <th colspan="100%" style="text-align: left;"><h2>Graphs</h2></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 10px 50px 10px 0px;">
          <label style="display: flex; column-gap: 10px;">
            <input type="checkbox" value="show:graph" v-model="permissions" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
            <p style="font-size: 12px;">Ability to show graphs</p>
          </label>
        </td>
      </tr>
    </tbody>
  </table>
</div>

  <button style="margin-top: 30px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Submit
    </button>
</div>
</form>

        </main>
    
 
    <script>
const app = Vue.createApp({
    data() {
        return {
          username: "",
          fullname: "",
          password: "",
          email: "",
          permissions: []
        }
    },
  methods: {
    async submit(e) {
      e.preventDefault();
      const response = await axios.post(route("api.user.store"), {
        username: this.username,
        fullname: this.fullname,
        password: this.password,
        email: this.email,
        permissions: JSON.stringify(this.permissions)
      });
      console.log(response);
      if(response.data.status === "200") {
        window.location = route("users");
      }
    }
  }
}).mount("#app");
</script>
</x-layout.app>