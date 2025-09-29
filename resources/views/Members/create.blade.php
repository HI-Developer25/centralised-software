<x-layout.app>
<script src="https://unpkg.com/vue@2"></script>
        <style>
          
          .vs__selected {
            color: black;
          }
          .v-select {
            padding: 3px;
          }
          .iti {
            width: 100%;
          }
          button:disabled {
            cursor: not-allowed;
          }
          .spouse-dropdown:hover {
            background: #f0f0f0;
            cursor: pointer;
          }

          .active {
            border: 1px solid #6B21A8;
            color: #6B21A8;
          }
          .current-step {
            border: 1px solid black;
            color : black;
          }
          .points {
            transition: .2s ease-in;
          }
          .points:hover {
            border: 1px solid #6B21A8;
            color: #6B21A8;
          }

          
        </style>
        <main id="app" class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->

          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Create Member
            </h2>
            <div v-show="current_step === 1" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Personal Information</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Member's name</span>
                    <input v-model="member_name" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span style="display: none;" class="member_field_message text-xs text-red-600 dark:text-red-400">
                      Member's field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Date of Birth</span>
                    <input v-model="date_of_birth" data-message="date_of_birth_field_message" type="date" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span style="display: none;" class="date_of_birth_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Date of Birth field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">CNIC/Passport</span>
                    <input v-model="cnic" data-message="cnic_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="XXXX-XXXXXXX-X">
                    <span style="display: none;" class="cnic_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      CNIC/Passport field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Gender</span>
                    <select v-model="gender" data-message="gender_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                    <span style="display: none;" class="gender_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Gender field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Marital Status</span>
                    <select v-model="marital_status" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                      <option value="divorced">Divorced</option>
                    </select>
                    <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Marital field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 2" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Contact Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400" style="margin-bottom: 20px;">Phone</span>
                    <br>
                    <input type="hidden" v-model="phone_numbers[0].countryCode" />
                    <input type="hidden" v-model="phone_numbers[0].phoneNumber"/>
                    <input style="width: 100% !important; margin-top: 4px !important;" v-model="phone" data-index="0" data-message="phone_field_message" class="phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Phone Number">
                    <span style="display: none;" class="phone_field_message text-xs text-red-600 dark:text-red-400">
                      Phone number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Alternate Phone Number</span>

                    <input type="hidden" v-model="phone_numbers[1].countryCode" />
                    <input type="hidden" v-model="phone_numbers[1].phoneNumber"/>
                    <input v-model="alt_phone_number" style="width: 100% !important; margin-top: 4px !important;" data-index="1" id="alt_phone_number" data-message="alt_ph_number_field_message" type="text" class="phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Alternate Phone Number">
                    <span style="display: none;" class="alt_ph_number_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Alternate Phone Number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input v-model="email" type="email" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="example@example.com">
                    <span style="display: none;" class="email_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Email field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Residential Address</span>
                    <input v-model="residential_address" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="residential_address_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="residential_address_message step_2_message text-xs text-red-600 dark:text-red-400">
                      Residential Address field is required
                    </span>
                  </label>
                </div>
                 <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Countries</span>
                    <v-select class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :options="options" label="country" v-model="selectedCountry"></v-select>
                    </label>
                </div>
                <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Cities</span>
                      <v-select :options="paginated" label="" :filterable="false" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" @search="onSearch" v-model="selectedCity"></v-select>
                    </label>
                  </div>

              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 3" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Membership Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Type</span>
                    <select v-model="membership_type" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option v-for="cardType in cardTypes" :value="cardType.id" v-text="cardType.card_name"></option>
                    </select>
                    <span style="display: none;" class="membership_type_field_message step_3_message text-xs text-red-600 dark:text-red-400">
                      Membership Type is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">File Number</span>
                    <input v-model="file_number" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="File Number">
                    <span style="display: none;" class="email_message step_1_message text-xs text-red-600 dark:text-red-400">
                      File Number field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Date of Applying</span>
                    <input v-model="date_of_applying" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="date_of_applying_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="date_of_applying_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Date of Applying field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Number</span>
                    <input v-model="membership_number" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="membership_number_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Membership Number">
                    <span style="display: none;" class="membership_number_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Membership Number field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 4" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Spouse Information</h5>
              <div class="spouse" v-for="(spouse, index) in spouses" :key="spouse.id">
                <div style="margin-bottom: 20px; display: flex; justify-content: space-between;" class="spouse-dropdown border border-gray-600 p-3 rounded-md dark:text-gray-200">
                  <h5 @click="spouse.hidden = !spouse.hidden" v-text="`${numberToOrdinal(index + 1)} Spouse Information`"></h5>
                  <button class="bg-red-600 text-white px-2 rounded-md" @click="removeSpouse(spouse.id)">Delete</button>
                </div>
                <div :style="{ display: !spouse.hidden ? 'flex' : 'none'}" style="column-gap: 20px;">
                  <div style="width: 50%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400" v-text="`${numberToOrdinal(index + 1)} Spouse`"></span>
                      <input v-model="spouse.name" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Spouse Name">
                    </label>
                  </div>
                  <div style="width: 50%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">CNIC/Passport</span>
                      <input v-model="spouse.cnic" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="CNIC">
                    </label>
                  </div>
                </div>
                <div :style="{ display: !spouse.hidden ? 'flex' : 'none'}" style="column-gap: 20px;">
                  <div style="width: 50%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Date of Birth</span>
                      <input v-model="spouse.date_of_birth" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Date of Birth">
                    </label>
                  </div>
                  <div style="width: 50%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Date of Issue</span>
                      <input v-model="spouse.date_of_issue" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Date of Issue">
                    </label>
                  </div>
                </div>
                <div :style="{ display: !spouse.hidden ? 'flex' : 'none'}" style="column-gap: 20px;">
                  <div style="width: 25%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Validity</span>
                      <input v-model="spouse.validity" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Validity">
                    </label>
                  </div>
                  <div style="width: 25%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Blood Group</span>
                      <input v-model="spouse.blood_group" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Blood Group">
                    </label>
                  </div>
                  <div style="width: 25%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Emergency Number</span>
                      <br>
                      <input type="hidden" v-model="spouse.emergency_country_code" />
                      <input type="hidden" v-model="spouse.emergency_phone_number"/>
                      <input v-model="spouse.emergency_number" style="width: 100% !important; margin-top: 4px !important;" :data-index="`spouse_${index}_emergency`" data-message="email_message" class="phone optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Emergency Number">
                    </label>
                  </div>
                  <div style="width: 25%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Picture</span>
                      <input type="file" @change="spouse.profile_pic = $event.target.files[0]" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Blood Group">
                    </label>
                  </div>
                </div>
              </div>
              <button :disabled="spouses.length > 3" @click="addSpouse" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Add Spouse
              </button>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 5" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Children Information</h5>
              <div v-for="(child, index) in children">
                <div style="margin-bottom: 20px; display: flex; justify-content: space-between;" class="children-dropdown border border-gray-600 p-3 rounded-md dark:text-gray-200">
                    <h5 @click="children.hidden = !children.hidden" v-text="`${numberToOrdinal(index + 1)} Child Information`"></h5>
                    <button class="bg-red-600 text-white px-2 rounded-md" @click="removeChild(child.id)">Delete</button>
                </div>
                <div style="width: 100%; display: flex; column-gap: 10px;">
                    <div style="width: 50%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;" v-text="`${numberToOrdinal(child.id)} child`"></span>
                            <input v-model="child.childName" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`${numberToOrdinal(child.id)} child`">
                        </label>
                    </div>
                    <div style="width: 50%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;">CNIC/Passport</span>
                            <input v-model="child.cnic" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`CNIC/Passport`">
                        </label>
                    </div>
                </div>
                <div style="width: 100%; display: flex; column-gap: 10px;">
                    <div style="width: 50%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;" v-text="`Date of Birth`"></span>
                            <input v-model="child.dob" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`${numberToOrdinal(child.id)} child`">
                        </label>
                    </div>
                    <div style="width: 50%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;">Date of Issue</span>
                            <input v-model="child.date_of_issue" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`Date of Issue`">
                        </label>
                    </div>
                </div>
                <div style="width: 100%; display: flex; column-gap: 10px;">
                    <div style="width: 20%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;" v-text="`Validity`"></span>
                            <input v-model="child.validity" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`Validity`">
                        </label>
                    </div>
                    <div style="width: 20%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;">Membership Type</span>
                            <select v-model="child.child_card" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                              <option :value="card.id" v-for="card in child_memberships" v-text="card.card_name"></option>
                            </select>
                        </label>
                    </div>
                    <div style="width: 20%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;">Blood Group</span>
                            <input v-model="child.blood_group" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`Blood Group`">
                        </label>
                    </div>
                    <div style="width: 20%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;">Emergency Number</span>
                            <br>
                            <input type="hidden" v-model="child.emergency_country_code" />
                            <input type="hidden" v-model="child.emergency_phone_number"/>
                            <input v-model="child.emergency_number" style="width: 100% !important; margin-top: 4px !important;" :data-index="`child_${index}_emergency`" data-message="email_message" class="phone optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`Emergency Number`">
                        </label>
                    </div>
                    <div style="width: 20%;">
                        <label class="block text-sm" style="margin-bottom: 20px;">
                            <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;">Picture</span>
                            <input type="file" @change="child.profile_pic = $event.target.files[0]" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`Date of Issue`">
                        </label>
                    </div>
                </div>
                <!-- <div class="actions" style="display: flex; column-gap: 10px;">
                  <button @click="addNewChild" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    +
                  </button>
                  <button @click="deleteChild(child.id)" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    -
                  </button>
                </div> -->
              </div>

            <div class="actions">
                <button @click="addNewChild" class="bg-purple-600 text-white p-1 px-2 rounded-md">Add new Child</button>
            </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 6" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Financial Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 25%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Payment Status</span>
                    <select v-model="payment_status" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="regular">Regular</option>
                      <option value="level1">Level 1 - Request for payment</option>
                      <option value="level2">Level 2 - Payment Reminder Letter</option>
                      <option value="level3">Level 3 - Final Notice</option>
                      <option value="level4">Level 4 - Membership Cancelled</option>
                      <option value="cleared">Cleared</option>
                      <option value="re-regularised">Re-Regularized</option>
                    </select>
                  </label>
                </div>
                <div style="width: 25%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Form Fee</span>
                    <input
                        type="text"
                        :value="Number(form_fee).toLocaleString('en-US')"
                        @input="form_fee = $event.target.value.replace(/,/g, '')"
                        placeholder="Form Fee"
                        style="width: 100% !important; margin-top: 4px !important;"
                        class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      />
                </label>
                </div>
                <div style="width: 25%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Processing Fee</span>
                    <input
                      type="text"
                      :value="Number(processing_fee).toLocaleString('en-US')"
                      @input="processing_fee = $event.target.value.replace(/,/g, '')"
                      style="width: 100% !important; margin-top: 4px !important;"
                      data-message="email_message"
                      class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Processing Fee">
                  </label>
                </div>
                <div style="width: 25%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">First Payment</span>
                    <input
                      type="text"
                      :value="Number(first_payment).toLocaleString('en-US')"
                      @input="first_payment = $event.target.value.replace(/,/g, '')"
                      style="width: 100% !important; margin-top: 4px !important;"
                      data-message="email_message"
                      class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="First Payment">
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Total Installment</span>
                    <input
                      type="text"
                      :value="Number(total_installment).toLocaleString('en-US')"
                      @input="total_installment = $event.target.value.replace(/,/g, '')"
                      style="width: 100% !important; margin-top: 4px !important;"
                      data-message="email_message"
                      class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Total Installment">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Installment Month</span>
                    <input type="text" v-model="installment_month" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Installment Month">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Sum</span>
                    <input type="text" :value="totalSum" readonly style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Sum">
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 7" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Professional Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Company Name</span>
                    <input
                        v-model="company_name"
                        type="text"
                        placeholder="e.g Visionary Group"
                        data-message="company_name"
                        style="width: 100% !important; margin-top: 4px !important;"
                        class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      />
                </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Company Designation</span>
                    <input
                        v-model="company_designation"
                        type="text"
                        placeholder="e.g COO"
                        style="width: 100% !important; margin-top: 4px !important;"
                        class="step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      />
                </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Type of Profession</span>
                    <input
                      v-model="profession"
                      type="text"
                      style="width: 100% !important; margin-top: 4px !important;"
                      data-message="email_message"
                      class="step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Executive Leadership">
                  </label>
                </div>
              </div>
              <div style="column-gap: 20px;" :style="{ display: parseInt(membership_with_extra_details) === parseInt(membership_type) ? 'flex' : 'none'}">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400" style="margin-bottom: 20px;">Office Phone Number</span>
                    <br>
                    <input type="hidden" v-model="phone_numbers[2].countryCode" />
                    <input type="hidden" v-model="phone_numbers[2].phoneNumber"/>
                    <input style="width: 100% !important; margin-top: 4px !important;" v-model="office_ph_number" data-index="3" data-message="phone_field_message" class="optional phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Phone Number">
                    <span style="display: none;" class="phone_field_message text-xs text-red-600 dark:text-red-400">
                      Phone number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Country</span>
                    <input type="text" v-model="office_country" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Country">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">City</span>
                    <input type="text" v-model="office_city" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="City">
                  </label>
                </div>
              </div>
              <div style="column-gap: 20px;" :style="{ display: parseInt(membership_with_extra_details) === parseInt(membership_type) ? 'flex' : 'none'}">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Work Email</span>
                    <input type="text" v-model="work_email" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Country">
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Office Address</span>
                    <input type="text" v-model="office_address" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="City">
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 8" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Emergency and Health Information</h5>
              <div style="display: flex; column-gap: 20px;">
                <label class="block text-sm" style="margin-bottom: 20px; width: 50%">
                  <span class="text-gray-700 dark:text-gray-400">Blood Group</span>
                  <select v-model="blood_group" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    <option value="-">-</option>
                      <option value="a+">A+</option>
                    <option value="a-">A-</option>
                    <option value="b+">B+</option>
                    <option value="b-">B-</option>
                    <option value="ab+">AB+</option>
                    <option value="ab-">AB-</option>
                    <option value="o+">O+</option>
                    <option value="o-">O-</option>
                  </select>
                  <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                    Marital field is required
                  </span>
                </label>
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <input type="hidden" v-model="phone_numbers[2].countryCode" />
                    <input type="hidden" v-model="phone_numbers[2].phoneNumber"/>
                    <span class="text-gray-700 dark:text-gray-400">Emergency Contact</span>
                    <input type="text" v-model="emergency_contact" data-index="2" style="width: 100% !important; margin-top: 4px !important;" data-message="emergency_contact" class="optional phone step_7 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Emergency Contact">
                  </label>
                  <span style="display: none;" class="emergency_contact text-xs text-red-600 dark:text-red-400">
                    Emergency Contact field is required
                  </span>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 9" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Membership Card Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Profile Picture</span>
                    <input type="file" @change="profile_picture = $event.target.files[0]" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Profile Picture">
                  </label>
                  <p class="text-primary" style="margin-bottom: 20px; color: #0d6efd; font-size: 13px;">Expected aspect ratio 4/5</p>
                </div>
                <label class="block text-sm" style="margin-bottom: 20px; width: 50%">
                  <span class="text-gray-700 dark:text-gray-400">Card Type</span>
                  <select v-model="card_type" data-message="marital_field_message" class="step_8 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    <option value="Provisional Membership">Provisional Membership</option>
                    <option value="Family Not Allowed">Family Not Allowed</option>
                    <option value="cleared">Cleared</option>
                  </select>
                </label>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Date of Issue</span>
                    <input type="date" v-model="date_of_issue" style="width: 100% !important; margin-top: 4px !important;" data-message="date_of_issue" class="step_8 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Profile Picture">
                  </label>
                  <span style="display: none;" class="date_of_issue text-xs text-red-600 dark:text-red-400">
                    Date of Issue field is required
                  </span>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Validity</span>
                    <input type="date" v-model="validity" style="width: 100% !important; margin-top: 4px !important;" data-message="validity_message" class="step_8 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Profile Picture">
                  </label>
                  <span style="display: none;" class="validity_message text-xs text-red-600 dark:text-red-400">
                    Validity field is required
                  </span>
                  <div style="margin-bottom: 20px;">&nbsp;</div>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 10" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Locker Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Locker Category</span>
                    <select v-model="locker_category" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                      <option value="e">E</option>
                      <option value="f">F</option>
                    </select>
                    <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Marital field is required
                    </span>
                  </label>
                </div>
                <label class="block text-sm" style="margin-bottom: 20px; width: 50%">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Locker Number</span>
                    <input type="text" v-model="locker_number" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Locker Number">
                  </label>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div style="display: flex; column-gap: 10px; justify-content: space-between;">
              <button @click="previous" :disabled="current_step < 2" style="background: #1f2937;" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-700 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Previous
              </button>

              <div class="steps">
                <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse" style="display: flex; gap: 20px;">
                    <li v-for="step in total_steps" @click="current_step = step" style="cursor: pointer;" class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                        <span v-text="step" style="" :class="{ 'active': step < current_step, 'current-step': step === current_step }" class="points flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500"></span>
                    </li>
                </ol>
              </div>
              <div class="next-actions">
                <button v-if="current_step < total_steps" @click="next" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  Next
                </button>
                
                <button :disabled="is_submitting" @click="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" v-else>
                  <span v-if="is_submitting">Saving...</span>
                  <span v-else>Submit</span>
                </button>
              </div>
            </div>
          </div>

        </main>
