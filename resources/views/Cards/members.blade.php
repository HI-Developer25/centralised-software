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

table {
    border-collapse: collapse;
    width: 100%;
  }


  tbody {
    border-top: 1px solid #ccc; /* Ensures border between tbody sections */
  }
  .card-buttons:disabled {
    background: gray;
    cursor: not-allowed;
  }
  </style>
  


  <main id="app" class="h-full pb-16 overflow-y-auto">
    <div class="checked-members" v-if="checked_members.length > 0 && openList" style="overflow-y: auto; border: 1px solid black; background: white; position: absolute; right: 0; bottom: 0; margin: 20px; margin-bottom: 70px; width: 25%; height: 50%; border-radius: 10px;">
      <div class="member flex justify-between items-center" v-for="member in checked_member_details" style="padding: 5px;">
        <p v-text="member[1]"></p>
        <button style="background: 	#F44336; color: white; padding: 3px; border-radius: 5px;" @click="deleteCheckedMember(member[0])">Delete</button>
      </div>
    </div>
    <div @click="openList = !openList" style="position: absolute; right: 0; bottom: 0;" v-if="checked_members.length > 0">
      <div class="flex items-center justify-center" style="position: relative; cursor: pointer; color: white; background: black; width: 30px; height: 30px; border-radius: 50px; margin: 20px;">
        <svg style="height: 14px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#ffffff" d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"/></svg>
        <div class="counter flex items-center justify-center" style="width: 15px; height: 15px; background: #b91c1c; font-size: 5x; padding: 1px; position: absolute; border-radius: 50px; top: -5px; left: 0;">
          <span style="font-size: 9px; top: 0;" v-text="checked_members.length"></span>
        </div>
      </div>
    </div>
    <!-- Remove everything INSIDE this div to a really blank page -->
    
    <div class="container px-6 mx-auto grid">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Manage Members
      </h2>
      <div style="display: flex; align-items: flex-start;">
        <input v-model="search" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="width: 25%; margin-bottom: 20px;" placeholder="Search">
        <button type="button" 
  style="
    display: flex;
    margin-left: 20px;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    padding: 0.625rem 1.25rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    border: none;
    cursor: pointer;
    outline: none;
  "
  @click="is_fuji = true"
  :style="{ 'background-color': is_fuji ? '#1d4ed8' : '#e5e7eb', 'color': is_fuji ? '#fff' : '#374151' }">
      

  Fuji Prints
</button>
<button type="button" 
  style="
    display: flex;
    margin-left: 5px;
    align-items: center;
    gap: 8px;
    color: #374151;              /* Dark gray text */
    background-color: #e5e7eb;   /* Gray-200 background */
    font-weight: 500;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    padding: 0.625rem 1.25rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    border: none;
    cursor: pointer;
    outline: none;
  "
  @click="is_fuji = false"
  :style="{ 'background-color': !is_fuji ? '#1d4ed8' : '#e5e7eb', 'color': !is_fuji ? '#fff' : '#374151' }">
  
  Borderless Prints
</button>



      </div>



      <table v-if="members.length > 0 && !is_fetching" class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">&nbsp;</th>
            <th class="px-4 py-3">Member Name</th>
            <th class="px-4 py-3">Membership Number</th>
            <th class="px-4 py-3">File Number</th>
            <th class="px-4 py-3">Locker Number</th>
          </tr>
        </thead>
        <tbody v-for="member in members" :key="member.id" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr class="text-gray-700 dark:text-gray-400">
         <td style="text-align: center; vertical-align: middle;">
                <input
                    type="checkbox"
                    @change="showFamily(member.id, member.member_name)"
                    style="height: 15px; width: 15px;"
                    :checked="checked_members.includes(member.id)"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                </td>
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
          </tr>
          <tr v-for="spouse in member.spouses"
    v-if="family.includes(member.id)"
    class="text-gray-700 dark:text-gray-400 bg-gray-50"
>
  <!-- Checkbox -->
  <td class="pl-4 border-l-2 border-dotted border-gray-300 text-center align-middle">
    <input
      type="checkbox"
      @change="saveToSessionStorage(`spouse-${spouse.id}`, `${spouse.spouse_name}`)"
      :checked="checked_members.includes(`spouse-${spouse.id}`)"
      style="height: 15px; width: 15px;"
      class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
    >
  </td>

  <!-- Spouse Name + Avatar -->
  <td class="px-4 py-3">
    <div class="flex items-center text-sm">
      <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
        <img class="object-cover w-full h-full rounded-full"
             :src="`https://gwadargymkhana.com.pk/members/storage/${spouse.picture}`"
             alt=""
             loading="lazy"
        >
        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
      </div>
      <div>
        <p class="font-semibold">
          ⤷ <span v-text="spouse.spouse_name + ' (S)'"></span>
        </p>
        <p class="text-xs text-gray-600 dark:text-gray-400 capitalize">
          <span v-text="`${member.membership_type} Membership`"></span>
        </p>
      </div>
    </div>
  </td>

  <!-- Membership Number -->
  <td>
    <p class="px-4 py-3 text-sm" v-text="member.membership_number"></p>
  </td>

  <!-- File Number -->
  <td>
    <p class="px-4 py-3 text-xs" v-text="member.file_number"></p>
  </td>

  <!-- Locker Number -->
  <td>
    <p class="px-4 py-3 text-sm uppercase" v-text="`${member.locker_category}${member.locker_number}`"></p>
  </td>
