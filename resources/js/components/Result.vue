<template>
    <div>
        <div v-if="!mobile" class="all">
            <div class="content">
                <div class="content_header">
                    Результаты анализа
                </div>
                <div class="content_1">
                    <div class="content_1_header">
                        <div class="content_1_header_text">
                            Общая информация
                        </div>
                        <div class="content_1_header_line"></div>
                    </div>
                    <div class="content_1_main">
                        <div class="content_1_main_text">
                            <div class="content_1_main_header">
                                Данные о файле
                            </div>
                            <div class="content_1_main_text_description">
                                <div class="content_1_main_text_name">
                                    <a class="content_1_main_text_name_1">
                                        Название:
                                    </a>
                                    <a class="content_1_main_text_name_2">
                                        {{$parent.fileInfo.name}}
                                    </a>
                                </div>
                                <div class="content_1_main_text_format">
                                    <a class="content_1_main_text_format_1">
                                        Формат:
                                    </a>
                                    <a class="content_1_main_text_format_2">
                                        {{$parent.fileInfo.type}}
                                    </a>
                                </div>
                                <!--                            <div class="content_1_main_text_length">-->
                                <!--                                <a class="content_1_main_text_length_1">-->
                                <!--                                    Продолжительность:-->
                                <!--                                </a>-->
                                <!--                                <a class="content_1_main_text_length_2">-->
                                <!--                                    {{this.$refs.videoPlayer.duration}}-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="content_1_main_text_resolutions">-->
                                <!--                                <a class="content_1_main_text_resolutions_1">-->
                                <!--                                    Разрешение:-->
                                <!--                                </a>-->
                                <!--                                <a class="content_1_main_text_resolutions_2">-->
                                <!--                                    720p-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <div class="content_1_main_text_size">
                                    <a class="content_1_main_text_size_1">
                                        Размер:
                                    </a>
                                    <a class="content_1_main_text_size_2">
                                        {{($parent.fileInfo.size / 1024 / 1024).toFixed(2)}} МБ
                                    </a>
                                </div>
                            </div>
                            <div @click="downloadReport" class="content_1_main_text_PDF">
                                Загрузить отчёт в формате PDF
                            </div>
                        </div>
                        <div class="content_1_main_video">
                            <div class="content_1_main_video_text">
                                Предварительный просмотр
                            </div>
                            <!--                        <img class="content_1_main_video_1" src="static/imgs/pc_1.png">-->
                            <video :src="video" class="content_1_main_video_1" controls>
                                <p>Ваш браузер не поддерживает HTML5 видео. Используйте <a :href="video">ссылку на видео</a> для доступа.</p>
                            </video>
                            <!--                        <video>-->
                            <!--                            <source></source>-->
                            <!--                        </video>-->
                        </div>
                    </div>
                </div>
                <div class="content_2" ref="report">
                    <div class="content_2_header">
                        <div class="content_2_header_text">
                            Эмоциальный фон
                        </div>
                        <div class="content_2_header_line"></div>
                    </div>
                    <div class="content_2_one">
                        <div class="content_2_one_1">
                            <div class="content_2_one_1_first">
                                <div class="content_2_one_1_first_header">
                                    Эмоциальный спектр
                                </div>
                                <div class="content_2_one_1_first_chart">
                                    <canvas class="circle_chart" id="circle_chart" ref="circle_chart"></canvas>
                                    <!--                                <script>-->

                                    <!--                                </script>-->
                                </div>
                            </div>
                            <div class="content_2_one_1_second">
                                <div class="content_2_one_1_second_header_circles">
                                    <div class="content_2_one_1_second_header">
                                        Соотношение эмоций
                                    </div>
                                    <div class="content_2_one_1_second_circles">
                                        <div class="content_2_one_1_second_circle_1"></div>
                                        <div class="content_2_one_1_second_circle_2"></div>
                                        <div class="content_2_one_1_second_circle_3"></div>
                                    </div>
                                </div>
                                <div class="content_2_one_1_second_content">
                                    <div class="content_2_one_1_second_content_names">
                                        <div class="content_2_one_1_second_content_names_1">
                                            <div class="content_2_one_1_second_content_name_circle_1"></div>
                                            <div class="content_2_one_1_second_content_name">
                                                Радость
                                            </div>
                                            <div class="content_2_one_1_second_content_line_1_main">
                                                <div class="content_2_one_1_second_content_line_1" ref="happy"></div>
                                                <div class="content_2_one_1_second_content_line_1_bg" ref="happy_bg"></div>
                                            </div>
                                            <div class="content_2_one_1_second_content_proc" v-if="data">
                                                {{ data.datasets[0].data[0] }}%
                                            </div>
                                        </div>
                                        <div class="content_2_one_1_second_line"></div>
                                        <div class="content_2_one_1_second_content_names_1">
                                            <div class="content_2_one_1_second_content_name_circle_2"></div>
                                            <div class="content_2_one_1_second_content_name">
                                                Грусть
                                            </div>
                                            <div class="content_2_one_1_second_content_line_2_main">
                                                <div class="content_2_one_1_second_content_line_2" ref="sadness"></div>
                                                <div class="content_2_one_1_second_content_line_2_bg" ref="sadness_bg"></div>
                                            </div>
                                            <div class="content_2_one_1_second_content_proc" v-if="data">
                                                {{ data.datasets[0].data[1] }}%
                                            </div>
                                        </div>
                                        <div class="content_2_one_1_second_line"></div>
                                        <div class="content_2_one_1_second_content_names_1">
                                            <div class="content_2_one_1_second_content_name_circle_3"></div>
                                            <div class="content_2_one_1_second_content_name">
                                                Страх
                                            </div>
                                            <div class="content_2_one_1_second_content_line_3_main">
                                                <div class="content_2_one_1_second_content_line_3" ref="fear"></div>
                                                <div class="content_2_one_1_second_content_line_3_bg" ref="fear_bg"></div>
                                            </div>
                                            <div class="content_2_one_1_second_content_proc" v-if="data">
                                                {{ data.datasets[0].data[2] }}%
                                            </div>
                                        </div>
                                        <div class="content_2_one_1_second_line"></div>
                                        <div class="content_2_one_1_second_content_names_1">
                                            <div class="content_2_one_1_second_content_name_circle_4"></div>
                                            <div class="content_2_one_1_second_content_name">
                                                Злость
                                            </div>
                                            <div class="content_2_one_1_second_content_line_4_main">
                                                <div class="content_2_one_1_second_content_line_4" ref="anger"></div>
                                                <div class="content_2_one_1_second_content_line_4_bg" ref="anger_bg"></div>
                                            </div>
                                            <div class="content_2_one_1_second_content_proc" v-if="data">
                                                {{ data.datasets[0].data[3] }}%
                                            </div>
                                        </div>
                                        <div class="content_2_one_1_second_line"></div>
                                        <div class="content_2_one_1_second_content_names_1">
                                            <div class="content_2_one_1_second_content_name_circle_5"></div>
                                            <div class="content_2_one_1_second_content_name">
                                                Нейтральность
                                            </div>
                                            <div class="content_2_one_1_second_content_line_5_main">
                                                <div class="content_2_one_1_second_content_line_5" ref="pokerface"></div>
                                                <div class="content_2_one_1_second_content_line_5_bg" ref="pokerface_bg"></div>
                                            </div>
                                            <div class="content_2_one_1_second_content_proc" v-if="data">
                                                {{ data.datasets[0].data[4] }}%
                                            </div>
                                        </div>
                                        <div class="content_2_one_1_second_line"></div>
                                        <div class="content_2_one_1_second_content_names_1">
                                            <div class="content_2_one_1_second_content_name_circle_6"></div>
                                            <div class="content_2_one_1_second_content_name">
                                                (неопределено)
                                            </div>
                                            <div class="content_2_one_1_second_content_line_6_main">
                                                <div class="content_2_one_1_second_content_line_6" ref="nothing"></div>
                                                <div class="content_2_one_1_second_content_line_6_bg" ref="nothing_bg"></div>
                                            </div>
                                            <div class="content_2_one_1_second_content_proc" v-if="data">
                                                {{ data.datasets[0].data[5] }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_2_one_2">
                            <div class="content_2_one_2_header_circles">
                                <div class="content_2_one_2_header">
                                    Рекомендация
                                </div>
                                <div class="content_2_one_2_circles">
                                    <div class="content_2_one_2_circle_1"></div>
                                    <div class="content_2_one_2_circle_2"></div>
                                    <div class="content_2_one_2_circle_3"></div>
                                </div>
                            </div>
                            <div class="content_2_one_2_emotion">
                                <div :class="'content_2_one_1_second_content_name_circle_' + $parent.emotion.value.index"></div>
                                <div class="content_2_one_2_emotion_text">
                                    {{ $parent.emotion.value.name }}
                                </div>
                            </div>
                            <div class="content_2_one_2_text">
                                <div class="content_2_one_2_text_1">
                                    {{ $parent.report }}
                                </div>
                                <!--                            <div class="content_2_one_2_text_2">-->
                                <!--                                Возможно, вы сказали что-то не то, или ваши сотрудники склонны терять интерес к работе спустя какое-то время?-->
                                <!--                            </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="content_2_two">
                        <div class="content_2_two_1">
                            <div class="content_2_two_1_header">
                                Группа
                            </div>
                            <div class="content_2_two_text">
                                <div class="content_2_two_text_header">
                                    Обнаружено: {{$parent.countPerson}} человек
                                </div>
                                <!--                            <div class="content_2_two_text_main">-->
                                <!--                                <div class="content_2_two_text_1">1. Участник 1</div>-->
                                <!--                                <div class="content_2_two_text_2">2. Участник 2</div>-->
                                <!--                                <div class="content_2_two_text_3">3. Участник 3</div>-->
                                <!--                                <div class="content_2_two_text_4">4. Участник 4</div>-->
                                <!--                                <div class="content_2_two_text_5">5. Участник 5</div>-->
                                <!--                            </div>-->
                            </div>
                        </div>
                        <div class="content_2_two_2">
                            <div class="content_2_two_2_header">
                                Участники
                            </div>
                            <div class="content_2_two_2_main">
                                <div class="content_2_two_2_main_1">
                                    <a :href="videoImage" target="_blank"><img class="content_2_two_2_main_img" :src="videoImage"></a>
                                    <div class="content_2_two_2_main_text">
                                        Определено
                                    </div>
                                </div>
                                <!--                            <div class="content_2_two_2_main_2">-->
                                <!--                                <img class="content_2_two_2_main_img" src="static/imgs/member_2.png">-->
                                <!--                                <div class="content_2_two_2_main_text">-->
                                <!--                                    Участник 2-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                            <div class="content_2_two_2_main_3">-->
                                <!--                                <img class="content_2_two_2_main_img" src="static/imgs/member_3.png">-->
                                <!--                                <div class="content_2_two_2_main_text">-->
                                <!--                                    Участник 3-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                            <div class="content_2_two_2_main_4">-->
                                <!--                                <img class="content_2_two_2_main_img" src="static/imgs/member_4.png">-->
                                <!--                                <div class="content_2_two_2_main_text">-->
                                <!--                                    Участник 4-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                            <div class="content_2_two_2_main_5">-->
                                <!--                                <img class="content_2_two_2_main_img" src="static/imgs/member_5.png">-->
                                <!--                                <div class="content_2_two_2_main_text">-->
                                <!--                                    Участник 5-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                            <img class="content_2_two_main_plus" src="static/imgs/plus.png">-->
                            </div>
                        </div>
                    </div>
                    <!--                <div class="content_2_three">-->
                    <!--                    <div class="content_2_three_header">-->
                    <!--                        Динамика изменения эмоциального фона-->
                    <!--                    </div>-->
                    <!--                    <img class="content_2_three_chart" src="static/imgs/chart_3.png">-->
                    <!--                    <div class="content_2_three_time">-->
                    <!--                        Время-->
                    <!--                    </div>-->
                    <!--                </div>-->
                </div>
                <div class="content_3">
                    <div class="content_3_header">
                        <div class="content_3_header_line"></div>
                    </div>
                    <!--                <div class="content_3_main">-->
                    <!--                    <div class="content_3_1">-->
                    <!--                        Посмотреть рекомендации-->
                    <!--                    </div>-->
                    <!--                    <div class="content_3_2">-->
                    <!--                        Оценить работу системы-->
                    <!--                    </div>-->
                    <!--                    <div class="content_3_3">-->
                    <!--                        Сообщить об ошибке-->
                    <!--                    </div>-->
                    <!--                </div>-->
                </div>
            </div>
            <div class="footer">
                <div class="footer_text_1">
                    AS.SYST © 2022
                </div>
                <div class="footer_text_2">
                    ООО “ААС”
                </div>
            </div>
        </div>
        <div v-else class="mobile">
            <div class="mobile_content" ref="mobile_report">
                <div class="mobile_content_header">
                    Результаты анализа
                </div>
                <div class="mobile_content_line"></div>
                <div class="mobile_content_1">
                    <div class="mobile_content_header_circles">
                        <div class="mobile_content_1_header">
                            Эмоциальный спектр
                        </div>
                        <div class="mobile_content_circles">
                            <div class="mobile_content_circle_1"></div>
                            <div class="mobile_content_circle_2"></div>
                            <div class="mobile_content_circle_3"></div>
                        </div>
                    </div>
                    <div class="diagramma">
                        <canvas id="myChart" ref="circle_chart"></canvas>
                    </div>
                </div>
                <div class="mobile_content_line"></div>
                <div class="mobile_content_2_result">
                    <div class="mobile_content_header_circles">
                        <div class="mobile_content_1_header">
                            Соотношение эмоций
                        </div>
                        <div class="mobile_content_circles mobile_content_circles_1">
                            <div class="mobile_content_circle_1"></div>
                            <div class="mobile_content_circle_2"></div>
                            <div class="mobile_content_circle_3"></div>
                        </div>
                    </div>
                    <div class="mobile_content_2_content">
                        <div class="mobile_content_2_content_1_2">
                            <div class="mobile_content_2_content_1">
                                <div class="mobile_content_2_content_1_circle"></div>
                                <div class="mobile_content_2_content_text_1">
                                    <div class="mobile_content_2_content_1_header">
                                        Радость
                                    </div>
                                    <div class="mobile_content_2_content_proc">
                                        {{ mobileResult.happy }}%
                                    </div>
                                </div>
                            </div>
                            <div class="mobile_content_2_content_2">
                                <div class="mobile_content_2_content_2_circle"></div>
                                <div class="mobile_content_2_content_text_2">
                                    <div class="mobile_content_2_content_2_header">
                                        Грусть
                                    </div>
                                    <div class="mobile_content_2_content_proc">
                                        {{ mobileResult.sadness }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile_content_2_content_3_4">
                            <div class="mobile_content_2_content_3">
                                <div class="mobile_content_2_content_3_circle"></div>
                                <div class="mobile_content_2_content_text_3">
                                    <div class="mobile_content_2_content_3_header">
                                        Страх
                                    </div>
                                    <div class="mobile_content_2_content_proc">
                                        {{ mobileResult.fear }}%
                                    </div>
                                </div>
                            </div>
                            <div class="mobile_content_2_content_4">
                                <div class="mobile_content_2_content_4_circle"></div>
                                <div class="mobile_content_2_content_text_4">
                                    <div class="mobile_content_2_content_4_header">
                                        Злость
                                    </div>
                                    <div class="mobile_content_2_content_proc">
                                        {{ mobileResult.anger }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile_content_2_content_5_6">
                            <div class="mobile_content_2_content_5">
                                <div class="mobile_content_2_content_5_circle"></div>
                                <div class="mobile_content_2_content_text_5">
                                    <div class="mobile_content_2_content_5_header">
                                        Нейтральность
                                    </div>
                                    <div class="mobile_content_2_content_proc">
                                        {{ mobileResult.pokerface }}%
                                    </div>
                                </div>
                            </div>
                            <div class="mobile_content_2_content_6">
                                <div class="mobile_content_2_content_6_circle"></div>
                                <div class="mobile_content_2_content_text_6">
                                    <div class="mobile_content_2_content_6_header">
                                        Не распознано
                                    </div>
                                    <div class="mobile_content_2_content_proc">
                                        {{ mobileResult.nothing }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile_content_line_2"></div>
                <div class="mobile_content_5">
                    <div class="mobile_content_5_header_em">
                        <div class="mobile_content_1_header mobile_content_5_header">
                            Рекомендации
                        </div>
                        <div class="mobile_content_5_em">
                            <div ref="emotion_circle"></div>
                            <div class="mobile_content_2_content_text_1">
                                <div class="mobile_content_2_content_1_header">
                                    {{ $parent.emotion.value.name}}
                                </div>
                                <div class="mobile_content_2_content_proc">
                                    {{ getMaxEmotion($parent.emotion.name) }} %
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile_content_5_text">
                        <div class="mobile_content_5_text_1">
                            {{$parent.report}}
                        </div>
<!--                        <div class="mobile_content_5_text_2">-->
<!--                            Возможно, вы сказали что-то не то, или ваши сотрудники склонны терять интерес к работе спустя какое-то время?-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="mobile_content_line"></div>
                <div class="mobile_content_3">
                    <div class="mobile_content_3_header_text">
                        <div class="mobile_content_3_header">
                            Группа
                        </div>
                        <div class="mobile_content_3_text">
                            Обнаружено: {{ $parent.dataset.countPerson}} человек
                        </div>

                    </div>
                    <div class="mobile_content_3_content">
                        <a :href="videoImage" target="_blank"><img style="width: 30%" :src="videoImage"></a>
                        <div class="mobile_content_3_circle_1_result">
                            <img class="mobile_content_3_circle_result" src="static/imgs/pic_1.png">
                        </div>
                    </div>
                </div>
                <div class="mobile_content_line"></div>
                <div class="mobile_content_4">
                    <div class="mobile_content_1_header">
                        Результаты
                    </div>
                    <div class="mobile_content_4_content">
                        <div class="mobile_content_4_content_1" @click="goToForm">
                            <img class="mobile_content_4_content_img mobile_content_4_content_img_1" src="static/imgs/pic_3.png">
                            <div class="mobile_content_4_content_text">
                                Оцените работу системы
                            </div>
                        </div>
                        <div class="mobile_content_line_1"></div>
                        <div class="mobile_content_4_content_1" @click="downloadMobileReport">
                            <img class="mobile_content_4_content_img mobile_content_4_content_img_2" src="static/imgs/pic_4.png">
                            <div class="mobile_content_4_content_text mobile_content_4_content_text_1">
                                Загрузить отчёт в формате PDF
                            </div>
                        </div>
                        <div class="mobile_content_line_1"></div>
                        <div class="mobile_content_4_content_1" @click="goToForm">
                            <img class="mobile_content_4_content_img mobile_content_4_content_img_1" src="static/imgs/pic_5.png">
                            <div class="mobile_content_4_content_text">
                                Сообщить об ошибке
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile_footer">
                <div class="mobile_footer_text mobile_footer_text_1">
                    AS.SYST © 2023
                </div>
                <div class="mobile_footer_text mobile_footer_text_2">
                    ООО “АСИСТЕМА”
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import html2pdf from 'html2pdf.js'
    export default {
        data () {
            return {
                data: null,
                result: null,
                mobileResult: {
                    happy: 0,
                    sadness: 0,
                    fear: 0,
                    anger: 0,
                    pokerface: 0,
                    nothing: 0
                }
            }
        },

        props: ['video', 'videoImage', 'mobile'],

        watch: {
            'this.$parent.dataset': {
                deep: true,
                handler: function (val) {
                    console.log(val)
                }
            }
        },

        methods: {
            loadCircle() {
                this.result = this.$parent.dataset.result
                var ctx = this.$refs['circle_chart'].getContext('2d');

                var data = {
                    datasets: [{
                        data: this.result,
                        backgroundColor: ['#FF784C', '#0077FF', '#D74CFA', '#F76672', '#858585', '#64CB54']
                    }]
                };

                this.data = data

                if (this.mobile) {
                    this.mobileResult.happy = Math.round(data.datasets[0].data[0])
                    this.mobileResult.sadness = Math.round(data.datasets[0].data[1])
                    this.mobileResult.fear = Math.round(data.datasets[0].data[2])
                    this.mobileResult.anger = Math.round(data.datasets[0].data[3])
                    this.mobileResult.pokerface = Math.round(data.datasets[0].data[4])
                    this.mobileResult.nothing = Math.round(data.datasets[0].data[5])
                } else {
                    this.$refs.happy.style.width = data.datasets[0].data[0] + '%'
                    this.$refs.happy_bg.style.width = (100 - data.datasets[0].data[0]) + '%'

                    this.$refs.sadness.style.width = data.datasets[0].data[1] + '%'
                    this.$refs.sadness_bg.style.width = (100 - data.datasets[0].data[1]) + '%'

                    this.$refs.fear.style.width = data.datasets[0].data[2] + '%'
                    this.$refs.fear_bg.style.width = (100 - data.datasets[0].data[2]) + '%'

                    this.$refs.anger.style.width = data.datasets[0].data[3] + '%'
                    this.$refs.anger_bg.style.width = (100 - data.datasets[0].data[3]) + '%'

                    this.$refs.pokerface.style.width = data.datasets[0].data[4] + '%'
                    this.$refs.pokerface_bg.style.width = (100 - data.datasets[0].data[4]) + '%'

                    this.$refs.nothing.style.width = data.datasets[0].data[5] + '%'
                    this.$refs.nothing_bg.style.width = (100 - data.datasets[0].data[5]) + '%'
                }

                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: {
                        cutout: '70%',
                        legend: {
                            display: false
                        }
                    }
                });

                const colors = [
                    {
                        class: 'mobile_content_2_content_1_circle',
                        color: '#FF784C'
                    },
                    {
                        class: 'mobile_content_2_content_2_circle',
                        color: '#0077FF'
                    },
                    {
                        class: 'mobile_content_2_content_3_circle',
                        color: '#D74CFA'
                    },
                    {
                        class: 'mobile_content_2_content_4_circle',
                        color: '#F76672'
                    },
                    {
                        class: 'mobile_content_2_content_5_circle',
                        color: '#7C7B7B'
                    },
                    {
                        class: 'mobile_content_2_content_6_circle',
                        color: '#35BE1F'
                    }
                ]

                const emotionObj = colors[this.$parent.emotion.value.index - 1]

                let circle = this.$refs.emotion_circle
                circle.classList.add(emotionObj.class)
                let elements = document.getElementsByClassName(emotionObj.class)
                elements.forEach(function (circle) {
                    circle.style.backgroundColor = emotionObj.color
                })
            },

            downloadReport () {
                html2pdf(this.$refs.report, {
                    margin: 2,
                    filename: 'report.pdf'
                })
            },

            downloadMobileReport () {
                let reportDom = this.$refs.mobile_report
                reportDom.removeChild(reportDom.getElementsByClassName('mobile_content_4')[0])
                html2pdf(reportDom, {
                    margin: 10,
                    filename: 'report.pdf'
                })
            },

            getMaxEmotion(name) {
                return this.mobileResult[name]
            },

            goToForm() {
                this.$parent.showHome = true
                this.$parent.toForm = true
                this.$parent.showResult = false

            }
        },

        mounted() {
            this.loadCircle()
            window.scrollTo(0, 0)
        }
    }
</script>
