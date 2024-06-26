<template>
    <b-navbar toggleable="lg" type="dark" variant="dark">
        <b-navbar-brand href="#">Feedback</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <!-- <b-nav-item :to="{path:'/admin/items'}">Items</b-nav-item>
            <b-nav-item :to="{path:'/admin/email'}">Email</b-nav-item>
            <b-nav-item :to="{path:'/admin/types'}">Types</b-nav-item> -->
            <b-nav-item :to="{path:'/admin/categories'}">Categories</b-nav-item>
            <b-nav-item :to="{path:'/logout'}">Logout</b-nav-item>
        </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>

export default {
    name: 'adminnavbar'
}

</script>
