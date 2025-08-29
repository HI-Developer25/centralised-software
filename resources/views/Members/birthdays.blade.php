<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
  </style>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    
    <div class="container px-6 mx-auto grid">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Birthdays
      </h2>
      <div style="display: flex; justify-content: space-between;">
        <input v-model="search" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="width: 25%; margin-bottom: 20px;" placeholder="Search">
      </div>
      <table v-if="members.length > 0 && !is_fetching" class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Member Name</th>
            <th class="px-4 py-3">Membership Number</th>
            <th class="px-4 py-3">Birthdate</th>
            <th class="px-4 py-3">Residential Address</th>
            <th class="px-4 py-3">Phone Number</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="member in sortedMembers" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
              <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                  <img class="object-cover w-full h-full rounded-full" :src="`https://gwadargymkhana.com.pk/members/storage/${member.profile_picture}`" alt="" loading="lazy">
                  <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                </div>
                <div>
                  <p class="font-semibold" v-text="member.member_name"></p>
                  <p class="text-xs text-gray-600 dark:text-gray-400" style="text-transform: capitalize;" v-text="`${member.membership_type} Membership`"></p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-sm" v-text="member.membership_number"></td>
            <td class="px-4 py-3 text-sm" v-text="formatDate(member.date_of_birth)"></td>
            <td class="px-4 py-3 text-xs break-words max-w-[200px]"
              v-html="member.residential_address.replace(/(.{80})/g, '$1<br>')">
            </td>
            <td class="px-4 py-3 text-sm" v-text="member.phone_number.replace(/^\+/, '+' + member.phone_number_code)"></td>
          </tr>
        </tbody>
      </table>
      <span v-if="is_fetching" class="loader big purple" style="margin: auto;"></span>
      <div v-else-if="!is_fetching && !members.length" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          No Members found!
        </p>
      </div>
    </div>
    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end" style="color: white; margin-top: 20px;">
      <nav aria-label="Table navigation">
        <ul class="inline-flex items-center">
          <li v-for="(link, index) in links">
            <button @click="changePage(link.url)" v-if="index === 0" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
              <svg class="w-4 h-4 fill-current text-black" aria-hidden="true" viewBox="0 0 20 20">
                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
              </svg>
            </button>
            <button @click="changePage(link.url)" v-else-if="index === links.length - 1" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
              <svg class="w-4 h-4 fill-current text-black" aria-hidden="true" viewBox="0 0 20 20">
                <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
              </svg>
            </button>
            <button @click="changePage(link.url)" v-else v-text="link.label" :class="{ 'bg-purple-600 border-purple-600 rounded-md text-white': link.active === true, 'text-black': link.active != true }" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"></button>
          </li>
        </ul>
      </nav>
    </span>
  </main>
   
  <script>
    console.log(route('api.member.index'));
    const app = Vue.createApp({
      data() {
        return {
          members: [],
          links: [],
          search: "",
          is_fetching: true
        }
      },
      async mounted() {
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
          this.$data = Object.assign(this.$data, savedData);
        }
        this.getContent(route("api.member.birthday"));
      },
      watch: {
        search(newValue) {
          this.getContent(route("api.member.birthday", { keyword: newValue }));
        },
      },
      computed: {
        sortedMembers() {
          return this.members.slice().sort((a, b) => {
            return new Date(a.dob) - new Date(b.dob); // Ascending
          });
        }
      },
      methods: {
        formatDate(date) {
          return new Date(date).toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' }).replace(' ', '-').replace(' ', '-') 
        },
        debounce(func, delay = 300) {
          let timeoutId;
          return function (...args) {
            const context = this;
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
              func.apply(context, args);
            }, delay);
          };
        },
        changePage(url) {
          this.getContent(url);
        },
        async getContent(url) {
          this.is_fetching = true;
          const response = await axios.get(url);
          this.members = response.data.data;
          this.links = response.data.meta.links;
          this.is_fetching = false;
        },
        editMember(id) {
          window.location = route('member.updated', { member: id });
        },
        async deleteMember(id) {

          Swal.fire({
            title: "Do you want to move it in trash?",
            showCancelButton: true,
            confirmButtonText: "Delete",
          }).then(async (result) => {
            if (result.isConfirmed) {
              const response = await axios.delete(route("api.member.delete", { member: id }));
              if(response.data.status === "200") {
                this.members = this.members.filter(member => member.id !== id);
              } 
            }
          });
        }
      }
    }).mount("#app");
  </script>
</x-layout.app>

