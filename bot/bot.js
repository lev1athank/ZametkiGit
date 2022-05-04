
const TelegramApi = require('node-telegram-bot-api')
const mysql = require('mysql');

const token = '5104688774:AAFZr02MVqTE3shadMVbxQ9c-t9JIWOo_BE'
const bot = new TelegramApi(token, {polling: true})

//npm run dev
const conn = mysql.createConnection({
    host: 'localhost',
    user: 'leviathan',
    database: 'zametki',
    password: 'nekitos31'
})
conn.connect( err=> {
    if(err) {
        return err;
    }else{
        console.log('connect')
    }
})



User_id = 804206736
const select = 'SELECT * FROM leviathan.zametki WHERE date = "' + new Date().toLocaleDateString().split(".").reverse().join("-") + '"';
const sendToUser = 'UPDATE leviathan.zametki SET sendToUser = 1 WHERE id ='
setInterval(()=>{


conn.query(select, (err, result) => {
    result.forEach(element => {
        if(element['sendToUser'] == 0) {

            const firstDate = new Date().toLocaleTimeString();
            const secondDate = element['time'];
                        
            let getDate = (string) => new Date(0, 0,0, string.split(':')[0], string.split(':')[1]); //получение даты из строки (подставляются часы и минуты
            const different = (getDate(secondDate) - getDate(firstDate));
            
            let hours = Math.floor((different % 86400000) / 3600000);
            let minutes = Math.round(((different % 86400000) % 3600000) / 60000);
            if(hours == 0 && minutes <= 30) {
                sendTask(element)
            }
            }
            
            
    });

})

function sendTask(task) {
    conn.query(sendToUser + task['id'])
    bot.sendMessage(User_id, `на сегодня в ${task['time'].split(":").splice(0,2).join(":")} запланировано \n«${task['content']}»`)
} 
}, 1000 * 60)

















