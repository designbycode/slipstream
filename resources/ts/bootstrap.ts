import axios from "axios";
import "cropperjs/dist/cropper.css";
import Cropper from "cropperjs";

declare global {
    interface Window {
        axios: any;
        Cropper: any;
    }
}

window.axios = axios;
window.Cropper = Cropper;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
