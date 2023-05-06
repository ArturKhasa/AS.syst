<template>
    <div>
        <div class="header">
            <div v-if="showHome" class="header_content">
                <div class="link_header_content_left">
                    <div class="img_logo">
                        <div class="img_logo_1"></div>
                        <div class="img_logo_2"></div>
                        <div class="img_logo_3"></div>
                    </div>
                </div>
                <div class="link_header_content_center">
                    <a class="text_logo">AS.SYST</a>
                    <a class="FAQ_header">FAQ</a>
                    <a class="main_header_top"></a>
                    <a class="main_header">Главная</a>
                    <a v-if="showHeaderResult" class="results_header_main" @click="showHome = false">Результаты</a>
                    <a class="main_header_bottom"></a>
                </div>
            </div>

            <div v-if="showResult" class="header">
                <div class="header_content">
                    <div class="img_logo">
                        <div class="img_logo_1"></div>
                        <div class="img_logo_2"></div>
                        <div class="img_logo_3"></div>
                    </div>
                    <a class="text_logo">AS.SYST</a>
                    <a class="FAQ_header">FAQ</a>
                    <a class="main_header" @click="showHome = true">Главная</a>
                    <a class="results_header_top"></a>
                    <a class="results_header">Результаты</a>
                    <a class="results_header_bottom"></a>
                </div>
            </div>
        </div>
        <home v-if="showHome" :mobile="isMobile"></home>
        <result v-else :video="video" :video-image="videoImage"></result>
    </div>
</template>

<script>
    import Result from './Result.vue'
    import Home from "./Home";
    export default {
        data() {
            return {
                showHome: true,
                showResult: false,
                showHeaderResult: false,
                dataset: null,
                video: null,
                videoImage: null,
                report: null,
                emotion: null,
                countPerson: null,
                isMobile: null,
                fileInfo: {
                    name: null,
                    size: null,
                    type: null
                }
            }
        },

        components: {Result, Home},

        watch: {
            showHome(val) {
                this.showResult = !val;
            }
        },

        mounted() {
            this.isMobile = window.innerWidth < 590
        }
    }
</script>
