<template>
    <div class="w-full flex flex-col items-center">
        <div class="w-full relative mb-8">
            <div class="w-full h-64 overflow-hidden bg-green-500">
                <img
                    src="https://c0.wallpaperflare.com/preview/542/56/997/orange-black-and-green-mechanical-keyboard.jpg"
                    alt="user background image"
                    class="object-cover w-full h-full"
                />
            </div>
            <div
                class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20"
            >
                <div class="w-32">
                    <img
                        src="https://media.licdn.com/dms/image/D5603AQFrGxTr52dZgg/profile-displayphoto-shrink_800_800/0/1704189591258?e=2147483647&v=beta&t=LBswfsVvP433RB7poYC51-at2nfLS03nOcr2I0B67Ws"
                        alt="user profile image"
                        class="object-fit w-full h-full border-4 rounded-full shadow-lg"
                    />
                </div>
                <p class="text-2xl text-gray-100 ml-4">
                    {{ user?.data?.attributes?.name }}
                </p>
            </div>
        </div>
        <div v-if="postLoading">
            <div role="status" class="mt-3">
                <svg
                    aria-hidden="true"
                    class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"
                    />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill"
                    />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <Post
            v-else
            v-for="post in posts.data"
            :key="post.data.post_id"
            :post="post"
        />

        <p v-if="!postLoading && posts.data.length < 1">No post found.</p>
    </div>
</template>

<script>
import Post from "../../components/Post.vue";
export default {
    data() {
        return {
            user: [],
            posts: [],
            userLoading: true,
            postLoading: true,
        };
    },
    components: {
        Post,
    },
    mounted() {
        axios
            .get("/api/users/" + this.$route.params.userId)
            .then((res) => {
                this.user = res.data;
                this.userLoading = false;
            })
            .catch((error) => {
                console.log("Unable to fetch the user from the server");
                this.userLoading = false;
            });

        axios
            .get("/api/users/" + this.$route.params.userId + "/posts")
            .then((res) => {
                this.posts = res.data;
                this.postLoading = false;
            })
            .catch((error) => {
                console.log(
                    `Unable to fetch the user with id ${this.$route.params.userId} post`
                );
                this.postLoading = false;
            });
    },
};
</script>

<style></style>
