<template>
  <div class="page_body">
    <div class="page_title position-relative">
      <h1
        class="
          text-center text-uppercase
          pt-4
          font_satify
          position-absolute
          top-50
          start-50
          translate-middle
          text-white
        "
      >
        Cerca la struttura perfetta per te
      </h1>
    </div>
    <div class="container mb-5 pb-5">
      <div class="row">
        <div class="col">
          <div class="mb-3 destination shadow position-relative mt-5">
            <label for="address" class="form-label">Destinazione</label>
            <input
              type="text"
              class="form-control mb-1"
              id="address"
              placeholder="inserisci una destinazione o una via"
              v-model="search"
              @keyup="callAddress()"
            />
            <div class="wrapper w-100">
              <div class="result_" hidden></div>
            </div>
          </div>
          <div class="accordion mb-3" id="accordionExample">
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
                  <div class="row row-cols-1 row-cols-sm-3">
                    <div class="col">
                      <div class="mb-3">
                        <label
                          for="radius"
                          class="form-label text-center w-100"
                        >
                          Distanza dal luogo
                        </label>
                        <div class="d-flex flex-column align-items-center">
                          <span>{{ radius }} KM</span>
                          <input
                            class="w-100"
                            id="radius"
                            type="range"
                            min="1"
                            name="radius"
                            value=""
                            v-model="radius"
                            @change="filterApartment()"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="rooms" class="form-label text-center w-100"
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
                          @keyup="filterApartment()"
                        />
                      </div>
                    </div>

                    <div class="col">
                      <div class="mb-3">
                        <label for="beds" class="form-label text-center w-100"
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
                          @keyup="filterApartment()"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="services" class="form-label">Servizi</label>
                    <div class="row gy-1 row-cols-2">
                      <div
                        class="col"
                        v-for="service in AllServices"
                        :key="service.id"
                      >
                        <input
                          type="checkbox"
                          name="services"
                          :value="service.id"
                          @click="addServiceList(service.id)"
                        />
                        <label>{{ service.name }}</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="article">
        <div class="row gx-2">
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <aside class="left_bar shadow">
              <h2>Affina la tua ricerca</h2>

              <div class="mb-3">
                <label for="radius" class="form-label">
                  Distanza in KM dal luogo
                </label>
                <div class="d-flex flex-column align-items-center">
                  <span>{{ radius }} KM</span>
                  <input
                    class="w-100"
                    id="radius"
                    type="range"
                    min="1"
                    name="radius"
                    value=""
                    v-model="radius"
                    @change="filterApartment()"
                  />
                </div>
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
                  @keyup="filterApartment()"
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
                  @keyup="filterApartment()"
                />
              </div>

              <div class="mb-3">
                <label for="services" class="form-label">Servizi</label>

                <div
                  name="services"
                  id="services"
                  v-for="service in AllServices"
                  :key="service.id"
                >
                  <input
                    type="checkbox"
                    name="services"
                    :value="service.id"
                    @click="addServiceList(service.id)"
                  />
                  <label>{{ service.name }}</label>
                </div>
              </div>
            </aside>
          </div>
          <div
            class="col position-relative"
            style="min-height: 430px"
            v-if="apartments.length > 0"
          >
            <div v-if="!maps_view">
              <a
                class="btn btn-warning position-absolute top-0 end-0"
                @click="createMap()"
                >Mappa</a
              >
              <h2 class="font_satify text-uppercase py-3 text-center">
                Annunci Appartamenti
              </h2>
              <div class="row gy-3 mb-5 pb-3 show_results">
                <div
                  class="col-xs-12 col-sm-12 col-md-6 col-lg-4"
                  v-for="apartment in apartments"
                  :key="apartment.id"
                >
                  <div
                    class="
                      card
                      h-100
                      rounded-3
                      shadow
                      bg-body
                      border-warning
                      position-relative
                    "
                  >
                    <div
                      class="bagde_"
                      v-if="apartment.sponsorizations.length > 0"
                    >
                      Consigliato
                    </div>
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
                      <h5 class="card-title">
                        {{ apartment.title }}
                      </h5>
                      <p class="card-text" v-if="apartment.description != null">
                        {{ splitText(apartment.description, 99) }}...
                      </p>
                      <router-link
                        class="btn btn_orange text-uppercase text-white"
                        :to="{
                          name: 'apartment',
                          params: {
                            id: apartment.id,
                          },
                        }"
                      >
                        Visualizza dettagli
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
              <nav
                aria-label="Page navigation"
                class="
                  mt-3
                  position-absolute
                  bottom-0
                  start-50
                  translate-middle-x
                "
              >
                <ul class="pagination justify-content-center mb-0">
                  <li
                    class="page-item"
                    v-if="response_apartments.current_page > 1"
                  >
                    <a
                      class="page_link"
                      aria-label="Previous"
                      @click="
                        getApartment(response_apartments.current_page - 1)
                      "
                    >
                      <span aria-hidden="true">&laquo;</span>
                      <span class="visually-hidden">Previous</span>
                    </a>
                  </li>
                  <li
                    :class="{
                      'page-item': true,
                      active: response_apartments.current_page == page,
                    }"
                    v-for="page in response_apartments.last_page"
                    :key="page"
                  >
                    <a class="page_link" @click="getApartment(page)">{{
                      page
                    }}</a>
                  </li>
                  <li
                    class="page-item"
                    v-if="
                      response_apartments.current_page <
                      response_apartments.last_page
                    "
                  >
                    <a
                      class="page_link"
                      aria-label="Next"
                      @click="
                        getApartment(response_apartments.current_page + 1)
                      "
                    >
                      <span aria-hidden="true">&raquo;</span>
                      <span class="visually-hidden">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div v-else>
              <a
                class="
                  btn btn-warning
                  position-absolute
                  top-0
                  start-0
                  close_map
                "
                @click="closeMap()"
                >Annunci</a
              >
              <div id="map" class="map h-100"></div>
            </div>
          </div>
          <div class="col" v-else>
            <div class="destination text-center">
              <span>La ricerca non ha portato nessun risultato</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";

