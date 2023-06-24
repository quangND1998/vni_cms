<template>
  <div class="mt-10 sm:mt-0">
    <MailModal :errors="errors" />
    <ModalSend :errors="errors" :contacts="contacts" />
    <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-blue-600 flex">
      <icon name="mail" class="w-8 h-8" />
      <span>Mail</span>
    </h3>
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
            <th scope="col" class="px-6 py-3">Title</th>
            <th scope="col" class="px-6 py-3">Content</th>

            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
            <th scope="col" class="px-6 py-3">Send & Preview</th>
          </tr>
        </thead>

        <tr
          v-for="(element, index) in mails.data"
          :key="index"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
        >
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
          >{{index +1}}</th>
          <td class="px-6 py-4 crop-content">{{element.title}}</td>
          <td class="px-6 py-4 crop-content" v-html="element.content"></td>

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
          <td class="px-6 py-4">
            <a
              :href="route('mail.previewMail',element.id)"
              target="_blank"
              type="button"
              class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            >
              <icon name="view" />
            </a>

            <a
              @click="onSendMail(element.id)"
              type="button"
              class="inline-block px-4 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            >
              <icon name="send" />
            </a>
          </td>
        </tr>
      </table>
      <pagination class="mt-6" :links="mails.links" />
    </div>
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout";
import { Link } from "@inertiajs/inertia-vue";
import Pagination from "@/Components/Pagination";
import MailModal from "./MailModal";
import ModalSend from "./ModalSend";
export default {
  layout: Layout,
  props: {
    mails: Object,
    errors: Object,
    contacts: Array
  },
  components: {
    Icon,
    Link,
    Pagination,
    MailModal,
    ModalSend
  },

  methods: {
    onAddClass() {
      Bus.$emit("onAddMail");
    },
    onEdit(data) {
      Bus.$emit("onEditMail", data);
    },
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("mail.delete", id), {
        preserveState: false
      });
    },
    onSendMail(id) {
      Bus.$emit("onSendMail", id);
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