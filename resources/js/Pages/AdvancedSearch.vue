<template>
  <div>
    <div class="title text-center">
      <h1>Cerca la struttura perfetta per te</h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <label for="address" class="form-label">Destinazione</label>
            <input
              type="text"
              class="form-control"
              id="address"
              placeholder="inserisci una destinazione o una via"
              v-model="search"
              @keyup="callAddress()"

            />
            <div class="result" hidden></div>

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
                  min="1"
                  name="radius"
                  value=""
                  placeholder="KM"
                  v-model="radius"
                  oninput="this.value = Math.abs(this.value)"
                  @keyup="getApartment()"
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
                <label for="rooms" class="form-label">Numero di stanze</label>
                <input
                  class="form-control rounded-0"
                  id="rooms"
                  type="number"
                  min="1"
                  max="100"
                  name="rooms"
                  value=""
                  placeholder="Rooms"
                  v-model="rooms"
                  oninput="this.value = Math.abs(this.value)"
                  @keyup="getApartment()"
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
                <label for="beds" class="form-label"
                  >Numero di posti letto</label
                >
                <input
                  class="form-control rounded-0"
                  id="beds"
                  min="1"
                  max="100"
                  type="number"
                  name="beds"
                  value=""
                  placeholder="Beds"
                  v-model="beds"
                  oninput="this.value = Math.abs(this.value)"
                  @keyup="getApartment()"
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
                    @click="getApartment()"
                  >
                    {{ service.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-cols-2">
        <div class="col" v-for="apartment in apartments" :key="apartment.id">
          <div class="card h-100">
            <img
              :src="'/storage/' + apartment.cover_image"
              alt=""
              class="card-img-top"
            />
            <div class="card-body">
              <p class="card-text text-center font_monserrat">
                {{ apartment.title }}
              </p>
              <p class="price font_monserrat">{{ apartment.description }}</p>
              <button
                class="btn btn_orange text-uppercase text-white font_monserrat"
              >
                Check it
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppVue from "../views/App.vue";
export default {
  name: "AdvancedSearch",
  data() {
    return {
      search: "",
      latitude: 36.74969053,
      longitude: 14.75327845,
      beds: "1",
      rooms: "1",
      radius: 20000,
      serviceSelect: [],
      AllServices: [],
      apartments: "",
      loading: true,
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
            services: this.serviceSelect,
          },
        })
        .then((response) => {
          console.log(response.data);
          if (response.data.status_code === 404) {
            this.loading = false;
            this.$router.push({ name: "not-found" });
          } else {
            this.apartments = response.data;
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
    callAddress() {
      window.axios.defaults.headers.common = {
        Accept: "application/json",
        "Content-Type": "application/json",
      };
      const address = document.getElementById("address").value;
      const resultElement = document.querySelector(".result");
      resultElement.innerHTML = "";
      const link = `https://kr-api.tomtom.com/search/2/geocode/${address}.json?key=MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF&typeahead=true`;
      if (address.length > 2) {
        axios.get(link).then((response) => {
          const attempts = response.data.results.slice(0,3);
          this.latitude = attempts[0].position.lat;
          this.longitude = attempts[0].position.lon;
          console.log(attempts[0]);
          this.getApartment();
          attempts.forEach((item) => {
            const divElement = document.createElement("div");
            divElement.classList.add("list-result");
            const markup = `<span>${item.address.freeformAddress}</span>`;
            divElement.insertAdjacentHTML("beforeend", markup);
            divElement.addEventListener("click", () => {
              document.getElementById("address").value =
                item.address.freeformAddress;
              this.search = item.address.freeformAddress;
              this.latitude = item.position.lat;
              this.longitude = item.position.lon;
              resultElement.innerHTML = "";
              resultElement.setAttribute("hidden", "true");
              this.getApartment();
            });
            resultElement.append(divElement);
            resultElement.removeAttribute("hidden");
          });
        });
      }
    },
  },
  mounted() {
    this.getServices();
  },
};
</script>

<style>
</style>
