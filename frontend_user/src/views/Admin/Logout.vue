<template>
    <div>
        <b-alert variant="danger" show>You have successfully logged out</b-alert>
    </div>
</template>

<script>

export default {
  created () {
    this.$api.get('/feedback/api/?action=logout')
        .then(() =>
    {
        setTimeout(()=> this.$router.push({ path: '/login'}) , 1000);
    })
  },

}
</script>
