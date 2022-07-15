<template>
<div class="single_page h-100">
    <div class="wrapper h-100" v-if="!loading">
      <div
        class="p-5 hero_image"
        :style="{
          backgroundImage: 'url(/storage/' + apartment.cover_image + ')',
        }"
      >
        <div class="container">
          <h1 class="display-3">{{ apartment.title }}</h1>
          <p class="lead">{{ apartment.description }}</p>
          <hr class="my-2 bg-white" />
        </div>
      </div>
    </div>
    <div class="loading bg-dark text-center text-white" v-else>⏲️ Loading</div>
  </div>
</template>

<script>
export default {
    name:'Apartment',
    data() {
    return {
      apartment: "",
      loading: true,
    };
  },
  methods: {
    getApartment() {
      axios
        .get("/api/apartments/" + this.$route.params.id)
        .then((response) => {
            console.log(response.data);
          if (response.data.status_code === 404) {
            this.loading = false;
            this.$router.push({ name: "not-found" });
          } else {
            this.apartment = response.data;
            this.loading = false;
          }
        })
        .catch((e) => {
          console.error(e);
        });
    },
  },
  mounted() {
    this.getApartment();
  },
}
</script>

<style>

</style>
