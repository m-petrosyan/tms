<template>
  <div class="task" v-if="form">
    <div v-if="!editOrCreate" class="cover rounded-t"
         :style="{backgroundImage : `url(${form.img ? form.img : defaultImg})`}"/>
    <label v-else>
      <label class="block cover rounded-t mx-auto" for="cover" :class="{'cursor-pointer' : editOrCreate}"
             :style="{backgroundImage : `url(${!preview ? form.img ?? defaultImg: preview })`}"/>
      <input v-if="editOrCreate" type="file" hidden="" accept="image/*" id="cover" @change="uploadCover"
             :disabled="loading">
    </label>
    <ErrorMessages :error="v$" :serverError="error" width="w-full"/>
    <div class="info form">
      <div class="item title flex justify-between gap-x-2 my-5">
        <div class="flex gap-x-2 w-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor"
               class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9"/>
          </svg>
          <h3 v-if="!editOrCreate">{{ form.title }}</h3>
          <input v-else type="text" placeholder="title" v-model="form.title">
        </div>
        <button class="editOrCreate" v-if="auth ? form.created_by?.id === auth.id && !editOrCreate : false"
                @click="() => editOrCreate=true">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
          </svg>
        </button>
      </div>
      <div class="item description flex gap-x-2 my-5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="icon w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
        </svg>
        <p v-if="!editOrCreate">{{ form.description }}</p>
        <textarea v-else v-model="form.description" rows="5"/>
      </div>
      <div class="item flex gap-x-2 my-5" v-if="!editOrCreate">
        <div class="flex gap-x-2 w-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="icon w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <p>{{ form.created_at }}</p>
        </div>
      </div>
      <div class="item flex gap-x-2 my-5" v-if="editOrCreate && options.data">
        <div class="flex gap-x-2 w-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
          </svg>
          <select name="" v-model="form.assigned_to" class="w-full">
            <option :value="item" v-for="item in options.data" :key="item">{{ item.full_name }}</option>
          </select>
        </div>
      </div>
      <button v-if="editOrCreate" class="block mx-auto submit" @click="save" :disabled="loading">Save
      </button>
      <UsersInfo v-if="!editOrCreate" :users="form"/>
    </div>
  </div>
</template>

<script>
import updateQueryMixin from "@/mixins/updateQueryMixin";
import {minLength, required} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import UsersInfo from "@/components/elements/UsersInfo.vue";
import popupItemMixin from "@/mixins/popupItemMixin";

export default {
  name: "TaskViewEdit",
  mixins: [updateQueryMixin, popupItemMixin],
  data() {
    return {
      editOrCreate: false,
      defaultImg: require('@/assets/images/noimage.jpg'),
      image: null,
      preview: null,
      newForm: null,
      actions: {
        get: 'getTask',
        options: 'getUsers',
        post: this.$route.params.id ? 'updateTask' : 'createTask',
        error: 'getTaskError',
        formData: true
      }
    }
  },
  mounted() {
    this.editOrCreate = this.$route.name === 'taskcreate'
  },
  methods: {
    uploadCover(file) {
      this.preview = URL.createObjectURL(file.target.files[0])
      this.form.img = this.image = file.target.files[0]
    },
    save() {
      if (this.$route.params.id) this.form._method = 'PUT'
      this.submit(this.form.assigned_to?.id).then(() => {
        this.$store.dispatch('getTasks')
        this.closeModal()
      })
    }
  },
  components: {UsersInfo},
  validations() {
    return {
      form: {
        description: {minLength: minLength(8)},
        title: {required, minLength: minLength(2)},
        assigned_to: {required},
      }
    }
  },
  setup() {
    return {v$: useVuelidate()}
  },
}
</script>

<style scoped lang="scss">
.task {
  .cover {
    height: 200px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  .info {
    padding: 20px;

    .item {
      input, textarea {
        width: 100%;
        outline: 1px solid #607d8b;
      }

      .edit {
        svg {
          opacity: .3;
          transition: all .5s;

          &:hover {
            opacity: 1;
            color: #f44336;
          }
        }
      }
    }
  }
}
</style>