<template>
  <div class="mt-10 sm:mt-0">
    <BreadCrumbVue :page="page" :section="section" />
      <ModalCategory :errors="errors" :section="section"/>
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
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(element, index) in section.category_contents"
            :key="index"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
            >{{index +1}}</th>
            <td class="px-6 py-4">
              {{__(element.title)}}
            </td>

            
            <!-- <td class="px-6 py-4">
              <Link
                data-toggle="tooltip"
                data-placement="bottom"
                title="Teams"
                :href="route('team.index',element.id)"
                type="button"
                class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="team" class="w-4 h-4" />
              </Link>
              <Link
                data-toggle="tooltip"
                data-placement="bottom"
                title="List User"
                :href="route('consumer.index',element.id)"
                type="button"
                class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="list" />
              </Link>
            </td>-->
            <td class="px-6 py-4">
                <Link
                    type="button"
                :href="route('category.contents',element.title)"
                  data-toggle="tooltip"
                  data-placement="bottom"
                  title="Contents"
                class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="content" />
              </Link>
              <a
                type="button"
                @click="onEdit(element)"
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
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import ModalCategory from './ModalCategory';
import Layout from "@/Components/Layout";
import { Link } from "@inertiajs/inertia-vue";
import BreadCrumbVue from "./BreadCrumb.vue";
export default {
  layout: Layout,
  components: {
    Icon,
    Link,
    ModalCategory,
    BreadCrumbVue
  },
  props: {
    section: Object,
    errors: Object,
    page: Object
  },
  methods: {
    onAddClass() {
      Bus.$emit("onAddCategory");
    },

    onEdit(data) {
      Bus.$emit("onEditCategory", data);
    },
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("category.delete", id));
    }
  }
};
</script>

<style>
</style>