export default {
  name: "AdvancedSearch",
  data() {
    return {
      search: "",
      latitude: 36.74969053,
      longitude: 14.75327845,
      beds: "1",
      rooms: "1",
      radius: 20,
      serviceSelect: [],
      AllServices: [],
      response_apartments: null,
      apartments: "",
      loading: true,
      maps_view: false,
    };
  },
  props: {
    searchAddress: {
      type: String,
    },
    searchLatitude: {
      type: Number,
    },
    searchLongitude: {
      type: Number,
    },
  },
  methods: {
    getApartment(selectPage) {
      axios
        .get("/api/apartments", {
          params: {
            page: selectPage,
            lat: this.latitude,
            lon: this.longitude,
            radius: this.radius * 1000,
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
            this.response_apartments = response.data;
            this.apartments = response.data.data;
            this.apartments.sort((a, b) =>
              a.sponsorizations.length > b.sponsorizations.length ? -1 : 1
            );
            this.loading = false;
            if (this.maps_view) {
              if (this.apartments.length > 0 && !this.loading) {
                this.createMap();
              }
            }
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
      const resultElement = document.querySelector(".result_");
      resultElement.innerHTML = "";
      const link = `https://kr-api.tomtom.com/search/2/geocode/${address}.json?key=MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF&typeahead=true`;
      if (address.length > 2) {
        axios.get(link).then((response) => {
          const attempts = response.data.results.slice(0, 3);
          this.latitude = attempts[0].position.lat;
          this.longitude = attempts[0].position.lon;

          this.getApartment();
          attempts.forEach((item) => {
            const divElement = document.createElement("div");
            divElement.classList.add("list-result_");
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
    splitText(data, num) {
      return data.slice(0, num);
    },
    addServiceList(value) {
      if (this.serviceSelect.includes(value)) {
        const index = this.serviceSelect.indexOf(value);
        this.serviceSelect.splice(index, 1);
      } else {
        this.serviceSelect.push(value);
      }
      this.filterApartment();
    },
    createMarker(position, color, popupText, map) {
      const markerElement = document.createElement("div");
      markerElement.className = "marker";
      const markerContentElement = document.createElement("div");
      markerContentElement.className = "marker-content";
      markerContentElement.style.backgroundColor = color;
      markerElement.appendChild(markerContentElement);
      const iconElement = document.createElement("div");
      iconElement.className = "marker-icon";
      iconElement.style.backgroundImage =
        "url(https://cdn.icon-icons.com/icons2/936/PNG/512/home_icon-icons.com_73532.png)";
      markerContentElement.appendChild(iconElement);
      const popup = new tt.Popup({ offset: 30 }).setHTML(popupText);
      // add marker to map
      new tt.Marker({ element: markerElement, anchor: "bottom"})
        .setLngLat(position)
        .setPopup(popup)
        .addTo(map);
    },
    createMap() {
      this.maps_view = true;
      setTimeout(() => {
        document.getElementById("map").innerHTML = "";
        tt.setProductInfo("BoolBNB", "1.0");
        const map = tt.map({
          key: "MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF",
          container: "map",
          center: [this.longitude, this.latitude],
          zoom: 11.7 - this.radius / 18,
          dragPan: !isMobileOrTablet(),
        });
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        this.apartments.forEach((apartment) => {
          const markup = `<div class="card text-center">
        <img class="img-fluid" src="/storage/${apartment.cover_image}" alt="">
        <div class="card-body">
            <p>${apartment.title}</p>
        </div>
        <div class="mb-4">
            <a class="btn btn-warning" href="/apartment/${apartment.id}">Vedi annuncio</a>
        </div>
    </div>`;
          this.createMarker(
            [apartment.longitude, apartment.latitude],
            "#ffa500",
            markup,
            map,
          );
        });
      }, 100);
    },
    closeMap() {
      this.maps_view = false;
      document.getElementById("map").innerHTML = "";
    },
    filterApartment() {
      this.getApartment();
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
.close_map {
  z-index: 1;
}
.map {
  height: 100%;
  position: absolute;
  width: 99%;
}
.page_title {
  height: 310px;
  background-image: url("https://wallpaperaccess.com/full/4213391.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.page_body {
  .destination {
    margin-bottom: 30px;
  }
  .left_bar {
    display: none;
  }
  .left_bar,
  .destination {
    padding: 15px;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
    border-radius: 10px;
    border: solid 2px rgb(255, 177, 22);
    background: linear-gradient(to top left, #ffa500 0%, rgb(255, 140, 0) 100%);
  }

  .img_resize {
    aspect-ratio: 2/1;
  }
  .accordion-item:last-of-type .accordion-button.collapsed {
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
  }
  .accordion-button:focus {
    border-color: transparent;
    box-shadow: 0 0 0 0 rgb(13 110 253 / 25%);
  }
  .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
  }
  .accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
  }
  .acc_btn {
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    color: white;
    background: linear-gradient(to top left, orange 0%, rgb(255, 140, 0) 100%);
    text-transform: uppercase;
  }

  .acc_body {
    background: linear-gradient(to top left, orange 0%, rgb(255, 140, 0) 100%);
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }
}

main {
  min-height: 816px;
  aside {
    height: 100%;
  }
  .article {
    height: 100%;
  }
}
.page-item:last-child .page_link {
  border-top-right-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}

.page-item:first-child .page_link {
  border-top-left-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}
.page-item.active .page_link {
  z-index: 3;
  color: #fff;
  border: solid 2px rgb(255, 177, 22);
  background: linear-gradient(to top left, orange 0%, rgb(255, 140, 0) 100%);
}
.page_link {
  padding: 0.375rem 0.75rem;
  cursor: pointer;
}
.page_link {
  position: relative;
  display: block;
  color: orange;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #dee2e6;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.font_satify {
  font-family: "Satisfy", cursive;
}
.bagde_ {
  position: absolute;
  top: 2%;
  left: -2%;
  background-color: green;
  padding: 0.5rem;
  color: white;
  border-radius: 10px;
}
@media (min-width: 768px) {
  .page_title {
    height: 450px;
  }
  .accordion {
    display: none;
  }
  .page_body {
    .left_bar {
      display: block;
    }
  }
}
@media (min-width: 1200px) {
  .page_title {
    height: 600px;
  }
}
</style>
