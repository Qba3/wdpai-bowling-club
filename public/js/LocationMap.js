mapboxgl.accessToken = 'pk.eyJ1IjoicWJhMzMxIiwiYSI6ImNtOGRoNmZiejI4OHAycnM4MXFxOTJsaDEifQ.3Uys3fkgmPBlhCOQ5xvqug';
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [19.9430, 50.0720], // PK
    zoom: 17,
});

document.querySelector('.mapboxgl-control-container').remove();