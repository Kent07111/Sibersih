console.log("APP JS BERHASIL DIMUAT");

import "./bootstrap";
import Alpine from "alpinejs";
import heic2any from "heic2any";

window.heic2any = heic2any;
window.Alpine = Alpine;

Alpine.start();
