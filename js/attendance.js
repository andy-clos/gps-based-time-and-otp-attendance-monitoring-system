/*
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

GEOLOCATION DETECTION (JAVASCRIPT)

BY  : ANDYCLOS A/L BOON MEE (01DDT20F1007)
      OOI YONG HERN (01DDT20F1042)
      CHIN LI XIN (01DDT20F1047)
*/

const button = document.querySelector(".location");

button.addEventListener("click", () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onSuccess, onError);
    } else {
        alert("Your browser doesn't support location");
    }
});

function onSuccess(position) {
    let {
        latitude,
        longitude
    } = position.coords;
    fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${api_key}`)
        .then(response => response.json()).then(result => {
            let currentLocation = result.results[0].components;
            let {
                city,
                state,
                country
            } = currentLocation;
            //document.write(`${city}, ${state}, ${country}`);
            document.getElementById("currentLocation").value = `${city}, ${state}, ${country}`;
        }).catch(() => {
            alert("Something went wrong");
        })
}

function onError(error) {
    if (error.code == 1) {
        alert("Please allow location access");
    } else if (error.code == 2) {
        alert("Location not available");
    } else {
        alert("Error");
    }
}