<script>
Vue.component('v-select', VueSelect.VueSelect);

new Vue({
  el: '#app',
  data: {

    
    options: [],
    cities: [],
    selectedCountry: "",
    selectedCity: "",
    offset: 0,
    limit: 10,
    search: "",
    

    current_step: 1,
    total_steps: 10,
    errors: [],

    member_name: "",
    date_of_birth: "",
    cnic: "",
    gender: "male",
    marital_status: "married",

    phone: "",
    alt_phone_number: "",
    email: "",
    residential_address: "",
    city_country: "null",
    phone_number_code: "",
    alt_phone_number_code: "",

    membership_type: "permanent",
    membership_number: "",
    membership_status: "regular",
    file_number: "",
    date_of_applying: "",
    validity: "",
    date_of_issue: "",
    profilePictureBase64: "",
    profile_picture: "",

    spouses: [{id: 1, name: "", cnic: "", date_of_birth: "", date_of_issue: "", validity: "", blood_group: "", emergency_number: "", emergency_country_code: "", emergency_phone_number: "", profile_pic: "", hidden: false}],
    children: [{id: 1, childName: "", cnic: "", dob: "", date_of_issue: "", validity: "", blood_group: "", emergency_number: "", emergency_country_code: "", emergency_phone_number: "", profile_pic: "", child_card: "child", hidden: false}],

    form_fee: "",
    processing_fee: "",
    first_payment: "",
    total_installment: "",
    installment_month: "0",
    payment_status: "regular",

    blood_group: "a+",
    emergency_contact: "",

    card_type: "Provisional Membership",

    locker_category: "a",
    locker_number: "",

    company_name: "",
    company_designation: "",
    profession: "",
    office_ph_number: "",
    office_country: "",
    office_city: "",
    work_email: "",
    office_address: "",
    membership_with_extra_details: null,

    phone_numbers: [
      {countryCode: "", phoneNumber: ""},
      {countryCode: "", phoneNumber: ""},
      {countryCode: "", phoneNumber: ""},
      {countryCode: "", phoneNumber: ""},
    ],
    formData: null,
    cardTypes: [],
    is_submitting: false,
    steps: [],
    child_memberships: []
  },
  watch: {
    async selectedCountry(newValue) {
        const response = await axios.post("https://countriesnow.space/api/v0.1/countries/cities", { country: newValue.country });
        this.cities = response.data.data;
    },
    form_fee(newValue) {
      this.form_fee = newValue.toLocaleString();
    },
  },
  computed: {
    filtered() {
      return this.cities.filter((country) =>
        country.toLocaleLowerCase().includes(this.search.toLocaleLowerCase())
      )
    },
    paginated() {
      return this.filtered.slice(this.offset, this.limit + this.offset)
    },
    hasNextPage() {
      const nextOffset = this.offset + this.limit
      return Boolean(
        this.filtered.slice(nextOffset, this.limit + nextOffset).length
      )
    },
    hasPrevPage() {
      const prevOffset = this.offset - this.limit
      return Boolean(
        this.filtered.slice(prevOffset, this.limit + prevOffset).length
      )
    },
    totalSum() {
      let total = 0;

      if (this.form_fee && typeof parseInt(this.form_fee) === "number") total += parseInt(this.form_fee);
      if (this.processing_fee && typeof parseInt(this.processing_fee) === "number") total += parseInt(this.processing_fee);
      if (this.first_payment && typeof parseInt(this.first_payment) === "number") total += parseInt(this.first_payment);
      if (this.total_installment && typeof parseInt(this.total_installment) === "number") total += parseInt(this.total_installment);

      return new Intl.NumberFormat().format(total);
    }
  },
  methods: {
    
  async putCountryCodes() {
    const inputs = document.querySelectorAll(".phone");

    inputs.forEach(input => {
      const iti = window.intlTelInput(input, {
        initialCountry: "PK",
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
      });

      input.addEventListener("countrychange", () => updatePhoneNumber(iti, input));
      input.addEventListener("input", () => updatePhoneNumber(iti, input));
    });

    const updatePhoneNumber = (iti, input) => {
      const countryData = iti.getSelectedCountryData();
      const dataIndex = input.dataset.index;
      
      if (dataIndex && !isNaN(dataIndex)) {
        // Handle main phone numbers
        this.phone_numbers[dataIndex]["countryCode"] = countryData.dialCode;
        this.phone_numbers[dataIndex]["phoneNumber"] = iti.getNumber().replace(/^\+/, '');
      } else if (dataIndex && dataIndex.startsWith('spouse_')) {
        // Handle spouse emergency numbers
        const spouseIndex = parseInt(dataIndex.split('_')[1]);
        this.spouses[spouseIndex].emergency_country_code = countryData.dialCode;
        this.spouses[spouseIndex].emergency_phone_number = iti.getNumber().replace(/^\+/, '');
      } else if (dataIndex && dataIndex.startsWith('child_')) {
        // Handle child emergency numbers
        const childIndex = parseInt(dataIndex.split('_')[1]);
        this.children[childIndex].emergency_country_code = countryData.dialCode;
        this.children[childIndex].emergency_phone_number = iti.getNumber().replace(/^\+/, '');
      }
    };
  },
    onSearch(query) {
      this.search = query
      this.offset = 0
    },
    removeSpouse(id) {
      if (!(this.spouses.length > 1)) {
        Swal.fire("Last spouse can not be deleted");
        return;
      }
      this.spouses = this.spouses.filter(spouse => spouse.id != id);
    },
    removeChild(id) {
      if (!(this.children.length > 1)) {
        Swal.fire("Last Child can not be deleted");
        return;
      }
      this.children = this.children.filter(child => child.id != id);
    },
    async addSpouse() {
      await this.spouses.forEach(spouse => spouse.hidden = true);
      await this.spouses.push({
        id: this.spouses.length + 1,
        name: "", cnic: "", date_of_birth: "", date_of_issue: "",
        validity: "", blood_group: "", emergency_number: "", emergency_country_code: "", emergency_phone_number: "", profile_pic: "", hidden: false
      });
      
      await this.putCountryCodes();
    },
    convertToBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
      });
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      this.formData.append("profile_picture", file);
    },
    validate_inputs() {
      const inputs = document.querySelectorAll(`.step_${this.current_step}:not(.optional)`);
      let doesntHaveErrors = true;

      inputs.forEach(input => {
        const message = document.querySelector(`.${input.dataset.message}`);
        if (!input.value) {
          message.style.display = "block";
          input.classList.add("border-red-600");
          doesntHaveErrors = false;
        } else {
          input.classList.remove("border-red-600");
          message.style.display = "none";
        }
      });

      return doesntHaveErrors;
    },
    next() {
      this.current_step++;
    },
    previous() {
      this.current_step--;
    },
    async addNewChild() {
      await this.children.push({
        id: this.children.length + 1,
        name: "", cnic: "", date_of_birth: "", date_of_issue: "", validity: "", blood_group: "", emergency_number: "", emergency_country_code: "", emergency_phone_number: "", profile_pic: "", child_card: "",hidden: false
      });

      await this.putCountryCodes();
    },
    numberToOrdinal(n) {
      const ordinals = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth'];
      if (n >= 1 && n <= ordinals.length) return ordinals[n - 1];
      const suffixes = ['th', 'st', 'nd', 'rd'];
      const v = n % 100;
      const suffix = suffixes[(v - 20) % 10] || suffixes[v] || suffixes[0];
      return n + suffix;
    },
    normalizeIds() {
      this.children.forEach((child, index) => {
        child.id = index + 1;
      });
    },
    deleteChild(id) {
      this.children = this.children.filter(child => child.id !== id);
      this.normalizeIds();
    },
    getData() {
      const fd = new FormData();
      fd.append("member_name", this.member_name);
      fd.append("date_of_birth", this.date_of_birth);
      fd.append("gender", this.gender);
      fd.append("marital_status", this.marital_status);
      fd.append("cnic_passport", this.cnic);
      fd.append("phone_number", this.phone);
      fd.append("alternate_ph_number", this.alt_phone_number);
      fd.append("email_address", this.email);
      fd.append("residential_address", this.residential_address);
      fd.append("city_country", this.city_country);
      fd.append("member_city", this.selectedCity);
      fd.append("member_country", this.selectedCountry.country);
      fd.append("membership_type", this.membership_type);
      fd.append("membership_number", this.membership_number);
      fd.append("membership_status", this.membership_status);
      fd.append("file_number", this.file_number);
      fd.append("date_of_applying", this.date_of_applying);
      fd.append("form_fee", this.form_fee);
      fd.append("processing_fee", this.processing_fee);
      fd.append("first_payment", this.first_payment);
      fd.append("total_installment", this.total_installment);
      fd.append("installment_month", this.installment_month);
      fd.append("blood_group", this.blood_group);
      fd.append("emergency_contact", this.emergency_contact);
      fd.append("profile_picture", this.profile_picture);
      fd.append("card_type", this.card_type);
      fd.append("date_of_issue", this.date_of_issue);
      fd.append("validity", this.validity);
      fd.append("phone_numbers", JSON.stringify(this.phone_numbers));
      fd.append("payment_status", this.payment_status);
      fd.append("locker_category", this.locker_category);
      fd.append("locker_number", this.locker_number);
      fd.append("company_name", this.company_name);
      fd.append("company_designation", this.company_designation);
      fd.append("profession", this.profession);
      fd.append("office_phone_number", this.office_ph_number);
      fd.append("country", this.office_country);
      fd.append("city", this.office_city);
      fd.append("work_email", this.work_email);
      fd.append("office_address", this.office_address);

      this.spouses.forEach((spouse, index) => {
        fd.append(`spouses[${index}][name]`, spouse.name);
        fd.append(`spouses[${index}][cnic]`, spouse.cnic);
        fd.append(`spouses[${index}][date_of_birth]`, spouse.date_of_birth);
        fd.append(`spouses[${index}][date_of_issue]`, spouse.date_of_issue);
        fd.append(`spouses[${index}][validity]`, spouse.validity);
        fd.append(`spouses[${index}][blood_group]`, spouse.blood_group);
        fd.append(`spouses[${index}][emergency_number]`, spouse.emergency_number);
        fd.append(`spouses[${index}][emergency_country_code]`, spouse.emergency_country_code);
        fd.append(`spouses[${index}][emergency_phone_number]`, spouse.emergency_phone_number);
        fd.append(`spouses[${index}][profile_pic]`, spouse.profile_pic);
      });

      this.children.forEach((child, index) => {
        fd.append(`children[${index}][name]`, child.childName);
        fd.append(`children[${index}][cnic]`, child.cnic);
        fd.append(`children[${index}][date_of_birth]`, child.dob);
        fd.append(`children[${index}][date_of_issue]`, child.date_of_issue);
        fd.append(`children[${index}][validity]`, child.validity);
        fd.append(`children[${index}][blood_group]`, child.blood_group);
        fd.append(`children[${index}][emergency_number]`, child.emergency_number);
        fd.append(`children[${index}][emergency_country_code]`, child.emergency_country_code);
        fd.append(`children[${index}][emergency_phone_number]`, child.emergency_phone_number);
        fd.append(`children[${index}][profile_pic]`, child.profile_pic);
        fd.append(`children[${index}][card_id]`, child.child_card);
      });

      this.formData = fd;
    },
    async submit() {
      this.is_submitting = true;
      this.getData();

      try {
        const response = await axios.post(route("api.member.create"), this.formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          }
        });

        if (response.data.status === "200") {
          window.location = route("member.manage");
        }
      } catch (e) {
        Swal.fire({
          icon: 'warning',
          title: 'Incomplete Form',
          text: 'Make sure all fields are filled',
          confirmButtonText: 'OK'
        });
        console.error(e.response?.data?.errors ?? e);
      } finally {
        this.is_submitting = false;
      }
    }
  },
  async mounted() {
    const response = await axios.get("https://countriesnow.space/api/v0.1/countries/");
    this.options = response.data.data;

    const childrenCard = await axios.get(route("api.card.child"));
    this.child_memberships = childrenCard.data.data;

    const cardTypes = await axios.get(route("api.card.all"));
    this.cardTypes = cardTypes.data.data;
    this.membership_with_extra_details = this.cardTypes.find(ct => ct.card_name.toLowerCase() === 'corporate')?.id ?? null;
    this.membership_type = this.cardTypes[0].id;

    this.steps = document.querySelectorAll(".step-form");
    this.total_steps = this.steps.length;

    this.formData = new FormData();

    this.putCountryCodes();

  }
});
</script>

</x-layout.app>

