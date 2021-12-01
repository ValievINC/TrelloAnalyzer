var xmlhttp = new XMLHttpRequest(); //для обмена данными между клиентом и сервером, можно юзать чтоб получить JSON файл
var url = "https://trello.com/b/XllYwyv4/%D1%82%D0%B5%D1%81%D1%82%D0%BE%D0%B2%D0%B0%D1%8F-%D0%B4%D0%BE%D1%81%D0%BA%D0%B0.json";
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
        MakeDiagrammThree();
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
            backgroundColor: 'rgba(153,51,204,1)',
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

    
function MakeDiagrammTwo(){
    const ctx = document.getElementById('myChart2').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: membersName,
            datasets: [{
            label: 'Распределение карточек по участникам',
            data: membersIdVar,
            backgroundColor: 'rgba(153,51,204,1)',
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
        
function MakeDiagrammThree(){
var ctx = document.getElementById("myChart3").getContext("2d");

var myChart = new Chart(ctx, {
  type: 'line',
  options: {
    scales: {
      x: {
          grid: {
              borderColor: 'red'
          }
      }
    }
  },
  data: {
    labels: ["2015-03-15T13:03:00Z", "2015-03-25T13:02:00Z", "2015-04-25T14:12:00Z"],
    datasets: [{
      label: 'допилю, еще не рабочая',
      data: [{
          t: '2015-03-15T13:03:00Z',
          y: 12
        },
        {
          t: '2015-03-25T13:02:00Z',
          y: 21
        },
        {
          t: '2015-04-25T14:12:00Z',
          y: 32
        }
      ],
      backgroundColor: 'rgba(153,51,204,1)',
      borderWidth: 1
    }]
  }
});
}