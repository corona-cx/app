import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
const routes = require('../../public/js/fos_js_routes.json');

export default class LocateButton {
    constructor(buttonElement) {

        Routing.setRoutingData(routes);
        if (!navigator.geolocation) {
            buttonElement.style.display = 'none';
        }

        buttonElement.addEventListener('click', button => {
            navigator.geolocation.getCurrentPosition(
position => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                const route = Routing.generate('display_coords', {
                    latitude: latitude,
                    longitude: longitude
                });

                window.location = route;
            },
    error => {
                alert('Dein Aufenthaltsort konnte leider nicht automatisch ermittelt werden.');
                console.error(error);
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const locateButtonList = document.querySelectorAll('.locate-position');

    locateButtonList.forEach((button) => {
        new LocateButton(button);
    });
});
