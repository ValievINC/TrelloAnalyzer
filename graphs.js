var xmlhttp = new XMLHttpRequest(); //для обмена данными между клиентом и сервером, можно юзать чтоб получить JSON файл
var url = teamUrl + ".json";
console.log(url);
var tableIDName = [];
var tableID = [];
var cards = [];
var cardsNames = [];
var tableIdVar = [];
var members = [];
var membersName = [];
var membersIdVar = [];
var item;

xmlhttp.open("GET",url,true); //инициализируем объект JSON
xmlhttp.send(); //отправка на веб сервер
xmlhttp.onreadystatechange = function(){ //проверка на то что данным успешно получены (readystate == 4, 4 это типо все шик, и 
    if(this.readyState == 4 && this.status == 200){         //status == 200 значит на веб сервер успешно что-то пришло
        var data = JSON.parse(this.responseText);
        cardsName(data); //достаю из JSON файла все приколы, все данные там как массивы из которых достаешь что тебе надо
        tableName(data);
        membersInfo(data);
        console.log(data);
        MakeDiagrammOne(); //диаграмки через CHARTJS, через Google Chart не разобрался, зато ChartJS можно что-то помутить
        MakeDiagrammTwo();
        MakeDiagrammThree(generateRanges(datamakes(data)[datamakes(data).length-1],datamakes(data)[0]),generatedatas(datamakes(data),generateRanges(datamakes(data)[datamakes(data).length-1],datamakes(data)[0])));
    }
}

function randomItem(){
    item = cards[Math.floor(Math.random()*cards.length)]; // random card item
    console.log(item.shortUrl)
    window.open(item.shortUrl);
}


window.addEventListener('load', function () {
document.getElementById('GetrandomItem').addEventListener('click', randomItem, false);
}, false);


function cardsName(data){
        for (let i = 0; i < data.cards.length; i++)
        {
            cards.push(data.cards[i])
            cardsNames.push(data.cards[i].name);
        }
}


function tableName(data){
        for (let i = 0; i < data.lists.length; i++)
        {
            if (data.lists[i].closed != true){
                tableIDName.push(data.lists[i].name);
                tableID.push(data.lists[i].id);
            }
        }
        for (let i = 0; i < tableID.length; i++){
            for (let j = 0; j < cardsNames.length; j++){
                if (tableID[i] == data.cards[j].idList)
                {
                    if (isNaN(tableIdVar[i]))
                    {
                        tableIdVar[i] = 0;
                    }
                    tableIdVar[i]++;
                }
            }
        }
}     


function membersInfo(data){
        for (let i = 0; i < data.members.length; i++)
        {
            members.push(data.members[i].id);
            membersName.push(data.members[i].fullName);
        }
        for (let i = 0; i < members.length; i++){
            for (let j = 0; j < cardsNames.length; j++){
                for (let k = 0; k < data.cards[j].idMembers.length; k++)
                {
                    if (members[i] == data.cards[j].idMembers[k])
                    {
                        if (isNaN(membersIdVar[i]))
                        {
                            membersIdVar[i] = 0;
                        }
                        membersIdVar[i]++;
                        
                    }
                }
            }
        }
}


function MakeDiagrammOne(){
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tableIDName,
            datasets: [{
            label: 'Распределение карточек по столбикам',
            data: tableIdVar,
            backgroundColor: 'rgba(45, 131, 209, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
                }
            }
        }
    });
}

    
function randColor(colorsL) {
    var COLORS = [];
    for (var i = 0; i < colorsL; i++) {
        COLORS.push('#' + rand(0,150).toString(16) + (131).toString(16) + (209).toString(16)); 
    }
    return COLORS;
}


function rand(frm, to) {
    return ~~(Math.random() * (to - frm)) + frm;
}
      

function MakeDiagrammTwo(){
    const ctx = document.getElementById('myChart2').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: membersName,
            datasets: [{
            label: 'Распределение карточек по участникам',
            data: membersIdVar,
            backgroundColor: randColor(membersName.length),
            borderWidth: 1,
            }]
        },
        options: {
        
        }
    });
}


