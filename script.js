// API для генерации текста
const RANDOM_QUOTE_API_URL_ENG = 'https://api.quotable.io/random'
const RANDOM_QUOTE_API_URL_RUS = 'https://fish-text.ru/get'

// Получение элемента по его ID
const quoteDisplayElement = document.getElementById('quoteDisplay')
const authorDisplayElement = document.getElementById('authorDisplay')
const lengthDisplayElement = document.getElementById('lengthDisplay')
const quoteInputElement = document.getElementById('quoteInput')
const lastTimeElement = document.getElementById('lastTime')
const speedElement = document.getElementById('typingSpeed')
const timerElement = document.getElementById('timer')
const lastError = document.getElementById('typingErrors')

// Получение переменных из PHP
let language = document.querySelector('.data-php').getAttribute('data-language')
let idUser = document.querySelector('.data-php').getAttribute('data-idUser')

let length
let author
let timerId
let isTimerStart = false
let errorCounter = 0

// Проверка на удаление для корректного подсчета ошибок
let oldValue = null;

// Функция для отслеживания нажатия кнопки Tab
//   и перезагрузке текста и таймера по ней
document.getElementById('body').addEventListener('keydown', function(event)
{
    if(['Tab'].includes(event.key))
    {
        event.preventDefault()
        isTimerStart = false
        errorCounter = 0

        clearInterval(timerId)
        timerElement.innerText = "Loading new quote..."
        renderNewQuote()
    }
})

// Отслеживание ввода букв в input
quoteInputElement.addEventListener('input', ()=>
{
    // Запуск таймера по началу печати
    if(!isTimerStart)
    {
        startTimer()
    }

    const arrayQuote = quoteDisplayElement.querySelectorAll('span')
    const arrayValue = quoteInputElement.value.split('')

    // console.log(arrayValue[arrayValue.length-1]);

    // Флаг для проверки правильности написания и отслеживания ошибки
    let correct = true
    let hasError = false

    arrayQuote.forEach((characterSpan, index) =>
    {
        const character = arrayValue[index]

        if(character == null)
        {
            characterSpan.classList.remove('correct')
            characterSpan.classList.remove('incorrect')
            correct = false
        }
        // В этом условии также учитывается написание
        //   написание е вместо ё и ковычка, которуя
        //   может создать проблему с написанием на 
        //   некоторых системах
        else if(character === characterSpan.innerText 
            || (character === "’" && characterSpan.innerText === "'") 
            || (character === "е" && characterSpan.innerText === "ё"))
        {
            characterSpan.classList.add('correct')
            characterSpan.classList.remove('incorrect')
        }
        else
        {
            characterSpan.classList.remove('correct')
            characterSpan.classList.add('incorrect')
            correct = false
            hasError = true
        }
    })

    // Отслеживание написания ошибки, а
    //   при стирании ее, уже созданные неверные
    //   символы не будут добавляться в общий
    //   счетчик
    if(hasError)
    {
        const newValue = quoteInputElement.value;
        const isDelete = oldValue && newValue.length < oldValue.length;
        if(!isDelete)
        {
            errorCounter++;
        }

        oldValue = newValue;
    }

    // Если ввели весь текст верно
    if(correct)
    {
        isTimerStart = false

        // Остановка таймера ( заданного функцией setInterval() )
        clearInterval(timerId)
        timerElement.innerText = "Good! Loading new quote..."

        // Получение точного времени и вывод на экран
        let time = getAccuracyTimerTime()
        lastTimeElement.innerText = time

        // Вычисление скорости печати и вывод на экран
        let speed = Math.floor(((length / time * 60) * 100) / 100)
        speedElement.innerText = speed

        // Подготовка сообщения к отправке на сервер
        // для добавления в БД
        let message = idUser + ";" + speed + ";" + language

        // Отправка сообщения файлу records_add.php через POST-запрос
        let xhr = new XMLHttpRequest()
        xhr.open("POST", 'components/records_add.php', true)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        xhr.send(JSON.stringify(message))

        // Получение сообщения от records_add.php
        xhr.onreadystatechange = function ()
        {
            // Если успешное получение, то вывод в консоль
            if(xhr.readyState === 4 && xhr.status == 200)
            {
                console.log(xhr.responseText)
            }
        }

        // Вывод на экран количество ошибок
        lastError.innerText = errorCounter
        errorCounter = 0

        // Генерация нового задания
        renderNewQuote()
    }
})

async function getRandomQuote()
{
    // Генерация текста из английского API
    if(language === "eng") {
        return fetch(RANDOM_QUOTE_API_URL_ENG)
            // => — стрелочная функция
            //  (что принимает) => {что возвращает} 
            .then(response => response.json())
            .then(data => {
                // сбор полезных сведений из API 
                //   (длина текста, автор, сам текст)
                length = data.length;
                author = data.author;
                return (data.content);
            })
    }
    // Генерация текста из русского API
    else
    {
        return fetch(RANDOM_QUOTE_API_URL_RUS)
            .then(response => response.json())
            .then(data => {
                // длину текста получаем с помощью свойства length
                length = data.text.length
                return(data.text)
            })
    }
}

// Функция генерации нового задания
async function renderNewQuote()
{
    // Запрет ввода в поле ввода текста
    quoteInputElement.setAttribute("readonly", "")
    // Получение нового текста из API, 
    //   при этом не продолжая выполнение скрипта (await)
    const quote = await getRandomQuote()
    // Отчистка экрана от прошлого текста
    quoteDisplayElement.innerText = ''

    // Разделение текста на символы
    quote.split('').forEach(character =>
    {
        const characterSpan = document.createElement('span')
        characterSpan.innerText = character
        quoteDisplayElement.appendChild(characterSpan)
    })

    if(language === 'eng')
    {
        // Вывод на экран автора
        authorDisplayElement.innerText = author;
    }
    // Вывод на экран длинны текста
    lengthDisplayElement.innerText = length
    // Отчистка поля ввода
    quoteInputElement.value = null
    // Разрешение печатать в поле ввода
    quoteInputElement.removeAttribute("readonly")
    // Оповещение пользователя о том, что задание подготовлено 
    //   и можно начинать печатать
    timerElement.innerText = "Start typing!"
}

// Переменная для отслеживания начала отсчета
let startTime

// Функция запуска таймера
function startTimer()
{
    isTimerStart = true
    // Обнуление таймера на странице
    timerElement.innerText = 0
    // Время начала отсчета
    startTime = new Date()
    // Регулярный вызов функций раз в 1000мс
    timerId = setInterval(() =>
    {
        // Вывод на экран значения функции подсчета времени
        timerElement.innerText = getTimerTime()
    }, 1000)
}

// Неточный таймер
function getTimerTime()
{
    return Math.floor((new Date() - startTime) / 1000)
}

// Точный таймер с тысячными долями секунды
function getAccuracyTimerTime()
{
    return (Math.floor((new Date() - startTime) * 10) / 10000)
}

// Стартовый вызов функции
renderNewQuote()