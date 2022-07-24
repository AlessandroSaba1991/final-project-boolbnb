<template>
  <div class="page_body">
    <div class="container shadow-lg rounded mt-3 p-3">
      <header>
        <div class="page_title">
          <h1 class="text-center text-uppercase">
            Cerca la struttura perfetta per te
          </h1>
          <div class="mb-5 destination shadow">
            <label for="address" class="form-label">Destinazione</label>
            <input
              type="text"
              class="form-control mb-1"
              id="address"
              placeholder="inserisci una destinazione o una via"
              v-model="search"
              @keyup="callAddress()"
            />
            <div class="result" hidden></div>
            <div class="accordion" id="accordionExample">
              <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingOne">
                  <button
                    class="accordion-button collapsed acc_btn"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    aria-expanded="true"
                    aria-controls="collapseOne"
                  >
                    Affina la tua ricerca
                  </button>
                </h2>
                <div
                  id="collapseOne"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingOne"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body acc_body">
                    <div class="mb-3">
                      <label for="radius" class="form-label">
                        Distanza max dal luogo
                      </label>
                      <input
                        class="form-control fw-bold"
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

                    <div class="mb-3">
                      <label for="rooms" class="form-label"
                        >Numero di stanze</label
                      >
                      <input
                        class="form-control fw-bold"
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

                    <div class="mb-3">
                      <label for="beds" class="form-label"
                        >Numero di posti letto</label
                      >
                      <input
                        class="form-control fw-bold"
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

                    <div class="multiple_service">
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
                          class="fw-bold"
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
          </div>
        </div>
      </header>
      <main>
        <div>
          <div class="row m-0 mb-5" style="width: 100%">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 p-0">
              <div class="left_bar shadow">
                <h2>Affina la tua ricerca</h2>

                <div class="mb-3">
                  <label for="radius" class="form-label">
                    Distanza max dal luogo
                  </label>
                  <input
                    class="form-control fw-bold"
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

                <div class="mb-3">
                  <label for="rooms" class="form-label">Numero di stanze</label>
                  <input
                    class="form-control fw-bold"
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

                <div class="mb-3">
                  <label for="beds" class="form-label"
                    >Numero di posti letto</label
                  >
                  <input
                    class="form-control fw-bold"
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

                <div class="mb-3">
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
                      class="fw-bold"
                      v-for="service in AllServices"
                      :key="service.id"
                      :value="service.id"
                      @click="getApartment()"
                    >
                      {{ service.name }}
                    </option>
                  </select>

                  <!-- <div
                    name="services"
                    id="services"
                    v-for="service in AllServices"
                    :key="service.id"
                  >
                    <input
                      type="checkbox"
                      name="services"
                      :value="service.id"
                      v-model="serviceSelect"
                      @click="getApartment()"
                    />
                    <label>{{ service.name }}</label>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row show_results px-2">
                <div
                  class="col-xs-12 col-sm-12 col-md-6 col-lg-4 g-3"
                  style="height: 420px"
                  v-for="apartment in apartments"
                  :key="apartment.id"
                >
                  <div
                    class="card rounded-3 shadow bg-body border-warning"
                    style="height: 100%"
                  >
                    <img
                      :src="'/storage/' + apartment.cover_image"
                      alt=""
                      class="card-img-top img_resize"
                    />
                    <div
                      class="
                        card-body
                        d-flex
                        flex-column
                        justify-content-between
                      "
                    >
                      <h5 class="card-title">{{ apartment.title }}</h5>
                      <p class="card-text">
                        {{ apartment.description | truncate(99) }}...
                      </p>
                      <router-link
                        class="btn btn_orange text-uppercase text-white"
                        :to="{
                          name: 'apartment',
                          params: { id: apartment.id },
                        }"
                      >
                        Visualizza dettagli
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
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
  props: {
    searchAddress: {
      type: String,
      required: true,
    },
    searchLatitude: {
      type: Number,
      required: true,
    },
    searchLongitude: {
      type: Number,
      required: true,
    },
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
          const attempts = response.data.results.slice(0, 3);
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

  filters: {
    truncate: function (data, num) {
      const reqdString = data.split("").slice(0, num).join("");
      return reqdString;
    },
  },

  mounted() {
    this.search = this.searchAddress;
    this.latitude = this.searchLatitude;
    this.longitude = this.searchLongitude;
    this.getApartment();
    this.getServices();
  },
};
</script>

<style lang="scss" scoped>
.page_body {
  .destination {
    margin-bottom: 30px;
  }
  .left_bar,
  .destination {
    padding: 15px;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
    border: solid 2px rgb(255, 177, 22);
    border-radius: 10px;
    background: linear-gradient(to top left, orange 0%, rgb(255, 140, 0) 100%);
  }

  .img_resize {
    aspect-ratio: 2/1;
  }

  .show_results {
    overflow-y: auto;
    height: 520px;
  }

  .acc_btn {
    background-color: orange;
    color: white;
    text-transform: uppercase;
  }

  .acc_body {
    background-color: orange;
  }

  @media (min-width: 746px) {
    .accordion {
      display: none;
    }
  }

  @media (max-width: 745px) {
    .left_bar {
      display: none;
    }
  }
}
</style>
