<template>
    <div>
        <adminnavbar />
        <router-view/>
    </div>
</template>

<script>
import adminnavbar from './Admin/Navbar.vue'

export default {
    components: {adminnavbar}
}
</script>
>