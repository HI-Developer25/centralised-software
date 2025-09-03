<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
    input[type='checkbox'] {
      width: 12px;
      height: 12px;
    }
    

.progress-container {
  width: 100%;
  height: 20px;
  background-color: #f3f3f3;
  border-radius: 10px;
  overflow: hidden;
  position: relative;
}

.progress-bar {
  width: 100%;
  height: 100%;
  background-image: linear-gradient(
    45deg,
    #dc2626 25%,
    #b91c1c 25%,
    #b91c1c 50%,
    #dc2626 50%,
    #dc2626 75%,
    #b91c1c 75%,
    #b91c1c 100%
  );
  background-size: 40px 40px;
  animation: moveStripes 1s linear infinite;
}

@keyframes moveStripes {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 40px 0;
  }
}
  </style>
  <script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    
    <div class="container px-6 mx-auto grid">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Manage Members
      </h2>
      <div style="display: flex; column-gap: 10px;">
        <a 
  href="{{ route('member.create') }}" 
  style="
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin-bottom: 16px;
    margin-right: 12px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(to right, #8b5cf6, #7c3aed); /* purple gradient */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(124, 58, 237, 0.35);
    transition: all 0.3s ease;
  "
  onmouseover="this.style.background='linear-gradient(to right,#7c3aed,#5b21b6)'; this.style.transform='translateY(-2px) scale(1.05)';"
  onmouseout="this.style.background='linear-gradient(to right,#8b5cf6,#7c3aed)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #ddd6fe'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  ✨ Create
</a>

<a 
  @click="createToWati" 
  style="
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin-bottom: 16px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(to right, #10b981, #059669); /* green gradient */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.35);
    transition: all 0.3s ease;
  "
  onmouseover="this.style.background='linear-gradient(to right,#059669,#047857)'; this.style.transform='translateY(-2px) scale(1.05)';"
  onmouseout="this.style.background='linear-gradient(to right,#10b981,#059669)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #a7f3d0'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  Export for Wati broadcast 
  <sub style="font-size: 0.7rem; opacity: 0.85;">(defaulter and cancelled excluded)</sub>
</a>

   
  
      @if($setting)
        <a href="{{ $setting->google_drive_link }}" target="_blank" style="margin-bottom: 20px; text-align: center; display: flex; align-items: center;" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
          <i class="fa-brands fa-google-drive"></i>
          <p style="margin-left: 10px;">Link</p>
        </a>
      @endif
            <a
  href="#"
  style="
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    margin-bottom: 16px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(to right, #22c55e, #16a34a); /* green gradient */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4); /* green shadow */
    transition: all 0.3s ease;
  "
  onmouseover="this.style.background='linear-gradient(to right,#16a34a,#15803d)'; this.style.transform='translateY(-2px) scale(1.05)';"
  onmouseout="this.style.background='linear-gradient(to right,#22c55e,#16a34a)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #bbf7d0'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  Export to Excel
</a>

      </div>
      <div style="display: flex; justify-content: space-between;">
        <input v-model="search" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="width: 25%; margin-bottom: 20px;" placeholder="Search">
      </div>
 
      <table v-if="members.length > 0 && !is_fetching" class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Member Name</th>
            <th class="px-4 py-3">Membership Number</th>
            <th class="px-4 py-3">File Number</th>
            <th class="px-4 py-3">Locker Number</th>
            <th class="px-4 py-3">Progress</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="member in members" class="text-gray-700 dark:text-gray-400">
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
            <td class="px-4 py-3 text-xs" v-text="member.file_number"></td>
            <td class="px-4 py-3 text-sm" style="text-transform: uppercase;" v-text="`${member.locker_category}${member.locker_number}`"></td>
            <td class="px-4 py-3 text-sm">
              <div class="progress-container" v-if="!Boolean(member.sheet_status)">
                <div class="progress-bar"></div>
              </div>
              <div v-else class="bg-green-500">
                Created
              </div>
            </td>
            <td class="px-4 py-3">
              <div class="flex items-center space-x-4 text-sm">
                <button @click="editMember(member.id)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </button>
                <button @click="deleteMember(member.id)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                </button>
                <button @click="getMember(member.id)" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple">
                  <i class="fa-solid fa-eye" style="color: rgba(126, 58, 242, var(--text-opacity));"></i>
                </button>
                <button v-if="Boolean(member.sheet_status)" @click="getFamilySheet(member.id)" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple">
                  <i class="fa-solid fa-sheet-plastic" style="color: rgba(126, 58, 242, var(--text-opacity));"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else-if="!is_fetching" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          No Members found!
        </p>
      </div>
      <span v-if="is_fetching" class="loader big purple" style="margin: auto;"></span>
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
          parentCheckbox: "",
          is_fetching: true,
          child_checkbox: []
        }
      },
      created() {
        const checked_checkboxes = document.querySelectorAll('.child-checkboxes');
        checked_checkboxes.forEach(checkbox => {
          checked_checkboxes.checked = false;
        });
      },
      async mounted() {
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
          this.$data = Object.assign(this.$data, savedData);
        }

        // Checking if the url is there is session storage
        this.getContent(route("api.member.index"));
      },
      watch: {
        search(newValue) {
          this.getContent(route("api.member.index", { keyword: newValue }));
        },
        parentCheckbox(newValue) {
          const child_checkboxes = document.querySelectorAll(".child-checkboxes");
          child_checkboxes.forEach(checkbox => {
            if(!newValue) this.child_checkbox = [];
            else this.child_checkbox.push(checkbox.value);
          });
        }
      },
      methods: {
        getFamilySheet(id) {
          window.location = route("download.family-sheet", { member: id });
        },
        async createToWati() {
          const response = await axios.get(route('api.valid.member'));
          const members = response.data.data;
          const header = "Name,CountryCode,Phone,AllowBroadcast,AllowSMS,Attribute 1,Attribute 2\n";
          const rows = members.map(row => `M - ${row.member_name},${row.phone_number_code},${row.phone_number_without_code},TRUE,TRUE`).join("\n");
          const csvContent = header + rows;

          // Create download link
          const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
          const url = URL.createObjectURL(blob);

          const link = document.createElement("a");
          link.setAttribute("href", url);
          link.setAttribute("download", `${(new Date()).toISOString().split("T")[0]}.csv`);
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        },
        async saveInGoogleDrive() {
          const response = await axios.post(route("api.member.save.google.drive"));
          console.log(response);
        },
        backCard() {
          window.location = route("card.back", { members: this.child_checkbox });
        },
        frontCard() {
          window.location = route("card.front", { members: this.child_checkbox })
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
          this.parentCheckbox = false;
          this.getContent(url);
        },
        async getContent(url) {
          this.is_fetching = true;
          const response = await axios.get(url);
          sessionStorage.setItem("url", url != null ? url : "");
          this.members = response.data.data;
          this.links = response.data.meta.links;
          this.is_fetching = false;
        },
        editMember(id) {
          window.location = route('member.updated', { member: id });
        },
        getMember(id) {
          window.location = route('member.get', { member: id });
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

