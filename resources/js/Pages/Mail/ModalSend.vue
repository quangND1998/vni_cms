<template>
  <div class="mb-6 flex justify-between items-center">
    <div>
      <form class="space-y-4 text-gray-700">
        <div
          v-if="showModal"
          class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
        >
          <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
              class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
            >
              <!--header-->
              <div
                class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t"
              >
                <h3 class="text-3xl font-semibold" v-if="editMode == false">{{ __('create') }} Page</h3>
                <h3 class="text-3xl font-semibold" v-else>{{ __('update') }} Page</h3>
                <button
                  class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                  @click="closeModal()"
                >
                  <span
                    class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none"
                  >
                    <i class="fas fa-times"></i>
                  </span>
                </button>
              </div>
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="country" class="block text-sm font-medium text-gray-700">Tags</label>
                  <Multiselect
                    v-model="form.contacts"
                    mode="tags"
                    :appendNewTag="false"
                    :createTag="false"
                    :searchable="true"
                    label="name"
                    valueProp="id"
                    trackBy="name"
                    :options="contacts"
                    class="multiselect-blue"
                  >
                    <template v-slot:tag="{ option, handleTagRemove, disabled }">
                      <div class="multiselect-tag is-user">
                        {{ option.name }} [ {{ option.email }} ]
                        <span
                          v-if="!disabled"
                          class="multiselect-tag-remove"
                          @mousedown.prevent="handleTagRemove(option, $event)"
                        >
                          <span class="multiselect-tag-remove-icon"></span>
                        </span>
                      </div>
                    </template>
                  </Multiselect>

                  <div class="text-red-500" v-if="errors.contacts">{{ errors.contacts }}</div>
                </div>
              </div>
              <!--footer-->
              <div
                class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
              >
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  type="button"
                  @click="closeModal()"
                >{{ __('cancel') }}</button>
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  type="submit"
                  @click.prevent="save"
                >Send</button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
      </form>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect/dist/multiselect.vue2.js";
import Icon from "@/Components/Icon";
export default {
  props: {
    errors: Object,
    contacts: Array
  },
  components: {
    Icon,
    Notification,
    Multiselect
  },
  data() {
    return {
      editMode: false,
      showModal: false,
      form: this.$inertia.form({
        id: null,
        contacts: null
      })
    };
  },
  mounted() {
    var self = this;
    Bus.$on("onSendMail", id => {
      this.editMode = false;
      this.form.id = id;
      this.toggleModal();
    });
  },

  methods: {
    save() {
      this.form.put(this.route("mail.sendMail", this.form.id), {
        preserveState: true,
        onError: errors => {
          if (Object.keys(errors).length > 0) {
            this.showModal = true;
            this.editMode = true;
          }
        },
        onSuccess: page => {
          this.showModal = false;
          this.editMode = false;
          this.reset();
        }
      });
    },
    reset: function() {
      this.form = this.$inertia.form({
        id: null,
        contacts: null

        // audio360: null
      });
    },
    toggleModal: function() {
      this.showModal = !this.showModal;
    },
    closeModal: function() {
      this.showModal = false;
      this.reset();
      this.editMode = false;
    }
  }
};
</script>
<style src="@vueform/multiselect/themes/default.css">
</style>
<style scoped>
</style>