<template>
  <div class="user-content">
    <div class="w-3/6 mx-auto">
      <label class="user-avatar">
        <label class="block avatar pointer mx-auto" for="cover"
               :style="{backgroundImage : `url(${!preview ? image: preview })`}"/>
        <input type="file" hidden="" accept="image/*" id="cover" @change="uploadCover">
      </label>
      <div class="form mb-5">
        <div class="mt-10">
          <input type="text" class="block mx-auto" placeholder="full name" autocomplete="off">
        </div>
        <div class="mt-10">
          <input type="email" class="block mx-auto" placeholder="email" autocomplete="off">
        </div>
        <div class="mt-10">
          <input type="password" class="block mx-auto" placeholder="password" autocomplete="off">
        </div>
        <div class="mt-10">
          <button class="block mx-auto save" @click="$emit('update:loading', true)">Save</button>
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
      image: 'https://assets.website-files.com/632f8897a9082d4ee0743070/6339d0586a79c5e4484979a2_Avatar%201.png',
      preview: null,
    }
  },
  props:{
    loading: Boolean
  },
  methods: {
    uploadCover(file) {
      console.log(file.target.files)
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
  .save{
    border: 1px solid #ff5722;
    color: #f44336;
    padding: 1px 20px;
    border-radius: 5px;
  }
}
</style>