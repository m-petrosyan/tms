<template>
  <div class="users flex gap-x-2">
    <div class="user" :data-tooltip="users.created_by.full_name.split(' ')[0]"
         :style="{backgroundImage : `url(${users.created_by.profile_pic})`}"
         @click.stop="viewUser(users.created_by.id)"/>
    <div class="user" :data-tooltip="users.assigned_to.full_name.split(' ')[0]"
         :style="{backgroundImage : `url(${ users.assigned_to.profile_pic})`}"
         @click.stop="viewUser(users.assigned_to.id)"/>
  </div>
</template>

<script>
export default {
  name: "UsersInfo",
  props: {
    users: Object,
  },
  methods: {
    viewUser(id) {
      this.$router.push({name: 'userview', params: {id: id}})
    },
  }
}
</script>

<style scoped lang="scss">
.users {
  .user {
    cursor: pointer;
    height: 40px;
    width: 40px;
    background-size: contain;
    border-radius: 100%;
    position: relative;

    &:hover:before {
      visibility: visible;
    }

    &:before {
      content: attr(data-tooltip);
      white-space: nowrap;
      padding: 2px 4px;
      visibility: hidden;
      position: absolute;
      bottom: -30px;
      left: 0;
      width: fit-content;
      z-index: 1;
      background-color: rgba(0, 0, 0, 0.4196078431);
      color: white;
      border-radius: 4px;
    }
  }
}
</style>