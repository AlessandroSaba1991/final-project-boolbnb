<template>
    <div class="container-fluid p-0">
        <div class="row g-0 backimg">
            <div class=" col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center flex-wrap">
                <div class="text-uppercase text-white p-5 title">team 7 boolbnb</div>
            </div>
             <div class="search d-flex justify-content-center">
                <div class="searchbox col-lg-6 col-md-6 col-sm-5 col-5">
                    <div class="input-group w-100 d-flex">
                        <input type="search" class="form-control" placeholder="Cerca L'Appartamento Più Vicino" aria-label="Search" aria-describedby="search-addon" />
                        <button type="button" class="btn btn_orange text-uppercase text-white font_monserrat">start searching</button>
                    </div>
                </div>
             </div>
        </div>
        <section class="subscription">
            <div class="d-flex justify-content-center p-3">
                <h2 class="text-uppercase font_satisy">subscription rental</h2>
            </div>
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                    <div class="col py-4 px-3 ">
                        <div class="card">
                            <img src="https://wallpapercave.com/wp/wp7111669.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <p class="card-text text-center font_monserrat">Villa Molto Graziosa</p>
                            <p class="price font_monserrat">300$/notte</p>
                            <button class="btn btn_orange text-uppercase text-white font_monserrat">Check it</button>
                        </div>
                    </div>
                    </div>
                <div class="col py-4 px-3">
                    <div class="card">
                        <img src="https://wallpapercave.com/wp/wp7111669.jpg" alt="" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center font_monserrat">Villa Molto Graziosa</p>
                        <p class="price font_monserrat">300$/notte</p>
                        <button class="btn btn_orange text-uppercase text-white font_monserrat">Check it</button>
                    </div>
                </div>
                </div>
                <div class="col py-4 px-3">
                    <div class="card">
                        <img src="https://wallpapercave.com/wp/wp7111669.jpg" alt="" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text text-center font_monserrat">Villa Molto Graziosa</p>
                        <p class="price font_monserrat">300$ / notte</p>
                        <button class="btn btn_orange text-uppercase text-white font_monserrat">Check it</button>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </section>
        <div class="d-flex justify-content-center pt-5">
            <div class="row g-0 w-100">
                <div class="col-12 col-lg-6 col-md-12">
                    <img :src="photo.image" alt=""  class="w-100 imgfit" :class="index == activeItem ?  'active_img' : '' " v-for="(photo,index) in photos" @click="selectedImage(index)" :key="index">
                </div>
                <div class="col-12 col-lg-6  text-center align-content-center bg_orange ">
                    <div class="pt_7 mb-5">
                        <h1 class="text-uppercase text-white font_satisy">why us ? </h1>
                        <p class="text-capitalize mt-5 text-white font_monserrat">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente dignissimos molestias adipisci fuga, cum ipsa dolores possimus animi ab velit! Numquam voluptates, totam ipsa deleniti quae deserunt rerum? Doloremque, rerum.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container p-5">
                <div class="row">
                    <div class="col-4">
                        <h5 class="pt-4 text-white text-uppercase font_monserrat">get socials</h5>
                        <p class="pt-3 text-white font_monserrat">Link with us via social networks</p>
                        <span class="instagram"><svg xmlns="http://www.w3.org/2000/svg" width="23" fill="orange" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></span>
                        <span class="linkedin mx-3"><svg xmlns="http://www.w3.org/2000/svg" width="23" fill="orange" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg></span>
                        <span class="facebook"><svg xmlns="http://www.w3.org/2000/svg"  width="23" fill="orange" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></span>
                    </div>
                    <div class="col-4">
                        <h5 class="pt-4 text-white text-uppercase font_monserrat">We're here for you</h5>
                        <p class="pt-3 text-white font_monserrat">8500, Lorem Street, Chicago, IL, 55030 Phone  (123)456-78-90 Phone  (123)456-78-90 sales@example.com</p>
                    </div>
                    <div class="col-4">
                        <h5 class="pt-4 text-white text-uppercase font_monserrat">contact us</h5>
                        <p class="pt-3 text-white font_monserrat">we love yoyr feedback and are constantly looking</p>
                        <p class="pt-3 orange text-uppercase font_monserrat">send us a message </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Home',
    data(){
        return{
             photos:[
            {
                image:"https://wallpaperaccess.com/full/1126760.jpg"
            },
            {
                image:"https://www.quiq.re/wp-content/uploads/2014/12/bg-1.jpg"
            }
        ],

        activeItem:0,
        }
       
    },

    methods:{
        selectedImage(index){
            this.activeItem = index;
            //console.log(this.activeItem);
        },
        goDown(){
            if(this.activeItem < this.photos.length - 1){
                this.activeItem++;
            }else{
                this.activeItem = 0;
            }
        },
        stopInterval () {
                clearInterval(this.interval);
            },
        startInterval () {
            this.interval = setInterval(this.goDown, 5000);
        }
    },
    mounted:function(){
        this.interval=setInterval(this.goDown,5000)
    }

    
}
</script>

<style>

    .backimg{
        background-image: url("https://www.myistria.com/UserDocsImages/app/objekti/795/slika_hd/19082020034916_Villas-near-Rovinj-Villa-Prestige-2.jpg");
        height: 400px;
        background-size: cover;
        background-position: center;
    }

    .title{
        font-size: 32px ;
    }

    .radius{
        border-radius: 50%;
    }

    .btn_orange{
       background: linear-gradient(to right,#edc156 0%,#fea759 0%,#fea759 50%,#edc156 100%) no-repeat scroll right bottom/210% 100% #fea759;
    }

    .price{
        text-align: center;
        text-transform: capitalize;
    }

    /* .bg_blue{
        background-color: aqua;
        height: 200px;
        width: 300px;
    } */

    .img1{
        height: 500px;
        width: 900px;
    }

    .pt_7{
        padding-top: 9rem;
    }

    .bg_img2{
        background-image: url(https://wallpaperaccess.com/full/1126760.jpg);
        width:100%;
        height: 500px;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .bg_orange{
       background: linear-gradient(to right,#edc156 0%,#fea759 0%,#fea759 50%,#edc156 100%) no-repeat scroll right bottom/210% 100% #fea759;
    }

    .border-black{
        border: 1px solid black;
        border-radius:50%;
        padding: 10px;
    }

    .active_img{
        display: none;
    }

    .footer{
        background-color: rgb(30, 29, 29);
        height: auto;
    }


    .borderimg{
        border: 1px solid black;
        border-radius:50%;
        
    }

    .orange{
        color: orange;
        transition: 2s;
    }

    .orange:hover{
        cursor: pointer;
        color: orangered;
    }

    .imgfit{
        aspect-ratio: 2/1;
    }


    .credit{
        background-color: orange;
    }

    .w-10{
        width: 10%;
    }

    .w26rem{
        width: 26rem;
    }


    .instagram,
    .linkedin,
    .facebook:hover{
        cursor: pointer;
    }

    .font_satisy{
        font-size: 42px;
        font-family: 'Satisfy', cursive;
    }

    .font_monserrat{
        font-family: 'Montserrat', sans-serif;
    }

    @media screen and(max-width:576px) { 
        .margin-3{
            margin: 0 0 0   0;
        }
    }

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Satisfy&display=swap');



    
</style>
