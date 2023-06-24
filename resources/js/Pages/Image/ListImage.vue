<template>
  <div class="mt-20 sm:mt-0">
    <BreadCrumbVue :page="page" :section="section" :name="null" />
    <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <button
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-sm px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          type="button"
          @click="onAdd()"
        >
          <icon class="w-6 h-6" name="create" />Add Image
        </button>
      </div>
    </div>
    <ModalImage :errors="errors" :content="content" />
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">
              <icon name="image" />
            </th>
            <th scope="col" class="px-6 py-3">Element</th>
            <th scope="col" class="px-6 py-3">embed width height</th>
            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>
        <draggable
          v-model="list_image"
          tag="tbody"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
          item-key="id_priority"
        >
       
            <tr
              v-for="(image, index) in list_image"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
              >{{index +1}}</th>

              <td class="px-6 py-4">{{image.name}}</td>

              <td class="px-6 py-4 crop-content">
                <img v-if="image.image" class="w-50 h-20" :src="image.image" alt="Card image cap" />
              </td>
              <td class="px-6 py-4 crop-content">
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                >Select Element</label>
                <select
                  id="countries"
                  @change="onChangeElement(image,$event)"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option value="null" :selected="image.element==null ?true :false">Defalut</option>
                  <option
                    value="gallery__item--h-2 gallery__item--v-2"
                    :selected="image.element =='gallery__item--h-2 gallery__item--v-2' ?true :false"
                  > Chiều Rộngx2 Chiều Dàix2</option>
                  <option
                    value="gallery__item--v-2"
                    :selected="image.element =='gallery__item--v-2' ?true :false"
                  >Chiều Rộngx2</option>
                  <option
                    value="gallery__item--h-2"
                    :selected="image.element =='gallery__item--h-2' ?true :false"
                  >Chiều Dài 2</option>
                  <option
                    value="gallery__item--h-2 gallery__item--v-3"
                    :selected="image.element =='gallery__item--h-2 gallery__item--v-3' ?true :false"
                  >Chiều Rộng 2 Chiều Dài 3</option>
                </select>
              </td>

              <td class="px-6 py-4 crop-content">
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                >Select embed width height</label>
                <select
                  id="countries"
                  @change="onChangeEmbed(image,$event)"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option value="null" :selected="image.embed==null ?true :false">Defalut</option>
                  <option
                    value="embed--1-2"
                    :selected="image.embed =='embed--1-2' ?true :false"
                  >Rộng 1 Dài 2 </option>
                  <option
                    value="embed--2-1"
                    :selected="image.embed =='embed--2-1' ?true :false"
                  >Rộng 2 Dài 1</option>
                  <option
                    value="embed--2-3"
                    :selected="image.embed =='embed--2-3' ?true :false"
                  >Rộng 2 Dài 3</option>
                </select>
              </td>

              <td class="px-6 py-4">
                <a
                  @click="onEdit(image)"
                  type="button"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </a>

                <a
                  type="button"
                  @click="onDelete(image.id)"
                  class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="delete" />
                </a>
              </td>
            </tr>
       
        </draggable>
      </table>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
import Icon from "@/Components/Icon";
import ModalImage from "./ModalImage";
import LayoutVue from "@/Components/Layout";
import BreadCrumbVue from "@/Pages/Content/BreadCrumb.vue";
import { objectTypeIndexer } from "@babel/types";
export default {
  layout: LayoutVue,
  props: {
    content: Object,
    list_image: Array,
    errors: Object,
    page: Object,
    section: Object
  },
  components: {
    draggable,
    Icon,
    BreadCrumbVue,
    ModalImage
  },
  computed: {
    dragOptions() {
      return {
        animation: 300,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
        scrollSensitivity: 200,
        forceFallback: true
      };
    }
  },
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null,
        images: null
      })
    };
  },
  methods: {
    onUnpublishedChange() {
      let query = {
        data: this.list_image
      };
      this.$inertia.post(this.route("image.priority"), query, {
        preserveState: false
      });
    },
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("image.delete", id));
    },
    onAdd() {
      Bus.$emit("onAddImage");
    },
    onEdit(element) {
      Bus.$emit("onEditImage", element);
    },
    onChangeElement(data, event) {
      let query = {
        element: event.target.value,
        id: data.id
      };

      axios
        .post("/admin/pages/image/selectElement", query)
        .then(response => {})
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    onChangeEmbed(data, event) {
      let query = {
        embed: event.target.value,
        id: data.id
      };

      axios
        .post("/admin/pages/image/selectEmbed", query)
        .then(response => {})
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    }
  }
};
</script>

<style>
</style>