<template>
  <section id="articles">
    <div class="slider py-5">
      <div class="slider-content">
        <h2 class="text-center pt-3 font_satisy">Dicono Di Noi</h2>
        <p class="review ">“ {{ articles[currentIndex].review }} ”</p>
        <p class="user">{{ articles[currentIndex].user }}</p>

        <div class="dots">
          <button
            class="dot"
            :class="i == currentIndex ? 'currentDot' : ''"
            v-for="(item, i) in articles"
            :key="i"
            @click="clickDots(i)"
          ></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "SliderComponent",
  data() {
    return {
      currentIndex: 0,
      articles: [
        {
          review:
            "Mi sono sempre trovata bene, basta saperlo utilizzare. Usare sempre prenotazione immediata e controllare le recensioni dell'appartamento che si vuole affittare.",
          user: "Cecilia Rizzo",
        },
        {
          review:
            "il migliore sito dove prenotare in sicurezza. Funziona tutto perfettamente. Facilissimo da usare. Commissioni basse. Assistenza telefonica ottima!",
          user: "Geraldina Manfrin",
        },
        {
          review:
            "Ottimo sito e il fatto che bisogna dare i documenti per rassicurare ospiti e ospitanti è un ottimo modo per evitare gentaglia poco raccomandabile.",
          user: "Prisco Colombo",
        },
      ],
    };
  },
  mounted: function () {
    this.startSlide();
  },
  methods: {
    next() {
      this.currentIndex += 1;
      if (this.currentIndex > this.articles.length - 1) {
        this.currentIndex = 0;
      }
    },
    prev() {
      this.currentIndex -= 1;
      if (this.currentIndex < 0) {
        this.currentIndex = this.articles.length - 1;
      }
    },
    clickDots(indexImage) {
      this.currentIndex = indexImage;
    },
    startSlide: function () {
      this.timer = setInterval(this.next, 4000);
    },
  },
};
</script>

<style lang="scss" scoped>

.slider {
    position: relative;
}
.slider-content {
  
  min-height: 370px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  width: 50%;
  margin: 0 auto;
  text-align: center;
  position: relative;
}

.review {
  line-height: 24px;
  max-width: 630px;
  margin-top: 40px;
  color: black;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
}
.user {
  color: orangered;
  font-size: 16px;
  margin: 10px 0 50px 0;
  text-transform: uppercase;
}
.dots {
  //padding: 10px;
  text-align: center;
  z-index: 1;
  position: absolute;
  bottom: 10%;
}
.dot {
  width: 8px;
  height: 8px;
  background-color: #ebebde;
  border-radius: 50%;
  margin: 0 7px;
  border: none;
  &:hover {
    cursor: pointer;
  }
}
.currentDot {
  background-color: lightslategray;
}
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 45%;
  background-color: orange;
  padding: 10px 20px;
  font-size: 12px;
  border-top-left-radius: 68px;
  border-top-right-radius: 68px;
  text-decoration: none;
  text-transform: uppercase;
}
.next {
  right: -16px;
  transform: rotate(270deg);
}
.prev {
  left: -17px;
  transform: rotate(90deg);
}
a{
    text-decoration: none;
    color: white;
    
}

.font_satisy {
  font-size: 86px;
  font-family: "Satisfy", cursive;
}
</style>