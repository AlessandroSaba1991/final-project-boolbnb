<template>
  <div>
    <div class="title text-center">
      <h1>Cerca la struttura perfetta per te</h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <form method="post" action="/"></form>
            <label for="address" class="form-label">Destinazione</label>
            <input
              type="text"
              class="form-control"
              id="address"
              placeholder="inserisci una destinazione o una via"
              v-model="search"
            />
            <div
              class="common_form d-flex justify-content-lg-between flex-wrap"
            >
              <div
                class="
                  p-0
                  mt-3
                  col-lg-2
                  pr-lg-3
                  pl-lg-0
                  mt-lg-3
                  col-md-6
                  pr-md-2
                  pl-md-0
                  mt-md-3
                  col-sm-12
                  t-sm-3
                "
              >
                <label for="radius" class="form-label">
                  Distanza max dal luogo
                </label>
                <input
                  class="form-control rounded-0"
                  id="radius"
                  type="number"
                  min="0"
                  name="radius"
                  value=""
                  placeholder="KM"
                  v-model="radius"
                />
              </div>
              <div
                class="
                  p-0
                  mt-3
                  col-lg-2
                  pl-lg-0
                  pr-lg-3
                  mt-lg-3
                  col-md-6
                  pl-md-2
                  pr-md-0
                  mt-md-3
                  col-sm-12
                  mt-sm-3
                "
              >
                <label for="address" class="form-label">Numero di stanze</label>
                <input
                  class="form-control rounded-0"
                  id="rooms"
                  type="number"
                  min="1"
                  name="rooms"
                  value=""
                  placeholder="Rooms"
                  v-model="rooms"
                />
              </div>
              <div
                class="
                  p-0
                  mt-3
                  col-lg-2
                  pl-lg-0
                  pr-lg-3
                  mt-lg-3
                  col-md-6
                  pl-md-0
                  pr-md-2
                  mt-md-3
                  col-sm-12
                  p-sm-0
                  mt-sm-3
                "
              >
                <label for="address" class="form-label"
                  >Numero di posti letto</label
                >
                <input
                  class="form-control rounded-0"
                  id="beds"
                  min="1"
                  type="number"
                  name="beds"
                  value=""
                  placeholder="Beds"
                  v-model="beds"
                />
              </div>
              <div
                class="
                  p-0
                  mt-3
                  col-lg-2
                  pl-lg-0
                  pr-lg-3
                  mt-lg-3
                  col-md-6
                  pl-md-0
                  pr-md-2
                  mt-md-3
                  col-sm-12
                  p-sm-0
                  mt-sm-3
                "
              >
                <label for="services" class="form-label">Servizi</label>
                <select
                  class="form-select"
                  name="services"
                  id="services"
                  multiple
                  aria-label="Default select example"
                  v-model="serviceSelect"
                >
                  <option disabled>seleziona dal menù</option>
                  <option
                    v-for="service in AllServices"
                    :key="service.id"
                    :value="service.id"
                  >
                    {{ service.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdvancedSearch",
  data() {
    return {
      search: "",
      latitude: "",
      longitude: "",
      beds: 1,
      rooms: 1,
      radius: 20000,
      serviceSelect: [],
      AllServices: [],
    };
  },
  methods: {
    getApartment() {
      axios
        .get("/api/apartments", {
          params: {
            lat: this.latitude,
            lon: this.longitude,
            radius: this.radius,
            beds: this.beds,
            rooms: this.rooms,
            service: this.serviceSelect,
          },
        })
        .then((response) => {
          console.log(response);
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
    getServices() {
      axios
        .get("api/services")
        .then((response) => {
          this.AllServices = response.data;
        })
        .catch((e) => {
          console.error(e);
        });
    },
  },
  mounted() {
    this.getServices();
  },
};
</script>

<style>
</style>
