<?php


namespace App\Http\Messages;


class Constants
{
    const AVG_HAPPY = 'возможно стоит переформировать команду';
    const MAX_HAPPY = 'обратить внимание на лидера команды и выполнение его функций';
    const AVG_SAD = "если человеку не подошел коллектив, следует отправить в другую группу.\nвозможно у человека не задался день, следует обсудить это лично.";
    const MAX_SAD = "возможна депрессия, следует обратиться к специалистам.\nвозможно человек не до конца понял суть задания, следует обсудить теоретическую часть.";
    const AVG_FEAR = "обратить внимание на формулировку задачи.\nобратить внимание на наличие агрессора.\nобратить внимание на рабочее пространство.";
    const MAX_FEAR = 'стоит обратиться к специалисту, возможна психологическая нестабильность';
    const AVG_ANGRY = 'стоит обратить внимание на работоспособность человека';
    const MAX_ANGRY = "если человеку не подошел коллектив, следует отправить в другую группу\n\nвозможно у человека не задался день, следует обсудить это лично \n\nвозможно человек не приспособлен для работы в команде, следует либо отстранить его, либо отправить на соответсвующие курсы";
    const MAX_NEUTRAL = 'человек не заинтересован в процессе, испытывает скуку ';
    const MAX_SURPRISE = 'пожалуйста, выберите другое видео для анализа';

    const HAPPY = 'Радость';
    const SAD = 'Грусть';
    const FEAR = 'Страх';
    const ANGRY = 'Злость';
    const NEUTRAL = 'Нейтральность';
    const SURPRISE = 'Удивление(Не определено)';

}