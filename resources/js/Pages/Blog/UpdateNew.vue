<template>
  <div class="mt-10 sm:mt-0 overflow-auto">
    <h1 class="mt-2">
      <i class="fa fa-newspaper-o"></i> Cập nhật Tin Tức
    </h1>

    <div class="md:mt-0 md:col-span-3 mt-8">
      <form @submit.prevent="save">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label for="country" class="block text-sm font-medium text-gray-700">Tags</label>
                <Multiselect
                  v-model="form.tags"
                  mode="tags"
                  :appendNewTag="false"
                  :createTag="false"
                  :searchable="true"
                  label="name"
                  valueProp="id"
                  trackBy="name"
                  :options="tags"
                  class="multiselect-blue"
                />

                <div class="text-red-500" v-if="errors.tags">{{ errors.tags }}</div>
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label for="country" class="block text-sm font-medium text-gray-700">Thể Loại</label>
                <select
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  id="grid-state"
                  v-model="form.idTheLoai"
                >
                  <option
                    v-for="(theloai, index) in theloais"
                    :key="index"
                    :value="theloai.id"
                  >{{ theloai.Ten }}</option>
                </select>
                <div class="text-red-500" v-if="errors.idTheLoai">{{ errors.idTheLoai }}</div>
              </div>
             
          

              <div class="col-span-6 sm:col-span-3">
                <label
                  for="email_address"
                  class="block text-sm font-medium text-gray-700"
                >Tiêu Đề English</label>
                <input
                  v-model="form.TieuDe_en"
                  type="text"
                  name="email_address"
                  id="email_address"
                  autocomplete="email"
                  placeholder="Title English"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.TieuDe_en">{{ errors.TieuDe_en }}</div>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label
                  for="country"
                  class="block text-sm font-medium text-gray-700"
                >Tiêu Đề Tiếng Việt</label>
                <input
                  v-model="form.TieuDe_vn"
                  type="text"
                  name="email_address"
                  id="email_address"
                  placeholder="Title VietNamese"
                  autocomplete="email"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.TieuDe_vn">{{ errors.TieuDe_vn }}</div>
              </div>

             
              <div class="col-span-6 sm:col-span-3">
                <label
                  for="street_address"
                  class="block text-sm font-medium text-gray-700"
                >Content English</label>
                <div class="mt-1">
                  <ckeditor
                    v-model="form.NoiDung_en"
                    :config="editorConfig"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></ckeditor>
                </div>
                <div class="text-red-500" v-if="errors.NoiDung_en">{{ errors.NoiDung_en }}</div>
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label
                  for="street_address"
                  class="block text-sm font-medium text-gray-700"
                >Content VietNamese</label>
                <div class="mt-1">
                  <ckeditor
                    v-model="form.NoiDung_vn"
                    :config="editorConfig2"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></ckeditor>
                </div>
                <div class="text-red-500" v-if="errors.NoiDung_vn">{{ errors.NoiDung_vn }}</div>
              </div>
                 <div class="col-span-6 sm:col-span-3">
                <label for="country" class="block text-sm font-medium text-gray-700">Image</label>
                <input
                  @input="form.image  = $event.target.files[0]"
                  type="file"
                  name="email_address"
                  id="email_address"
                  placeholder="Title VietNamese"
                  autocomplete="Image"
                  accept=".png, .jpeg, .jpg"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label for="street_address" class="block text-sm font-medium text-gray-700">Nổi Bật</label>
                <div class="mt-1">
                  <input
                    type="radio"
                    v-model="form.NoiBat"
                    name="inlineRadioOptions"
                    id="inlineRadio1"
                    value="0"
                    class="form-check-input form-check-input ml-2 appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                  />
                  <div class="ml-2 text-sm">
                    <span
                      value="0"
                      for="helper-checkbox"
                      class="font-medium text-gray-900 dark:text-gray-300"
                    >Không</span>
                  </div>
                  <input
                    type="radio"
                    v-model="form.NoiBat"
                    name="inlineRadioOptions"
                    id="inlineRadio1"
                    value="1"
                    class="form-check-input form-check-input ml-2 appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                  />
                  <div class="ml-2 text-sm">
                    <span
                     
                      for="helper-checkbox"
                      class="font-medium text-gray-900 dark:text-gray-300"
                    >Có</span>
                  </div>
                </div>
                <div class="text-red-500" v-if="errors.NoiBat">{{ errors.NoiBat }}</div>
              </div>
          
          </div>
          </div>

          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <Link
              type="button"
              :href="route('tintuc.index')"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
            >Back</Link>
            <button
              type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect/dist/multiselect.vue2.js";
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout";
import { Link } from "@inertiajs/inertia-vue";

export default {
  layout: Layout,
  props: {
    tags: Array,
    tintuc: Object,
    theloais: Array,
    errors: Object
  },
  components: {
    Link,
    Icon,
    Multiselect
  },
  data() {
    return {
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
      editorConfig2: {
        // The configuration of the editor.
      },
      form: this.$inertia.form({
        id: null,
        TieuDe: null,
        TieuDe_en: null,
        TieuDe_vn: null,
        NoiDung: null,
        NoiDung_en: null,
        NoiDung_vn: null,
        image: null,
        NoiBat: 0,
        tags: this.getData(),
        idTheLoai: null
      })
    };
  },
  mounted() {
    this.form.id = this.tintuc.id;
    this.form.TieuDe = this.tintuc.TieuDe;
    this.form.NoiDung = this.tintuc.NoiDung;
    const result = this.tintuc.languages.find(
      element => element.key == this.form.TieuDe
    );
    this.form.TieuDe_en = result == undefined ? null : result.en;
    this.form.TieuDe_vn = result == undefined ? null : result.vn;

    const result2 = this.tintuc.languages.find(
      element => element.key == this.tintuc.NoiDung
    );
    this.form.NoiDung_en = result2 == undefined ? null : result2.en;
    this.form.NoiDung_vn = result2 == undefined ? null : result2.vn;
    this.form.NoiBat = this.tintuc.NoiBat;
    this.form.idTheLoai = this.tintuc.idTheLoai;
  },
  computed: {},

  methods: {
    getData() {
      let array = [];
      if (this.tintuc.tags.length > 0) {
        this.tintuc.tags.map(function(value, key) {
          array.push(parseInt(value.id));
        });
      }

      return array;
    },

    save() {
      this.form.post(this.route("tintuc.update", this.tintuc.id), {
        preserveState: true,

        onError: errors => {
          if (Object.keys(errors).length > 0) {
          }
        },
        onSuccess: page => {
          this.reset();
        }
      });
    },
    reset: function() {
      this.form.TieuDe = this.tintuc.TieuDe;
      this.form.NoiDung = this.tintuc.NoiDung;
      const result = this.tintuc.languages.find(
        element => element.key == this.form.TieuDe
      );
      this.form.TieuDe_en = result == undefined ? null : result.en;
      this.form.TieuDe_vn = result == undefined ? null : result.en;

      const result2 = this.tintuc.languages.find(
        element => element.key == this.tintuc.NoiDung
      );
      this.form.NoiDung_en = result2 == undefined ? null : result2.en;
      this.form.NoiDung_vn = result2 == undefined ? null : result2.en;
      this.form.NoiBat = this.tintuc.NoiBat;
      this.form.idTheLoai = this.tintuc.idTheLoai;
      let object = Object.assign({}, this.tintuc.tags);
    }
  }
};
</script>
<style src="@vueform/multiselect/themes/default.css">
</style>
<style>
</style>