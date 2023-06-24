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

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">Phone</th>
            <th scope="col" class="px-6 py-3">Message</th>
          </tr>
        </thead>

        <tr
          v-for="(element, index) in contacts.data"
          :key="index"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
        >
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
          >{{index +1}}</th>
          <td class="px-6 py-4">{{element.name}}</td>
          <td class="px-6 py-4">{{element.email}}</td>
          <td class="px-6 py-4">{{element.phone}}</td>
          <td class="px-6 py-4 crop-content">{{element.message}}</td>
        </tr>
      </table>
      <pagination class="mt-6" :links="contacts.links" />
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
    contacts: Object,
    errors: Object
  },
  components: {
    Pagination,
    Icon,
    ModalLanguage
  },
  data() {
    return {
      term: null,
    };
  },
  methods: {
    search() {
      this.$inertia.get(
        this.route("contact.index", { term: this.term }),
        {},
        { preserveState: true }
      );
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