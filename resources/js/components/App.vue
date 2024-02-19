<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <NavBar />
        <div class="flex overflow-y-hidden flex-1">
            <SideBar />
            <div class="overflow-x-hidden w-4/5">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import NewPost from "./NewPost.vue";
import NavBar from "./NavBar.vue";
import SideBar from "./SideBar.vue";
export default {
    components: {
        NavBar,
        SideBar,
    },
};
</script>

<style></style>
