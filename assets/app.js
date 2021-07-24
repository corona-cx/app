/*
 * Welcome to your app's main JavaScript file!
 *npm config set "@fortawesome:registry" https://npm.fontawesome.com/
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import '@fortawesome/fontawesome-pro/js/all';
import '@fortawesome/fontawesome-pro/js/fontawesome.min';

// start the Stimulus application
import './bootstrap';

import LocateButton from './modules/LocateButton';

export {LocateButton};