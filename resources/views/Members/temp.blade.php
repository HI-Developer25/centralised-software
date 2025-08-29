<x-layout.app>
     <style>
     .iti {
       width: 100%;
     }
     input[type='checkbox'] {
       width: 12px;
       height: 12px;
     }
     
           /* Custom button styling */
      .btn-yes {
        background-color: #10b981;
        color: white;
        border: 2px solid #10b981;
      }
      
      .btn-yes:hover {
        background-color: #059669;
        border-color: #059669;
      }
      
      .btn-no {
        background-color: #6b7280;
        color: white;
        border: 2px solid #6b7280;
      }
      
      .btn-no:hover {
        background-color: #4b5563;
        border-color: #4b5563;
      }
     
     /* Button base styles */
     .toggle-btn {
       width: 100%;
       padding: 8px 16px;
       border-radius: 6px;
       font-size: 14px;
       font-weight: 500;
       transition: all 0.3s ease;
       cursor: pointer;
       border: 2px solid transparent;
     }
     
                                               .toggle-btn:disabled {
          opacity: 0.7;
          cursor: not-allowed;
        }
        

   </style>
  <script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Temporary Members
      </h2>
      
      <div style="display: flex; gap: 10px;">
        <input v-model="search" class="block w-full mt-1 text-sm search-input form-input" style="width: 25%; margin-bottom: 20px;" placeholder="Search">
        <select v-model="count" class="block w-full mt-1 text-sm search-input form-input" style="width: 10%; margin-bottom: 20px;">
          <option value="15">15</option>
          <option value="30">30</option>
          <option value="60">60</option>
        </select>
      </div>
    
 
      <table v-if="tempMembers.length > 0 && !is_fetching" class="w-full whitespace-no-wrap">
                 <thead>
           <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
             <th class="px-4 py-3">Member Name</th>
             <th class="px-4 py-3">Contact Number</th>
             <th class="px-4 py-3">Address</th>
             <th class="px-4 py-3">Contacted</th>
             <th class="px-4 py-3">Email</th>
             <th class="px-4 py-3">Alt Ph. No.</th>
           </tr>
         </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <template v-for="member in tempMembers" :key="member.id">
            <!-- Parent Row -->
                         <tr @click="toggleMemberExpansion(member.id)" class="text-gray-700 dark:text-gray-400 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                                                                           <td class="px-4 py-3">
                 <div class="flex items-center text-sm">
                  <!-- Expand/Collapse Icon -->
                  <div class="mr-2 text-gray-500">
                    <i :class="member.expanded ? 'fas fa-chevron-down' : 'fas fa-chevron-right'" class="text-sm"></i>
                  </div>
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
                                                       <td class="px-4 py-3 text-sm" v-text="member.contact_number"></td>
               <td class="px-4 py-3 text-sm">
                <div v-if="member.address && member.address.length > 60" 
                     class="cursor-help"
                     :title="member.address.replace(/<br\s*\/?>/gi, ' ').replace(/<[^>]*>/g, '')"
                     v-html="member.address.substring(0, 60) + '...'">
                </div>
                <div v-else v-html="member.address.replace(/<br\s*\/?>/gi, ' ').replace(/<[^>]*>/g, '')"></div>
              </td>
              <td class="px-4 py-3 text-sm">
                               <button 
                   @click.stop="toggleContacted(member.id, !member.is_contacted)"
                   :disabled="member.contacting"
                   class="toggle-btn"
                   :class="member.is_contacted ? 'btn-yes' : 'btn-no'"
                 >
                  <span v-if="member.contacting" class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                  <span v-else v-text="member.is_contacted ? 'Yes' : 'No'"></span>
                </button>
              </td>
              <td v-text="member.email"></td>
              <td v-text="member?.alternate_ph_number ?? '-'"></td>
          </tr>
          
                     <!-- Children Header Row -->
           <tr v-if="member.expanded && member.children && member.children.length > 0" 
               class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-blue-50 dark:bg-blue-900 border-l-4 border-blue-500">
                           <td class="px-4 py-2 text-blue-700 dark:text-blue-300">
                <i class="fas fa-users mr-2"></i>Children
              </td>
             <td class="px-4 py-2 text-blue-700 dark:text-blue-300" colspan="2">Age</td>
             <td class="px-4 py-2 text-blue-700 dark:text-blue-300">Converted</td>
             <td class="px-4 py-2 text-blue-700 dark:text-blue-300"></td>
           </tr>
           
                       <!-- Children Rows -->
            <tr v-if="member.expanded && member.children && member.children.length > 0" 
                v-for="child in member.children" 
                :key="`${member.id}-${child.id}`"
                class="text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 border-l-4 border-blue-500">
             <td class="px-4 py-3">
               <div class="flex items-center text-sm">
                 <!-- Indent for child -->
                 <div class="w-8"></div>
                 <!-- Child Avatar -->
                 <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                   <img class="object-cover w-full h-full rounded-full" :src="`https://gwadargymkhana.com.pk/members/storage/${child.profile_pic}`" alt="" loading="lazy">
                   <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                 </div>
                 <div>
                   <p class="font-semibold text-blue-600" v-text="child.child_name"></p>
                   <p class="text-xs text-gray-500">Child Member</p>
                 </div>
               </div>
             </td>
                                    <td colspan="2" class="px-4 py-3 text-sm" v-text="calculateAge(child.date_of_birth)"></td>
               <td class="px-4 py-3 text-sm" colspan="1">
                 <button 
                   @click.stop="toggleChildConverted(child.id, !child.is_converted)"
                   :disabled="child.converting"
                   class="toggle-btn"
                   :class="child.is_converted ? 'btn-yes' : 'btn-no'"
                 >
                   <span v-if="child.converting" class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                   <span v-else v-text="child.is_converted ? 'Yes' : 'No'"></span>
                 </button>
               </td>
               <td class="px-4 py-3 text-sm"></td>
           </tr>
        </template>
        </tbody>
      </table>
      <div v-else-if="!is_fetching" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          No Temporary Members found!
        </p>
      </div>
      <span v-if="is_fetching" class="loader big purple" style="margin: auto;"></span>
    </div>
    
    <!-- Pagination -->
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
    const app = Vue.createApp({
      data() {
        return {
          tempMembers: [],
          links: [],
          search: "",
          count: 30,
          is_fetching: true
        }
      },
      async mounted() {
        // Get temp members data
        this.getContent(route("api.temp.member.index"));
      },
      watch: {
        search(newValue) {
          this.getContent(route("api.temp.member.index", { keyword: newValue, count: this.count }));
        },
        count(newValue) {
          this.getContent(route('api.temp.member.index', { keyword: this.keyword, count: newValue }))
        }
      },
      methods: {
        changePage(url) {
          this.getContent(url);
        },
        async getContent(url) {
          this.is_fetching = true;
          try {
            const response = await axios.get(url);
            console.log(response);
            this.tempMembers = response.data.data;
            // Initialize expanded property for each member
            this.tempMembers.forEach(member => {
              member.expanded = false;
            });
            this.links = response.data.meta.links;
          } catch (error) {
            console.error('Error fetching temp members:', error);
            this.tempMembers = [];
            this.links = [];
          }
          this.is_fetching = false;
        },
        async toggleConverted(memberId, isConverted) {
          const member = this.tempMembers.find(m => m.id === memberId);
          if (!member) return;
          member.converting = true;
          try {
            const response = await axios.patch(route("api.temp.member.toggle.converted", { child: memberId }), {
              is_converted: isConverted
            });
            if (response.data.data.success) {
              member.is_converted = isConverted;
            }
          } catch (error) {
            console.error('Error updating converted status:', error);
            member.is_converted = !isConverted;
          } finally {
            member.converting = false;
          }
        },
                 async toggleContacted(memberId, isContacted) {
           const member = this.tempMembers.find(m => m.id === memberId);
           if (!member) return;
           member.contacting = true;
           try {
             const response = await axios.patch(route("api.temp.member.toggle.contacted", { member: memberId }), {
               is_contacted: isContacted
             });
             if (response.data.data.success) {
               member.is_contacted = isContacted;
             }
           } catch (error) {
             console.error('Error updating contacted status:', error);
             member.is_contacted = !isContacted;
           } finally {
             member.contacting = false;
           }
         },
        toggleMemberExpansion(memberId) {
          const member = this.tempMembers.find(m => m.id === memberId);
          if (member) {
            member.expanded = !member.expanded;
          }
        },
        async toggleChildConverted(childId, isConverted) {
          const child = this.findChildById(childId);
          if (!child) return;
          child.converting = true;
          try {
            const response = await axios.patch(route("api.temp.member.toggle.converted", { child: childId }), {
              is_converted: isConverted
            });
            if (response.data.data.success) {
              child.is_converted = isConverted;
            }
          } catch (error) {
            console.error('Error updating child converted status:', error);
            child.is_converted = !isConverted;
          } finally {
            child.converting = false;
          }
        },
        async toggleChildContacted(childId, isContacted) {
          const child = this.findChildById(childId);
          if (!child) return;
          child.contacting = true;
          try {
            const response = await axios.patch(route("api.temp.member.toggle.contacted", { child: childId }), {
              is_contacted: isContacted
            });
            if (response.data.data.success) {
              child.is_contacted = isContacted;
            }
          } catch (error) {
            console.error('Error updating child contacted status:', error);
            child.is_contacted = !isContacted;
          } finally {
            child.contacting = false;
          }
        },
                 findChildById(childId) {
           for (const member of this.tempMembers) {
             if (member.children) {
               const child = member.children.find(c => c.id === childId);
               if (child) return child;
             }
           }
           return null;
         },
         
         calculateAge(dateOfBirth) {
           if (!dateOfBirth) return 'N/A';
           
           const today = new Date();
           const birthDate = new Date(dateOfBirth);
           
           if (isNaN(birthDate.getTime())) return 'Invalid Date';
           
           let age = today.getFullYear() - birthDate.getFullYear();
           const monthDiff = today.getMonth() - birthDate.getMonth();
           
           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
             age--;
           }
           
           return age + ' years';
         }
      }
    }).mount("#app");
  </script>
</x-layout.app>
