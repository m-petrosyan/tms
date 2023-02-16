<template>
  <div class="user-content">
    <div class="w-3/6 mx-auto">
      <label class="user-avatar">
        <label class="block avatar pointer mx-auto" for="cover"
               :style="{backgroundImage : `url(${!preview ? image: preview })`}"/>
        <input type="file" hidden="" accept="image/*" id="cover" @change="uploadCover" :disabled="loading">
      </label>
      <div class="form mb-5">
        <div class="mt-10">
          <input type="text" class="block mx-auto" placeholder="full name" autocomplete="off" :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="email" class="block mx-auto" placeholder="email" autocomplete="off" :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="password" class="block mx-auto" placeholder="password" autocomplete="off" :disabled="loading">
        </div>
        <div class="mt-10">
          <button class="block mx-auto save" @click="$emit('update:loading', true)" :disabled="loading">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserEdit",
  data() {
    return {
      image: require('@/assets/images/avatar.png'),
      preview: null,
    }
  },
  props: {
    loading: Boolean
  },
  methods: {
    uploadCover(file) {
      this.preview = URL.createObjectURL(file.target.files[0])
      this.image = file.target.files[0]
    },
  }
}
</script>

<style scoped lang="scss">
.user-avatar {
  position: relative;
  cursor: pointer;

  &:before {
    content: '';
    position: absolute;
    background-image: url("@/assets/images/frame.png");
    background-size: contain;
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
  }

  .avatar {
    width: 200px;
    height: 200px;
    background-size: cover;
    background-position: center;
    border-radius: 100%;
  }
}

.form {
  input {
    text-align: center;

    &::placeholder {
      text-align: center;
    }
  }
}
</style>