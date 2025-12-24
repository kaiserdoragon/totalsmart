import imagemin from "imagemin";
import imageminMozjpeg from "imagemin-mozjpeg";
import imageminPngquant from "imagemin-pngquant";
import imageminSvgo from "imagemin-svgo";
import { glob } from "glob";
import fs from "fs/promises";
import path from "path";

const SOURCE_DIR = "img";
const DEST_DIR = "dist";

async function compressImages() {
  try {
    // Create destination directory if it doesn't exist
    await fs.mkdir(DEST_DIR, { recursive: true });

    const files = await glob(`${SOURCE_DIR}/**/*.{jpg,png,svg}`);

    for (const file of files) {
      const destinationPath = path.join(DEST_DIR, path.relative(SOURCE_DIR, file));
      await fs.mkdir(path.dirname(destinationPath), { recursive: true });

      const originalSize = (await fs.stat(file)).size;

      const compressedFiles = await imagemin([file], {
        destination: path.dirname(destinationPath),
        plugins: [
          imageminMozjpeg({ quality: 80 }),
          imageminPngquant({ quality: [0.6, 0.8] }),
          imageminSvgo(),
        ],
      });

      if (compressedFiles.length > 0) {
        const compressedSize = (await fs.stat(compressedFiles[0].destinationPath)).size;
        console.log(
          `Compressed: ${file} (${originalSize} bytes) -> ${compressedFiles[0].destinationPath} (${compressedSize} bytes)`
        );
      }
    }
    console.log("Image compression complete.");
  } catch (error) {
    console.error("Error during image compression:", error);
  }
}

compressImages();
