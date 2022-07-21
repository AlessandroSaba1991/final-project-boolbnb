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
                  mt-sm-3
                "
              >
                <label for="address" class="form-label"
                  >Distanza max dal luogo</label
                >
                <input
                  class="form-control rounded-0"
                  id="range"
                  type="number"
                  min="0"
                  name="range"
                  value=""
                  placeholder="KM"
                  v-model="range"
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
                  <option value="1">Wi-fi</option>
                  <option value="2">Portineria</option>
                  <option value="3">Posto Auto</option>
                  <option value="4">Piscina</option>
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
      beds: "",
      rooms: "",
      range: "",
      serviceSelect: [],
      services: [],
    };
  },
  methods: {
    /* getServices() {
      axios
        .get("api/services")
        .then((response) => {
          this.services = response.data;
        })
        .catch((e) => {
          console.error(e);
        });
    }, */
  },
  mounted() {
    /* this.getServices(); */
  },
};
</script>

<style>
</style>
