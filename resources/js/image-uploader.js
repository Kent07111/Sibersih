import Compressor from "compressorjs";
import heic2any from "heic2any";

window.ImageUploader = {
    async process(file) {
        // ======================
        // HEIC
        // ======================

        if (file.name.match(/\.(heic|heif)$/i)) {
            const blob = await heic2any({
                blob: file,

                toType: "image/jpeg",

                quality: 0.9,
            });

            file = new File(
                [blob],

                file.name.replace(/\.(heic|heif)$/i, ".jpg"),

                {
                    type: "image/jpeg",
                },
            );
        }

        // ======================
        // Compress
        // ======================

        return new Promise((resolve) => {
            new Compressor(file, {
                quality: 0.8,

                mimeType: "image/webp",

                maxWidth: 1600,

                success(result) {
                    resolve(
                        new File(
                            [result],

                            file.name.replace(/\.[^.]+$/, ".webp"),

                            {
                                type: "image/webp",
                            },
                        ),
                    );
                },
            });
        });
    },
};
