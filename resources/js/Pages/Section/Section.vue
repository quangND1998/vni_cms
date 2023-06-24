<template>
  <div class="mt-10 sm:mt-0">
    <BreadCrumb :page="page" :name="null" />

    <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <Link
          :href="route('section.create', page.id)"
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-sm px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          type="button"
        >
          <icon class="w-6 h-6" name="create" />Add
        </Link>
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
            <th scope="col" class="px-6 py-3">Sub Title</th>
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Theme</th>
              <th scope="col" class="px-6 py-3">Active</th>
            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>

        <draggable
          v-model="sections"
          tag="tbody"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
          item-key="id_priority"
        >
          <template>
            <tr
              v-for="(element, index) in sections"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
              >{{index +1}}</th>

              <td class="px-6 py-4">{{__(element.title)}}</td>
              <td class="px-6 py-4 crop-content">{{__(element.sub_title)}}</td>

              <td v-if="element.description" class="px-6 py-4 crop-content">
                <span v-html="__(element.description)"></span>
              </td>
              <td v-else class="px-6 py-4 crop-content"></td>
              <td class="px-6 py-4 crop-content">
                <img
                  v-if="element.theme.image_template"
                  class="w-50 h-20"
                  :src="element.theme.image_template"
                  alt="Card image cap"
                />
              </td>
              <td class="px-6 py-4 crop-content">
                <input
                        :checked="element.active == 1 ? true : false"
                        @change="onChangeActive(element, $event)"
                        class="toggle-class-public"
                        type="checkbox"
                      />
              </td>
              <td class="px-6 py-4">
                <Link
                  v-if="element.theme.type ==0 ||element.theme.type ==2"
                  type="button"
                  data-toggle="tooltip"
                  data-placement="bottom"
                  title="Contents"
                  :href="route('content.index',element.title)"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="content" />
                </Link>

                <Link
                  v-if="element.theme.type ==1 ||element.theme.type ==3"
                  type="button"
                  data-toggle="tooltip"
                  data-placement="bottom"
                  title="Categrory Content"
                  :href="route('category.index',element.title)"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="content" />
                </Link>
                <Link
                  type="button"
                  :href="route('section.edit',element.id)"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </Link>

                <a
                  type="button"
                  @click="onDelete(element.id)"
                  class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="delete" />
                </a>
              </td>
            </tr>
          </template>
        </draggable>
      </table>
    </div>
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import BreadCrumb from "./BreadCrumb";
import Layout from "@/Components/Layout";
import { Link } from "@inertiajs/inertia-vue";
import draggable from "vuedraggable";
export default {
  layout: Layout,
  components: {
    Icon,
    Link,
    BreadCrumb,
    draggable
  },
  props: {
    page: Object,
    themes: Array,
    sections: Array,
    errors: Object
  },
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null
      })
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 100,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    }
  },
  methods: {
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("section.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.sections
      };
      this.$inertia.post(this.route("section.priority"), query, {
        preserveState: false
      });
    },
      onChangeActive(data, event) {
      if (event.target.checked) {
        this.form.active = 1;
      } else {
        this.form.active = 0;
      }
      let query = {
        id: data.id,
        active: this.form.active
      };
      axios
        .post("/changeActiveSection", query)
        .then(response => {})
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
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