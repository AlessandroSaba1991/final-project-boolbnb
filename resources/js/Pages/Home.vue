<template>
  <div class="container-fluid p-0 container-home">
    <div class="row g-0 backimg">
      <div
        class="
          col-lg-12 col-md-12 col-sm-12
          d-flex
          justify-content-center
          align-items-center
          flex-wrap
        "
      >
        <div class="text-uppercase text-white p-5 title">team 7 boolbnb</div>
      </div>
      <div class="d-flex justify-content-center">
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
          class="btn btn_orange text-uppercase text-white font_monserrat"
          >Cerca</router-link
        >
        </div>
      </div>
    </div>
    <section class="subscription">
      <div class="d-flex justify-content-center p-3">
        <h2 class="text-uppercase font_satisy fz_48 mb-0 py-5">sponsorizzati</h2>
      </div>
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
            <h2 class="text-white font_satisy fz_64">Perchè noi?</h2>
            <p class="text-capitalize mt-5 text-white font_monserrat">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente
              dignissimos molestias adipisci fuga, cum ipsa dolores possimus
              animi ab velit! Numquam voluptates, totam ipsa deleniti quae
              deserunt rerum? Doloremque, rerum.
            </p>
            <div class="why_icons d-flex justify-content-evenly w-100">
            <div class="icon_and_text text-center">
              <div class="house_icon">
                <svg height="50" width="50" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"/></svg>
              </div>
              <div class="icon_text">
                <p>Over 3700 <br> Structures</p>
              </div>
            </div>
            <div class="icon_and_text">
               <div class="customer_icon">
                <img src="../../img/customer.png" alt="" height="50" width="50">
              </div>
              <div class="icon_text">
                <p class="">24/7 Support</p>
              </div>
            </div>
            <div class="icon_and_text text-center">
              <div class="rank_icon">
                <svg height="50" width="50" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M406.1 61.65C415.4 63.09 419.4 74.59 412.6 81.41L374.6 118.1L383.6 170.1C384.1 179.5 375.3 186.7 366.7 182.4L320.2 157.9L273.3 182.7C264.7 187 255 179.8 256.4 170.5L265.4 118.4L227.4 81.41C220.6 74.59 224.6 63.09 233.9 61.65L286.2 54.11L309.8 6.332C314.1-2.289 326.3-1.93 330.2 6.332L353.8 54.11L406.1 61.65zM384 256C401.7 256 416 270.3 416 288V480C416 497.7 401.7 512 384 512H256C238.3 512 224 497.7 224 480V288C224 270.3 238.3 256 256 256H384zM160 320C177.7 320 192 334.3 192 352V480C192 497.7 177.7 512 160 512H32C14.33 512 0 497.7 0 480V352C0 334.3 14.33 320 32 320H160zM448 416C448 398.3 462.3 384 480 384H608C625.7 384 640 398.3 640 416V480C640 497.7 625.7 512 608 512H480C462.3 512 448 497.7 448 480V416z"/></svg>
              </div>
              <div class="icon_text">
                <p class="">Top 10 Best <br> Rent Sites</p>
              </div>
            </div>
          </div>
        </div>
          </div>
      </div>
    <section class="users_comments">
      <SliderComponent/>
    </section>
    <!-- <div class="footer">
      <div class="container p-3">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="socials">
              <h5 class="pt-4 text-white text-uppercase font_monserrat">
              get socials
            </h5>
            <p class="text-white font_monserrat">
              Link with us via social networks
            </p>
            <span class="instagram"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                width="23"
                fill="orange"
                viewBox="0 0 448 512"
              >
                <path
                  d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                /></svg
            ></span>
            <span class="linkedin mx-3"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                width="23"
                fill="orange"
                viewBox="0 0 448 512"
              >
                <path
                  d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"
                /></svg
            ></span>
            <span class="facebook"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                width="23"
                fill="orange"
                viewBox="0 0 512 512"
              >
                <path
                  d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"
                /></svg
            ></span>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="">
              <h5 class="pt-4 text-white text-uppercase font_monserrat">
              We're here for you
              </h5>
            <p class="text-white font_monserrat">
              8500, Lorem Street, Chicago, IL, 55030 Phone (123)456-78-90 Phone
              (123)456-78-90 sales@example.com
            </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="">
              <h5 class="pt-4 text-white text-uppercase font_monserrat">
              contact us
            </h5>
            <p class="text-white font_monserrat">
              we love yoyr feedback and are constantly looking
            </p>
            <p class="orange text-uppercase font_monserrat">
              send us a message
            </p>
            </div>
          </div>
        </div>
      </div>
      <div class="credits text-center text-white font_monserrat p-2">
        &copy; Team 7 Boolean
      </div>
    </div> -->
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
  height: 400px;
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

.bg_orange {
  background: linear-gradient(
      to right,
      #edc156 0%,
      #fea759 0%,
      #fea759 50%,
      #edc156 100%
    )
    no-repeat scroll right bottom/210% 100% #fea759;
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

.font_satisy {
  font-family: "Satisfy", cursive;
}

.font_monserrat {
  font-family: "Montserrat", sans-serif;
}

.house_icon{
  background-color: rgba(255,255,255,.2);
  max-height: 110px;
  max-width: 110px;
  border-radius: 50%;
  padding: 25px;
  transition: 0.8s;
}

.customer_icon{
  background-color: rgba(255,255,255,.2);
  max-height: 110px;
  max-width: 110px;
  border-radius: 50%;
  padding: 25px;
  transition: 0.8s;
}

.house_icon:hover,
.customer_icon:hover,
.rank_icon:hover{
  background:#0d6efd;
}

.customer_icon > img{
  filter: invert(100);
}

.rank_icon{
  background-color: rgba(255,255,255,.2);
  max-height: 110px;
  max-width: 110px;
  border-radius: 50%;
  padding: 25px;
  transition: 0.8s;
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

@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Satisfy&display=swap");
}


</style>




