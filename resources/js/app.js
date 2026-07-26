console.log("APP JS BERHASIL DIMUAT");

import "./bootstrap";
import Alpine from "alpinejs";
import heic2any from "heic2any";
import Compressor from "compressorjs";
import "./pdf-viewer";
import "./image-uploader";

window.heic2any = heic2any;
window.Compressor = Compressor;
window.Alpine = Alpine;

Alpine.start();
