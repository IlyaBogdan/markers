var map = document.getElementById('map');
map.width = 800;
map.height = 550;
ctx = map.getContext('2d');

function drawMarker(x, y) {

    // нормализация координат
    x += 180;
    y += 90;

    x = map.width / 360 * x;
    y = map.height / 180 * y;

    // отрисовка
    ctx.beginPath();
    ctx.arc(x, y, 5, 0, Math.PI*2, false);
    ctx.strokeStyle = "red";
    ctx.fillStyle = "red";
    ctx.fill();
    ctx.closePath();
}

async function getMarker(mode="all", mobile) {

    if (mode == "all") APIurl = `http://localhost:8000/api/all`;
    if (mode == "one") APIurl = `http://localhost:8000/api/find/${mobile}`;

    let result = $.ajax({ 
        url: APIurl,
        method: "GET",
        dataType: "json",
    }).done((response) => {
        return response;
    });

    return await result;
}

async function drawMarkers(mode="all", mobile){
    getMarker(mode, mobile).then((markers) => {
        console.log(markers);
        ctx.clearRect(0, 0, map.width, map.height);

        if (mode == "one") {
            drawMarker(markers.x, markers.y);
            description  = `<p><b>ID: </b>${markers.id}<p>`;
            description += `<p><b>Mobile: </b>${markers.mobile}<p>`;
            description += `<p><b>Description: </b>${markers.description}<p>`;
            description += `<p><b>Coordinates: </b>${markers.x} ${markers.y}<p>`;
            descriptionElement = document.getElementById('description-section');
            descriptionElement.style.display = "block";
            descriptionElement.innerHTML = description;
        }

        for (let i = 0; i < markers.length; i++) {
            let marker = markers[i];
            drawMarker(marker.x, marker.y);
        }
    })
}

drawMarkers();
