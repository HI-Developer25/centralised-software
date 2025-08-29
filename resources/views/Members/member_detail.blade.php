<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
    input[type='checkbox'] {
      width: 12px;
      height: 12px;
    }
    .tab-button:hover {
      color: white;
    }
  </style>
  <script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    <div>
      <div class="container px-6 mx-auto flex items-center" style="margin-top: 50px;">
        <div>
          <label for="profile_picture">
            <img id="profileImage" style="cursor: pointer; border-radius: 100%; height: 100px; width: 100px;" src="https://gwadargymkhana.com.pk/members/storage/{{ $member->profile_picture }}"/>
            <input type="file" @change="changeProfilePicture" id="profile_picture" v-show="false" />
          </label>
        </div>
        <div style="margin-left: 10px;">
          <h1 style="font-size: 20px; font-weight: bold;" class="editable" data-editable="member_name" data-type="text">{{ $member->member_name }}</h1>
          <input type="hidden" id="member_name" value="{{ $member->member_name }}"/>
          <p style="margin-bottom: 5px; font-size: 13px; font-style: italic;">{{ $member->membership->card_name }} Membership</p>
          <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 p-1 px-2 rounded-md">{{ $member->payment_status }}</span>
          </div>
      </div>
      <div class="container px-6 mx-auto" style="margin-top: 50px; display: flex; column-gap: 40px;">
              <!-- Sidebar Tabs -->
        <div class="tabs">
          <div style="margin-bottom: 20px;">
            <button @click="tab = 'personal information'" :class="{'bg-purple-600 text-white': tab === 'personal information'}" style="width: 200px; text-align: left;" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Personal Information
            </button>
          </div>

          <div @click="tab = 'contact information'" style="margin-bottom: 20px;">
            <button style="width: 200px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'contact information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Contact Information
            </button>
          </div>

          <div @click="tab = 'professional information'" style="margin-bottom: 20px;">
            <button style="width: 200px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'professional information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Professional Information
            </button>
          </div>

          <div @click="tab = 'membership information'" style="margin-bottom: 20px;">
            <button style="width: 200px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'membership information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Membership
            </button>
          </div>

          <div @click="tab = 'payment information'" style="margin-bottom: 20px;">
            <button style="width: 200px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'payment information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Payments
            </button>
          </div>

          <div @click="tab = 'locker information'" style="margin-bottom: 20px;">
            <button style="width: 200px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'locker information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Locker
            </button>
          </div>
        </div>
        <div v-show="tab === 'personal information'">
          <p><span style="display: inline-block; width: 200px;">Name:</span> <span editable="true">{{ $member->member_name }}</span></p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Date of Birth:</span> 
              <span class="editable" data-editable="date_of_birth" data-type="date">
                {{ \Carbon\Carbon::parse($member->date_of_birth)->format("d-M-Y") }}
              </span> 
              <input type="hidden" id="date_of_birth" value="{{ $member->date_of_birth }}"/>
          </p>
          <p style="margin-top: 10px;">
            <span style="display: inline-block; width: 200px; text-transform: capitalize;">Gender:</span> 
            <span class="editable" data-editable="gender" data-type="text">
              {{ $member->gender }}
            </span>
            <select id="gender" style="display: none;">
              <option class="male">Male</option>
              <option class="female">Female</option>
            </select>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px; text-transform: capitalize;">
            Marital Status:</span> 
            <span class="editable" data-editable="marital_status" data-type="text">
              {{ $member->marital_status }}
            </span>
            <select id="marital_status" style="display: none;">
              <option class="single">Single</option>
              <option class="divorced">Divorced</option>
              <option class="Married">married</option>
            </select>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">CNIC/Passport:</span> 
            <span class="editable" data-editable="cnic_passport" data-type="text">
              {{ $member->cnic_passport }}
            </span>
            <input type="hidden" id="cnic_passport" value="{{ $member->cnic_passport }}"/>
            </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">City/Country:</span> {{ $member->country }}/{{ $member->city }}</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Blood Group:</span> 
            <span style="text-transform: uppercase;" class="editable" data-editable="blood_group" data-type="text">{{ $member->blood_group }}</span>
            <select id="blood_group" style="display: none;">
                <option value="a+">A+</option>
                <option value="a-">A−</option>
                <option value="b+">B+</option>
                <option value="b-">B−</option>
                <option value="ab+">AB+</option>
                <option value="ab-">AB−</option>
                <option value="o+">O+</option>
                <option value="o-">O−</option>
            </select>
          </p>
        </div>
        <div v-show="tab === 'contact information'">
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Phone Number:</span> 
            @php
              $phone_number = Str::replaceFirst("+", $member->phone_number_code, Str::replaceFirst($member->phone_number_code, "", $member->phone_number));
            @endphp
            {{ strlen(Str::replaceFirst($member->phone_number_code, "", $member->phone_number)) > 0 ? $phone_number : "-" }}
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Alternate Phone Number:</span> 
            @php
              $alternate_ph_number = str_replace("+", $member->alternate_ph_number_code,  Str::replaceFirst($member->alternate_ph_number_code, "", $member->alternate_ph_number));
            @endphp
            {{ strlen(Str::replaceFirst($member->alternate_ph_number_code, "", $alternate_ph_number)) > 0 ? $alternate_ph_number : "-" }}
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Emergency Number:</span>
            @php
              $emergency_ph_number = Str::replaceFirst(
                "+", 
                $member->emergency_contact_code, 
                Str::replaceFirst(
                  $member->emergency_contact_code, 
                  "", 
                  $member->emergency_contact
                )) ;
            @endphp
            <span class="editable" data-editable="emergency_contact">
              {{ strlen(Str::replaceFirst($member->emergency_contact_code, "", $emergency_ph_number)) > 0 ? $emergency_ph_number : "-" }}
            </span>
            <input type="hidden" id="emergency_contact" value="{{ $member->emergency_contact }}"/>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Email Address:</span> 
            <span class="editable" data-editable="email_address" type="email">
              {{ $member->email_address }}
            </span>
            <input type="hidden" id="email_address" value="{{ $member->email_address }}"/>
          </p>
        </div>
        <div v-show="tab === 'professional information'">
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Company Name:</span> 
            <span class="editable" data-editable="profession.company_name">
              {{ $member->profession?->company_name ?? "N/A" }}
            </span>
            <input type="hidden" id="profession.company_name" value="{{ $member->profession?->company_name ?? 'N/A' }}"/>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Designation:</span> {{ $member->profession?->designation ?? "N/A" }}</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Profession:</span> {{ $member->profession?->type_of_profession ?? "N/A" }}</p>
          @if($member->membership->card_name === "Corporate" || $member->membership->card_name === 'corporate')
            <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Office Address:</span> {{ $member->profession?->office_address ?? "N/A" }}</p>
            <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Office Phone Number:</span> {{ $member->profession?->office_phone_number ?? "N/A" }}</p>
            <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Country:</span> {{ $member->profession?->country ?? "N/A" }}</p>
            <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">City:</span> {{ $member->profession?->city ?? "N/A" }}</p>
            <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Work Email:</span> {{ $member->profession?->work_email ?? "N/A" }}</p>
          @endif
        </div>
        <div v-show="tab === 'membership information'">
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Membership Type:</span> 
            <span class="editable" data-editable="membership_type">
              {{ $member->membership->card_name }}
            </span>
            <select id="membership_type" style="display: none;">
              @foreach($memberships as $membership)
                <option value="{{ $membership->id }}">{{ $membership->card_name }}</option>
              @endforeach
            </select>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Membership Number:</span> 
            <span class="editable" data-editable="membership_number">
              {{ $member->membership_number }}
            </span>
            <input type="hidden" id="membership_number" value="{{ $member->membership_number }}"/>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Card Type:</span> 
            <span class="editable" data-editable="card_type" type="text">
              {{ $member->card_type }}
            </span>
            <select id="card_type" style="display: none;">
              <option value="cleared">Cleared</option>
              <option value="Provisional Membership">Provisional Membership</option>
              <option value="Family Not Allowed">Family Not Allowed</option>
            </select>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Date of Issue(Card):</span> 
            <span class="editable" data-editable="date_of_issue" data-type="date">
              {{ \Carbon\Carbon::parse($member->date_of_issue)->format("d-M-Y") }}
            </span>
            <input type="hidden" id="date_of_issue" value="{{ $member->date_of_issue }}"/>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Validity(Card):</span> 
            <span class="editable" data-editable="validity" data-type="date">
              {{ \Carbon\Carbon::parse($member->validity)->format("d-M-Y") }}
            </span>
            <input type="hidden" id="validity" value="{{ $member->validity }}"/>
          </p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Date of Applying:</span> {{ \Carbon\Carbon::parse($member->date_of_applying)->format("d-M-Y") }}</p>
        </div>
        <div v-show="tab === 'payment information'">
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">File Number:</span> {{ $member->file_number }}</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Form Fee:</span> {{ number_format($member->form_fee) }}/-</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Processing Fee:</span> {{ number_format($member->processing_fee) }}/-</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">First Payment:</span> {{ number_format($member->first_payment) }}/-</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Total Installment:</span> {{ number_format($member->total_installment) }}/-</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Installment Month:</span> {{ $member->installment_month }}</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Total:</span> {{ number_format($member->form_fee + $member->processing_fee + $member->first_payment + $member->total_installment) }}/-</p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Payment Status:</span> {{ $member->payment_status }}</p>
        </div>
        <div v-show="tab === 'locker information'">
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Locker Category:</span> <span style="text-transform: uppercase;">{{ $member->locker_category }}</span></p>
          <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Locker Number:</span> {{ $member->locker_number }}</p>
        </div>
      </div>
    </div>

    <div class="container px-6 mx-auto">
      
      <h1 class="flex items-center" style="margin-top: 50px; font-weight: bold;">Spouses</h1>
      <div class="spouses flex flex-wrap">
      @foreach($member->spouses as $spouse)
        <div class="spouse" style="width: 33.33%; display: flex; flex-direction: column; justify-content: center;">
          <div class="container px-6 mx-auto flex items-center" style="margin-top: 50px;">
            <div>
              <label for="picture.{{ $spouse->id }}">
                <img id="spouse.{{ $spouse->id }}" style="cursor: pointer; border-radius: 100%; height: 100px; width: 100px;" src="https://gwadargymkhana.com.pk/members/storage/{{ $spouse->picture }}"/>
                <input type="file" @change="changeSpousePicture" id="picture.{{ $spouse->id }}" v-show="false" />
              </label>
            </div>
            <br>
            <div style="margin-left: 10px;">
              <h1 style="font-size: 20px; font-weight: bold;" class="editable" data-editable="spouse.spouse_name.{{ $spouse->id }}" data-type="text">{{ $spouse->spouse_name }}</h1>
              <input type="hidden" id="spouse.spouse_name.{{ $spouse->id }}" value="{{ $member->member_name }}"/>
              <p style="margin-bottom: 5px; font-size: 13px; font-style: italic;">{{ $member->membership->card_name }} Membership</p>
              @if($member->membership_status === "regular")
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 p-1 px-2 rounded-md">Regular</span>
              @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300 p-1 px-2 rounded-md">{{ $member->membership_status }}</span>
              @endif
            </div>
          </div>
          <div class="container px-6 mx-auto" style="margin-top: 30px;">
            <p>Date of Birth: 
              <span class="editable" data-editable="spouse.date_of_birth.{{ $spouse->id }}" data-type="date">
                {{ \Carbon\Carbon::parse($spouse->date_of_birth)->format("d M Y") }}
              </span>
              <input type="hidden" id="spouse.date_of_birth.{{ $spouse->id }}" value="{{ $spouse->date_of_birth }}"/>
            <p>
            <p>Date of Issue: 
              <span class="editable" data-editable="spouse.date_of_issue.{{ $spouse->id }}" data-type="date">
                {{ \Carbon\Carbon::parse($spouse->date_of_issue)->format("d M Y") }}
              </span>
              <input type="hidden" id="spouse.date_of_issue.{{ $spouse->id }}" value="{{ $spouse->date_of_issue }}"/>
            <p>
            <p>Validity: 
              <span class="editable" data-editable="spouse.validity.{{ $spouse->id }}" data-type="date">
                {{ \Carbon\Carbon::parse($spouse->validity)->format("d M Y") }}
              </span>
              <input type="hidden" id="spouse.validity.{{ $spouse->id }}" value="{{ $spouse->validity }}"/>
            <p>
            <p>Blood Group: 
              <span class="editable" data-editable="spouse.blood_group.{{ $spouse->id }}">
                {{ $spouse->blood_group }}
              </span>
              <input type="hidden" id="spouse.blood_group.{{ $spouse->id }}" value="{{ $spouse->blood_group }}"/>
            <p>
          </div>
          <button class="bg-purple-600" @click="divorce('{{ $spouse->id }}')" style="color: white; width: 90%; margin: 0 auto; border-radius: 5px; margin-top: 10px;">Delete</button>
        </div>
      @endforeach
      <div @click="addSpouse" style="padding: 10px 10px; width: 33.33%; border: 1px dashed black; border-radius: 5px; margin-top: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
        <span style="color: white; background: rgba(126, 58, 242, var(--bg-opacity);border-radius: 50px; display: flex; align-items: center; justify-content: center;">
          <i class="fa-solid fa-plus" style="padding: 5px;"></i>
        </span>
      </div>
    </div>
   </div>

    <div class="container px-6 mx-auto">
      <h1 class="" style="margin-top: 50px; font-weight: bold;">Children</h1>
      <div class="children flex flex-wrap">
        @foreach($member->children as $child)
          <div class="child" style="width: 33.33%;">
            <div class="flex items-center" style="margin-top: 50px;">
              <div>
                <label for="profile_pic.{{ $child->id }}">
                  <img id="image.{{ $child->id }}" style="cursor: pointer; border-radius: 100%; height: 100px; width: 100px;" src="https://gwadargymkhana.com.pk/members/storage/{{ $child->profile_pic }}"/>
                  <input type="file" @change="changeChildPicture" id="profile_pic.{{ $child->id }}" v-show="false" />
                </label>
              </div>
              <br>
              <div style="margin-left: 10px;">
                <h1 style="font-size: 20px; font-weight: bold;" class="editable" data-editable="child.child_name.{{ $child->id }}" data-type="text">{{ $child->child_name }}</h1>
                <input type="hidden" id="child.child_name.{{ $child->id }}" value="{{ $child->child_name }}"/>
                <span class="editable" data-editable="child.membership_id.{{ $child->id }}">
                  <p style="margin-bottom: 5px; font-size: 13px; font-style: italic;">{{ $child->membership->card_name }} Membership</p>
                </span>
                <select style="display: none;" id="child.membership_id.{{ $child->id }}">
                  @foreach ($childMemberships as $childMembership)
                    <option value="{{ $childMembership->id }}">{{ $childMembership->card_name }}</option>
                  @endforeach
                </select>
                @if($member->membership_status === "regular")
                  <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 p-1 px-2 rounded-md">Regular</span>
                @else
                  <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300 p-1 px-2 rounded-md">{{ $member->membership_status }}</span>
                @endif
              </div>
            </div>
            <div class="" style="margin-top: 30px;">
              <p>Date of Birth: 
                <span class="editable" data-editable="child.date_of_birth.{{ $child->id }}" data-type="date">
                  {{ \Carbon\Carbon::parse($child->date_of_birth)->format("d M Y") }}
                </span>
                <input type="hidden" id="child.date_of_birth.{{ $child->id }}" value="{{ $child->date_of_birth }}"/>
              <p>
              <p>Date of Issue: 
                <span class="editable" data-editable="child.date_of_issue.{{ $child->id }}" data-type="date">
                  {{ \Carbon\Carbon::parse($child->date_of_issue)->format("d M Y") }}
                </span>
                <input type="hidden" id="child.date_of_issue.{{ $child->id }}" value="{{ $child->date_of_issue }}"/>
              <p>
              <p>Validity: 
                <span class="editable" data-editable="child.validity.{{ $child->id }}" data-type="date">
                  {{ \Carbon\Carbon::parse($child->validity)->format("d M Y") }}
                </span>
                <input type="hidden" id="child.validity.{{ $child->id }}" value="{{ $child->validity }}"/>
              <p>
              <p>Blood Group: 
                <span class="editable" data-editable="child.blood_group.{{ $child->id }}" data-type="text">
                  {{ $child->blood_group }}
                </span>
                <input type="hidden" id="child.blood_group.{{ $child->id }}" value="{{ $child->validity }}"/>
              <p>
            </div>
            <button class="bg-purple-600" @click="deleteChild('{{ $child->id }}')" style="color: white; width: 90%; margin: 0 auto; border-radius: 5px; margin-top: 10px;">Delete</button>
          </div>
        @endforeach
        <div @click="addChild" style="padding: 10px 10px; width: 33.33%; border: 1px dashed black; border-radius: 5px; margin-top: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
          <span style="color: white; background: rgba(126, 58, 242, var(--bg-opacity);border-radius: 50px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-plus" style="padding: 5px;"></i>
          </span>
        </div>
      </div>
    </div>
  </main>
  <script>
    const app = Vue.createApp({
      data() {
        return {
          tab: "personal information"
        }
      },
      methods: {
        async deleteChild(id) {
            // Show confirmation dialog
            const result = await Swal.fire({
              title: 'Are you sure?',
              text: "This will permanently delete this child record.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'Cancel'
            });

            if (result.isConfirmed) {
            try {
              const response = await axios.post(route("api.child.delete", id), { _method: "DELETE" });

              if (response.status === 200) {
                await Swal.fire(
                  'Deleted!',
                  'The child record has been deleted.',
                  'success'
                );
                window.location.reload();
              } else {
                await Swal.fire(
                  'Error!',
                  'Could not delete the child record.',
                  'error'
                );
              }
            } catch (error) {
              console.error('Error deleting child:', error);
              await Swal.fire(
                'Error!',
                'Something went wrong. Please try again.',
                'error'
              );
            }
          }
        },

        async divorce(id) {
          const confirmed = await Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this spouse? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
          });

          if (confirmed.isConfirmed) {
            try {
              const response = await axios.post(route('api.spouse.delete', id), { _method: "DELETE" });
              if (response.status === 200) {
                await Swal.fire('Deleted!', 'The spouse record has been deleted.', 'success');
                window.location.reload();
              }
            } catch (error) {
              console.error('Error deleting spouse:', error);
              await Swal.fire('Error', 'Could not delete spouse. Please try again.', 'error');
            }
          }
        },

        changeSpousePicture(e) {
          const id = e.target.id.split(".")[1];
          const file = e.target.files[0];
          const reader = new FileReader();
          const spouse_pic = document.getElementById(`spouse.${id}`);
          reader.onload = async function(event) {
            const base64String = event.target.result;
            spouse_pic.src = base64String;

            const formData = new FormData();
            formData.append("_method", "PATCH");
            formData.append("attribute", "picture");
            formData.append("value", file);

            const response = await axios.post(route('spouse.patch', { spouse: id }), formData, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            });

          };

          reader.readAsDataURL(file); 
        },
        changeChildPicture(e) {
          const id = e.target.id.split(".")[1];
          console.log(e.target.id);
          const file = e.target.files[0];
          const reader = new FileReader();
          const child_pic = document.getElementById(`image.${id}`);
          reader.onload = async function(event) {
            const base64String = event.target.result;
            child_pic.src = base64String;

            const formData = new FormData();
            formData.append("_method", "PATCH");
            formData.append("attribute", "profile_pic");
            formData.append("value", file);

            const response = await axios.post(route('child.patch', { child: id }), formData, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            });

          };

          reader.readAsDataURL(file); 
        },
        addSpouse() {
                 Swal.fire({
    title: 'Membership Form',
    width: 600,
    html: `
      <style>
        .swal-form-group {
          display: flex;
          flex-direction: column;
          margin-bottom: 12px;
          text-align: left;
        }
        .swal-form-group label {
          font-weight: bold;
          margin-bottom: 4px;
        }
        .swal-form-group input,
        .swal-form-group select {
          padding: 8px;
          width: 100%;
          box-sizing: border-box;
        }
      </style>

      <div class="swal-form-group">
        <label for="swal-name">Name</label>
        <input type="text" id="swal-name" placeholder="Enter Name">
      </div>

      <div class="swal-form-group">
        <label for="swal-dob">Date of Birth</label>
        <input type="date" id="swal-dob">
      </div>

      <div class="swal-form-group">
        <label for="swal-issue">Date of Issue</label>
        <input type="date" id="swal-issue">
      </div>

      <div class="swal-form-group">
        <label for="swal-cnic">CNIC</label>
        <input type="text" id="swal-cnic">
      </div>

      <div class="swal-form-group">
        <label for="swal-validity">Validity</label>
        <input type="date" id="swal-validity">
      </div>

      <div class="swal-form-group">
        <label for="swal-blood">Blood Group</label>
        <input type="text" id="swal-blood" placeholder="e.g. A+, B-">
      </div>

      <div class="swal-form-group">
        <label for="swal-profile">Profile Picture</label>
        <input type="file" id="swal-profile">
      </div>
    `,
    showCancelButton: true,
    confirmButtonText: 'Submit',
    focusConfirm: false,
    preConfirm: () => {
      return {
        name: document.getElementById('swal-name').value,
        cnic: document.getElementById("swal-cnic").value,
        date_of_birth: document.getElementById('swal-dob').value,
        date_of_issue: document.getElementById('swal-issue').value,
        validity: document.getElementById('swal-validity').value,
        blood_group: document.getElementById('swal-blood').value,
        profile_pic: document.getElementById('swal-profile').files[0]
      }
    }
  }).then((result) => {
    if (result.isConfirmed) {
       // Prepare form data for AJAX
      const formData = new FormData();
      formData.append('spouse_name', result.value.name);
      formData.append('member_id', route().params.member)
      formData.append('date_of_birth', result.value.date_of_birth);
      formData.append('date_of_issue', result.value.date_of_issue);
      formData.append("cnic", result.value.cnic),
      formData.append('validity', result.value.validity);
      formData.append('blood_group', result.value.blood_group);
      if (result.value.profile_pic) {
        formData.append('picture', result.value.profile_pic);
      }

      // Send via AJAX using fetch
         axios.post(route("api.spouse.create"), formData)
      .then(response => {
        Swal.fire('Success!', 'Form submitted successfully.', 'success');
        console.log('Server Response:', response.data);
        window.location.reload();
      })
      .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Something went wrong.', 'error');
      });

    }
  });
        },
        addChild() {
          Swal.fire({
    title: 'Membership Form',
    width: 600,
    html: `
      <style>
        .swal-form-group {
          display: flex;
          flex-direction: column;
          margin-bottom: 12px;
          text-align: left;
        }
        .swal-form-group label {
          font-weight: bold;
          margin-bottom: 4px;
        }
        .swal-form-group input,
        .swal-form-group select {
          padding: 8px;
          width: 100%;
          box-sizing: border-box;
        }
      </style>

      <div class="swal-form-group">
        <label for="swal-name">Name</label>
        <input type="text" id="swal-name" placeholder="Enter Name">
      </div>

      <div class="swal-form-group">
        <label for="swal-membership">Membership</label>
        <select id="swal-membership">
          <option value="">Select Membership</option>
          @foreach($childMemberships as $childMembership)
            <option value="{{ $childMembership->id }}">{{ $childMembership->card_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="swal-form-group">
        <label for="swal-dob">Date of Birth</label>
        <input type="date" id="swal-dob">
      </div>

      <div class="swal-form-group">
        <label for="swal-issue">Date of Issue</label>
        <input type="date" id="swal-issue">
      </div>

      <div class="swal-form-group">
        <label for="swal-cnic">CNIC</label>
        <input type="text" id="swal-cnic">
      </div>

      <div class="swal-form-group">
        <label for="swal-validity">Validity</label>
        <input type="date" id="swal-validity">
      </div>

      <div class="swal-form-group">
        <label for="swal-blood">Blood Group</label>
        <input type="text" id="swal-blood" placeholder="e.g. A+, B-">
      </div>

      <div class="swal-form-group">
        <label for="swal-profile">Profile Picture</label>
        <input type="file" id="swal-profile">
      </div>
    `,
    showCancelButton: true,
    confirmButtonText: 'Submit',
    focusConfirm: false,
    preConfirm: () => {
      return {
        name: document.getElementById('swal-name').value,
        membership: document.getElementById('swal-membership').value,
        cnic: document.getElementById("swal-cnic").value,
        date_of_birth: document.getElementById('swal-dob').value,
        date_of_issue: document.getElementById('swal-issue').value,
        validity: document.getElementById('swal-validity').value,
        blood_group: document.getElementById('swal-blood').value,
        profile_pic: document.getElementById('swal-profile').files[0]
      }
    }
  }).then((result) => {
    if (result.isConfirmed) {
       // Prepare form data for AJAX
      const formData = new FormData();
      formData.append('child_name', result.value.name);
      formData.append('member_id', route().params.member)
      formData.append('membership_id', result.value.membership);
      formData.append('date_of_birth', result.value.date_of_birth);
      formData.append('date_of_issue', result.value.date_of_issue);
      formData.append("cnic", result.value.cnic),
      formData.append('validity', result.value.validity);
      formData.append('blood_group', result.value.blood_group);
      if (result.value.profile_pic) {
        formData.append('profile_pic', result.value.profile_pic);
      }

      // Send via AJAX using fetch
         axios.post(route("api.child.create"), formData)
      .then(response => {
        Swal.fire('Success!', 'Form submitted successfully.', 'success');
        console.log('Server Response:', response.data);

        window.location.reload();
      })
      .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Something went wrong.', 'error');
      });

    }
  });
        },
        changeProfilePicture(e) {
          const file = e.target.files[0];
          const reader = new FileReader();

          reader.onload = async function(event) {
            const base64String = event.target.result;
            profileImage.src = base64String;

            const formData = new FormData();
            formData.append("_method", "PATCH");
            formData.append("attribute", "profile_picture");
            formData.append("value", file);

            const response = await axios.post(route('member.patch', route().params), formData, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            });

            console.log(response);
          };

          reader.readAsDataURL(file); 
        }
      },
      mounted() {
        const editables = document.querySelectorAll(".editable");

        editables.forEach(editable => {
        editable.addEventListener("click", function(e) {
          const input_field = document.getElementById(e.currentTarget.dataset?.editable);
          if (!input_field) return;

          // Remember original type
          if (!input_field.dataset.originalType) {
            input_field.dataset.originalType = input_field.type;
          }

          // Show as text input
          input_field.type = e.currentTarget.dataset?.type;
          input_field.style.display = "inline";
          input_field.focus();
          editable.style.display = "none";

          // Handle blur ONCE
          input_field.addEventListener("blur", async function handler() {
            // Restore input type
            input_field.type = input_field.dataset.originalType;
            input_field.style.display = "none";
            editable.style.display = "inline";
            editable.textContent = input_field.value;
            console.log(input_field.tagName);
            input_field.click();
            input_field.focus();

            let parameter = {};
            let routeName = 'member.patch';
            if(input_field.id.includes(".") && input_field.id.includes("child")) {
              routeName = 'child.patch';
              parameter.child = input_field.id.split(".")[2]
            } else if(input_field.id.includes(".") && input_field.id.includes("spouse")) {
              routeName = 'spouse.patch';
              parameter.spouse = input_field.id.split(".")[2];
            } else {
              routeName = "member.patch";
              parameter = { ...route().params };
            }
          
            const response = await axios.post(route(routeName, { 
              ...parameter, 
              attribute: input_field.id.split(".")?.[1] ?? input_field.id, 
              value: input_field.value, 
              _method: "PATCH" 
            }));
            console.log(response);

          }, { once: true });

          // Handle Enter key ONCE
          input_field.addEventListener("keydown", function handler(e) {
            if (e.key === "Enter") {
              e.preventDefault();
              input_field.blur();
            }
          }, { once: true });
        });
      });
        
      }
    }).mount("#app");
  </script>
</x-layout.app>

