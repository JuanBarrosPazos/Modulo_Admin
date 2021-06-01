function hora(){
    var fecha = new Date()
    
    var diames = fecha.getDate()
   
    var daytext = fecha.getDay()
    if (daytext == 0)
    daytext = "Domingo"
    else if (daytext == 1)
    daytext = "Lunes"
    else if (daytext == 2)
    daytext = "Martes"
    else if (daytext == 3)
    daytext = "Miercoles"
    else if (daytext == 4)
    daytext = "Jueves"
    else if (daytext == 5)
    daytext = "Viernes"
    else if (daytext == 6)
    daytext = "Sabado"
    
    var mes = fecha.getMonth() + 1
    
    var ano = fecha.getYear()
    
    if (fecha.getYear() < 2000) 
    ano = 1900 + fecha.getYear()
    else 
    ano = fecha.getYear()
    
    var hora = fecha.getHours()
    var minuto = fecha.getMinutes()
    var segundo = fecha.getSeconds()
    
    if(hora>=12 && hora<=23)
    m="P.M"
    else
    m="A.M"
    
    if (hora < 10) {hora = "0" + hora}
    if (minuto < 10) {minuto = "0" + minuto}
    if (segundo < 10) {segundo = "0" + segundo}
    
    var nowhora = daytext + " " + diames + " / " + mes + " / " + ano + " - " + hora + ":" + minuto + ":" + segundo
    document.getElementById('hora').firstChild.nodeValue = nowhora
    tiempo = setTimeout('hora()',1000)
    }
   