function MakeDiagrammThree(data,data1) {
    var ctx = document.getElementById("myChart3").getContext("2d");
    var myChart = new Chart(ctx, {
      type: 'line',
      options: {
        scales: {
          x: {
              grid: {
                  borderColor: 'red',
              }
          }
        }
      },
      data: {
        labels: data,
        datasets: [{
          label: 'График добавления карточек',
          data: data1,
          backgroundColor: 'rgba(45, 131, 209, 1)',
          borderWidth: 1
        }]
      }
    });
}


function datamakes(data) {      
    var newDate = ""  
    var constructor = [];
    var newconstructor = [];
    var temp1 = [];
    var newcons = [];
    var dates = [];
    for (let i = 0; i < data.actions.length; i++) {
        if (data.actions[i].type == "createCard") {
            constructor.push(data.actions[i].date.substr(0,10).split('-'));
        }
    }
    for (let j = 0; j < constructor.length; j++) {  
        for (let k = 0; k < constructor[j].length; k++) {
            var temp = 0;
            newDate += constructor[j][k] + "/"
        }        
    }
    for (let g = 0; g < newDate.length-1; g+=11) {
            newconstructor.push(newDate.substring(g,g+10));
    }
    return newconstructor;
}


function generateRanges(startDate, endDate) {
    var arr = [];
    var temparr = [];
    var temparr1 = [];
    let current = moment(startDate, 'YYYY/MM/DD');
    const end = moment(endDate, 'YYYY/MM/DD');
    const daysByMonth = {};

    while (current <= end) {
        var month = current.month();
        var key = `${current.year()}${current.month()}`;
        var date = current.date();

        if (date < 10) {
            date = "0" + date;
        }

        if (month < 10) {
            month = "0" + month;
        }

        if (key in daysByMonth) {
            daysByMonth[key].dates.push(`${current.year()}` + '-' + month + '-' + date);
            arr.push(`${current.year()}` + '-' + month + '-' + date)
        }

        else {
            daysByMonth[key] = {
            dates: [`${current.year()}` + '-' + month + '-' + date],
            }
        }
        current.add(7, 'days');

        arr.push(daysByMonth[key].dates);
        for (let i = 0; i < arr.length; i++) {
            for (let j = 0; j < arr[i].length; j++) {
                if (!temparr.includes(arr[i][j]) && (arr[i][j].length > 2)) {
                    temparr.push(arr[i][j]);
                }
            }
        }
    }

    String.prototype.replaceAt = function(index, replacement) {
            return this.substr(0, index) + replacement + this.substr(index + replacement.length);
    }

    for (let k = 0; k < temparr.length; k++) {
        var normalMonth = parseInt(temparr[k].substring(5,7)) + 1;
        if (normalMonth < 10) {
            normalMonth = "0" + normalMonth + "-" + temparr[k].slice(temparr[k].length-2,temparr[k].length);
            temparr1.push(temparr[k].replaceAt(5,normalMonth.toString()));
        }
        if (normalMonth >= 10) {
        temparr1.push(temparr[k].replaceAt(5,normalMonth.toString()));
        }
        
    }
    return temparr1;
}


function generatedatas(data,xLabels)
{
    var counter = 0;
    var cont = [];
    for (var i = 0; i < xLabels.length; i++)
    {
        xLabels[i] = xLabels[i].replace(new RegExp('-','g'),'/');
    }
    for (var i = 0; i < data.length; i++)
    {
        for (var j = 0; j < xLabels.length-1; j++)
        {
            if (isNaN(cont[j]))
                {
                    cont[j] = 0;
                }
            if (data[i] <= xLabels[j+1] && data[i] >= xLabels[j])
            {
                cont[j]++
            }
        }
    }
    cont.unshift(0);
    return cont;   
}