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
    return hours + ":" + minutes + "<br>" + day + "/" + month + "/" + year;
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

        if (historyData[i].length > 25) {
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
  });
