<template>
  <div class="single_page h-100">
    <div class="wrapper h-100" v-if="!loading">
      <div class="container">
        <div class="apartment_image mb-5">
          <img
            class="apt-img"
            :src="'/storage/' + apartment.cover_image"
            alt=""
          />
        </div>

        <div class="apartment_title mb-2">
          <h1>{{ apartment.title }}</h1>
        </div>

        <div class="apartment_address mb-5">
          <h5>{{ apartment.address }}</h5>
        </div>

        <div class="apartment_description mb-5">
          <h2>Descrizione</h2>
          <p>{{ apartment.description }}</p>
        </div>

        <div class="apartment_details mb-5">
          <h2 class="mb-3">Dettagli</h2>
          <div
            class="
              details-list
              d-flex
              justify-content-around
              align-items-center
              mb-5
            "
          >
            <div class="detail-element">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="30"
                height="30"
                fill="fillcolor"
                class="bi bi-trash-fill"
                viewBox="0 0 640 512"
              >
                <path
                  d="M176 288C220.1 288 256 252.1 256 208S220.1 128 176 128S96 163.9 96 208S131.9 288 176 288zM544 128H304C295.2 128 288 135.2 288 144V320H64V48C64 39.16 56.84 32 48 32h-32C7.163 32 0 39.16 0 48v416C0 472.8 7.163 480 16 480h32C56.84 480 64 472.8 64 464V416h512v48c0 8.837 7.163 16 16 16h32c8.837 0 16-7.163 16-16V224C640 170.1 597 128 544 128z"
                />
              </svg>
              <span class="fw-bold">{{ apartment.beds }}</span>
            </div>

            <div class="detail-element">
              <img src="../../img/bathroom.png" width="30" height="30" />
              <span class="fw-bold">{{ apartment.bathrooms }}</span>
            </div>

            <div class="detail-element">
              Numero camere:
              <span class="fw-bold"> {{ apartment.rooms }}</span>
            </div>

            <div class="detail-element">
              metri quadri:
              <span class="fw-bold">{{ apartment.square_meters }}</span>
            </div>
          </div>
        </div>

        <div class="apartment_services" v-if="apartment.services.length > 0">
          <h2>Servizi</h2>
          <ul class="list">
            <li
              class="services-elements"
              v-for="service in apartment.services"
              :key="service.id"
            >
              {{ service.name }}
            </li>
          </ul>
        </div>

        <div class="maps py-5 mb-5">
          <h2>Posizione sulla mappa</h2>
          <div class="map-container">
            <div class="mapouter">
              <div class="gmap_canvas">
                <iframe
                  width="100%"
                  height="500"
                  id="gmap_canvas"
                  src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed"
                  frameborder="0"
                  scrolling="no"
                  marginheight="0"
                  marginwidth="0"
                ></iframe>
                <a href="https://fmovies-online.net"></a>
                <br />
                <a href="https://www.embedgooglemap.net"
                  >google maps create map</a
                >
              </div>
            </div>
          </div>
        </div>

        <div class="message-form message-style">
          <h2 class="text-white text-uppercase fw-bold">
            Invia un messaggio all' Host
          </h2>
          <div class="mb-3">
            <label
              for="exampleFormControlInput1"
              class="form-label fw-bold text-white"
              >Nome Completo</label
            >
            <input
              type="text"
              class="form-control"
              id="exampleFormControlInput1"
              placeholder="Mario Rossi"
            />
          </div>

          <div class="mb-3">
            <label
              for="exampleFormControlInput1"
              class="form-label fw-bold text-white"
              >Indirizzo mail</label
            >
            <input
              type="email"
              class="form-control"
              id="exampleFormControlInput1"
              placeholder="name@example.com"
            />
          </div>

          <div class="mb-3">
            <label
              for="exampleFormControlTextarea1"
              class="form-label fw-bold text-white"
              >Il tuo messaggio</label
            >
            <textarea
              class="form-control"
              id="exampleFormControlTextarea1"
              rows="3"
            ></textarea>
          </div>
          <button
            type="submit"
            class="
              message_button
              btn btn-primary
              text-white text-uppercase
              fw-bold
              mt-5
            "
          >
            Invia
          </button>
        </div>
      </div>
    </div>
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
        .get("/api/apartment/" + this.$route.params.id, {
          params: {
            lat: 44.78993000,
            lon: 11.57065000,
            radius: 20000
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
  },
  mounted() {
    this.getApartment();
  },
};
</script>

<style lang="scss" scoped>
.apt-img {
  width: 100%;
}

.apartment_address,
.apartment_details,
.apartment_services,
.apartment_description,
.maps {
  border-bottom: 1px dotted lightgrey;
}

.list {
  column-count: 4;
  column-gap: 20px;
  //list-style-image: url("../../img/check-solid.svg");
  list-style: none;
}

.list li:before {
  content: "\2713";
  color: #faad58;
  font-weight: bold;
  display: inline-block;
  width: 1em;
  margin-left: -1em;
}

.mapouter {
  position: relative;
  text-align: right;
  height: 500px;
  width: 100%;
}
.gmap_canvas {
  overflow: hidden;
  background: none !important;
  height: 500px;
  width: 100%;
}

.message-style {
  background-color: #faad58;
  padding: 50px;
}

@media screen and (max-width: 600px) {
  .details-list,
  .list {
    flex-direction: column;
    justify-content: space-between;
    column-count: 1;
  }

  .services-elements {
    font-size: 20px;
  }

  .detail-element {
    margin-bottom: 20px;
    font-size: 20px;
  }

  .message-form {
    display: flex;
    flex-direction: column;
  }
  .message_button {
    padding: 16px 32px;
    font-size: large;
    align-items: center;
  }
}
</style>
