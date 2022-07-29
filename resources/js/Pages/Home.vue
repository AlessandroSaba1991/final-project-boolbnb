<template>
  <div class="container-fluid p-0 container-home">
    <div class="row align-items-center g-0 backimg">
      <div class="col d-flex justify-content-center">
        <div class="mb-3 w-50 me-2 position-relative">
          <input
            type="search"
            id="search"
            class="form-control"
            placeholder="Cerca L'Appartamento Più Vicino"
            aria-label="Search"
            aria-describedby="search-addon"
            v-model="searchAddress"
            @keyup="callAddress()"
          />
          <div class="result w-100" hidden></div>
        </div>
        <div>
        <router-link

          :to="{
            name: 'advancedsearch',
            params: {
              searchAddress: searchAddress,
              searchLatitude: searchLatitude,
              searchLongitude: searchLongitude,
            },
          }"
          class="btn btn_orange text-uppercase"
          >Cerca</router-link
        >
        </div>
      </div>
    </div>
    <section class="subscription text-center">

      <h2 class="sponsored_title text-capitalize bg_orange rounded-3 mb-5 font_satisy fz_48 p-4 d-inline-block">in evidenza</h2>

      <div class="container">
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
                      <h5 class="card-title text-capitalize">
                        {{ apartment.title }}
                      </h5>
                      <p class="card-text" v-if="apartment.description != null">
                        {{ splitText(apartment.description, 99) }}...
                      </p>
                      <router-link
                        class="btn btn_orange text-uppercase"
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
      </div>
    </section>
      <div class="row g-0 w-100">
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="h-100 image_container">
            <img
            :src="photo.image"
            alt=""
            class="imgfit"
            :class="index == activeItem ? 'active_img' : ''"
            v-for="(photo, index) in photos"
            @click="selectedImage(index)"
            :key="index"
            />
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-12 col-sm-12 bg_orange ">
          <div class="d-flex flex-column justify-content-evenly align-items-center h-100 p-3">
            <h2 class="pt-5 font_satisy fz_64">Perchè noi?</h2>
            <p class="text-capitalize text-center p-3">
              Il nostro unico obiettivo è offrire la totale sicurezza nei confronti dei clienti <br> e fornire la miglior esperienza in base alle proprie esigenze. <br> There’s no place like us.
            </p>
            <div class="why_icons d-flex justify-content-evenly w-100">
            <div class="icon_and_text text-center">
              <div class="why_us_icon">
                <svg height="45" width="45" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"/></svg>
              </div>
              <div class="icon_text">
                <p class="text-center text-dark">Over 3700 <br> Structures</p>
              </div>
            </div>
            <div class="icon_and_text">
               <div class="why_us_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-telephone-plus-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM12.5 1a.5.5 0 0 1 .5.5V3h1.5a.5.5 0 0 1 0 1H13v1.5a.5.5 0 0 1-1 0V4h-1.5a.5.5 0 0 1 0-1H12V1.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
              </div>
              <div class="icon_text">
                <p class="text-center text-dark">24/7 <br> Support</p>
              </div>
            </div>
            <div class="icon_and_text text-center">
              <div class="why_us_icon">
                <svg height="45" width="45" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M406.1 61.65C415.4 63.09 419.4 74.59 412.6 81.41L374.6 118.1L383.6 170.1C384.1 179.5 375.3 186.7 366.7 182.4L320.2 157.9L273.3 182.7C264.7 187 255 179.8 256.4 170.5L265.4 118.4L227.4 81.41C220.6 74.59 224.6 63.09 233.9 61.65L286.2 54.11L309.8 6.332C314.1-2.289 326.3-1.93 330.2 6.332L353.8 54.11L406.1 61.65zM384 256C401.7 256 416 270.3 416 288V480C416 497.7 401.7 512 384 512H256C238.3 512 224 497.7 224 480V288C224 270.3 238.3 256 256 256H384zM160 320C177.7 320 192 334.3 192 352V480C192 497.7 177.7 512 160 512H32C14.33 512 0 497.7 0 480V352C0 334.3 14.33 320 32 320H160zM448 416C448 398.3 462.3 384 480 384H608C625.7 384 640 398.3 640 416V480C640 497.7 625.7 512 608 512H480C462.3 512 448 497.7 448 480V416z"/></svg>
              </div>
              <div class="icon_text">
                <p class="text-center text-dark">Top 10 Best <br> Rent Sites</p>
              </div>
            </div>
          </div>
        </div>
          </div>
      </div>
    <section class="users_comments">
      <SliderComponent/>
    </section>
  </div>
</template>

<script>
import SliderComponent from "../components/SliderComponent.vue"

