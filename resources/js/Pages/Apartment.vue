<template>
  <div class="single_page h-100">
    <div class="wrapper h-100" v-if="!loading">
      <div
        class="p-5 hero_image"
        :style="{
          backgroundImage: 'url(/storage/' + apartment.cover_image + ')',
        }"
      ></div>
      <div class="container">
        <div class="card p-3">
            <div class="row row-cols-4">
                <div class="col">
                    <span>Rooms: </span>{{apartment.rooms}}
                </div>
                <div class="col">
                    <span>Beds: </span>{{apartment.beds}}
                </div>
                <div class="col">
                    <span>Bathrooms: </span>{{apartment.bathrooms}}
                </div>
                <div class="col">
                    <span>Square_meters: </span>{{apartment.square_meters}}
                </div>
                <div class="col">
                    <span>Address: </span>{{apartment.address}}
                </div>
                <div class="col">
                    <span>Latitude: </span>{{apartment.latitude}}
                </div>
                <div class="col">
                    <span>Longitude: </span>{{apartment.longitude}}
                </div>
                <div class="col">
                    <span>Visible: </span>
                    <span v-if="apartment.visible">Visibile</span>
                    <span v-else>Non Visibile</span>
                </div>
            </div>
          <h1 class="display-3">{{ apartment.title }}</h1>
          <p class="lead">{{ apartment.description }}</p>
        </div>
      </div>
    </div>
    <div class="loading bg-dark text-center text-white" v-else>⏲️ Loading</div>
  </div>
</template>

<script>
export default {
  name: "Apartment",
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
};
</script>

<style lang="scss" scoped>
.hero_image {
  height: 500px;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
}
</style>
