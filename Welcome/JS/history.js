let historyDataStorageUser = {
    Name: null,
    Value: null
} 
let CACHE_KEY = "HISTORY_E-PERPUS_MEJAYAN";
function checkForStorage(){
    return typeof(Storage) !== "undefined"
}
function date() {
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    return hours + ":" + minutes + "\n" + day + "/" + month + "/" + year;
  }

// push ke local storage
function putHistory(data,i) {
    if (checkForStorage) {
        let historyData = null;
        if (localStorage.getItem(CACHE_KEY) === null) {
            historyData = [
                [],
                []
            ];
        localStorage.setItem(CACHE_KEY, JSON.stringify(historyData[i]));
        } else {
            historyData = JSON.parse(localStorage.getItem(CACHE_KEY));
        }

        historyData[i].unshift(data);

        if (historyData[i].length > 100) {
            historyData[i].pop();
        }

        localStorage.setItem(CACHE_KEY, JSON.stringify(historyData));
    }
}
// add masuk
function putData() {
    historyDataStorageUser = {
        enterName: "masuk",
        enterValue: date()
    }
    if(!localStorage.getItem(CACHE_KEY + "(visited)")){
        putHistory(historyDataStorageUser,0);
        localStorage.setItem(CACHE_KEY + "(visited)", true)
    }
}
putData();
// add keluar
window.addEventListener('beforeunload', function(event) {
    historyDataStorageUser = {
        outName: "keluar",
        outValue: date()
    }
    if(localStorage.getItem(CACHE_KEY + "(visited)")){
    putHistory(historyDataStorageUser,1);
    }
    localStorage.removeItem(CACHE_KEY + "(visited)");
    renderHistory();
  });

let storages = localStorage.getItem("HISTORY_E-PERPUS_MEJAYAN");
let item = JSON.parse(storages);
let lengthItem = item[1].length;

function showHistory() {
    if (checkForStorage()) {
        return JSON.parse(localStorage.getItem("HISTORY_E-PERPUS_MEJAYAN"))[0] || [];
    } else {
        return [];
    }
}

function renderHistory() {
    const historyData = showHistory();
    let historyList = document.querySelector("#isi-data .data table tbody");


    // selalu hapus konten HTML pada elemen historyList agar tidak menampilkan data ganda
    historyList.innerHTML = "";


    for (let history of historyData) {
        let row = document.createElement('tr');
        row.innerHTML = "<td>" + history.enterValue + "</td>";


        historyList.appendChild(row);
    }
}