</tr>
          <tr v-for="child in member.children"
    v-if="family.includes(member.id)"
    class="text-gray-700 dark:text-gray-400 bg-gray-50"
>
  <!-- Checkbox -->
  <td class="pl-4 border-l-2 border-dotted border-gray-300 text-center align-middle">
    <input
      type="checkbox"
      style="height: 15px; width: 15px;"
    :checked="checked_members.includes(`child-${child.id}`)"
      @change="saveToSessionStorage(`child-${child.id}`, `${child.child_name}`)"
      class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
    >
  </td>

  <!-- Spouse Name + Avatar -->
  <td class="px-4 py-3">
    <div class="flex items-center text-sm">
      <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
        <img class="object-cover w-full h-full rounded-full"
             :src="`https://gwadargymkhana.com.pk/members/storage/${child.profile_pic}`"
             alt=""
             loading="lazy"
        >
        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
      </div>
      <div>
        <p class="font-semibold">
          ⤷ <span v-text="child.child_name + ' (C)'"></span>
        </p>
        <p class="text-xs text-gray-600 dark:text-gray-400 capitalize">
          <span v-text="`${member.membership_type} Membership`"></span>
        </p>
      </div>
    </div>
  </td>

  <!-- Membership Number -->
  <td>
    <p class="px-4 py-3 text-sm" v-text="member.membership_number"></p>
  </td>

  <!-- File Number -->
  <td>
    <p class="px-4 py-3 text-xs" v-text="member.file_number"></p>
  </td>

  <!-- Locker Number -->
  <td>
    <p class="px-4 py-3 text-sm uppercase" v-text="`${member.locker_category}${member.locker_number}`"></p>
  </td>
</tr>

        </tbody>
      </table>
      <div v-else-if="!is_fetching" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          No Members found!
        </p>
      </div>
      <div class="print-buttons" v-if="!is_fetching" style="display: flex; gap: 10px; margin-top: 20px;">
          <button :disabled="!checked_members.length" @click="selectFront" class="card-buttons px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">View Selected (front)</button>
          <button :disabled="!checked_members.length" @click="selectBack" class="card-buttons px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">View Selected (back)</button>
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
          child_checkbox: [],
          family: [],
          checked_members: [],
          checked_member_details: new Map(),
          debounceTimer: null,
          openList: false,
          is_fuji: true
        }
      },
      created() {
        const checked_checkboxes = document.querySelectorAll('.child-checkboxes');
        checked_checkboxes.forEach(checkbox => {
          checked_checkboxes.checked = false;
        });
      },
      async mounted() {
        sessionStorage.clear();
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
          this.$data = Object.assign(this.$data, savedData);
        }

        // Checking if the url is there is session storage
        this.getContent(route("api.member.index"));
      },
      watch: {
        search(newValue) {
          this.is_fetching = true;
          clearTimeout(this.debounceTimer);
          this.debounceTimer = setTimeout(() => {
            console.log("test");
            this.getContent(route("api.member.index", { keyword: newValue }));
          }, 500);
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
        deleteCheckedMember(id) {
          this.checked_member_details.delete(id);
          this.checked_members = this.checked_members.filter(checked_member => checked_member !== id);
          sessionStorage.setItem("checked_members", JSON.stringify(this.checked_members));

        },
        selectFront() {
            const url = route('card.front', { members: JSON.parse(sessionStorage.checked_members), fuji: this.is_fuji === false ? 1 : 0 });
            window.open(url, '_blank');
        },
        selectBack() {
            const url = route("card.back", { members: JSON.parse(sessionStorage.checked_members), fuji: this.is_fuji === false ? 1 : 0 });
            window.open(url, '_blank');
        },
        saveToSessionStorage(id, name) {
            const index = this.checked_members.indexOf(id);
            if (index === -1) {
              this.checked_members.push(id); // Add
                
              this.checked_member_details.set(id, name);
            } else {
                this.checked_members.splice(index, 1); // Remove
                this.checked_member_details.delete(id);
            }
            sessionStorage.setItem("checked_members", JSON.stringify(this.checked_members));

        },
        showFamily(id, name) {
            const index = this.family.indexOf(id);
            if (index === -1) {
                this.family.push(id); // Add
            } else {
                this.family.splice(index, 1); // Remove
            }
            this.saveToSessionStorage(id, name);
        },
        async createToWati() {
          const response = await axios.get(route('api.member.all'));
          const members = response.data.data;
          const header = "Name,CountryCode,Phone,AllowBroadcast,AllowSMS,Attribute 1,Attribute 2\n";
          const rows = members.map(row => `${row.member_name},${row.phone_number_code},${row.phone_number_without_code},TRUE,TRUE`).join("\n");
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

