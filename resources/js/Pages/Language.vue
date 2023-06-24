<template>
  <div>
    <div class="mb-6 flex flex-wrap justify-center md:mb-8 md:justify-between">
      <form
        class="relative search-form mt-5 h-[40px] w-full rounded-full bg-grey-400 md:mt-0 md:w-52"
      >
        <span
          class="z-10 h-full mr-1 leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
        >
          <i class="fas fa-search"></i>
        </span>
        <input
          v-model="term"
          @keyup="search"
          type="text"
          placeholder="Search here..."
          class="border-0 px-5 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
        />
      </form>
    </div>
    <ModalLanguage :errors="errors"/>
    <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-blue-600 flex"><icon name="language"  class="w-8 h-8"/> Languages</h3>
        <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <button
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-sm px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          type="button"
          v-on:click="onAddClass()"
        >
          <icon class="w-6 h-6" name="create" />Add
        </button>
      </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">Key</th>
            <th scope="col" class="px-6 py-3">English</th>
            <th scope="col" class="px-6 py-3">Vietnamese</th>
            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>

        <tr
          v-for="(element, index) in languages.data"
          :key="index"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
        >
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
          >{{index +1}}</th>
          <td class="px-6 py-4 crop-content">{{element.key}}</td>
          <td class="px-6 py-4 crop-content">{{__(element.en)}}</td>
          <td class="px-6 py-4 crop-content">{{__(element.vn)}}</td>

          <td class="px-6 py-4">
            <a
                @click="onEdit(element)"
              type="button"
              class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            >
              <icon name="edit" />
            </a>

            <a
              type="button"
              @click="onDelete(element.id)"
              class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            >
              <icon name="delete" />
            </a>
          </td>
        </tr>
      </table>
      <pagination class="mt-6" :links="languages.links" />
    </div>
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout";
import Pagination from "@/Components/Pagination";
import ModalLanguage from "../Components/Modal/ModalLanguage";
export default {
  layout: Layout,
  props: {
    languages: Object,
    errors:Object
  },
  components: {
    Pagination,
    Icon,
    ModalLanguage
  },
  data() {
    return {
      term: null,
      form: this.$inertia.form({
        en: null,
        vn: null,
        key: null
      })
    };
  },
  methods: {
    onDelete(id) {
       if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("languages.delete", id));
    },
    search() {
      this.$inertia.get(
        this.route("languages", { term: this.term }),
        {},
        { preserveState: true }
      );
    },
    onAddClass(){
        Bus.$emit('onAddLanguage')
    },
    onEdit(data){
        Bus.$emit("onEditLanguage",data)
    }
  }
};
</script>


<style>
.crop-content {
  max-width: 120px;
  overflow-x: auto;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>