async function render(all=true, mobile) {

    document.getElementById('map').innerHTML = '';
    let descriptionBlock = document.getElementById('description-section');
    descriptionBlock.style.display = "none";
    descriptionBlock.innerHTML = '';

    // get locations from server
    let markersFromServer;

    if (all) markersFromServer = await getMarker();
    else {
        markersFromServer = [await getMarker("one", mobile)];
        descriptionBlock.style.display = "block";
        let marker = markersFromServer[0];
        if (!!marker.id) {
            let description = '<div>';
            description += `<p>ID: ${marker.id}</p>`;
            description += `<p>Mobile: ${marker.mobile}</p>`;
            description += `<p>Description: ${marker.description}</p>`;
            description += `<p>Coordinates: ${marker.x}, ${marker.y}</p>`;
            description += '<p><button style="width: 200px;" class="btn btn-primary" onclick="render();"}>Clear</button></p>'
            description += '</div>';
            descriptionBlock.innerHTML = description;
        } else {
            alert(`Not found marker with mobile ${mobile}`);
            render();
            return;
        }
    };

    console.log(markersFromServer);

    const markersToMap = [] // in this array i'll set markers (Feauture object)

    for (let i = 0; i < markersFromServer.length; i++) {
        const current = markersFromServer[i];

        let marker = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([current.y, current.x], 'EPSG:4326', 'EPSG:3857')),
            mobile: current.mobile,
            description: current.description
        });

        markersToMap.push(marker);
    };

    // settings for map and marker style
    const vectorSource = new ol.source.Vector({
        features: markersToMap
    });
    
    const iconStyle = new ol.style.Style({
        image: new ol.style.Icon(({
          anchor: [0.5, 46],
          anchorXUnits: 'fraction',
          anchorYUnits: 'pixels',
          opacity: 1,
          src: '../marker.png'
        }))
    });
    
    const vectorLayer = new ol.layer.Vector({
        source: vectorSource,
        style: iconStyle
    });

    const map = new ol.Map({
        target: 'map',
        layers: [new ol.layer.Tile({source: new ol.source.OSM()}), vectorLayer],
        view: new ol.View({
            center: [0, 0],
            zoom: 0
        })
    });

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
};

render();