export default {
  name: "Home",

  components:{
    SliderComponent
  },
  data() {
    return {
      photos: [
        {
          image: "https://wallpaperaccess.com/full/1126760.jpg",
        },
        {
          image: "https://images.posarellivillas.com/property_posarelli/96071/wide-asra16:10/villa-serapias-posarelli-29-.jpg",
        },
      ],
      activeItem: 0,
      searchLatitude: "",
      searchLongitude: "",
      searchAddress: "",
      apartments: "",
    };
  },

  methods: {
    getSponsoredApartments() {
      axios
        .get("/api/apartments/sponsored")
        .then((response) => {
          //console.log(response);
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
    selectedImage(index) {
      this.activeItem = index;
      //console.log(this.activeItem);
    },
    goDown() {
      if (this.activeItem < this.photos.length - 1) {
        this.activeItem++;
      } else {
        this.activeItem = 0;
      }
    },
    stopInterval() {
      clearInterval(this.interval);
    },
    startInterval() {
      this.interval = setInterval(this.goDown, 5000);
    },
    splitText(data, num) {
      return data.slice(0, num);
    },
    callAddress() {
      window.axios.defaults.headers.common = {
        Accept: "application/json",
        "Content-Type": "application/json",
      };
      const address = document.getElementById("search").value;
      const resultElement = document.querySelector(".result");
      resultElement.innerHTML = "";
      const link = `https://kr-api.tomtom.com/search/2/geocode/${address}.json?key=MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF&typeahead=true`;
      if (address.length > 2) {
        axios.get(link).then((response) => {
          const attempts = response.data.results.slice(0, 3);
          this.searchLatitude = attempts[0].position.lat;
          this.searchLongitude = attempts[0].position.lon;
          attempts.forEach((item) => {
            const divElement = document.createElement("div");
            divElement.classList.add("list-result");
            const markup = `<span>${item.address.freeformAddress}</span>`;
            divElement.insertAdjacentHTML("beforeend", markup);
            divElement.addEventListener("click", () => {
              document.getElementById("search").value =
                item.address.freeformAddress;
              this.searchAddress = item.address.freeformAddress;
              this.searchLatitude = item.position.lat;
              this.searchLongitude = item.position.lon;
              resultElement.innerHTML = "";
              resultElement.setAttribute("hidden", "true");
            });
            resultElement.append(divElement);
            resultElement.removeAttribute("hidden");
          });
        });
      }
    },
  },
  mounted() {
     this.getSponsoredApartments();
    this.interval = setInterval(this.goDown, 5000);
  },
};
</script>

<style lang="scss" scoped>

.sponsored_title {
  margin: -50px 0;
}

.img_resize {
    aspect-ratio: 2/1;
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

.container-home{
  .backimg {
  background-image: url("https://www.myistria.com/UserDocsImages/app/objekti/795/slika_hd/19082020034916_Villas-near-Rovinj-Villa-Prestige-2.jpg");
  height: 500px;
  background-size: cover;
  background-position: center;
  overflow-x:hidden;
}

.title {
  font-size: 32px;
}

.radius {
  border-radius: 50%;
}

.btn_orange {
  background: linear-gradient(
      to right,
      #edc156 0%,
      #fea759 0%,
      #fea759 50%,
      #edc156 100%
    )
    no-repeat scroll right bottom/210% 100% #fea759;
}

.price {
  text-align: center;
  text-transform: capitalize;
}

/* .bg_blue{
        background-color: aqua;
        height: 200px;
        width: 300px;
    } */

.img1 {
  height: 500px;
  width: 900px;
}

.pt_7 {
  padding-top: 9rem;
}

.bg_img2 {
  background-image: url(https://wallpaperaccess.com/full/1126760.jpg);
  width: 100%;
  height: 500px;
  background-size: cover;
  background-repeat: no-repeat;
}


.border-black {
  border: 1px solid black;
  border-radius: 50%;
  padding: 10px;
}

.active_img {
  display: none;
}


.fade{
  opacity: 0;
  transition: opacity 4s;
}


.borderimg {
  border: 1px solid black;
  border-radius: 50%;
}


.imgfit {
  aspect-ratio: 2;
  height: 100%;
  width: 100%;
}

.credit {
  background-color: orange;
}

.w-10 {
  width: 10%;
}

.w26rem {
  width: 26rem;
}

.fz_64{
  font-size: 64px;
}

.fz_48{
  font-size: 48px;
}


// .font_monserrat {
//   font-family: "Montserrat", sans-serif;
// }

.why_us_icon{
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(255,255,255,.2);
  height: 80px;
  width: 80px;
  border-radius: 50%;
  padding: 25px;
  transition: 0.8s;
}

.why_us_icon:hover{
  background:#0d6efd;
  background-image: var(--bs-gradient) !important;
  color: white;
}

.customer_icon > img{
  filter: invert(100);
}



.icon_text{
  color: white;
  text-transform: uppercase;
  margin-top: 16px;
}

@media screen and(max-width:576px) {
  .margin-3 {
    margin: 0 0 0 0;
  }

  .socials{
    margin-bottom: 20px;
  }
}

}


</style>




