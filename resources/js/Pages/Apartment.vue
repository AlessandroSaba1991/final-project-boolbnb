<template>
  <div class="single_page h-100">
    <div class="jumbo_container position-relative">
      <div class="jumbotron"></div>
      <div
        class="
          apt_title
          d-flex
          justify-content-center
          align-items-center
          text-white
        "
      >
        <h1 class="font_satisfy text-center">{{ apartment.title }}</h1>
      </div>
    </div>

    <div class="h-100 pt-5" v-if="!loading">
      <div class="container-fluid mt-lg-5">
        <div class="row gx-3">
          <div class="col-12 col-lg-8 position-relative mb-5">
            <div class="apartment_image">
              <h2 class="bg_label_absolute">Foto</h2>
              <img
                class="apt-img"
                :src="'/storage/' + apartment.cover_image"
                alt=""
              />
            </div>
          </div>
          <div class="col-12 col-lg-4 position-relative col_map mb-5">
            <h2 class="bg_label_absolute">Mappa</h2>

            <div id="map" class="map border_shadow"></div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="first_info mb-5">
          <div class="section_title">
            <h2 class="bg_label">{{ apartment.title }}</h2>
          </div>
          <div class="apartment_address mb-5">
            <h5>{{ apartment.address }}</h5>
          </div>
        </div>

        <div class="apartment_description mb-5">
          <div class="section_title">
            <h2 class="bg_label">Descrizione</h2>
          </div>

          <p>{{ apartment.description }}</p>
        </div>

        <div class="apartment_details mb-5">
          <div class="section_title">
            <h2 class="mb-3 bg_label">Dettagli</h2>
          </div>

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

        <div
          class="apartment_services mb-5"
          v-if="apartment.services.length > 0"
        >
          <div class="section_title">
            <h2 class="bg_label">Servizi</h2>
          </div>

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

        <div class="d-flex justify-content-center pb-5 mt-5 position-relative">
          <div class="form_ py-5">
            <h2 class="bg_label_absolute left_">Contatta il proprietario</h2>

            <form @submit.prevent="saveMessage()" method="post">
              <label for="name" class="mt-3">Nome*:</label>
              <input
                placeholder="scrivi il tuo nome qui.."
                type="text"
                v-model="guestFullName"
                name="name"
                id="name"
                min="3"
                max="25"
                aria-describedby="namehelpId"
                required
              />

              <label for="email" class="mt-3">Email*:</label>
              <input
                placeholder="scrivi qui la tua mail.."
                type="email"
                v-model="guestEmail"
                name="email"
                id="email"
                required
                aria-describedby="emailHelpId"
              />

              <label for="message" class="mt-3">Messaggio*:</label>
              <textarea
                @keyup.enter="saveMessage()"
                required
                v-model="guestMessage"
                class="mod_txtarea"
                name="message"
                id="message"
                cols="30"
                rows="5"
              ></textarea>

              <button type="submit" value="INVIA">Invia</button>
            </form>

            <div
              :class="messageSend ? 'position-absolute' : 'd-none'"
              class="
                message_send
                rounded
                p-1
                mb-2
                bg-success bg-gradient
                text-white text-center
                fs-3
                d-inline-block
              "
            >
              Messaggio inviato!
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
  name: "Apartment",
  data() {
    return {
      apartment: "",
      loading: true,
      yourIP: "",
      guestFullName: "",
      guestEmail: "",
      guestMessage: "",
      messageSend: false,
    };
  },
  methods: {
    createMarker(position, color, popupText, icon, map) {
      const markerElement = document.createElement("div");
      markerElement.className = "marker";
      const markerContentElement = document.createElement("div");
      markerContentElement.className = "marker-content";
      markerContentElement.style.backgroundColor = color;
      markerElement.appendChild(markerContentElement);
      const iconElement = document.createElement("div");
      iconElement.className = "marker-icon";
      iconElement.style.backgroundImage = "url(" + icon + ")";
      markerContentElement.appendChild(iconElement);
      const popup = new tt.Popup({ offset: 30 }).setHTML(popupText);
      // add marker to map
      new tt.Marker({ element: markerElement, anchor: "bottom" })
        .setLngLat(position)
        .setPopup(popup)
        .addTo(map);
    },
    createMap(apartment) {
      setTimeout(() => {
        document.getElementById("map").innerHTML = "";
        tt.setProductInfo("BoolBNB", "1.0");
        const map = tt.map({
          key: "MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF",
          container: "map",
          center: [apartment.longitude, apartment.latitude],
          zoom: 16,
          dragPan: !isMobileOrTablet(),
        });
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        const markupPos = `<div class="card text-center">
                <img class="img-fluid" src="/storage/${apartment.cover_image}" alt="">
                <div class="card-body">
                <p>${apartment.title}</p>
                </div>
                </div>`;
        this.createMarker(
          [apartment.longitude, apartment.latitude],
          "#000",
          markupPos,
          "https://cdn1.iconfinder.com/data/icons/office-22/48/flag-512.png",
          map
        );
      }, 100);
    },
    getAuthUser() {
      this.guestEmail = window.user_email;
      this.guestFullName = window.user_name;
    },
    saveMessage() {
      axios
        .get("/api/apartment/message", {
          params: {
            apartment_id: this.$route.params.id,
            fullname: this.guestFullName,
            email: this.guestEmail,
            content: this.guestMessage,
          },
        })
        .then((response) => {
          //console.log(response);
          if (response.data.status_code === 404) {
            this.$router.push({ name: "not-found" });
          } else {
            console.log(response);
            this.guestMessage = "";
            this.messageSend = true;
            setTimeout(() => {
              this.messageSend = false;
            }, 2000);
          }
        })
        .catch((e) => {
          console.error(e);
        });
    },
    postView() {
      axios
        .get("/api/visualization/", {
          params: {
            ip: this.yourIP,
            apartment_id: this.$route.params.id,
          },
        })
        .catch((e) => {
          console.error(e);
        });
    },
    showYourIP() {
      fetch("https://api.ipify.org?format=json")
        .then((x) => x.json())
        .then(({ ip }) => {
          this.yourIP = ip;
          this.postView();
        });
    },
    getApartment() {
      axios
        .get("/api/apartment/" + this.$route.params.id, {
          params: {
            lat: 44.78993,
            lon: 11.57065,
            radius: 20000,
          },
        })
        .then((response) => {
          //console.log(response);
          if (response.data.status_code === 404) {
            this.loading = false;
            this.$router.push({ name: "not-found" });
          } else {
            this.apartment = response.data;
            this.loading = false;
            this.createMap(response.data);
          }
        })
        .catch((e) => {
          console.error(e);
        });
    },
  },
  mounted() {
    this.getApartment();
    this.showYourIP();
    this.getAuthUser();
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/message.scss";
.map {
  height: 100%;
  position: absolute;
  width: 97%;
}
.left_ {
  left: 10px !important;
}
.single_page {
  background: linear-gradient(
    132deg,
    rgb(238 238 238) 0%,
    rgb(214 214 214 / 45%) 100%
  );
  .jumbotron {
    height: 500px;
    background-image: url("../../img/1126773.jpg");
    background-position: center;
    background-size: cover;
    filter: brightness(50%);
  }

  .apt_title {
    height: 500px;
    width: 100%;
    position: absolute;
    top: 0;
  }

  .font_satisfy {
    font-size: 62px;
    font-family: "Satisfy", cursive;
  }
  .apt-img {
    width: 100%;
    height: 100%;
    aspect-ratio: 2/1;
  }

  .bg_label_absolute {
    position: absolute;
    z-index: 1;
    top: -9px;
    left: 16px;
    background: linear-gradient(
      to right,
      #edc156 0%,
      #fea759 0%,
      #fea759 50%,
      #edc156 100%
    );
    padding: 5px 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  }
  .bg_label {
    display: inline;
    background: linear-gradient(
      to right,
      #edc156 0%,
      #fea759 0%,
      #fea759 50%,
      #edc156 100%
    );
    padding: 5px 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    margin-left: -10px;
  }

  .section_title,
  .apartment_description {
    padding-bottom: 50px;
  }

  .first_info,
  .apartment_details,
  .apartment_services,
  .apartment_description {
    background-color: white;
    border: 1px solid #ffecba;
    box-shadow: 3px 3px 8px 0px #fea759;
    padding: 0px 20px 0px 20px;
  }

  .border_shadow {
    border: 1px solid #ffecba;
    box-shadow: 3px 3px 8px 0px #fea759;
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
  }

  @media screen and (max-width: 991.98px) {
    .map {
      height: 97%;
      position: absolute;
      width: 95.5%;
    }
    .col_map {
      aspect-ratio: 2/1;
    }
  }

  @import url("https://fonts.googleapis.com/css2?family=Satisfy&display=swap");
}
</style>
